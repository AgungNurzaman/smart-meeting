<?php

include '../../config/database.php';

// DATA KARYAWAN
$karyawan = mysqli_query($conn,
"SELECT * FROM m_karyawan");

// DATA RUANGAN
$ruangan = mysqli_query($conn,
"SELECT * FROM m_ruangan");


// PROSES SIMPAN
if(isset($_POST['simpan'])){

    $id_karyawan = $_POST['id_karyawan'];
    $id_ruang    = $_POST['id_ruang'];
    $tanggal     = $_POST['tanggal'];
    $mulai       = $_POST['mulai'];
    $selesai     = $_POST['selesai'];
    $agenda      = $_POST['agenda'];

    // VALIDASI JAM
    if($selesai < $mulai){

        echo "
        <script>

            alert(
            'Jam selesai tidak boleh lebih kecil dari jam mulai'
            );

            window.location='tambah.php';

        </script>
        ";

        exit;
    }


    // VALIDASI BENTROK RUANGAN
    $cek = mysqli_query($conn,"
        SELECT *
        FROM t_booking

        INNER JOIN m_karyawan
        ON t_booking.id_karyawan =
        m_karyawan.id_karyawan

        WHERE id_ruang='$id_ruang'
        AND tanggal_rapat='$tanggal'

        AND (

            ('$mulai'
            BETWEEN jam_mulai
            AND jam_selesai)

            OR

            ('$selesai'
            BETWEEN jam_mulai
            AND jam_selesai)

            OR

            (jam_mulai
            BETWEEN '$mulai'
            AND '$selesai')

        )
    ");


    // JIKA RUANGAN BENTROK
    if(mysqli_num_rows($cek) > 0){

        $bentrok =
        mysqli_fetch_array($cek);

        echo "
        <script>

            alert(
            'Maaf, ruangan sudah digunakan oleh Divisi ".$bentrok['divisi']." untuk agenda ".$bentrok['agenda']."'
            );

            window.location='tambah.php';

        </script>
        ";

        exit;
    }


    // VALIDASI DOUBLE BOOKING USER
    $cek_user = mysqli_query($conn,"
        SELECT *
        FROM t_booking

        WHERE id_karyawan='$id_karyawan'

        AND tanggal_rapat='$tanggal'

        AND (

            ('$mulai'
            BETWEEN jam_mulai
            AND jam_selesai)

            OR

            ('$selesai'
            BETWEEN jam_mulai
            AND jam_selesai)

        )
    ");


    // JIKA USER SUDAH BOOKING
    if(mysqli_num_rows($cek_user) > 0){

        echo "
        <script>

            alert(
            'Karyawan masih memiliki jadwal meeting lain'
            );

            window.location='tambah.php';

        </script>
        ";

        exit;
    }


    // SIMPAN BOOKING
    mysqli_query($conn,"
        INSERT INTO t_booking
        (
            id_karyawan,
            id_ruang,
            tanggal_rapat,
            jam_mulai,
            jam_selesai,
            agenda,
            status
        )
        VALUES
        (
            '$id_karyawan',
            '$id_ruang',
            '$tanggal',
            '$mulai',
            '$selesai',
            '$agenda',
            'Pinjam'
        )
    ");


    // SIMPAN LOG
    $tanggal_log =
    date('Y-m-d H:i:s');

    mysqli_query($conn,"
        INSERT INTO t_log_aktivitas
        (
            keterangan
        )
        VALUES
        (
            'Booking berhasil dibuat pada $tanggal_log'
        )
    ");


    echo "
    <script>

        alert(
        'Booking berhasil disimpan'
        );

        window.location='index.php';

    </script>
    ";
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Tambah Booking</title>

    <style>

        body{
            font-family:Arial;
            background:#f4f4f4;
        }

        .container{
            width:500px;
            margin:auto;
            background:white;
            padding:20px;
            margin-top:30px;
            border-radius:10px;
        }

        input,
        select,
        textarea{
            width:100%;
            padding:10px;
            margin-bottom:15px;
        }

        button{
            padding:10px 20px;
            background:green;
            color:white;
            border:none;
            cursor:pointer;
        }

    </style>

</head>

<body>

<div class="container">

    <h2>Tambah Booking</h2>

    <form method="POST">

        <label>Tanggal Rapat</label>

        <input
            type="date"
            name="tanggal"
            required
        >


        <label>Jam Mulai</label>

        <input
            type="time"
            name="mulai"
            required
        >


        <label>Jam Selesai</label>

        <input
            type="time"
            name="selesai"
            required
        >


        <label>Nama Karyawan</label>

        <select
            name="id_karyawan"
            id="karyawan"
            required
        >

            <option value="">
                -- Pilih Karyawan --
            </option>

            <?php while($k=mysqli_fetch_array($karyawan)){ ?>

                <option

                    value="<?= $k['id_karyawan'] ?>"

                    data-divisi="<?= $k['divisi'] ?>"

                >

                    <?= $k['nama_karyawan'] ?>
                    -
                    <?= $k['divisi'] ?>

                </option>

            <?php } ?>

        </select>


        <label>Divisi</label>

        <input
            type="text"
            id="divisi"
            disabled
        >


        <label>Nama Ruangan</label>

        <select
            name="id_ruang"
            required
        >

            <option value="">
                -- Pilih Ruangan --
            </option>

            <?php while($r=mysqli_fetch_array($ruangan)){ ?>

                <option
                    value="<?= $r['id_ruangan'] ?>"
                >

                    <?= $r['nama_ruangan'] ?>

                </option>

            <?php } ?>

        </select>


        <label>Agenda Meeting</label>

        <textarea
            name="agenda"
            rows="5"
            required
        ></textarea>


        <button
            type="submit"
            name="simpan"
        >
            Simpan
        </button>

    </form>

</div>


<script>

// DIVISI OTOMATIS

const karyawan =
document.getElementById(
'karyawan'
);

const divisi =
document.getElementById(
'divisi'
);

karyawan.addEventListener(
'change',
function(){

    const selected =
    this.options[
    this.selectedIndex
    ];

    divisi.value =
    selected.getAttribute(
    'data-divisi'
    );

});

</script>

</body>
</html>
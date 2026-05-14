<?php

include '../../config/database.php';

// AMBIL ID
$id = $_GET['id'];

// AMBIL DATA BOOKING
$data = mysqli_query($conn,"
SELECT *
FROM t_booking
WHERE id_booking='$id'
");

$d = mysqli_fetch_array($data);

// DATA KARYAWAN
$karyawan = mysqli_query($conn,
"SELECT * FROM m_karyawan");

// DATA RUANGAN
$ruangan = mysqli_query($conn,
"SELECT * FROM m_ruangan");


// PROSES UPDATE
if(isset($_POST['update'])){

    $id_karyawan = $_POST['id_karyawan'];
    $id_ruang    = $_POST['id_ruang'];
    $tanggal     = $_POST['tanggal'];
    $mulai       = $_POST['mulai'];
    $selesai     = $_POST['selesai'];
    $agenda      = $_POST['agenda'];
    $status      = $_POST['status'];

    // VALIDASI JAM
    if($selesai < $mulai){

        echo "
        <script>
            alert('Jam selesai tidak valid');
            window.location='edit.php?id=$id';
        </script>
        ";

        exit;
    }

    // VALIDASI BENTROK
    $cek = mysqli_query($conn,"
        SELECT *
        FROM t_booking
        WHERE id_ruang='$id_ruang'
        AND tanggal_rapat='$tanggal'
        AND id_booking != '$id'
        AND (
            ('$mulai' BETWEEN jam_mulai AND jam_selesai)
            OR
            ('$selesai' BETWEEN jam_mulai AND jam_selesai)
            OR
            (jam_mulai BETWEEN '$mulai' AND '$selesai')
        )
    ");

    // JIKA BENTROK
    if(mysqli_num_rows($cek) > 0){

        echo "
        <script>
            alert('Ruangan sudah digunakan');
            window.location='edit.php?id=$id';
        </script>
        ";

    }else{

        // UPDATE DATA
        mysqli_query($conn,"
            UPDATE t_booking
            SET
            id_karyawan='$id_karyawan',
            id_ruang='$id_ruang',
            tanggal_rapat='$tanggal',
            jam_mulai='$mulai',
            jam_selesai='$selesai',
            agenda='$agenda',
            status='$status'
            WHERE id_booking='$id'
        ");

        // SIMPAN LOG
        mysqli_query($conn,"
            INSERT INTO t_log_aktivitas
            (
                keterangan
            )
            VALUES
            (
                'Data booking berhasil diupdate'
            )
        ");

        echo "
        <script>
            alert('Data berhasil diupdate');
            window.location='index.php';
        </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit Booking</title>

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
            background:orange;
            color:white;
            border:none;
        }

    </style>

</head>

<body>

<div class="container">

    <h2>Edit Booking</h2>

    <form method="POST">

        <label>Tanggal Rapat</label>

        <input
            type="date"
            name="tanggal"
            value="<?= $d['tanggal_rapat'] ?>"
            required
        >

        <label>Jam Mulai</label>

        <input
            type="time"
            name="mulai"
            value="<?= $d['jam_mulai'] ?>"
            required
        >

        <label>Jam Selesai</label>

        <input
            type="time"
            name="selesai"
            value="<?= $d['jam_selesai'] ?>"
            required
        >

        <label>Karyawan</label>

        <select name="id_karyawan">

            <?php while($k=mysqli_fetch_array($karyawan)){ ?>

                <option
                    value="<?= $k['id_karyawan'] ?>"

                    <?php
                    if(
                    $d['id_karyawan']
                    ==
                    $k['id_karyawan']
                    ){
                        echo "selected";
                    }
                    ?>
                >

                    <?= $k['nama_karyawan'] ?>
                    -
                    <?= $k['divisi'] ?>

                </option>

            <?php } ?>

        </select>

        <label>Ruangan</label>

        <select name="id_ruang">

            <?php while($r=mysqli_fetch_array($ruangan)){ ?>

                <option
                    value="<?= $r['id_ruangan'] ?>"

                    <?php
                    if(
                    $d['id_ruang']
                    ==
                    $r['id_ruangan']
                    ){
                        echo "selected";
                    }
                    ?>
                >

                    <?= $r['nama_ruangan'] ?>

                </option>

            <?php } ?>

        </select>

        <label>Agenda</label>

        <textarea
            name="agenda"
            rows="5"
        ><?= $d['agenda'] ?></textarea>

        <label>Status</label>

        <select name="status">

            <option
                value="Pinjam"

                <?php
                if($d['status']=="Pinjam"){
                    echo "selected";
                }
                ?>
            >
                Pinjam
            </option>

            <option
                value="Kosong"

                <?php
                if($d['status']=="Kosong"){
                    echo "selected";
                }
                ?>
            >
                Kosong
            </option>

        </select>

        <button
            type="submit"
            name="update"
        >
            Update
        </button>

    </form>

</div>

</body>
</html>
<br>

<a href="index.php">
    Kembali ke Data Booking
</a>
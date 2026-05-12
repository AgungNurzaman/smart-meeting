<?php

include '../../config/database.php';


// PROSES SIMPAN
if(isset($_POST['simpan'])){

    $nama       = $_POST['nama_ruangan'];
    $kapasitas  = $_POST['kapasitas'];
    $fasilitas  = $_POST['fasilitas'];


    // VALIDASI DOUBLE DATA RUANGAN
    $cek = mysqli_query($conn,"
        SELECT *
        FROM m_ruangan
        WHERE nama_ruangan='$nama'
    ");


    // JIKA SUDAH ADA
    if(mysqli_num_rows($cek) > 0){

        echo "
        <script>

            alert(
            'Nama ruangan sudah ada'
            );

            window.location='tambah.php';

        </script>
        ";

        exit;
    }


    // VALIDASI KAPASITAS
    if($kapasitas > 10){

        echo "
        <script>

            alert(
            'Kapasitas maksimal 10 orang'
            );

            window.location='tambah.php';

        </script>
        ";

        exit;
    }


    // SIMPAN DATA
    mysqli_query($conn,"
        INSERT INTO m_ruangan
        (
            nama_ruangan,
            kapasitas,
            fasilitas
        )
        VALUES
        (
            '$nama',
            '$kapasitas',
            '$fasilitas'
        )
    ");


    echo "
    <script>

        alert(
        'Data ruangan berhasil ditambahkan'
        );

        window.location='index.php';

    </script>
    ";
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Tambah Ruangan</title>

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

    <h2>Tambah Ruangan</h2>

    <form method="POST">

        <label>Nama Ruangan</label>

        <input
            type="text"
            name="nama_ruangan"
            required
        >


        <label>Kapasitas</label>

        <input
            type="number"
            name="kapasitas"
            required
        >


        <label>Fasilitas</label>

        <textarea
            name="fasilitas"
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

</body>
</html>
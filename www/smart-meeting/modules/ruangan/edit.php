<?php

include '../../config/database.php';

$id = $_GET['id'];

$data = mysqli_query($conn,
"SELECT * FROM m_ruangan
WHERE id_ruangan='$id'");

$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){

    $nama = $_POST['nama_ruangan'];
    $kapasitas = $_POST['kapasitas'];
    $fasilitas = $_POST['fasilitas'];

    mysqli_query($conn,"
        UPDATE m_ruangan
        SET
        nama_ruangan='$nama',
        kapasitas='$kapasitas',
        fasilitas='$fasilitas'
        WHERE id_ruangan='$id'
    ");

    header('location:index.php');
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit Ruangan</title>

    <style>

        body{
            font-family:Arial;
            background:#f4f4f4;
        }

        .container{

            width:40%;
            margin:auto;

            background:white;

            padding:20px;

            margin-top:50px;

            border-radius:10px;

            box-shadow:0 0 10px #ccc;
        }

        h2{
            text-align:center;
        }

        input,
        textarea{

            width:100%;

            padding:10px;

            margin-top:10px;

            margin-bottom:20px;

            border:1px solid #ccc;

            border-radius:5px;
        }

        .btn{

            padding:10px 20px;

            border:none;

            border-radius:5px;

            color:white;

            text-decoration:none;

            cursor:pointer;
        }

        .update{
            background:orange;
        }

        .kembali{
            background:red;
        }

    </style>

</head>

<body>

<div class="container">

<h2>Edit Ruangan</h2>

<form method="POST">

    <label>
        Nama Ruangan
    </label>

    <input
        type="text"
        name="nama_ruangan"
        value="<?= $d['nama_ruangan'] ?>"
        required
    >


    <label>
        Kapasitas
    </label>

    <input
        type="number"
        name="kapasitas"
        value="<?= $d['kapasitas'] ?>"
        required
    >


    <label>
        Fasilitas
    </label>

    <textarea
        name="fasilitas"
        required
    ><?= $d['fasilitas'] ?></textarea>


    <button
        type="submit"
        name="update"
        class="btn update"
    >
        Update
    </button>

    <a
        href="index.php"
        class="btn kembali"
    >
        Kembali
    </a>

</form>

</div>

</body>
</html>
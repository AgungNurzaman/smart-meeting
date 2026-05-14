<?php

include '../../config/database.php';

if(!isset($_GET['id'])){

    die("ID tidak ditemukan");

}

$id = $_GET['id'];

$data = mysqli_query($conn,
"SELECT * FROM m_karyawan
WHERE id_karyawan='$id'");

$d = mysqli_fetch_array($data);

if(!$d){

    die("Data karyawan tidak ditemukan");

}

if(isset($_POST['update'])){

    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $divisi = $_POST['divisi'];

    mysqli_query($conn,"
        UPDATE m_karyawan
        SET
        nik='$nik',
        nama_karyawan='$nama',
        divisi='$divisi'
        WHERE id_karyawan='$id'
    ");

    header('location:index.php');
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit Karyawan</title>

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

        input{

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

<h2>Edit Karyawan</h2>

<form method="POST">

    <label>
        NIK
    </label>

    <input
        type="text"
        name="nik"
        value="<?= $d['nik'] ?>"
        required
    >


    <label>
        Nama Karyawan
    </label>

    <input
        type="text"
        name="nama"
        value="<?= $d['nama_karyawan'] ?>"
        required
    >


    <label>
        Divisi
    </label>

    <input
        type="text"
        name="divisi"
        value="<?= $d['divisi'] ?>"
        required
    >


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
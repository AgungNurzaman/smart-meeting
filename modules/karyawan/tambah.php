<?php

include '../../config/database.php';


// PROSES SIMPAN
if(isset($_POST['simpan'])){

    $nik    = $_POST['nik'];
    $nama   = $_POST['nama_karyawan'];
    $divisi = $_POST['divisi'];


    // VALIDASI DOUBLE NIK
    $cek = mysqli_query($conn,"
        SELECT *
        FROM m_karyawan
        WHERE nik='$nik'
    ");


    // JIKA NIK SUDAH ADA
    if(mysqli_num_rows($cek) > 0){

        echo "
        <script>

            alert(
            'NIK sudah digunakan'
            );

            window.location='tambah.php';

        </script>
        ";

        exit;
    }


    // VALIDASI NAMA KOSONG
    if($nama == ''){

        echo "
        <script>

            alert(
            'Nama karyawan wajib diisi'
            );

            window.location='tambah.php';

        </script>
        ";

        exit;
    }


    // SIMPAN DATA
    mysqli_query($conn,"
        INSERT INTO m_karyawan
        (
            nik,
            nama_karyawan,
            divisi
        )
        VALUES
        (
            '$nik',
            '$nama',
            '$divisi'
        )
    ");


    echo "
    <script>

        alert(
        'Data karyawan berhasil ditambahkan'
        );

        window.location='index.php';

    </script>
    ";
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Tambah Karyawan</title>

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

        input{
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

    <h2>Tambah Karyawan</h2>

    <form method="POST">

        <label>NIK</label>

        <input
            type="text"
            name="nik"
            required
        >


        <label>Nama Karyawan</label>

        <input
            type="text"
            name="nama_karyawan"
            required
        >


        <label>Divisi</label>

        <input
            type="text"
            name="divisi"
            required
        >


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
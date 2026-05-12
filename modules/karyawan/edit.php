<?php

include '../../config/database.php';

$id = $_GET['id'];

$data = mysqli_query($conn,
"SELECT * FROM m_karyawan
WHERE id_karyawan='$id'");

$d = mysqli_fetch_array($data);

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

<form method="POST">

    <input type="text" name="nik"
    value="<?= $d['nik'] ?>">

    <input type="text" name="nama"
    value="<?= $d['nama_karyawan'] ?>">

    <input type="text" name="divisi"
    value="<?= $d['divisi'] ?>">

    <button type="submit" name="update">
        Update
    </button>

</form>
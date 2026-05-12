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

<h2>Edit Ruangan</h2>

<form method="POST">

    <input
        type="text"
        name="nama_ruangan"
        value="<?= $d['nama_ruangan'] ?>"
    >

    <input
        type="number"
        name="kapasitas"
        value="<?= $d['kapasitas'] ?>"
    >

    <textarea name="fasilitas"><?= $d['fasilitas'] ?></textarea>

    <button type="submit" name="update">
        Update
    </button>

</form>
<?php

include '../../config/database.php';

// AMBIL ID
$id = $_GET['id'];

// HAPUS DATA BOOKING
// YANG MENGGUNAKAN RUANGAN INI
mysqli_query($conn,"
DELETE FROM t_booking
WHERE id_ruang='$id'
");

// HAPUS DATA RUANGAN
mysqli_query($conn,"
DELETE FROM m_ruangan
WHERE id_ruangan='$id'
");

// KEMBALI KE INDEX
header('location:index.php');

?>
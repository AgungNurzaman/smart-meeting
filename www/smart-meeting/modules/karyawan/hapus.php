<?php

include '../../config/database.php';

$id = $_GET['id'];

// HAPUS DATA BOOKING TERLEBIH DAHULU
mysqli_query($conn,"
DELETE FROM t_booking
WHERE id_karyawan='$id'
");

// HAPUS DATA KARYAWAN
mysqli_query($conn,"
DELETE FROM m_karyawan
WHERE id_karyawan='$id'
");

// KEMBALI
header('location:index.php');

?>
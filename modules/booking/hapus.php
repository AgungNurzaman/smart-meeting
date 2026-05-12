<?php

include '../../config/database.php';

// AMBIL ID BOOKING
$id = $_GET['id'];


// HAPUS DATA BOOKING
mysqli_query($conn,"
DELETE FROM t_booking
WHERE id_booking='$id'
");


// NAMA ADMIN
$admin = "Administrator";


// TANGGAL DAN JAM
$tanggal =
date('Y-m-d H:i:s');


// SIMPAN LOG AKTIVITAS
mysqli_query($conn,"
INSERT INTO t_log_aktivitas
(
    keterangan
)
VALUES
(
'$admin menghapus booking pada $tanggal'
)
");


// KEMBALI KE HALAMAN INDEX
header('location:index.php');

?>
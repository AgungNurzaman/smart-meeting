<?php

include '../../config/database.php';

$id = $_GET['id'];


// AMBIL DATA BOOKING

$data = mysqli_query($conn,"
SELECT
t_booking.*,
m_karyawan.nama_karyawan,
m_karyawan.divisi,
m_ruangan.nama_ruangan

FROM t_booking

INNER JOIN m_karyawan
ON t_booking.id_karyawan =
m_karyawan.id_karyawan

INNER JOIN m_ruangan
ON t_booking.id_ruang =
m_ruangan.id_ruangan

WHERE id_booking='$id'
");

$d = mysqli_fetch_array($data);


// HAPUS BOOKING

mysqli_query($conn,"
DELETE FROM t_booking
WHERE id_booking='$id'
");


// SIMPAN LOG

$tanggal =
date('Y-m-d H:i:s');

$keterangan =
"Administrator menghapus booking ruangan ".
$d['nama_ruangan'].
" oleh ".
$d['nama_karyawan'].
" divisi ".
$d['divisi'].
" pada ".
$tanggal;


mysqli_query($conn,"
INSERT INTO t_log_aktivitas
(keterangan)
VALUES
('$keterangan')
");


header('location:index.php');

?>
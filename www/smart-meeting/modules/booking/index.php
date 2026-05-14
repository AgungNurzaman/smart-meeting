<?php

include '../../config/database.php';

$total_ruangan = mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM m_ruangan"
)
);

$ruangan_digunakan = mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM t_booking
WHERE status='Pinjam'"
)
);

$ruangan_tersedia =
$total_ruangan -
$ruangan_digunakan;


$query = mysqli_query($conn,"
SELECT *
FROM t_booking

INNER JOIN m_karyawan
ON t_booking.id_karyawan =
m_karyawan.id_karyawan

INNER JOIN m_ruangan
ON t_booking.id_ruang =
m_ruangan.id_ruangan

ORDER BY id_booking DESC
");

?>

<!DOCTYPE html>
<html>
<head>

<title>Smart Meeting</title>

<style>

body{
    font-family:Arial;
    background:#f2f2f2;
}

.container{

    width:95%;
    margin:auto;

    background:white;

    padding:20px;

    margin-top:20px;

    border-radius:10px;

    box-shadow:0 0 10px #ccc;
}

.header{

    display:flex;

    justify-content:space-between;

    align-items:center;
}

.btn{

    background:green;

    color:white;

    padding:10px 20px;

    text-decoration:none;

    border-radius:5px;
}

.kembali{

    background:red;

    margin-left:10px;
}

.log{

    background:blue;

    margin-left:10px;
}

.dashboard{

    display:grid;

    grid-template-columns:
    repeat(3,1fr);

    gap:20px;

    margin-top:20px;
}

.card{

    border:2px solid #ddd;

    padding:20px;

    text-align:center;

    border-radius:10px;

    background:#fafafa;
}

.card h1{
    margin:0;
}

.search{

    margin-top:20px;

    display:flex;

    gap:10px;
}

.search input{

    padding:10px;

    border:1px solid #ccc;

    border-radius:5px;
}

table{

    width:100%;

    border-collapse:collapse;

    margin-top:20px;
}

table th,
table td{

    border:1px solid #ccc;

    padding:10px;

    text-align:center;
}

table th{

    background:#eee;
}

.edit{

    background:orange;

    color:white;

    padding:5px 10px;

    text-decoration:none;

    border-radius:5px;
}

.hapus{

    background:red;

    color:white;

    padding:5px 10px;

    text-decoration:none;

    border-radius:5px;
}

</style>

</head>

<body>

<div class="container">

<div class="header">

<div>

<h2>Smart Meeting System</h2>

<p>Data Peminjaman</p>

</div>

<div>

<a
href="tambah.php"
class="btn"
>
Tambah Peminjaman
</a>

<a
href="../../logs.php"
class="btn log"
>
Log Aktivitas
</a>

<a
href="../../index.php"
class="btn kembali"
>
Kembali
</a>

</div>

</div>


<!-- DASHBOARD -->

<div class="dashboard">

<div class="card">

<h4>Total Ruangan</h4>

<h1>
<?= $total_ruangan ?>
</h1>

</div>


<div class="card">

<h4>Ruangan Tersedia</h4>

<h1>
<?= $ruangan_tersedia ?>
</h1>

</div>


<div class="card">

<h4>Ruangan Digunakan</h4>

<h1>
<?= $ruangan_digunakan ?>
</h1>

</div>

</div>


<!-- SEARCH -->

<div class="search">

<input
type="date"
id="filterTanggal"
>

<input
type="text"
id="cariRuangan"
placeholder="Cari Ruangan"
>

</div>


<!-- TABLE -->

<table id="tableBooking">

<thead>

<tr>

<th>No</th>
<th>Tanggal</th>
<th>Waktu</th>
<th>Nama Ruangan</th>
<th>Nama Peminjam</th>
<th>Divisi</th>
<th>Agenda</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($d=mysqli_fetch_array($query)){

?>

<tr>

<td>
<?= $no++ ?>
</td>

<td>
<?= $d['tanggal_rapat'] ?>
</td>

<td>

<?= $d['jam_mulai'] ?>

-

<?= $d['jam_selesai'] ?>

</td>

<td>
<?= $d['nama_ruangan'] ?>
</td>

<td>
<?= $d['nama_karyawan'] ?>
</td>

<td>
<?= $d['divisi'] ?>
</td>

<td>
<?= $d['agenda'] ?>
</td>

<td>

<a
href="edit.php?id=<?= $d['id_booking'] ?>"
class="edit"
>
EDIT
</a>

<a
href="#"
class="hapus"

onclick="
hapusData(
<?= $d['id_booking'] ?>
)
"
>
HPS
</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>


<script src="../../assets/js/script.js"></script>

</body>
</html>
a<?php

include '../../config/database.php';

$data = mysqli_query($conn,"
SELECT * FROM m_karyawan
ORDER BY id_karyawan DESC
");

?>

<!DOCTYPE html>
<html>
<head>

<title>Data Karyawan</title>

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

<h2>Data Karyawan</h2>

<p>Master Data Karyawan</p>

</div>

<div>

<a
href="tambah.php"
class="btn"
>
Tambah Karyawan
</a>

<a
href="../../index.php"
class="btn kembali"
>
Kembali
</a>

</div>

</div>


<table>

<thead>

<tr>

<th>No</th>
<th>NIK</th>
<th>Nama Karyawan</th>
<th>Divisi</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php

$no = 1;

while($d = mysqli_fetch_assoc($data)){

?>

<tr>

<td>
<?= $no++ ?>
</td>

<td>
<?= $d['nik'] ?>
</td>

<td>
<?= $d['nama_karyawan'] ?>
</td>

<td>
<?= $d['divisi'] ?>
</td>

<td>

<a
href="edit.php?id=<?= $d['id_karyawan'] ?>"
class="edit"
>
EDIT
</a>

<a
href="hapus.php?id=<?= $d['id_karyawan'] ?>"
class="hapus"
>
HAPUS
</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>
</html>
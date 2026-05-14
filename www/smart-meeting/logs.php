<?php

include 'config/database.php';

$data = mysqli_query($conn,"
SELECT * FROM t_log_aktivitas
ORDER BY id_log DESC
");

?>

<!DOCTYPE html>
<html>
<head>

<title>Log Aktivitas</title>

<style>

body{
    font-family:Arial;
    background:#f2f2f2;
}

.container{

    width:90%;
    margin:auto;

    background:white;

    padding:20px;

    margin-top:20px;

    border-radius:10px;
}

table{

    width:100%;

    border-collapse:collapse;
}

table th,
table td{

    border:1px solid #ccc;

    padding:10px;
}

.btn{

    background:red;

    color:white;

    padding:10px 20px;

    text-decoration:none;

    border-radius:5px;
}

</style>

</head>

<body>

<div class="container">

<h2>Log Aktivitas</h2>

<a
href="index.php"
class="btn"
>
Kembali
</a>

<br><br>

<table>

<tr>

<th>No</th>
<th>Keterangan</th>
<th>Waktu</th>

</tr>

<?php

$no=1;

while($d=mysqli_fetch_array($data)){

?>

<tr>

<td>
<?= $no++ ?>
</td>

<td>
<?= $d['keterangan'] ?>
</td>

<td>
<?= $d['created_at'] ?>
</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>
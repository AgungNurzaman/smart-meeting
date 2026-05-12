<?php

include 'config/database.php';

$total_ruangan = mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM m_ruangan"
)
);

$ruangan_dipakai = mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM t_booking
WHERE status='Pinjam'"
)
);

$ruangan_kosong =
$total_ruangan -
$ruangan_dipakai;

?>

<!DOCTYPE html>
<html>
<head>

    <title>Smart Meeting</title>

    <style>

        body{
            font-family:Arial;
            background:#f4f4f4;
        }

        .dashboard{

            display:grid;

            grid-template-columns:
            repeat(auto-fit,minmax(250px,1fr));

            gap:20px;

            margin:20px;
        }

        .card{

            background:white;

            padding:20px;

            border-radius:10px;

            box-shadow:0 0 10px #ccc;

            text-align:center;
        }

        .menu{

            margin:20px;
        }

        .menu a{

            text-decoration:none;

            background:green;

            color:white;

            padding:10px 20px;

            margin-right:10px;

            border-radius:5px;
        }

    </style>

</head>

<body>

<h1 align="center">
SMART MEETING SYSTEM
</h1>

<div class="dashboard">

    <div class="card">

        <h3>Total Ruangan</h3>

        <h1>
            <?= $total_ruangan ?>
        </h1>

    </div>


    <div class="card">

        <h3>Ruangan Tersedia</h3>

        <h1>
            <?= $ruangan_kosong ?>
        </h1>

    </div>


    <div class="card">

        <h3>Ruangan Digunakan</h3>

        <h1>
            <?= $ruangan_dipakai ?>
        </h1>

    </div>

</div>


<div class="menu">

    <a href="modules/ruangan/index.php">
        Data Ruangan
    </a>

    <a href="modules/karyawan/index.php">
        Data Karyawan
    </a>

    <a href="modules/booking/index.php">
        Data Booking
    </a>

</div>

</body>
</html>
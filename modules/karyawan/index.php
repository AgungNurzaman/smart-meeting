<?php

include '../../config/database.php';

$data = mysqli_query($conn,
"SELECT * FROM m_karyawan");

?>

<!DOCTYPE html>
<html>
<head>

    <title>Data Karyawan</title>

    <style>

        body{
            font-family:Arial;
            background:#f4f4f4;
        }

        .container{
            width:90%;
            margin:auto;
            background:white;
            padding:20px;
            margin-top:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th,
        table td{
            border:1px solid #ddd;
            padding:10px;
        }

        .btn{
            padding:8px 15px;
            text-decoration:none;
            color:white;
            border-radius:5px;
        }

        .tambah{
            background:green;
        }

        .edit{
            background:orange;
        }

        .hapus{
            background:red;
        }

    </style>

</head>

<body>

<div class="container">

    <h2>Data Karyawan</h2>

    <a
        href="tambah.php"
        class="btn tambah"
    >
        Tambah Karyawan
    </a>

    <br><br>

    <table>

        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama Karyawan</th>
            <th>Divisi</th>
            <th>Action</th>
        </tr>

        <?php

        $no = 1;

        while($d = mysqli_fetch_array($data)){

        ?>

        <tr>

            <td><?= $no++ ?></td>

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
                    class="btn edit"
                >
                    Edit
                </a>

                <a
                    href="hapus.php?id=<?= $d['id_karyawan'] ?>"
                    class="btn hapus"
                    onclick="
                    return confirm(
                    'Yakin ingin menghapus data?'
                    )
                    "
                >
                    Hapus
                </a>

            </td>

        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>
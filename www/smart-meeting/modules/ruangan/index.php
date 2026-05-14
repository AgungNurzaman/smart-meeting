<?php

include '../../config/database.php';

$data = mysqli_query($conn,
"SELECT * FROM m_ruangan");

?>

<!DOCTYPE html>
<html>
<head>

    <title>Data Ruangan</title>

    <style>

        body{
            font-family:Arial;
            background:#f4f4f4;
        }

        .container{
            width:95%;
            margin:auto;
            padding:20px;
        }

        .header{
            margin-bottom:20px;
        }

        .btn{
            padding:10px 20px;
            text-decoration:none;
            color:white;
            border-radius:5px;
        }

        .tambah{
            background:green;
        }

        .kembali{
            background:red;
            margin-left:10px;
        }

        .edit{
            background:orange;
        }

        .hapus{
            background:red;
        }

        /* GRID CARD */

        .grid{

            display:grid;

            grid-template-columns:
            repeat(
            auto-fit,
            minmax(250px,1fr)
            );

            gap:20px;

        }

        .card-ruangan{

            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0 0 10px #ccc;

        }

        .card-ruangan h3{
            margin-top:0;
        }

        .action{
            margin-top:20px;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="header">

        <h2>Data Ruangan</h2>

        <a
            href="tambah.php"
            class="btn tambah"
        >
            Tambah Ruangan
        </a>

        <a
            href="../../index.php"
            class="btn kembali"
        >
            Kembali
        </a>

    </div>


    <!-- CARD GRID -->

    <div class="grid">

        <?php

        while($d=mysqli_fetch_array($data)){

        ?>

        <div class="card-ruangan">

            <h3>
                <?= $d['nama_ruangan'] ?>
            </h3>

            <p>

                <b>Kapasitas :</b>

                <?= $d['kapasitas'] ?>

            </p>

            <p>

                <b>Fasilitas :</b>

                <?= $d['fasilitas'] ?>

            </p>

            <div class="action">

                <a
                    href="edit.php?id=<?= $d['id_ruangan'] ?>"
                    class="btn edit"
                >
                    Edit
                </a>

                <a
                    href="#"
                    class="btn hapus"
                    onclick="
                    hapusData(
                    <?= $d['id_ruangan'] ?>
                    )
                    "
                >
                    Hapus
                </a>

            </div>

        </div>

        <?php } ?>

    </div>

</div>


<script>

// KONFIRMASI HAPUS

function hapusData(id){

    let kode = prompt(
    'Ketik HAPUS untuk menghapus data'
    );

    if(kode == 'HAPUS'){

        window.location =
        'hapus.php?id=' + id;

    }else{

        alert('Kode salah');

    }

}

</script>

</body>
</html>
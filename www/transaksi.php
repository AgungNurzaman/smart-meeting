<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kasir Toko</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body { 
            font-family: sans-serif;
            background: #7e808a;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            width: 100%;
            max-width: 400px;
            background-color: rgb(7, 15, 113);
            padding: 20px;
            color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }
        h2 { 
            color: rgb(156, 198, 209);
            text-align: center;
        }
        input[type="text"], 
        input[type="number"] {
            margin-top: 5px;
            margin-bottom: 15px;
            padding: 8px;
            width: 100%;
            border-radius: 5px;
            border: none;
        }

        .radio-group { margin-bottom: 15px; }

        input[type="submit"], 
        input[type="reset"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            width: 48%;
        }

        input[type="submit"] { background-color: #4CAF50; color: white; }
        input[type="reset"] { background-color: #f44336; color: white; }

        .hasil {
            margin-top: 20px;
        }

        hr {
            border: 0;
            border-top: 1px solid rgba(255,255,255,0.2);
            margin: 15px 0;
        }

        .total-akhir {
            font-size: 1.2em;
            color: #ffeb3b;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Kasir Toko</h2>

    <form method="post">
        Nama Barang:
        <input type="text" name="nama_barang" required>

        Harga Satuan (Rp):
        <input type="number" name="harga" min="0" required>

        Jumlah Beli:
        <input type="number" name="jumlah" min="1" required>

        <div class="radio-group">
            Status Member:<br>
            <input type="radio" name="status" value="Member" checked> Member (Diskon 10%) <br>
            <input type="radio" name="status" value="Bukan Member"> Bukan Member
        </div>

        <div style="display:flex; justify-content:space-between;">
            <input type="submit" value="Hitung">
            <input type="reset" value="Batal">
        </div>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_barang = $_POST['nama_barang'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];
        $status = $_POST['status'];

        $total_awal = $harga * $jumlah;

        $diskon_member = 0;
        if ($status == "Member") {
            $diskon_member = 0.1 * $total_awal;
        }

        $setelah_diskon_member = $total_awal - $diskon_member;

        $potongan_tambahan = 0;
        if ($setelah_diskon_member > 500000) {
            $potongan_tambahan = 20000;
        }

        $total_bayar = $setelah_diskon_member - $potongan_tambahan;
        $total_hemat = $diskon_member + $potongan_tambahan;

        echo "<div class='hasil'>";
        echo "<h2>Struk</h2>";
        echo "Barang : <b>$nama_barang</b><br>";
        echo "Harga : Rp " . number_format($harga, 0, ',', '.') . "<br>";
        echo "Jumlah : $jumlah<br>";
        echo "Total Awal : Rp " . number_format($total_awal, 0, ',', '.') . "<br>";
        echo "Status : $status<br>";

        echo "<hr>";
        echo "Diskon Member : Rp " . number_format($diskon_member, 0, ',', '.') . "<br>";
        echo "Potongan Tambahan : Rp " . number_format($potongan_tambahan, 0, ',', '.') . "<br>";
        echo "Total Hemat : Rp " . number_format($total_hemat, 0, ',', '.') . "<br>";

        echo "<hr>";
        echo "TOTAL BAYAR: <span class='total-akhir'>Rp " . number_format($total_bayar, 0, ',', '.') . "</span>";
        echo "</div>";
    }
    ?>

</div>

</body>
</html>
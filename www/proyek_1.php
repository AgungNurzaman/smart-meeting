<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulir Pendaftaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body{ 
            font-family: sans-serif;
            background: #7e808a;
            line-height: 1.6; 
            margin: 20px; 
        }
        .container{
            max-width: 650px;
            background-color: rgb(7, 15, 113);
            padding: 20px;
            color: white;
        }
        
        h2{
            color: rgb(156, 198, 209);
        }

        input, textarea{
            margin-top: 5px;
            margin-bottom: 10px;
            padding: 5px;
            width: 100%;
            border-radius: 5px;
            border: none;
        }

        input[type="submit"], input[type="reset"]{
            width: auto;
            cursor: pointer;
        }
    </style>
</head>

<body>
<div class="container">
    <h2>Formulir Pendaftaran Mahasiswa Universitas IPWIJA</h2>

    <form action="metodegetproses.php" method="post">
        Masukkan Nama :
        <input type="text" name="nama" required>

        Masukan Email :
        <input type="email" name="email" required>

        Komentar :
        <textarea rows="3" name="komentar" required></textarea>

        <input type="submit" value="Kirim">
        <input type="reset" value="Batal">
    </form>
</div>
</body>
</html>
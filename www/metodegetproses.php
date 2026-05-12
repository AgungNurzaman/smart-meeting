<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hasil Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body{ 
            font-family: sans-serif;
            background: #7e808a;
            line-height: 1.6; 
            margin: 20px; 
        }

        .container{
            max-width: 500px;
            background-color: rgb(7, 15, 113);
            padding: 20px;
            border-radius: 10px;
            color: white;
        }

        a{
            display: inline-block;
            margin-top: 15px;
            color: rgb(156, 198, 209);
            text-decoration: none;
        }
    </style>
</head>

<body>
<div class="container">
    <h2>Hasil Input</h2>

    Nama Anda Adalah : <?php echo htmlspecialchars($_POST['nama']); ?><br>
    Email Anda Adalah : <?php echo htmlspecialchars($_POST['email']); ?><br>
    Komentar Anda Adalah : <?php echo htmlspecialchars($_POST['komentar']); ?><br>

    <a href="index.html">← Kembali ke Form</a>
</div>
</body>
</html>
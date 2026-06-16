<?php
include 'koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM menu WHERE id_menu='$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Menu</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

body{
    min-height:100vh;
    background:#81898a;
    display:flex;
    justify-content:center;
    align-items:center;
}

.blackbox{
    width:90%;
    max-width:500px;
    background:#111;
    color:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 15px 35px rgba(0,0,0,0.4);
}

.blackbox img{
    width:100%;
    height:300px;
    object-fit:cover;
}

.content{
    padding:25px;
}

.content h1{
    margin-bottom:15px;
    color:#fff;
}

.harga{
    font-size:22px;
    font-weight:bold;
    color:#4CAF50;
    margin-bottom:15px;
}

.keterangan{
    color:#ddd;
    line-height:1.6;
    margin-bottom:20px;
}
.alamat{
    margin-bottom:15px;
}

.alamat a{
    display:block;
    background:#222;
    color:white;
    text-decoration:none;
    padding:12px;
    border-radius:10px;
    border-left:4px solid #4CAF50;
    transition:0.3s;
}

.alamat a:hover{
    background:#333;
}
.btn-kembali{
    display:inline-block;
    padding:12px 20px;
    background:#81898a;
    color:white;
    text-decoration:none;
    border-radius:10px;
    transition:0.3s;
}

.btn-kembali:hover{
    opacity:0.8;
}
</style>

</head>
<body>

<div class="blackbox">

    <img src="gambar/<?= $data['gambar']; ?>" alt="<?= $data['nama_menu']; ?>">

    <div class="content">

        <h1><?= $data['nama_menu']; ?></h1>

        <div class="harga">
            Rp <?= number_format($data['harga'],0,',','.'); ?>
        </div>

        <div class="keterangan">
            <?= $data['keterangan']; ?>
        </div>

        <div class="alamat">
            <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($data['alamat']); ?>" 
            target="_blank">
            📍 <?= $data['alamat']; ?>
            </a>
        </div>

        <a href="Home.php" class="btn-kembali">
            ← Kembali
        </a>

    </div>

</div>

</body>
</html>
<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}
body {
    min-height: 100vh;
    background: #B8860B;
    display: flex;
}
.sidebar {
    width:220px;
    height:100vh;
    background:rgba(148,142,142,0.95);
    padding:20px;
    position:fixed;
    left:-240px;
    top:0;
    transition:0.3s;
    z-index:1000;
}
.sidebar.active{
    left:0;
}
.sidebar a {
    display: block;
    text-decoration: none;
    margin-bottom: 10px;
}

.sidebar button {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 10px;
    background: #B8860B;
    color: white;
    cursor: pointer;
    transition: 0.3s;
}

.sidebar button:hover {
    transform: translateX(5px);
}

/* tombol garis tiga */
.menu-toggle{
    position:fixed;
    top:20px;
    left:20px;
    width:45px;
    height:45px;
    background:#B8860B;
    color:white;
    border:none;
    border-radius:10px;
    font-size:25px;
    cursor:pointer;
    z-index:1100;
}

/* main menyesuaikan */
.main {
    flex:1;
    padding:20px;
    margin-left:0;
    transition:0.3s;
}

/* ketika sidebar terbuka */
.main.active{
    margin-left:220px;
}

.topbar {
    display: flex;
    justify-content: flex-end;
}

.logout-btn {
    padding: 10px 16px;
    background: #f80606;
    border: none;
    color: white;
    border-radius: 8px;
    cursor: pointer;
}
.content h1 {
    margin-bottom: 25px;
    color: #0e0d0d;
    margin-left:450px;
}

.foto-bulat {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid rgb(202, 131, 131);
    margin: 0 auto 15px; /* center + jarak bawah */
    display: block; /* wajib supaya bisa center */
}
.line{
    width: 100%;
    height: 2px;
    background-color: black;
    margin: 20px 0;
}

.main {
    flex: 1;
    padding: 20px;
    display: flex;
    flex-direction: column;
}

.topbar {
    display: flex;
    justify-content: flex-end;
}

.logout-btn {
    padding: 10px 16px;
    background: #f80606;
    border: none;
    color: white;
    border-radius: 8px;
    cursor: pointer;
}

.content {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;  
    justify-content: flex-start; 
    gap: 25px;
    margin-top: 20px;
}
.content h1 {
    margin-bottom: 3px;
    color: #0e0d0d;
}
.card {
    background: white;
    padding: 20px;
    border-radius: 16px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    text-align: center;
    max-width: 300px;
    width: 100%;
    margin-right: 10px;
}

.card h1 {
    margin-bottom: 3px;
}

.card p {
    color: #666;
    margin-bottom: 10pt;
}

.card input {
    width: 100%;
    padding: 14px 15px;
    margin-bottom: 10px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 10px;
    outline: none;
    background: #f9f9f9;
    transition: 0.3s;
}

.card input:focus {
    border-color: #81898a;
    background: #fff;
    box-shadow: 0 0 8px rgba(79,172,254,0.4);
}

.card input::placeholder {
    color: #aaa;
}

.card button {
    width: 100%;
    padding: 14px;
    font-size: 15px;
    border: none;
    border-radius: 10px;
    background: #81898a;
    color: white;
    cursor: pointer;
    transition: 0.3s;
}

.card button:hover {
    transform: translateY(-2px);
    opacity: 0.9;
}

/* BUTTON */
.button{
    display:inline-block;
    padding:8px 16px;
    background:#007bff;
    color:white;
    text-decoration:none;
    border-radius:5px;
    margin-bottom:15px;
}

/* TABLE */
.table-responsive{
    width:100%;
    overflow-x:auto;
}

.table-menu{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:8px;
    overflow:hidden;
    box-shadow:0 2px 6px rgba(0,0,0,.15);
}

.table-menu th{
    background:#3a5f3b;
    color:white;
    padding:12px;
    text-align:center;
}

.table-menu td{
    padding:10px;
    border-bottom:1px solid #e0e0e0;
}

.table-menu tr:nth-child(even){
    background:#f9f9f9;
}

/* IMAGE */
.thumb{
    width:80px;
    height:80px;
    object-fit:cover;
    border-radius:6px;
    border:1px solid #ddd;
}
</style>
</head>
<body>
<button class="menu-toggle" onclick="toggleMenu()">
☰
</button>

<!-- SIDEBAR -->
<div class="sidebar">
    <img src="logo.jpeg" alt="Foto Profil" class="foto-bulat">
    <div class="line"></div>
    <a href="Home.php"><button>Dashboard</button></a>
    <a href="menu.php"><button>Data Menu</button></a>
</div>

<!-- MAIN -->
<div class="main">

    <div class="topbar">
        <a href="index.php">
            <button class="logout-btn">Logout</button>
        </a>
    </div>

    <!-- MAIN -->
<div class="main-content">
    <div class="content-wrapper">

        <center><h2>Data Menu</h2></center>

        <a href="tambahmenu.php" class="button">➕ Tambah Data</a>

        <div class="table-responsive">
            <table class="table-menu">
                <thead>
                <tr>
                    <th>No</th>
                    <th>ID Menu</th>
                    <th>Nama Menu</th>
                    <th>Gambar</th>
                    <th>Harga</th>
                    <th>Keterangan</th>
                    <th>Alamat</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                $query = mysqli_query($conn, "SELECT * FROM menu");
                while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['id_menu']; ?></td>
                    <td><?= htmlspecialchars($row['nama_menu']); ?></td>
                    <td>
                        <img src="gambar/<?= htmlspecialchars($row['gambar']); ?>" class="thumb">
                    </td>
                    <td>Rp <?= number_format($row['harga'],0,',','.'); ?></td>
                    <td><?= htmlspecialchars($row['keterangan']); ?></td>
                    <td><?= htmlspecialchars($row['alamat']); ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
         </div>
    </div>
</div>
<script>
function toggleMenu(){
    let sidebar = document.querySelector(".sidebar");
    let main = document.querySelector(".main");
    sidebar.classList.toggle("active");
    main.classList.toggle("active");
}
</script>
</body>
</html>
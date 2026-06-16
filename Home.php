<?php
session_start();
include 'koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM menu");
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
.menu-container{
    display:flex;
    flex-wrap:wrap;
    gap:20px;
    justify-content:center;
}

.card-menu{
    width:220px;
    background:white;
    border-radius:15px;
    overflow:hidden;
    text-decoration:none;
    color:black;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
    transition:0.3s;
}

.card-menu:hover{
    transform:translateY(-5px);
}

.card-menu img{
    width:100%;
    height:180px;
    object-fit:cover;
}

.card-menu h3{
    padding:15px;
    text-align:center;
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

<div class="content">
<h1>Dashboard</h1>
</div>

    <div class="menu-container">
    <?php while($menu = mysqli_fetch_assoc($query)) { ?>
    <a href="detail_menu.php?id=<?= $menu['id_menu']; ?>" class="card-menu">
        <img src="gambar/<?= $menu['gambar']; ?>" alt="<?= $menu['nama_menu']; ?>">
        <h3><?= $menu['nama_menu']; ?></h3>
    </a>
    <?php } ?>

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
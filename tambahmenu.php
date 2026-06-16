<?php
include 'koneksi.php';

$query = mysqli_query($conn, "SELECT id_menu FROM menu ORDER BY id_menu DESC LIMIT 1");
$data = mysqli_fetch_assoc($query);

if ($data) {
    $last_id = $data['id_menu'];
    $angka = (int) substr($last_id, 1);
    $angka++;
    $id_menu = "M" . str_pad($angka, 2, "0", STR_PAD_LEFT);
} else {
    $id_menu = "M01";
}

if (isset($_POST['submit'])) {

    $nama_menu = $_POST['nama_menu'];
    $kategori  = $_POST['keterangan'];
    $harga     = $_POST['harga'];
    $alamat     = $_POST['alamat'];

    $folder = "gambar/";
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $nama_gambar = $_FILES['gambar']['name'];
    $tmp_gambar  = $_FILES['gambar']['tmp_name'];

    if ($nama_gambar != "") {
        move_uploaded_file($tmp_gambar, $folder . $nama_gambar);

        $query = "INSERT INTO menu (id_menu, nama_menu, keterangan, harga, gambar, alamat)
                  VALUES ('$id_menu','$nama_menu', '$kategori', '$harga', '$nama_gambar','$alamat')";

        if ($conn->query($query)) {
            header("Location: menu.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Menu</title>

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
h2 {
    margin-bottom: 5px;
    color: #0e0d0d;
    margin-left:400px;
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
.main-content{
    margin-left:80px;
    padding:20px;
}

.content-wrapper{
    max-width:600px;
    margin:0 auto;
}
.form-menu{
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 2px 5px rgba(0,0,0,0.1);
}

.form-group{
    margin-bottom:12px;
}

.form-group label{
    font-weight:bold;
    display:block;
    margin-bottom:5px;
}

.form-group input,
.form-group select{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:5px;
    font-size:14px;
}

.form-group input[type="file"]{
    padding:6px;
}

.form-group.center{
    text-align:center;
}

.form-group.center input{
    width:200px;
    background:#007bff;
    color:white;
    border:none;
    padding:10px;
    border-radius:5px;
    cursor:pointer;
}

.form-group.center input:hover{
    background:#0056b3;
}

.form-group textarea{
    width:100%;
    padding:12px;
    border-radius:8px;
    border:1px solid #ddd;
}

.form-group textarea{
    resize:none;
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
<h2>Tambah Data Menu</h2>
<!-- MAIN -->
<div class="main-content">
    <div class="content-wrapper">
        
        <form method="post" enctype="multipart/form-data" class="form-menu">

            <div class="form-group">
                <label>Nama Menu</label>
                <input type="text" name="nama_menu" required>
            </div>

            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="gambar" required>
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="text" id="harga_view" onkeyup="formatRupiah(this)" required>
                <input type="hidden" name="harga" id="harga_db">
            </div>

            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" rows="4" required></textarea>
            </div>

             <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" required>
            </div>

            <div class="form-group center">
                <input type="submit" name="submit" value="Simpan">
            </div>

        </form>

    </div>
</div>

<script>
function formatRupiah(input) {
    let angka = input.value.replace(/[^,\d]/g, '');
    let sisa = angka.length % 3;
    let rupiah = angka.substr(0, sisa);
    let ribuan = angka.substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        rupiah += (sisa ? '.' : '') + ribuan.join('.');
    }

    input.value = 'Rp ' + rupiah;
    document.getElementById('harga_db').value = angka;
}
function toggleMenu(){
    let sidebar = document.querySelector(".sidebar");
    let main = document.querySelector(".main");
    sidebar.classList.toggle("active");
    main.classList.toggle("active");
}
</script>

</body>
</html>

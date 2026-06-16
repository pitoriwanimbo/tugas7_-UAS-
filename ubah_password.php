<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['reset_username'])){

    header("Location:lupa_password.php");
    exit;
}

$username = $_SESSION['reset_username'];$pesan="";

if($_SERVER['REQUEST_METHOD']=="POST"){

$password_baru = $_POST['password'];
$konfirmasi = $_POST['konfirmasi'];

if($password_baru != $konfirmasi){$pesan="Konfirmasi password tidak sama!";
}else{
$password = password_hash($password_baru, PASSWORD_DEFAULT);
mysqli_query($conn,"UPDATE user SET password='$password'WHERE username='$username'");

unset($_SESSION['reset_username']);

echo "<script>alert('Password berhasil diubah');window.location='index.php';</script>
";
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Ubah Password</title>
<style>
body{
background:#B8860B;
height:100vh;
display:flex;
justify-content:center;
align-items:center;
font-family:Segoe UI;
}

.box{
background:white;
padding:30px;
width:400px;
border-radius:15px;
}

input{
width:100%;
padding:12px;
margin-bottom:15px;
border-radius:8px;
border:1px solid #ddd;
}
button{
width:100%;
padding:12px;
background:#81898a;
color:white;
border:none;
border-radius:8px;
}

.alert{
color:red;
text-align:center;
}
</style>
</head>
<body>

<div class="box">
<h2>Ubah Password</h2>

<p>Username: <b><?= $username ?></b></p>

<br>
<?php if($pesan!=""){ ?>
<div class="alert">
<?= $pesan ?>
</div>
<?php } ?>

<form method="POST">
<input type="password"name="password"placeholder="Password Baru"required>

<input type="password"name="konfirmasi"placeholder="Konfirmasi Password"required>
<button>Simpan Password</button>
</form>
</div>
</body>
</html>
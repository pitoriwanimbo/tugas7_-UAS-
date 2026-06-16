<?php
include 'koneksi.php';
$pesan = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];

    // cek username
    $query = mysqli_query($conn, 
        "SELECT * FROM user WHERE username='$username'"
    );
    $cek = mysqli_num_rows($query);
    if ($cek > 0) {

        // simpan username sementara
        session_start();
        $_SESSION['reset_username'] = $username;

        // pindah ke halaman ubah password
        header("Location: ubah_password.php");
        exit;
    } else {

        $pesan = "Username yang Anda tuliskan tidak ada!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Lupa Password</title>
<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    min-height:100vh;
    background:#B8860B;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:20px;
}

.container{
    width:100%;
    max-width:420px;
    background:white;
    padding:30px;
    border-radius:16px;
    box-shadow:0 15px 35px rgba(0,0,0,.2);
}

h2{
    text-align:center;
    margin-bottom:25px;
}

.input-group{
    margin-bottom:18px;
}

.input-group input{
    width:100%;
    padding:14px;
    border:1px solid #ddd;
    border-radius:10px;
}

button{
    width:100%;
    padding:14px;
    background:#81898a;
    color:white;
    border:none;
    border-radius:10px;
    cursor:pointer;
}

button:hover{
    opacity:.8;
}

.alert{
    background:#ffdddd;
    color:#b30000;
    padding:10px;
    border-radius:8px;
    margin-bottom:15px;
    text-align:center;
}

.link{
    text-align:center;
    margin-top:18px;
}

.link a{
    text-decoration:none;
    color:#B8860B;
}
</style>
</head>
<body>
<div class="container">
<h2>Lupa Password</h2>
<?php if($pesan!=""){ ?>
<div class="alert">
<?= $pesan ?>
</div>
<?php } ?>
<form method="POST">
<div class="input-group">
<input type="text" name="username"placeholder="Masukkan Username"required>
</div>
<button type="submit">Reset Sandi</button>
</form>
<div class="link">
<a href="index.php">Kembali ke Login</a>
</div>
</div>
</body>
</html>
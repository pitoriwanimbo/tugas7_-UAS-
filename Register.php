<?php
include 'koneksi.php';

if(isset($_POST['daftar'])){

    $username  = mysqli_real_escape_string($conn, $_POST['username']);
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Membuat ID User Otomatis
    $query = mysqli_query($conn, "SELECT MAX(id_user) AS id_terbesar FROM user");
    $data = mysqli_fetch_assoc($query);

    if($data['id_terbesar']){
        $urutan = (int) substr($data['id_terbesar'], 1);
        $urutan++;
    } else {
        $urutan = 1;
    }

    $id_user = 'U' . str_pad($urutan, 2, '0', STR_PAD_LEFT);

    // Simpan ke database
    $simpan = mysqli_query($conn, "
        INSERT INTO user(id_user,username,password)
        VALUES('$id_user','$username','$password')
    ");

    if($simpan){
        echo "<script>
                alert('Pendaftaran berhasil');
                window.location='Home.php';
              </script>";
    }else{
        echo "<script>
                alert('Pendaftaran gagal');
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun</title>
</head>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

/* 🔥 BACKGROUND UTAMA (DESKTOP) */
body {
    min-height: 100vh;
    background: #B8860B;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

/* Container */
.container {
    width: 100%;
    max-width: 420px;
    background: rgba(255, 255, 255, 0.95);
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    backdrop-filter: blur(8px);
    animation: fadeIn 0.5s ease;
    position: relative;
    z-index: 2;
}

/* Animasi */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(25px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #333;
    font-size: 24px;
}

/* Input */
.input-group {
    margin-bottom: 18px;
}

.input-group input {
    width: 100%;
    padding: 14px;
    font-size: 15px;
    border: 1px solid #ddd;
    border-radius: 10px;
    outline: none;
    transition: 0.3s;
}

.input-group input:focus {
    border-color: #81898a;
    box-shadow: 0 0 8px rgba(79,172,254,0.4);
}

/* Button */
button {
    width: 100%;
    padding: 14px;
    font-size: 16px;
    background: #81898a;
    border: none;
    color: white;
    border-radius: 10px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    transform: translateY(-2px);
}

/* Link */
.link {
    text-align: center;
    margin-top: 18px;
}

.link a {
    display: block;
    text-decoration: none;
    color: #81898a;
    font-size: 14px;
    margin-top: 6px;
}
</style>
<body>

<div class="container">
    <h2>Buat Akun</h2>

   <form method="POST">

    <div class="input-group">
        <input type="text" name="username" placeholder="Username" required>
    </div>

    <div class="input-group">
        <input type="password" name="password" placeholder="Password" required>
    </div>

    <button type="submit" name="daftar">Daftar</button>

</form>

</div>

</body>
</html>
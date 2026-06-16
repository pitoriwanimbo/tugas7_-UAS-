<?php
session_start();
include 'koneksi.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];

            header("Location: Home.php");
            exit;

        } else {
            $error = "Password salah!";
        }

    } else {
        $error = "Username tidak ditemukan!";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.container {
    width: 100%;
    max-width: 420px;
    background: rgba(255, 255, 255, 0.95);
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 65px 65px rgba(0,0,0,0.2);
    backdrop-filter: blur(8px);
    animation: fadeIn 0.5s ease;
}

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

.link {
    text-align: center;
    margin-top: 18px;
}

.link a {
    display: block;
    text-decoration: none;
    color: #B8860B;
    font-size: 14px;
    margin-top: 6px;
}

</style>
</head>
<body>

<div class="container">
    <h2>Login</h2>

 <form method="POST" action="">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Masukan Username" required>
              <br>
              <br>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Masukan Password" required>
                <br>
              <br>
                <button type="submit" class="btn-login">Login</button>
            </div>
        </form>

    <div class="link">
        <a href="ForgetPassword.php">Lupa Password?</a>
        <a href="Register.php">Buat Akun</a>
    </div>
</div>

</body>
</html>
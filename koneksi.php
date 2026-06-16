<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'rotbar_kompak';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Kodeksi gagal: ' . $conn->connect_error);
}
?>
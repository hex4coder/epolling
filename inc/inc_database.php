<?php
$database = 'epolling';
$host = 'localhost';
$user = 'root';
$pass = '';

$koneksi = mysqli_connect($host, $user, $pass, $database);
if (!$koneksi) {
    echo ("Koneksi gagal");
    die("Koneksi kedatabase gagal.");
}
?>
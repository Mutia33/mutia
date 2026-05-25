<?php 
$host = "localhost";
$user = "root";
$pass = "";
$db   = "2526_14db"; // Pastikan ini benar-benar "login"

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    // TAMBAHKAN INI SEMENTARA untuk tes
    // echo "Koneksi ke database 'login' berhasil!"; 
}
?>
<?php
session_start(); 
$host     = "localhost";
$username = "2526_14"; 
$password = "12345678";   
$database = "2526_14db";

// PERBAIKAN: Gunakan nama variabelnya (pakai $), bukan isinya langsung tanpa tanda $
$koneksi = mysqli_connect($host, $username, $password, $database);

// Mengecek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
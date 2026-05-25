<?php 
// 1. Hubungkan ke database
include 'koneksi.php';

// 2. Tangkap data dari form login.php
$username = $_POST['username'];
$password = $_POST['password'];

// 3. Cek apakah username dan password ada di tabel 'users'
// Pastikan nama tabel di database kamu adalah 'users'
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");

// 4. Hitung jumlah data yang ditemukan
$cek = mysqli_num_rows($query);

if($cek > 0){
    // Jika login berhasil
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    
    // Lempar ke halaman utama CRUD
    header("location:index.php");
} else {
    // Jika login gagal, balikkan ke login.php dengan pesan error
    header("location:login.php?pesan=gagal");
}
?>
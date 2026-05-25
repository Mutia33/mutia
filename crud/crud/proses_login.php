<?php 
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Ambil data user sekaligus role-nya dari database
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($query);

if($cek > 0){
    $data = mysqli_fetch_assoc($query);
    
    // SIMPAN DATA KE SESSION (Penting untuk index.php tadi)
    $_SESSION['user_id']  = $data['id'];       // Untuk variabel $my_id
    $_SESSION['username'] = $data['username']; 
    $_SESSION['role']     = $data['role'];     // Untuk variabel $role (admin/guru)
    $_SESSION['status']   = "login";
    
    header("location:index.php");
} else {
    header("location:login.php?pesan=gagal");
}
?>
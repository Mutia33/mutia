<?php 
session_start();
include 'koneksi.php'; 

// --- PROSES CEK LOGIN (PLAIN TEXT - APA ADANYA) ---
if (isset($_POST['proses_login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password_input = $_POST['password']; // Tanpa MD5, langsung ambil apa adanya
    
    // Query untuk mencocokkan username dan password apa adanya
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password_input'");
    
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama']     = $data['nama_lengkap'];
        $_SESSION['status']   = "login";
        
        // Simpan data biodata ke session
        $_SESSION['nip']      = $data['NIP/NIS'];
        $_SESSION['posisi']   = $data['posisi']; 
        $_SESSION['no_hp']    = $data['no_hp']; 
        $_SESSION['jk']       = $data['jk']; 
        
        // Arahkan ke halaman utama
        header("location: index.php");
    } else {
        // Jika gagal
        echo "<script>alert('Username atau Password Salah!'); window.location.href='index.php';</script>";
    }
} else {
    header("location: index.php");
}
?>
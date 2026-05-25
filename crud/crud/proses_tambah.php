<?php 
session_start(); // TAMBAHKAN INI
include 'koneksi.php';

// Menangkap data yang dikirim dari form
$nama           = $_POST['nama'];
$alamat         = $_POST['alamat'];
$tempat_lahir   = $_POST['tempat_lahir'];
$tanggal_lahir  = $_POST['tanggal_lahir'];

// TAMBAHAN: Menangkap data akun untuk tabel 'users'
$username       = $_POST['username']; 
$password       = md5($_POST['password']); // Enkripsi biar aman
$role           = 'guru'; // Otomatis jadi guru

// 1. Simpan ke tabel USERS dulu supaya dapat ID
$query_user = mysqli_query($koneksi, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')");

if($query_user){
    // Ambil ID yang baru saja dibuat di tabel users
    $user_id_baru = mysqli_insert_id($koneksi);

    // 2. Simpan ke tabel BIODATA_GURU menggunakan ID tadi
    // (Menyesuaikan kode kamu dengan menambahkan kolom user_id)
    $query_biodata = mysqli_query($koneksi, "INSERT INTO biodata_guru (user_id, nama, alamat, tempat_lahir, tanggal_lahir) VALUES ('$user_id_baru', '$nama', '$alamat', '$tempat_lahir', '$tanggal_lahir')");

    // Mengalihkan halaman kembali ke index.php
    header("location:index.php?pesan=berhasil");
} else {
    echo "Gagal menambah data: " . mysqli_error($koneksi);
}
?>
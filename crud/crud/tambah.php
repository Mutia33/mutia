<?php 
session_start();
include 'koneksi.php';

// Kunci Pintu: Hanya Admin yang bisa nambah guru
if ($_SESSION['role'] != 'admin') {
    die("Akses Ditolak! Hanya Admin yang boleh menambah data.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Guru Baru</title>
</head>
<body>
    <h2>Tambah Data Guru Baru</h2>
    <a href="index.php">KEMBALI</a>
    <br><br>

    <form method="POST" action="proses_tambah.php">
        <h3>Data Akun Login</h3>
        <table>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" required placeholder="Masukkan Username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" required placeholder="Masukkan Password"></td>
            </tr>
        </table>

        <h3>Biodata Lengkap</h3>
        <table>
            <tr>
                <td>Nama Lengkap</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td>NIP</td>
                <td><input type="text" name="NIP" required></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td><input type="text" name="jabatan"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat" required></textarea></td>
            </tr>
            <tr>
                <td>Tempat Lahir</td>
                <td><input type="text" name="tempat_lahir"></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td><input type="date" name="tanggal_lahir"></td>
            </tr>
            <tr>
                <td>No Handphone</td>
                <td><input type="text" name="no_hp"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit">SIMPAN DATA GURU</button></td>
            </tr>
        </table>
    </form>
</body>
</html>
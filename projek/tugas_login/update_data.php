<?php 
session_start();
include 'koneksi.php';

$username  = $_SESSION['username'];
$nip       = $_POST['nip'];
$tgl_lahir = $_POST['tgl_lahir'];
$posisi    = $_POST['posisi']; 
$alamat    = $_POST['alamat'];

// Update ke tabel 'users'
$query = mysqli_query($koneksi, "UPDATE users SET nip='$nip', tgl_lahir='$tgl_lahir', posisi='$posisi', alamat='$alamat' WHERE username='$username'");

if(!$query){
    die("Gagal update: " . mysqli_error($koneksi));
}

// --- KUNCI UTAMANYA DI SINI ---
// Kita daftarkan semua data ke session agar index.php bisa langsung membaca profilnya tanpa kosong
$_SESSION['status']    = "login";
$_SESSION['nip']       = $nip;
$_SESSION['tgl_lahir'] = $tgl_lahir;
$_SESSION['posisi']    = $posisi;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Berhasil Disimpan</title>
</head>
<body style="font-family: Arial; background-color: #f4f4f4; padding: 20px;">
    <div style="background: white; padding: 20px; border-radius: 10px; width: 500px; margin: auto; border-top: 5px solid #006400; text-align: center; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h2 style="color: #006400;">Data Berhasil Disimpan!</h2>
        <table border="1" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <tr style="background: #eee;">
                <th style="padding: 10px;">Kategori</th>
                <th style="padding: 10px;">Informasi</th>
            </tr>
            <tr><td>Username</td><td><b><?php echo $username; ?></b></td></tr>
            <tr><td>NIP</td><td><?php echo $nip; ?></td></tr>
            <tr><td>Posisi</td><td><?php echo $posisi; ?></td></tr>
            <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
        </table>
        <p id="notif" style="font-size: 14px; color: #555;">
            Menuju halaman utama dalam <span id="detik" style="font-weight: bold; color: #800000;">5</span> detik...
        </p>
        <button onclick="pindah()" style="background: #800000; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer;">Pindah Sekarang</button>
    </div>

    <script>
        function pindah() {
            // Diubah arahnya ke index.php agar memicu tampilan profil rahasia yang sudah kita buat
            window.location.href = "index.php";
        }

        let waktu = 5;
        const hitungMundur = setInterval(() => {
            waktu--;
            document.getElementById('detik').innerText = waktu;
            if (waktu <= 0) {
                clearInterval(hitungMundur);
                pindah();
            }
        }, 1000);
    </script>
</body>
</html>
<?php 
session_start(); // TAMBAHKAN INI DI BARIS PERTAMA!
include 'koneksi.php';

// Jika belum login, tendang kembali ke halaman login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:login.php?pesan=belum_login");
    exit;
}

$role = $_SESSION['role'];
$my_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Utama - Biodata Guru</title>
</head>
<body>
    <h3>Halo, <?php echo $_SESSION['username']; ?> (Status: <?php echo $role; ?>)</h3>
    <a href="logout.php">Logout</a> | 
    
    <?php if ($role == 'admin') { ?>
        <a href="tambah.php">+ Tambah Guru Baru</a>
    <?php } ?>
    <br><br>

    <?php 
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "berhasil"){
            echo "<p style='color:green; font-weight:bold;'>Data Berhasil Disimpan!</p>";
        } else if($_GET['pesan'] == "hapus"){
            echo "<p style='color:red; font-weight:bold;'>Data Berhasil Dihapus!</p>";
        } else if($_GET['pesan'] == "berhasil_update"){
            echo "<p style='color:blue; font-weight:bold;'>Data Berhasil Diperbarui!</p>";
        }
    }
    ?>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Username</th><th>Nama</th><th>NIP</th><th>Jabatan</th><th>Alamat</th><th>Tempat, Tgl Lahir</th><th>No Handphone</th><th>Opsi</th>
        </tr>

        <?php
        // Menggunakan LEFT JOIN agar akun yang belum isi biodata tetap muncul namanya dan tidak error
        if ($role == 'admin') {
            $query = mysqli_query($koneksi, "SELECT users.username, users.id AS uid, biodata_guru.* FROM users LEFT JOIN biodata_guru ON users.id = biodata_guru.user_id");
        } else {
            $query = mysqli_query($koneksi, "SELECT users.username, users.id AS uid, biodata_guru.* FROM users LEFT JOIN biodata_guru ON users.id = biodata_guru.user_id WHERE users.id = '$my_id'");
        }

        // Cek apakah ada data atau tidak
        if (mysqli_num_rows($query) > 0) {
            while ($data = mysqli_fetch_array($query)) {
                // Beri teks alternatif jika kolom biodata masih kosong di database
                $nama = !empty($data['nama']) ? $data['nama'] : "- Belum Diisi -";
                $nip = !empty($data['NIP']) ? $data['NIP'] : "-";
                $jabatan = !empty($data['jabatan']) ? $data['jabatan'] : "-";
                $alamat = !empty($data['alamat']) ? $data['alamat'] : "-";
                $ttl = (!empty($data['tempat_lahir']) && !empty($data['tanggal_lahir'])) ? $data['tempat_lahir'] . ", " . $data['tanggal_lahir'] : "-";
                
                // Catatan: Pastikan nama kolom no hp di tabel MySQL kamu adalah 'no_hp' (tanpa spasi)
                $no_hp = !empty($data['no_hp']) ? $data['no_hp'] : "-"; 
            ?>
            <tr>
                <td><?php echo $data['username']; ?></td>
                <td><?php echo $nama; ?></td>
                <td><?php echo $nip; ?></td>
                <td><?php echo $jabatan; ?></td>
                <td><?php echo $alamat; ?></td>
                <td><?php echo $ttl; ?></td>
                <td><?php echo $no_hp; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $data['uid']; ?>">Edit</a>
                    
                    <?php if ($role == 'admin') { ?>
                        | <a href="hapus.php?id=<?php echo $data['uid']; ?>" onclick="return confirm('Yakin hapus data?')">Hapus</a>
                    <?php } ?>
                </td>
            </tr>
            <?php 
            } 
        } else {
            echo "<tr><td colspan='8' align='center'>Data tidak ditemukan</td></tr>";
        }
        ?>
    </table>
</body>
</html>
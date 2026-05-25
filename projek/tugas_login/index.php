<?php 
session_start();
include 'koneksi.php'; 

// --- LOGIKA LOGOUT ---
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

$step = "login"; 

// --- 1. PROSES CEK LOGIN ---
if (isset($_POST['proses_login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password_input = $_POST['password']; 
    
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password_input'");
    
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama']     = $data['nama_lengkap'];
        
        if (!empty($data['NIP/NIS'])) {
            $_SESSION['status'] = "login";
            $_SESSION['nip']    = $data['NIP/NIS'];
            $_SESSION['posisi'] = $data['posisi']; 
            $_SESSION['no_hp']  = $data['no_hp']; 
            $_SESSION['jk']     = $data['jk']; 
            $step = "utama"; 
        } else {
            $step = "biodata"; 
        }
    } else {
        echo "<script>alert('Username atau Password Salah!');</script>";
    }
}

// --- 2. PROSES REGISTRASI ---
elseif (isset($_POST['proses_register'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $nama_lengkap = $_POST['nama_lengkap']; 

    $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek_user) > 0) {
        echo "<script>alert('Username sudah ada!');</script>";
        $step = "register";
    } else {
        $insert = mysqli_query($koneksi, "INSERT INTO users (username, password, nama_lengkap) VALUES ('$username', '$password', '$nama_lengkap')");
        if ($insert) {
            echo "<script>alert('Akun Berhasil! Silakan Login.'); window.location.href='index.php';</script>";
        }
    }
}

// --- 3. PROSES SIMPAN BIODATA ---
elseif (isset($_POST['simpan_biodata'])) {
    $username  = $_SESSION['username'];
    $nip       = $_POST['nip'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $posisi    = $_POST['posisi']; 
    $alamat    = $_POST['alamat'];
    $no_hp     = $_POST['no_hp']; 
    $jk        = $_POST['jenis_kelamin']; 
    
    $sql = "UPDATE users SET `NIP/NIS`='$nip', tgl_lahir='$tgl_lahir', posisi='$posisi', alamat='$alamat', no_hp='$no_hp', jk='$jk' WHERE username='$username'";
    $update = mysqli_query($koneksi, $sql);
    
    if ($update) {
        $_SESSION['status'] = "login";
        $_SESSION['nip']    = $nip;
        $_SESSION['posisi'] = $posisi; 
        $_SESSION['no_hp']  = $no_hp; 
        $_SESSION['jk']     = $jk; 
        $step = "selesai"; 
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
        $step = "biodata";
    }
}

elseif (isset($_SESSION['status']) && $_SESSION['status'] == "login") { $step = "utama"; }
elseif (isset($_GET['page']) && $_GET['page'] == 'register') { $step = "register"; }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Terpadu</title>
    <style>
        body { margin: 0; padding: 0; font-family: 'Segoe UI', Arial, sans-serif; height: 100vh; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        body::before { content: ""; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-image: url('https://assets.pikiran-rakyat.com/crop/0x0:0x0/x/photo/2024/06/11/3056068281.jpg'); background-size: cover; background-position: center; filter: blur(5px); z-index: -1; transform: scale(1.1); }
        .box { position: relative; z-index: 1; background: rgba(255, 255, 255, 0.95); padding: 30px; border-radius: 20px; width: 400px; box-shadow: 0 15px 35px rgba(0,0,0,0.2); border-top: 6px solid #6FAF4F; text-align: center; }
        input, textarea, select { width: 100%; padding: 12px; margin: 10px 0; box-sizing: border-box; border: 1px solid #ddd; border-radius: 10px; }
        button { width: 100%; padding: 12px; background: #6FAF4F; color: white; border: none; cursor: pointer; border-radius: 10px; font-weight: bold; transition: 0.3s; }
        button:hover { background: #5a943f; transform: translateY(-2px); }
        .btn-web { display: block; text-align: center; padding: 12px; background: #6FAF4F; color: white; text-decoration: none; border-radius: 10px; font-weight: bold; margin-top: 20px; cursor: pointer; }
        .btn-logout { display: block; text-align: center; padding: 10px; background: #dc3545; color: white; text-decoration: none; border-radius: 10px; font-weight: bold; margin-top: 10px; cursor: pointer; }
        .splash-container { display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999; width: 100%; text-align: center; }
        .splash-text { font-size: 130px; font-weight: 900; color: white; letter-spacing: 30px; text-transform: uppercase; text-shadow: 0 0 30px rgba(255,255,255,0.6); }
        .jalankan-animasi { animation: fadeInOut 3.5s ease-in-out forwards; }
        @keyframes fadeInOut { 0% { opacity: 0; transform: scale(0.6); } 40% { opacity: 1; transform: scale(1); } 100% { opacity: 0; transform: scale(1.2); } }
        table { width: 100%; text-align: left; margin-bottom: 20px; border-collapse: collapse; }
        table td { padding: 8px 0; border-bottom: 1px solid #eee; }
        .nav-link { margin-top: 15px; font-size: 14px; color: #555; }
        .nav-link a { color: #6FAF4F; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div id="halamanSplash" class="splash-container"><h1 id="teksSplash" class="splash-text">KURIKULUM</h1></div>

    <?php if ($step == "login") : ?>
    <div class="box">
        <h2 style="color:#6FAF4F">LOGIN</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" id="passL" placeholder="Password" required>
            <label style="font-size:12px"><input type="checkbox" onclick="togglePass('passL')"> Lihat Password</label>
            <button type="submit" name="proses_login">Masuk</button>
        </form>
        <div class="nav-link">Belum punya akun? <a href="?page=register">Daftar di sini</a></div>
    </div>
    <?php elseif ($step == "register") : ?>
    <div class="box">
        <h2 style="color:#6FAF4F">BUAT AKUN</h2>
        <form method="POST">
            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" id="passR" placeholder="Password" required>
            <label style="font-size:12px"><input type="checkbox" onclick="togglePass('passR')"> Lihat Password</label>
            <button type="submit" name="proses_register">Daftar</button>
        </form>
        <div class="nav-link">Sudah punya akun? <a href="index.php">Login</a></div>
    </div>
    <?php elseif ($step == "biodata") : ?>
    <div class="box">
        <h2 style="color:#6FAF4F">Lengkapi Data</h2>
        <form method="POST">
            <input type="text" name="nip" placeholder="NIP/NIS" required>
            <input type="text" name="posisi" placeholder="Posisi" required>
            <input type="text" name="no_hp" placeholder="No Handphone" required>
            <select name="jenis_kelamin" required>
                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <input type="date" name="tgl_lahir" required>
            <textarea name="alamat" placeholder="Alamat" rows="3"></textarea>
            <button type="submit" name="simpan_biodata">Simpan</button>
        </form>
    </div>
    <?php elseif ($step == "selesai") : ?>
    <div id="halamanTabel" class="box">
        <h2 style="color:#6FAF4F">Data Disimpan!</h2>
        <p>Halaman dialihkan dalam: <span id="timer">5</span></p>
        <button onclick="showSplash('halamanTabel')">Pindah Sekarang</button>
    </div>
    <script>
        let detik = 5;
        const interval = setInterval(() => { detik--; document.getElementById('timer').innerText = detik; if (detik <= 0) { clearInterval(interval); showSplash('halamanTabel'); } }, 1000);
    </script>
    <?php elseif ($step == "utama") : ?>
    <div id="halamanUtamaProfil" class="box" style="text-align: left; width: 450px;">
        <h2 style="color: #6FAF4F; text-align: center;">Profil Anda</h2>
        <table>
            <tr><td><b>Nama</b></td><td>: <?php echo $_SESSION['nama']; ?></td></tr>
            <tr><td><b>NIP/NIS</b></td><td>: <?php echo $_SESSION['nip']; ?></td></tr>
            <tr><td><b>Posisi</b></td><td>: <?php echo $_SESSION['posisi']; ?></td></tr>
            <tr><td><b>No HP</b></td><td>: <?php echo $_SESSION['no_hp']; ?></td></tr> 
            <tr><td><b>J. Kelamin</b></td><td>: <?php echo $_SESSION['jk']; ?></td></tr> 
        </table>
        <button onclick="showSplash('halamanUtamaProfil')" class="btn-web">Masuk ke Website Kurikulum</button>
        <a href="?logout=true" class="btn-logout">Logout</a>
    </div>
    <?php endif; ?>

    <script>
        function togglePass(id) {
            var x = document.getElementById(id);
            x.type = (x.type === "password") ? "text" : "password";
        }
        function showSplash(idHalamanSkarang) {
            document.getElementById(idHalamanSkarang).style.display = 'none';
            document.getElementById('halamanSplash').style.display = 'block';
            document.getElementById('teksSplash').classList.add('jalankan-animasi');
            setTimeout(() => { window.location.href = "../kurikulum/index.html"; }, 3500); 
        }
    </script>
</body>
</html>
<?php 
session_start();
include 'koneksi.php'; 

// --- 1. LOGIKA SATPAM (Mencegah Error Undefined Index) ---
$nip = isset($nip) ? $nip : "";
$jabatan = isset($jabatan) ? $jabatan : "";

$step = "login"; 

// --- Tambahan: Deteksi jika user klik link daftar atau kembali ---
if (isset($_GET['page']) && $_GET['page'] == 'register') {
    $step = "register";
}

// --- 2. PROSES CEK LOGIN ---
if (isset($_POST['proses_login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); 
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['username'] = $username;
        $step = "biodata"; 
    } else {
        echo "<script>alert('Login Gagal! Periksa Username/Password');</script>";
    }
}

// --- TAMBAHAN: PROSES REGISTRASI AKUN BARU ---
if (isset($_POST['proses_register'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Menggunakan md5 disamakan dengan sistem loginmu

    // Cek dulu apakah username sudah terpakai
    $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek_user) > 0) {
        echo "<script>alert('Username sudah digunakan! Cari nama lain.');</script>";
        $step = "register";
    } else {
        // Simpan data akun baru ke database
        $insert = mysqli_query($koneksi, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
        if ($insert) {
            echo "<script>alert('Akun Berhasil Dibuat! Silakan Login.'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal mendaftarkan akun.');</script>";
            $step = "register";
        }
    }
}

// --- 3. PROSES SIMPAN BIODATA ---
if (isset($_POST['simpan_biodata'])) {
    $username  = $_SESSION['username'];
    $nip       = $_POST['nip'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jabatan   = $_POST['jabatan'];
    $alamat    = $_POST['alamat'];
    
    $update = mysqli_query($koneksi, "UPDATE users SET nip='$nip', tgl_lahir='$tgl_lahir', jabatan='$jabatan', alamat='$alamat' WHERE username='$username'");
    
    if ($update) {
        $step = "selesai"; 
    } else {
        echo "Gagal Update: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Terpadu</title>
    <style>
        body {
            margin: 0; padding: 0;
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url('https://assets.pikiran-rakyat.com/crop/0x0:0x0/x/photo/2024/06/11/3056068281.jpg');
            background-size: cover; background-position: center;
            filter: blur(5px); z-index: -1; transform: scale(1.1); 
        }

        .box { 
            position: relative; z-index: 1; 
            background: rgba(255, 255, 255, 0.95); 
            padding: 30px; border-radius: 20px; width: 400px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.2); 
            border-top: 6px solid #6FAF4F; text-align: center;
        }

        input, textarea { width: 100%; padding: 12px; margin: 10px 0; box-sizing: border-box; border: 1px solid #ddd; border-radius: 10px; }
        button { width: 100%; padding: 12px; background: #6FAF4F; color: white; border: none; cursor: pointer; border-radius: 10px; font-weight: bold; transition: 0.3s; }
        button:hover { background: #5a943f; transform: translateY(-2px); }

        /* --- STYLE KURIKULUM RAKSASA --- */
        .splash-container {
            display: none;
            position: fixed;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            width: 100%;
            text-align: center;
        }

        .splash-text {
            font-size: 130px; 
            font-weight: 900;
            color: white;
            letter-spacing: 30px; 
            text-transform: uppercase;
            text-shadow: 0 0 30px rgba(255,255,255,0.6), 0 10px 50px rgba(0,0,0,0.6);
            margin: 0;
            white-space: nowrap;
            animation: fadeInOut 3.5s ease-in-out forwards;
        }

        @keyframes fadeInOut {
            0% { opacity: 0; transform: scale(0.6); filter: blur(15px); }
            40% { opacity: 1; transform: scale(1); filter: blur(0px); }
            70% { opacity: 1; transform: scale(1.05); }
            100% { opacity: 0; transform: scale(1.2); filter: blur(10px); }
        }

        #timer {
            font-size: 20px; font-weight: bold; color: white;
            background: linear-gradient(45deg, #6FAF4F, #91D06C);
            padding: 5px 15px; border-radius: 50px; display: inline-block;
        }

        table { width: 100%; text-align: left; margin-bottom: 20px; border-collapse: collapse; }
        table td { padding: 8px 0; border-bottom: 1px solid #eee; }

        /* Style untuk link navigasi bawah */
        .nav-link { margin-top: 15px; font-size: 14px; color: #555; }
        .nav-link a { color: #6FAF4F; text-decoration: none; font-weight: bold; }
        .nav-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <?php if ($step == "login") : ?>
    <div class="box">
        <h2 style="color:#6FAF4F">LOGIN</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required autocomplete="off">
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="proses_login">Masuk</button>
        </form>
        <div class="nav-link">
            Belum punya akun? <a href="?page=register">Daftar di sini</a>
        </div>
    </div>

    <?php elseif ($step == "register") : ?>
    <div class="box">
        <h2 style="color:#6FAF4F">BUAT AKUN</h2>
        <form method="POST" action="index.php">
            <input type="text" name="username" placeholder="Masukkan Username Baru" required autocomplete="off">
            <input type="password" name="password" placeholder="Masukkan Password Baru" required>
            <button type="submit" name="proses_register">Daftar Sekarang</button>
        </form>
        <div class="nav-link">
            Sudah punya akun? <a href="index.php">Login di sini</a>
        </div>
    </div>

    <?php elseif ($step == "biodata") : ?>
    <div class="box">
        <h2 style="color:#6FAF4F">Lengkapi Data</h2>
        <p>Halo, <b><?php echo $_SESSION['username']; ?></b></p>
        <form method="POST">
            <input type="text" name="nip" placeholder="NIP" required>
            <input type="text" name="jabatan" placeholder="Jabatan" required>
            <input type="date" name="tgl_lahir" required>
            <textarea name="alamat" placeholder="Alamat Lengkap" rows="3"></textarea>
            <button type="submit" name="simpan_biodata">Simpan & Lanjut</button>
        </form>
    </div>

    <?php elseif ($step == "selesai") : ?>
    <div id="halamanTabel" class="box">
        <h2 style="color:#6FAF4F">Data Disimpan!</h2>
        <table>
            <tr><td><b>NIP</b></td><td>: <?php echo $nip; ?></td></tr>
            <tr><td><b>Jabatan</b></td><td>: <?php echo $jabatan; ?></td></tr>
        </table>
        <p style="margin-top:15px;">Halaman dialihkan dalam: <span id="timer">5</span></p>
        <button onclick="showSplash()">Pindah Sekarang</button>
    </div>

    <div id="halamanSplash" class="splash-container">
        <h1 class="splash-text">KURIKULUM</h1>
    </div>

    <script>
        let detik = 5;
        const interval = setInterval(() => {
            detik--;
            document.getElementById('timer').innerText = detik;
            if (detik <= 0) {
                clearInterval(interval);
                showSplash();
            }
        }, 1000);

        function showSplash() {
            document.getElementById('halamanTabel').style.display = 'none';
            document.getElementById('halamanSplash').style.display = 'block';
            
            setTimeout(() => {
                window.location.href = "../kurikulum/index.html";
            }, 3500); 
        }
    </script>
    <?php endif; ?>

</body>
</html>
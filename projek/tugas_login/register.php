<?php
// 1. Hubungkan ke database menggunakan file koneksi yang sudah kamu punya
include 'koneksi.php';

// 2. Cek apakah tombol "Daftar" sudah diklik
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 3. Enkripsi password agar aman di database (tidak berupa teks biasa)
    $password_aman = password_hash($password, PASSWORD_DEFAULT);

    // 4. Cek apakah username sudah ada di database atau belum
    $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($cek_user) > 0) {
        echo "<script>
                alert('Username sudah terdaftar! Gunakan username lain.');
                window.location.href = 'register.php';
              </script>";
    } else {
        // 5. Jika username belum ada, masukkan data ke tabel 'users'
        // (Pastikan kamu sudah membuat tabel 'users' dengan kolom id, username, dan password)
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password_aman')";
        $simpan = mysqli_query($koneksi, $query);

        if ($simpan) {
            echo "<script>
                    alert('Registrasi Berhasil! Silakan Login.');
                    window.location.href = 'login.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal mendaftarkan akun baru.');
                  </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Akun Baru</title>
    <style>
        /* Style sederhana agar tampilan form rapi di tengah halaman */
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1); width: 300px; }
        h2 { text-align: center; margin-bottom: 20px; color: #333; }
        label { font-weight: bold; color: #555; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; margin: 8px 0 20px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #28a745; border: none; color: white; border-radius: 4px; font-weight: bold; cursor: pointer; }
        button:hover { background-color: #218838; }
        p { text-align: center; margin-top: 15px; font-size: 14px; }
        a { color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="card">
    <h2>Daftar Akun</h2>
    <form action="" method="POST">
        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan username baru" required autocomplete="off">

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password" required>

        <button type="submit" name="register">Daftar Sekarang</button>
    </form>
    
    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
</div>

</body>
</html>
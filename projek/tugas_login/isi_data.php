<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Isi Data Profil</title>
</head>
<body style="font-family: Arial; background: #f4f4f4; padding: 20px;">
    <div style="width: 400px; margin: auto; background: white; padding: 20px; border-radius: 10px; border-top: 5px solid #800000; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h2 style="color: #91D06C; text-align: center;">Lengkapi Data</h2>
        <form action="update_data.php" method="POST">
            <p>Username: <b><?php echo $_SESSION['username']; ?></b></p>
            
            <label>NIP:</label><br>
            <input type="text" name="nip" style="width: 100%; padding: 8px; margin: 10px 0;" required><br>
            
            <label>Posisi:</label><br>
            <input type="text" name="posisi" style="width: 100%; padding: 8px; margin: 10px 0;" required><br>
            
            <label>Tanggal Lahir:</label><br>
            <input type="date" name="tgl_lahir" style="width: 100%; padding: 8px; margin: 10px 0;" required><br>
            
            <label>Alamat:</label><br>
            <textarea name="alamat" style="width: 100%; padding: 8px; margin: 10px 0;" required></textarea><br>
            
            <button type="submit" style="width: 100%; background: #91D06C; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer;">Simpan Data</button>
        </form>
    </div>
</body>
</html>
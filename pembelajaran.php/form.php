<!DOCTYPE html>
<html lang="en">
        <h1>Form HTML Dengan PHP</h1>
    <form action="proses.php" method="post">
        <div>
        <label>Nama</label><input type="text" name="nama" value="<?=isset($_POST['nama']) ? $_POST['nama'] : ''?>"/>
        </div>
        <div>
            <label>Email</label><input type="text" name="email" value="<?=isset($_POST['email']) ? $_POST['email'] : ''?>"/>
        </div>
        <input type="submit" name="submit" value="Save"/>
    </form>
<?php
if (isset($_POST['submit'])) {
    echo 'Nama anda : ' . $_POST['nama'] . '<br/>';
    echo 'Email anda : ' . $_POST['email'];
}?>

<?php
session_start();
if (!isset($_SESSION["is_login"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
</head>
<body>
    <?php include "layout/header.html"; ?>
    
    <h3>Selamat datang, <?= htmlspecialchars($_SESSION["username"]); ?>!</h3>

    <h4>Pilih Fitur:</h4>
    <ul>
        <li><a href="pengajuan_donasi.php">Pengajuan Donasi</a></li>
        <li><a href="riwayat_donasi.php">Riwayat Donasi</a></li>
        <li><a href="profil.php">Profil Saya</a></li>
    </ul>

    <form action="logout.php" method="POST">
        <button type="submit" name="logout">Logout</button> 
    </form>

    <?php include "layout/footer.html"; ?>
</body>
</html>

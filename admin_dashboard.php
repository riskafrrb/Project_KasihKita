<?php
session_start();
if (!isset($_SESSION["is_login"]) || $_SESSION["role"] !== "admin") {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
</head>
<body>
    <?php include "layout/header.html"; ?>
    
    <h3>Selamat datang, Admin <?= htmlspecialchars($_SESSION["username"]); ?>!</h3>
    <p>Ini adalah halaman khusus untuk admin.</p>

    <form action="logout.php" method="POST">
        <button type="submit" name="logout">Logout</button> 
    </form>

    <?php include "layout/footer.html"; ?>
</body>
</html>

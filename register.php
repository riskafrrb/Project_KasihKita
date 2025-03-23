<?php
include "service/database.php";
$register_message = "";
session_start();

if (isset($_SESSION["is_login"])) {
    header("location: dashboard.php");
    exit();
}

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hash_password = hash("sha256", $password);
    
    // Semua yang mendaftar otomatis sebagai 'user'
    $role = "user";

    try {
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hash_password', '$role')";

        if ($db->query($sql)) {
            $register_message = "Pendaftaran berhasil, silakan login!";
        } else {
            $register_message = "Pendaftaran gagal, coba lagi!";
        }
    } catch (mysqli_sql_exception) {
        $register_message = "Username sudah ada, silakan gunakan yang lain!";
    }
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php include "layout/header.html"; ?>
    <h3>DAFTAR AKUN</h3>
    <i><?= $register_message ?></i>
    <form action="register.php" method="POST">
        <input type="text" placeholder="Username" name="username" required />
        <input type="password" placeholder="Password" name="password" required />
        <button type="submit" name="register">Daftar Sekarang</button>
    </form>
    <?php include "layout/footer.html"; ?>
</body>
</html>

<?php
include "service/database.php";
session_start();
$login_message = "";

if (isset($_SESSION["is_login"])) {
    header("location: user_dashboard.php");
    exit();
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash_password = hash("sha256", $password);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$hash_password'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION["user_id"] = $data["id"]; 
        $_SESSION["username"] = $data["username"];
        $_SESSION["role"] = $data["role"];
        $_SESSION["is_login"] = true;

        // Redirect berdasarkan role
        if ($data["role"] === "admin") {
            header("location: admin_dashboard.php");
        } else {
            header("location: user_dashboard.php");
        }
        exit();
    } else {
        $login_message = "Akun tidak ditemukan!";
    }
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php include "layout/header.html"; ?>
    <h3>MASUK AKUN</h3>
    <i><?= $login_message ?></i>
    <form action="login.php" method="POST">
        <input type="text" placeholder="Username" name="username" required />
        <input type="password" placeholder="Password" name="password" required />
        <button type="submit" name="login">Masuk Sekarang</button>
    </form>
    <?php include "layout/footer.html"; ?>
</body>
</html>

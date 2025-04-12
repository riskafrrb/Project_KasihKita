<?php
include "service/database.php";
session_start();
$login_message = "";

if (isset($_SESSION["is_login"])) {
    if ($_SESSION["role"] === "admin") {
        header("location: admin_dashboard.php");
    } else {
        header("location: user_dashboard.php");
    }
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
        $_SESSION["email"] = $data["email"]; // ← tambahkan ini saat login berhasil


        if ($data["role"] === "admin") {
            header("location: admin_dashboard.php");
        } else {
            header("location: user_dashboard.php");
        }
        exit();
    } else {
        $login_message = "Username/password salah!";
    }
    $db->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kasih Kita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #0b1f47; /* ← Warna peach muda */
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: Arial, sans-serif;
        }

        .login-card {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }

        .login-card h3 {
            color: #17a2b8;
            font-weight: bold;
        }

        .btn-login {
            background-color: #17a2b8;
            color: white;
            font-weight: bold;
            border-radius: 50px;
            padding: 10px;
            font-size: 16px;
        }

        .btn-login:hover {
            background-color: #138496;
        }

        .form-control {
            border-radius: 10px;
        }

        .login-message {
            color: red;
            font-style: italic;
        }
    </style>
</head>
<body>
<?php include "layout/headerlogin.html"; ?>
<div class="login-card text-center">
        <h3 class="mb-4">Silahkan Login</h3>
        <p class="login-message"><?= $login_message ?></p>
        <form action="login.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" name="username" required />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" required />
            </div>
            <button type="submit" name="login" class="btn btn-login btn-block">Masuk Sekarang</button>

            <p class="mt-3 text-center">
                Belum punya akun? <a href="register.php" class="text-info font-weight-bold">Silakan daftar di sini</a>
            </p>
        </form>
    </div>

</body>
</html>

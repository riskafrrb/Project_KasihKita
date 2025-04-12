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
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hash_password = hash("sha256", $password);
    
    $role = "user";

    try {
        $sql = "INSERT INTO users (username, email, password, role) 
                VALUES ('$username', '$email', '$hash_password', '$role')";

        if ($db->query($sql)) {
            $register_message = "Pendaftaran berhasil, silakan login!";
        } else {
            $register_message = "Pendaftaran gagal, coba lagi!";
        }
    } catch (mysqli_sql_exception) {
        $register_message = "Username atau Email sudah terdaftar, gunakan yang lain!";
    }
    $db->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Kasih Kita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #0b1f47;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        }

        .register-card {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }

        .register-card h3 {
            color: #17a2b8;
            font-weight: bold;
        }

        .btn-register {
            background-color: #17a2b8;
            color: white;
            font-weight: bold;
            border-radius: 50px;
            padding: 10px;
            font-size: 16px;
        }

        .btn-register:hover {
            background-color: #138496;
        }

        .form-control {
            border-radius: 10px;
        }

        .register-message {
            color: red;
            font-style: italic;
        }
    </style>
</head>
<body>
    <?php include "layout/headerlogin.html"; ?>
    <div class="register-card text-center">
        <h3 class="mb-4">Daftar Akun</h3>
        <p class="register-message"><?= $register_message ?></p>
        <form action="register.php" method="POST">
    <div class="form-group">
        <input type="email" class="form-control" placeholder="Email" name="email" required />
    </div>
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Username" name="username" required />
    </div>
    <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" required />
    </div>
    <button type="submit" name="register" class="btn btn-register btn-block">Daftar Sekarang</button>

    <p class="mt-3 text-center">
        Sudah punya akun? <a href="login.php" class="text-info font-weight-bold">Login</a>
    </p>
</form>

    </div>
</body>
</html>

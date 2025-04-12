<?php
session_start();

// Cek apakah pengguna sudah login
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
    <title>Profil Saya - Kasih Kita</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
            color: white;
            font-family: Arial, sans-serif;
            min-height: 100vh;
            padding-top: 80px;
        }

        .card-custom {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            transition: transform 0.2s ease-in-out;
        }

        .card-custom:hover {
            transform: translateY(-5px);
        }

        .card-title {
            color: #0b1f47;
            font-weight: bold;
        }

        .btn-custom {
            border-radius: 50px;
            font-weight: bold;
        }

        .profile-text h3 {
            color: #17a2b8;
            font-weight: bold;
        }

        .profile-text p {
            color: #dcdcdc;
        }
    </style>
</head>
<body>

    <?php include "layout/header.html"; ?>

    <div class="container">
        <div class="text-center profile-text mb-5">
            <h3>Profil Pengguna</h3>
            <p><span class="text-dark">Selamat datang,</span> <span class="text-info"><?= htmlspecialchars($_SESSION["username"]); ?></span></p>
        </div>

        <div class="row">
            <!-- Info Profil -->
            <div class="col-md-6 mb-4">
                <div class="card card-custom h-100 text-center p-3">
                    <div class="card-body">
                        <i class="fas fa-user-circle fa-3x mb-3 text-info"></i>
                        <h5 class="card-title">Nama Pengguna</h5>
                        <p class="card-text text-dark"><?= htmlspecialchars($_SESSION["username"]); ?></p>
                    </div>
                </div>
            </div>

            <!-- Info Lainnya -->
            <div class="col-md-6 mb-4">
                <div class="card card-custom h-100 text-center p-3">
                    <div class="card-body">
                        <i class="fas fa-envelope fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Email</h5>
                        <p class="card-text text-dark"><?= htmlspecialchars($_SESSION["email"]); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button untuk Kembali -->
        <div class="text-center mt-4">
    <a href="user_dashboard.php" class="btn btn-secondary">Kembali</a>
</div>
    </div>

    <?php include "layout/footer.html"; ?>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

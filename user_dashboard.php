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
    <title>Dashboard User - Kasih Kita</title>
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

        .welcome-text h3 {
            color: #17a2b8;
            font-weight: bold;
        }

        .welcome-text p {
            color: #dcdcdc;
        }
    </style>
</head>
<body>

    <?php include "layout/header.html"; ?>

    <div class="container">
        <div class="text-center welcome-text mb-5">
            <h3>Selamat datang, <span class="text-info"><?= htmlspecialchars($_SESSION["username"]); ?></span>!</h3>
            <p style="color: #000000;">Silakan pilih fitur yang tersedia di bawah ini.</p>
        </div>

        <div class="row">
            <!-- Pengajuan Donasi -->
            <div class="col-md-4 mb-4">
                <div class="card card-custom h-100 text-center p-3">
                    <div class="card-body">
                        <i class="fas fa-hands-helping fa-3x mb-3 text-success"></i>
                        <h5 class="card-title">Pengajuan Donasi</h5>
                        <p class="card-text text-dark">Ajukan donasi baru untuk bantu sesama.</p>
                        <a href="pengajuan_donasi.php" class="btn btn-outline-success btn-custom btn-sm">Akses</a>
                    </div>
                </div>
            </div>

            <!-- Riwayat Donasi -->
            <div class="col-md-4 mb-4">
                <div class="card card-custom h-100 text-center p-3">
                    <div class="card-body">
                        <i class="fas fa-history fa-3x mb-3 text-warning"></i>
                        <h5 class="card-title">Riwayat Donasi</h5>
                        <p class="card-text text-dark">Lihat catatan dan status donasi kamu.</p>
                        <a href="riwayat_donasi.php" class="btn btn-outline-warning btn-custom btn-sm">Lihat</a>
                    </div>
                </div>
            </div>

            <!-- Profil Saya -->
            <div class="col-md-4 mb-4">
                <div class="card card-custom h-100 text-center p-3">
                    <div class="card-body">
                        <i class="fas fa-user-circle fa-3x mb-3 text-info"></i>
                        <h5 class="card-title">Profil Saya</h5>
                        <p class="card-text text-dark">Kelola data pribadi dan pengaturan akun.</p>
                        <a href="profil.php" class="btn btn-outline-info btn-custom btn-sm">Buka</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "layout/footer.html"; ?>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

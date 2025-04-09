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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="margin-top: 80px;">

    <?php include "layout/header.html"; ?>

    <div class="container">
    <div class="text-center mb-4">
        <h3>Selamat datang, <span class="text-primary"><?= htmlspecialchars($_SESSION["username"]); ?></span>!</h3>
        <p class="text-muted">Silakan pilih fitur yang tersedia di bawah ini.</p>
    </div>

    <div class="row">
        <!-- Pengajuan Donasi -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-hands-helping fa-3x mb-3 text-success"></i>
                    <h5 class="card-title">Pengajuan Donasi</h5>
                    <p class="card-text">Ajukan donasi baru untuk bantu sesama.</p>
                    <a href="pengajuan_donasi.php" class="btn btn-outline-success btn-sm">Akses</a>
                </div>
            </div>
        </div>

        <!-- Riwayat Donasi -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-history fa-3x mb-3 text-warning"></i>
                    <h5 class="card-title">Riwayat Donasi</h5>
                    <p class="card-text">Lihat catatan dan status donasi kamu.</p>
                    <a href="riwayat_donasi.php" class="btn btn-outline-warning btn-sm">Lihat</a>
                </div>
            </div>
        </div>

        <!-- Profil Saya -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-user-circle fa-3x mb-3 text-info"></i>
                    <h5 class="card-title">Profil Saya</h5>
                    <p class="card-text">Kelola data pribadi dan pengaturan akun.</p>
                    <a href="profil.php" class="btn btn-outline-info btn-sm">Buka</a>
                </div>
            </div>
        </div>
    </div>

    </div>

    <?php include "layout/footer.html"; ?>

    <!-- Bootstrap JS -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

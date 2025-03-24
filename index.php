<?php
require "service/database.php";

// Ambil semua donasi yang sudah disetujui
$result = $db->query("SELECT * FROM pengajuan_donasi WHERE status = 'Disetujui'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasih Kita - Beranda</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar .nav-link {
            font-size: 18px;
            font-weight: bold;
            padding: 12px 20px;
        }
        .hero-section {
            text-align: center;
            padding: 80px 20px;
            background-color: #f8f9fa;
        }
        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
            color: #1a1a1a;
        }
        .hero-section p {
            font-size: 1.2rem;
            color: #333;
        }
        .btn-primary {
            background-color: #17a2b8;
            border: none;
            padding: 14px 24px;
            font-size: 20px;
            border-radius: 50px;
            text-decoration: none;
        }
        .btn-primary:hover {
            background-color: #138496;
        }
        .donasi-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="#">Kasih Kita</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link btn btn-outline-info" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-success ml-2" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-outline-primary ml-2" href="register.php">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <h1>Selamat Datang 👋</h1>
        <h1>Kasih Kita</h1>
        <p><strong>Platform Donasi & Kemanusiaan</strong></p>
        <p>Bersama kita bisa membuat perubahan. <strong>Mari bantu mereka yang membutuhkan!</strong></p>
        <a href="kontak.php" class="btn btn-primary">Hubungi Kami</a>
    </section>

    <!-- Daftar Donasi -->
    <div class="container mt-5">
        <h2 class="text-center">Donasi yang Sedang Berjalan</h2>
        <div class="row mt-4">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-4">
                    <div class="card donasi-card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row["judul_donasi"]) ?></h5>
                            <p class="card-text"><strong>Kategori:</strong> <?= htmlspecialchars($row["kategori"]) ?></p>
                            <p class="card-text"><strong>Target:</strong> Rp <?= number_format($row["target_donasi"], 2, ",", ".") ?></p>
                            <p class="card-text"><?= nl2br(htmlspecialchars($row["deskripsi"])) ?></p>
                            <a href="detail_donasi.php?id=<?= $row["id"] ?>" class="btn btn-info btn-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php include "layout/footer.html"; ?>
</body>
</html>
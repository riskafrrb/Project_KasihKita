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
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 20px;
    background-image: url('images/batik.jpg'); /* Ganti path kalau beda */
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    position: relative;
}
/* Lapisan putih transparan agar teks terlihat */
.hero-section::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: rgba(255, 255, 255, 0.85);
    z-index: 1;
    border-radius: 0;
}

/* Pastikan isi di atas layer transparan */
.hero-section > * {
    position: relative;
    z-index: 2;
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
        .bantu-section {
    min-height: 70vh; /* atau pakai min-height */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 20px;
    background-image: url('images/batik.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    position: relative;
    color: white;
}
        
/* Optional: kasih overlay putih transparan jika ingin teks tetap terbaca */
.bantu-section::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: rgba(255, 255, 255, 0.85);
    z-index: 1;
}

.bantu-section > * {
    position: relative;
    z-index: 2;
}
        .donasi-card {
            border: none;
            color: #000; /* Warna hitam */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .bantu-section h2 {
    font-size: 3rem;
    font-weight: bold;
    color: #1a1a1a;
}
.donasi-wrapper {
    display: flex;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    -webkit-overflow-scrolling: touch;
    padding-bottom: 10px;
    padding-left: 10px;
}

.donasi-wrapper::-webkit-scrollbar {
    height: 8px;
}

.donasi-wrapper::-webkit-scrollbar-thumb {
    background-color: rgba(0,0,0,0.2);
    border-radius: 4px;
}

.donasi-card {
    flex: 0 0 auto;
    width: 300px;
    scroll-snap-align: start;
}

    </style>
</head>
<body>
    
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
  <div class="container">
    <a class="navbar-brand text-info font-weight-bold" href="#">kasihkita</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto font-weight-bold">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">Tentang Kami</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <h1>Selamat Datang👋</h1>
        <h1>Kasih Kita</h1>
        <p class="text-info"><strong>Platform Donasi & Kemanusiaan</strong></p>
        <p>Bersama kita bisa membuat perubahan. <strong>Mari bantu mereka yang membutuhkan!</strong></p>
        <a href="login.php" class="btn btn-primary">Login</a>
    </section>

    <!-- About Section Start -->
    <section id="about" class="py-5" style="background-color: #0b1f47; color: white;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <h4 class="text-info font-weight-bold">Tentang Kami</h4>
        <h2 class="mb-3 font-weight-bold">Yuk, berbagi dan saling bantu sesama!</h2>
        <p class="text-muted">
          Kasih Kita adalah platform donasi dan kemanusiaan yang bertujuan membantu mereka yang membutuhkan.
          Kami percaya bahwa sedikit bantuan bisa memberi harapan besar.
        </p>
      </div>
      <div class="col-lg-6">
        <h5 class="font-weight-bold">Mari Berbagi</h5>
        <p class="text-muted">
          Bergabunglah bersama komunitas peduli kami dalam menyebarkan kebaikan.
          Mulai dari aksi kecil, hingga perubahan besar.
        </p>
        <div class="d-flex">
          <a href="https://youtube.com/chibimarukochanbahasaindonesia" target="_blank" class="btn btn-outline-danger btn-sm mr-2">
            <i class="fab fa-youtube"></i> YouTube
          </a>
          <a href="https://instagram.com/riskafrrb" target="_blank" class="btn btn-outline-warning btn-sm mr-2">
            <i class="fab fa-instagram"></i> Instagram
          </a>
          <a href="https://twitter.com/usntwit" target="_blank" class="btn btn-outline-info btn-sm mr-2">
            <i class="fab fa-twitter"></i> Twitter
          </a>
          <a href="https://tiktok.com/@usntt" target="_blank" class="btn btn-outline-dark btn-sm">
            <i class="fab fa-tiktok"></i> TikTok
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- Tampilan Donasi -->
    <section class="bantu-section">
    <h2 class="display-4 font-weight-bold text-info mb-4">Bantu Mereka</h2>
    <div class="container">
    <div class="donasi-wrapper mt-4">
    <?php while ($row = $result->fetch_assoc()) { ?>
        <div class="card donasi-card mx-2">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($row["judul_donasi"]) ?></h5>
                <p class="card-text"><strong>Kategori:</strong> <?= htmlspecialchars($row["kategori"]) ?></p>
                <p class="card-text"><strong>Target:</strong> Rp <?= number_format($row["target_donasi"], 2, ",", ".") ?></p>
                <p class="card-text"><?= nl2br(htmlspecialchars($row["deskripsi"])) ?></p>
                <a href="detail_donasi.php?id=<?= $row["id"] ?>" class="btn btn-info btn-sm">Lihat Detail</a>
            </div>
        </div>
    <?php } ?>
</div>

    </div>
</section>

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
 
        <!-- Footer Start -->
        <footer style="background-color: #0b1f47;" class="text-white pt-5 pb-4 mt-5">
      <div class="container">
        <div class="row">
          <!-- Kolom 1 -->
          <div class="col-md-4">
            <h5 class="text-uppercase mb-4 font-weight-bold text-white">Kasih Kita</h5>
            <h6 class="text-light">Hubungi Kami</h6>
            <p>kasihkita@gmail.com<br>Jl. yang penting jalan No. 777<br>Surabaya</p>
          </div>

          <!-- Kolom 2 -->
          <div class="col-md-4">
            <h5 class="text-uppercase mb-4 font-weight-bold text-white">Kategori Donasi</h5>
            <ul class="list-unstyled">
            <li><p class="text-light mb-1">Kesehatan</p></li>
            <li><p class="text-light mb-1">Bencana Alam</p></li>
            <li><p class="text-light mb-1">Yatim Piatu</p></li>
            </ul>
          </div>

          <!-- Kolom 3 -->
          <div class="col-md-4">
            <h5 class="text-uppercase mb-4 font-weight-bold text-white">Tautan</h5>
            <ul class="list-unstyled">
              <li><a href="index.php" class="text-light" style="text-decoration: none;">Beranda</a></li>
              <li><a href="#about" class="text-light" style="text-decoration: none;">Tentang Kami</a></li>
            </ul>
          </div>
        </div>

        <hr class="mb-4">

        <!-- Ikon Sosial Media -->
        <div class="text-center mb-3">
          <a href="https://youtube.com/chibimarukochanbahasaindonesia" class="text-white mx-2">
            <i class="fab fa-youtube fa-lg border rounded-circle p-2"></i>
          </a>
          <a href="https://instagram.com/riskafrrb" class="text-white mx-2">
            <i class="fab fa-instagram fa-lg border rounded-circle p-2"></i>
          </a>
          <a href="https://twitter.com/usntwit" class="text-white mx-2">
            <i class="fab fa-twitter fa-lg border rounded-circle p-2"></i>
          </a>
          <a href="https://tiktok.com/@usntt" class="text-white mx-2">
            <i class="fab fa-tiktok fa-lg border rounded-circle p-2"></i>
          </a>
        </div>

        <p class="text-center text-muted small mb-0">
          Dibuat dengan ❤️ oleh <a href="https://instagram.com/riskafrrb" class="text-info font-weight-bold" target="_blank">Kelompok 10</a>.
        </p>
      </div>
    </footer>
    <!-- Footer End -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>
</html>

</body>
</html>
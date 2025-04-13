<?php
require 'service/database.php';

$id_donasi = $_GET['id'] ?? null;

if (!$id_donasi) {
    echo "ID donasi tidak ditemukan.";
    exit();
}

// Ambil data donasi untuk ditampilkan
$id_donasi_safe = mysqli_real_escape_string($db, $id_donasi);
$query = "SELECT judul_donasi, target_donasi FROM pengajuan_donasi WHERE id = $id_donasi_safe";
$result = mysqli_query($db, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $judul_donasi = $row['judul_donasi'];
    $target_donasi = $row['target_donasi'];
} else {
    echo "Donasi tidak ditemukan.";
    exit();
}

// Query untuk menghitung total donasi yang sudah diterima
$query_total = "SELECT SUM(nominal) AS total_donasi FROM donasi WHERE id_donasi = $id_donasi_safe";
$result_total = mysqli_query($db, $query_total);
$total_donasi = mysqli_fetch_assoc($result_total)['total_donasi'] ?? 0;

// Jika target donasi sudah tercapai
$donasi_tercapai = $total_donasi >= $target_donasi;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Donasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            max-width: 600px;
            margin-top: 60px;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #1aa7b9;
            font-weight: 700;
            margin-bottom: 20px;
        }

        p {
            color: #333;
            margin-bottom: 30px;
        }

        .form-control {
            background-color: #f0f0f0; /* abu-abu muda */
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .form-control:focus {
            border-color: #1aa7b9;
            box-shadow: 0 0 0 0.2rem rgba(26, 167, 185, 0.25);
        }

        .btn-custom {
            background-color: #1aa7b9;
            color: white;
            padding: 10px 30px;
            border-radius: 12px;
            border: none;
        }

        .btn-custom:hover {
            background-color: #1796a7;
        }

        .btn-secondary {
            padding: 10px 30px;
            border-radius: 12px;
            margin-left: 10px;
        }

        .btn-group-center {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        
        .alert {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h3 class="text-center">Donasi untuk: <strong><?= htmlspecialchars($judul_donasi) ?></strong></h3>

    <?php if ($donasi_tercapai): ?>
        <div class="alert alert-success">
            <strong>Target donasi sudah tercapai!</strong> Terima kasih atas dukungan Anda.
        </div>
        <div class="btn-group-center mt-4">
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </div>
    <?php else: ?>
        <form action="proses_donasi.php" method="POST">
            <input type="hidden" name="id_donasi" value="<?= $id_donasi ?>">

            <div class="form-group">
                <label for="nama_donatur">Nama Donatur</label>
                <input type="text" class="form-control" name="nama_donatur" required>
            </div>

            <div class="form-group">
                <label for="nominal">Nominal Donasi (Rp)</label>
                <input type="number" class="form-control" name="nominal" required>
            </div>

            <div class="form-group">
                <label for="metode">Metode Pembayaran</label>
                <select name="metode" class="form-control" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="E-Wallet">E-Wallet</option>
                    <option value="QRIS">Tunai</option>
                </select>
            </div>

            <div class="form-group">
                <label for="kontak">Kontak (Opsional)</label>
                <input type="text" class="form-control" name="kontak">
            </div>

            <div class="btn-group-center mt-4">
                <button type="submit" class="btn btn-custom">Kirim Donasi</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    <?php endif; ?>
</div>

</body>
</html>

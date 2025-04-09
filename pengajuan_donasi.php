<?php
session_start();
if (!isset($_SESSION["is_login"])) {
    header("Location: login.php");
    exit();
}
require "service/database.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ajukan Donasi</title>
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

        h2 {
            color: #1aa7b9;
            font-weight: 700;
            margin-bottom: 10px;
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
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Ajukan Donasi</h2>
    <p class="text-center">Silakan isi data berikut untuk mengajukan donasi.</p>

    <form action="proses_pengajuan.php" method="POST">
        <div class="form-group">
            <label for="nama">Nama Pengaju</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="form-group">
            <label for="kontak">Kontak (HP / WhatsApp)</label>
            <input type="text" class="form-control" id="kontak" name="kontak" required>
        </div>

        <div class="form-group">
            <label for="judul">Judul Donasi</label>
            <input type="text" class="form-control" id="judul" name="judul" required>
        </div>

        <div class="form-group">
            <label for="kategori">Kategori Donasi</label>
            <select class="form-control" id="kategori" name="kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Pendidikan">Pendidikan</option>
                <option value="Kesehatan">Kesehatan</option>
                <option value="Bencana Alam">Bencana Alam</option>
                <option value="Sosial">Sosial</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Donasi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="target">Target Donasi (Rp)</label>
            <input type="number" class="form-control" id="target" name="target" required>
        </div>

        <div class="btn-group-center mt-4">
            <button type="submit" class="btn btn-custom">Kirim</button>
            <a href="user_dashboard.php" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

</body>
</html>
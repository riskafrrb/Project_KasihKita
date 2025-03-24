<?php
session_start();
if (!isset($_SESSION["is_login"])) {
    header("Location: index.php");
    exit();
}
require "service/database.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Donasi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center"><strong>Ajukan Donasi</strong></h2>

        <form action="proses_pengajuan.php" method="POST">
            <div class="form-group">
                <label for="nama">Nama Pengaju:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>

            <div class="form-group">
                <label for="kontak">Kontak:</label>
                <input type="text" class="form-control" id="kontak" name="kontak" required>
            </div>

            <div class="form-group">
                <label for="judul">Judul Donasi:</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori Donasi:</label>
                <select class="form-control" id="kategori" name="kategori" required>
                    <option value="Pendidikan">Pendidikan</option>
                    <option value="Kesehatan">Kesehatan</option>
                    <option value="Bencana Alam">Bencana Alam</option>
                    <option value="Sosial">Sosial</option>
                </select>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Donasi:</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="target">Target Donasi (Rp):</label>
                <input type="number" class="form-control" id="target" name="target" required>
            </div>

            <button type="submit" class="btn btn-primary">Ajukan Donasi</button>
            <a href="user_dashboard.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
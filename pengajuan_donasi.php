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
</head>
<body>
    <h2><strong>AJUKAN DONASI</strong></h2>

    <form action="proses_pengajuan.php" method="POST">
        <label for="nama">Nama Pengaju:</label>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="kontak">Kontak:</label>
        <input type="text" id="kontak" name="kontak" required><br><br>

        <label for="judul">Judul Donasi:</label>
        <input type="text" id="judul" name="judul" required><br><br>

        <label for="kategori">Kategori Donasi:</label>
        <select id="kategori" name="kategori" required>
            <option value="Pendidikan">Pendidikan</option>
            <option value="Kesehatan">Kesehatan</option>
            <option value="Bencana Alam">Bencana Alam</option>
            <option value="Sosial">Sosial</option>
        </select><br><br>

        <label for="deskripsi">Deskripsi Donasi:</label><br>
        <textarea id="deskripsi" name="deskripsi" rows="4" cols="50" required></textarea><br><br>

        <label for="target">Target Donasi (Rp):</label>
        <input type="number" id="target" name="target" required><br><br>

        <button type="submit">Ajukan Donasi</button>
    </form>
</body>
</html>

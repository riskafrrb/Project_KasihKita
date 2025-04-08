<?php
session_start();
require "service/database.php"; // Pastikan file koneksi ada

// Cek apakah user sudah login
if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='index.php';</script>";
    exit();
}

// Pastikan koneksi database masih aktif
if (!isset($db) || !mysqli_ping($db)) {
    die("Koneksi database tidak ditemukan atau terputus.");
}

// Tangkap data dari form
$user_id = $_SESSION["user_id"];
$nama = $_POST["nama"];
$kontak = $_POST["kontak"];
$judul = $_POST["judul"];
$kategori = $_POST["kategori"];
$deskripsi = $_POST["deskripsi"];
$target = $_POST["target"];

// Query untuk insert data
$sql = "INSERT INTO pengajuan_donasi (user_id, nama_pengaju, kontak, judul_donasi, kategori, deskripsi, target_donasi) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

// Gunakan mysqli_prepare agar sesuai dengan mysqli_connect()
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, "isssssd", $user_id, $nama, $kontak, $judul, $kategori, $deskripsi, $target);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Pengajuan Donasi Berhasil!'); window.location='user_dashboard.php';</script>";
} else {
    echo "<script>alert('Gagal mengajukan donasi. Coba lagi!');</script>";
}

// Tutup statement dan koneksi
mysqli_stmt_close($stmt);
mysqli_close($db);
?>

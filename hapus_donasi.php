<?php
session_start();
require "service/database.php"; // Pastikan file koneksi ada

// Cek apakah user sudah login
if (!isset($_SESSION["is_login"])) {
    header("Location: index.php");
    exit();
}

// Pastikan ada parameter ID yang valid
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: riwayat_donasi.php?error=invalid_id");
    exit();
}

$id = intval($_GET["id"]); // Pastikan ID adalah angka
$user_id = $_SESSION["user_id"]; // Ambil user_id yang sedang login

// Cek koneksi database
if (!$db) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Gunakan prepared statement untuk mencegah SQL Injection
$sql = "DELETE FROM pengajuan_donasi WHERE id = ? AND user_id = ?";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, "ii", $id, $user_id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($db);
    header("Location: riwayat_donasi.php?success=deleted");
    exit();
} else {
    mysqli_stmt_close($stmt);
    mysqli_close($db);
    header("Location: riwayat_donasi.php?error=delete_failed");
    exit();
}
?>

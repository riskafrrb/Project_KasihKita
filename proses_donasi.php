<?php
require 'service/database.php';

$id_donasi = $_POST['id_donasi'];
$nama = $_POST['nama_donatur'];
$nominal = $_POST['nominal'];
$metode = $_POST['metode'];
$kontak = $_POST['kontak'] ?? null;
$tanggal = date("Y-m-d H:i:s");

$query = "INSERT INTO donasi (id_donasi, nama_donatur, nominal, metode, kontak, tanggal) 
          VALUES (?, ?, ?, ?, ?, ?)";

// Gunakan prepared statement gaya procedural
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "isisss", $id_donasi, $nama, $nominal, $metode, $kontak, $tanggal);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Terima kasih! Donasi berhasil dikirim.');window.location.href='index.php';</script>";
} else {
    echo "Gagal menyimpan donasi: " . mysqli_error($db);
}

mysqli_stmt_close($stmt);
?>

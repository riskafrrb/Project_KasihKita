<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "buku_tamu";

// Membuat koneksi
$db = mysqli_connect($hostname, $username, $password, $database_name);

// Cek koneksi
if (!$db) { // Mengecek jika koneksi gagal
    die("Koneksi database gagal: " . mysqli_connect_error());
}

?>

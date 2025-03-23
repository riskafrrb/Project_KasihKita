<?php
session_start();
require "service/database.php";

if (!isset($_GET["id"])) {
    header("Location: riwayat_donasi.php");
    exit();
}

$id = $_GET["id"];
$result = $db->query("SELECT * FROM pengajuan_donasi WHERE id = $id");
$data = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST["judul"];
    $kategori = $_POST["kategori"];
    $deskripsi = $_POST["deskripsi"];
    $target = $_POST["target"];

    $stmt = $db->prepare("UPDATE pengajuan_donasi SET judul_donasi = ?, kategori = ?, deskripsi = ?, target_donasi = ? WHERE id = ?");
    $stmt->bind_param("sssdi", $judul, $kategori, $deskripsi, $target, $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Donasi berhasil diperbarui!'); window.location='riwayat_donasi.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Donasi</title>
</head>
<body>
    <h2>Edit Donasi</h2>
    <form action="" method="POST">
        <label>Judul:</label>
        <input type="text" name="judul" value="<?= $data['judul_donasi'] ?>" required><br><br>

        <label>Kategori:</label>
        <select name="kategori" required>
            <option value="Pendidikan">Pendidikan</option>
            <option value="Kesehatan">Kesehatan</option>
            <option value="Bencana Alam">Bencana Alam</option>
            <option value="Sosial">Sosial</option>
        </select><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi" required><?= $data['deskripsi'] ?></textarea><br><br>

        <label>Target Donasi (Rp):</label>
        <input type="number" name="target" value="<?= $data['target_donasi'] ?>" required><br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>

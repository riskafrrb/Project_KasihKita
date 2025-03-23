<?php
session_start();
if (!isset($_SESSION["is_login"])) {
    header("Location: index.php");
    exit();
}
require "service/database.php";

$user_id = $_SESSION["user_id"];
$result = $db->query("SELECT * FROM pengajuan_donasi WHERE user_id = $user_id");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Donasi</title>
</head>
<body>
    <h2>Riwayat Pengajuan Donasi</h2>
    <table border="1">
        <tr>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Target</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row["judul_donasi"] ?></td>
            <td><?= $row["kategori"] ?></td>
            <td>Rp <?= number_format($row["target_donasi"], 2, ",", ".") ?></td>
            <td><?= $row["status"] ?></td>
            <td>
                <a href="edit_donasi.php?id=<?= $row["id"] ?>">Edit</a> |
                <a href="hapus_donasi.php?id=<?= $row["id"] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

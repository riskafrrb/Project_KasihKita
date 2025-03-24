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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Donasi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Riwayat Pengajuan Donasi</h2>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Target</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row["judul_donasi"]) ?></td>
                    <td><?= htmlspecialchars($row["kategori"]) ?></td>
                    <td>Rp <?= number_format($row["target_donasi"], 2, ",", ".") ?></td>
                    <td><strong><?= htmlspecialchars($row["status"]) ?></strong></td>
                    <td>
                        <?php if ($row["status"] !== "Disetujui") { ?>
                            <a href="edit_donasi.php?id=<?= $row["id"] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_donasi.php?id=<?= $row["id"] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        <?php } else { ?>
                            <span class="badge badge-success">Tidak dapat diedit</span>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="user_dashboard.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>
</html>
<?php
session_start();
if (!isset($_SESSION["is_login"]) || $_SESSION["role"] !== "admin") {
    header("Location: index.php");
    exit();
}

require "service/database.php";

// Ambil data donasi dari database
$result = $db->query("SELECT * FROM pengajuan_donasi");

// Proses perubahan status donasi
if (isset($_POST['update_status'])) {
    $donasi_id = $_POST['donasi_id'];
    $status_baru = $_POST['status'];

    $update_query = "UPDATE pengajuan_donasi SET status='$status_baru' WHERE id=$donasi_id";
    if ($db->query($update_query)) {
        echo "<script>alert('Status berhasil diperbarui!'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "Error: " . $db->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include "layout/header.html"; ?>

    <div class="container mt-5">
        <h3>Selamat datang, Admin <?= htmlspecialchars($_SESSION["username"]); ?>!</h3>
        <p>Ini adalah halaman khusus untuk admin.</p>

        <h3 class="mt-4">Riwayat Pengajuan Donasi</h3>
        <table class="table table-bordered">
            <thead>
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
                    <td><?= htmlspecialchars($row["status"]) ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="donasi_id" value="<?= $row['id'] ?>">
                            <select name="status" class="form-control">
                                <option value="Pending" <?= ($row["status"] == "Pending") ? "selected" : "" ?>>Pending</option>
                                <option value="Disetujui" <?= ($row["status"] == "Disetujui") ? "selected" : "" ?>>Disetujui</option>
                                <option value="Ditolak" <?= ($row["status"] == "Ditolak") ? "selected" : "" ?>>Ditolak</option>
                            </select>
                            <button type="submit" name="update_status" class="btn btn-primary btn-sm mt-1">Ubah Status</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <form action="logout.php" method="POST">
            <button type="submit" name="logout" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <?php include "layout/footer.html"; ?>
</body>
</html>
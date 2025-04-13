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
    <title>Dashboard Admin - Kasih Kita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #0b1f47;
            font-family: Arial, sans-serif;
            color: white;
            padding-top: 80px;
        }

        .admin-card {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        h3, h4 {
            color: #17a2b8;
            font-weight: bold;
        }

        .table thead {
            background-color: #17a2b8;
            color: white;
        }

        .btn-primary {
            background-color: #138496;
            border-color: #138496;
        }

        .btn-primary:hover {
            background-color: #0f6e7c;
            border-color: #0f6e7c;
        }

        .btn-danger {
            border-radius: 30px;
            font-weight: bold;
        }

        .logout-btn {
            margin-top: 30px;
        }

        .status-select {
            border-radius: 10px;
        }

        .btn-sm {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <?php include "layout/header.html"; ?>

    <div class="container">
        <div class="admin-card">
            <h3>Selamat datang, Admin <?= htmlspecialchars($_SESSION["username"]); ?>!</h3>
            <p class="text-dark">Ini adalah halaman khusus untuk mengelola pengajuan donasi.</p>

            <h4 class="mt-4 mb-3">Riwayat Pengajuan Donasi</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-dark">
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
                            <td>
    <?php
        $status = htmlspecialchars($row["status"]);
        $badgeClass = "badge-secondary";
        if ($status == "Pending") {
            $badgeClass = "badge-warning";
        } elseif ($status == "Disetujui") {
            $badgeClass = "badge-success";
        } elseif ($status == "Ditolak") {
            $badgeClass = "badge-danger";
        }
    ?>
    <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
</td>

                            <td>
                                <form method="POST" class="form-inline">
                                    <input type="hidden" name="donasi_id" value="<?= $row['id'] ?>">
                                    <select name="status" class="form-control status-select mr-2">
                                        <option value="Pending" <?= ($row["status"] == "Pending") ? "selected" : "" ?>>Pending</option>
                                        <option value="Disetujui" <?= ($row["status"] == "Disetujui") ? "selected" : "" ?>>Disetujui</option>
                                        <option value="Ditolak" <?= ($row["status"] == "Ditolak") ? "selected" : "" ?>>Ditolak</option>
                                    </select>
                                    <button type="submit" name="update_status" class="btn btn-primary btn-sm">Ubah</button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

    
        </div>
    </div>

    <?php include "layout/footer.html"; ?>
</body>
</html>

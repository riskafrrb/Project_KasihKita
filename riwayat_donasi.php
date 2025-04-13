<?php
include 'service/database.php'; // koneksi ke database
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Query untuk mengambil data pengajuan donasi dan menghitung total donasi
$sql = "
    SELECT 
        pd.id, 
        pd.judul_donasi, 
        pd.kategori, 
        pd.target_donasi, 
        pd.status,
        IFNULL(SUM(d.nominal), 0) AS total_donasi
    FROM pengajuan_donasi pd
    LEFT JOIN donasi d ON pd.id = d.id_donasi
    WHERE pd.user_id = $user_id
    GROUP BY pd.id
    ORDER BY pd.id DESC
";

$result = mysqli_query($db, $sql);

if (!$result) {
    die("Query error: " . mysqli_error($db));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Donasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome (opsional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            max-width: 900px;
            margin-top: 60px;
            background-color: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #1aa7b9;
            font-weight: 700;
            margin-bottom: 30px;
        }
        .table {
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 8px;
            overflow: hidden;
        }
        .table th, .table td {
            vertical-align: middle;
            border: none;
            padding: 14px 16px;
        }

        .badge-status {
            padding: 6px 14px;
            border-radius: 16px;
            font-size: 0.85rem;
        }

        .btn-custom {
            background-color: #1aa7b9;
            color: white;
            padding: 8px 20px;
            border-radius: 12px;
            border: none;
        }

        .btn-custom:hover {
            background-color: #1796a7;
        }

        .btn-outline-warning,
        .btn-outline-danger {
            border-radius: 12px;
            padding: 6px 14px;
        }

        .btn-secondary {
            padding: 10px 24px;
            border-radius: 12px;
        }

        .table-hover tbody tr:hover {
            background-color: #f0f0f0;
            transition: background-color 0.3s ease;
        }

        .text-muted {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Riwayat Pengajuan Donasi</h2>

        <table class="table table-hover table-striped table-bordered mt-4">
            <thead class="thead-light">
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Target</th>
                    <th>Status</th>
                    <th>Total Donasi</th>
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
                        <span class="badge-status badge 
                            <?= $row["status"] === 'Disetujui' ? 'badge-success' : 
                                ($row["status"] === 'Ditolak' ? 'badge-danger' : 'badge-secondary') ?>">
                            <?= htmlspecialchars($row["status"]) ?>
                        </span>
                    </td>
                    <td>Rp <?= number_format($row["total_donasi"], 2, ",", ".") ?></td>
                    <td>
                        <?php if ($row["status"] !== "Disetujui") { ?>
                            <a href="edit_donasi.php?id=<?= $row["id"] ?>" class="btn btn-outline-warning btn-sm">Edit</a>
                            <a href="hapus_donasi.php?id=<?= $row["id"] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        <?php } else { ?>
                            <span class="text-muted">-</span>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="user_dashboard.php" class="btn btn-secondary">
                <i></i> Kembali
            </a>
        </div>
    </div>
</body>
</html>

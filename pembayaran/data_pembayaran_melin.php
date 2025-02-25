<?php
session_start();
include "../config/database_melin.php";

$query = "SELECT p.resi_melin, p.total_harga_melin, p.status_pembayaran_melin, p.tanggal_pembayaran_melin 
          FROM pembayaran_melin p"; // Menampilkan semua pembayaran
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Semua Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "../includes/sidebar_melin.php"; ?>

<div class="container mt-5">
    <h2 class="text-center">📜 Daftar Semua Pembayaran</h2>

    <?php if (mysqli_num_rows($result) > 0) : ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Resi</th>
                    <th>Total Harga</th>
                    <th>Status Pembayaran</th>
                    <th>Tanggal Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= $row['resi_melin'] ?></td>
                        <td>Rp <?= number_format($row['total_harga_melin'], 0, ',', '.') ?></td>
                        <td>
                            <?php if ($row['status_pembayaran_melin'] == 'Lunas') : ?>
                                <span class="badge bg-success">Lunas</span>
                            <?php else : ?>
                                <span class="badge bg-danger">Belum Lunas</span>
                            <?php endif; ?>
                        </td>
                        <td><?= !empty($row['tanggal_pembayaran_melin']) ? $row['tanggal_pembayaran_melin'] : '-' ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="alert alert-info text-center">Belum ada transaksi pembayaran.</div>
    <?php endif; ?>
</div>

</body>
</html>

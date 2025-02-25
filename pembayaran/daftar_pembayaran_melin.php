<?php
session_start();
include "../config/database_melin.php";

$query = "SELECT p.resi_melin, p.total_harga_melin, p.status_pembayaran_melin 
          FROM pembayaran_melin p 
          WHERE p.status_pembayaran_melin = 'Belum Lunas'"; // Hanya menampilkan yang belum lunas
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "../includes/sidebar_melin.php"; ?>

<div class="container mt-5">
    <h2 class="text-center">💰 Daftar Pembayaran Belum Lunas</h2>

    <?php if (mysqli_num_rows($result) > 0) : ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Resi</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= $row['resi_melin'] ?></td>
                        <td>Rp <?= number_format($row['total_harga_melin'], 0, ',', '.') ?></td>
                        <td><span class="badge bg-danger"><?= $row['status_pembayaran_melin'] ?></span></td>
                        <td>
                            <a href="proses_pembayaran_melin.php?resi=<?= $row['resi_melin'] ?>&aksi=bayar" class="btn btn-success">💳 Bayar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="alert alert-success text-center">✅ Semua pembayaran sudah lunas!</div>
    <?php endif; ?>
</div>

</body>
</html>

<?php
session_start();
include "../config/database_melin.php";

if (!isset($_GET['resi'])) {
    die("Resi tidak ditemukan.");
}

$resi = $_GET['resi'];

// Ambil detail pengiriman berdasarkan resi
$query = "SELECT * FROM pengiriman_melin WHERE resi_melin = '$resi'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data pengiriman tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php include "../includes/sidebar_melin.php"; ?>
<body>
<div class="container mt-5">
    <h2 class="text-center">Pembayaran Pengiriman</h2>
    <p class="text-center">Resi: <strong><?= $resi ?></strong></p>
    <p class="text-center">Total Harga: <strong>Rp <?= number_format($data['harga_melin'], 0, ',', '.') ?></strong></p>

    <div class="text-center mt-4">
        <a href="proses_pembayaran_melin.php?resi=<?= $resi ?>&aksi=bayar" class="btn btn-success">Bayar Sekarang (pengirim)</a>
        <a href="daftar_pembayaran_melin.php" class="btn btn-secondary">Bayar Nanti (Penerima)</a>
    </div>
</div>
</body>
</html>

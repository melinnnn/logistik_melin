<?php
session_start();
if (!isset($_SESSION['login_melin'])) {
    header("Location: ../auth/login_melin.php");
    exit();
}
include "../config/database_melin.php";

if (!isset($_GET['resi_melin'])) {
    header("Location: tracking_melin.php");
    exit();
}

$resi = $_GET['resi_melin'];
$query = mysqli_query($conn, "SELECT * FROM pengiriman_melin WHERE resi_melin = '$resi'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Tracking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "../includes/sidebar_melin.php"; ?>

<div class="p-4">
    <h2>📦 Hasil Tracking</h2>

    <?php if ($data): ?>
        <table class="table table-bordered">
            <tr>
                <th>Nomor Resi</th>
                <td><?= $data['resi_melin']; ?></td>
            </tr>
            <tr>
                <th>Pengirim</th>
                <td><?= $data['nama_pengirim_melin']; ?></td>
            </tr>
            <tr>
                <th>Penerima</th>
                <td><?= $data['nama_penerima_melin']; ?></td>
            </tr>
            <tr>
                <th>Kota Asal</th>
                <td><?= $data['kota_asal_melin']; ?></td>
            </tr>
            <tr>
                <th>Kota Tujuan</th>
                <td><?= $data['kota_tujuan_melin']; ?></td>
            </tr>
            <tr>
                <th>Status Pengiriman</th>
                <td><strong><?= $data['status_melin']; ?></strong></td>
            </tr>
        </table>
    <?php else: ?>
        <div class="alert alert-danger">Nomor resi tidak ditemukan!</div>
    <?php endif; ?>

</div>

</body>
</html>

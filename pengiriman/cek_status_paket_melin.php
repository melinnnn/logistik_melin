<?php
session_start();
include "../config/database_melin.php";

$status = "";
$detail_paket = null;

if (isset($_POST['cek_status'])) {
    $resi = $_POST['resi_melin'];
    $query = "SELECT p.*, b.status_pembayaran_melin, b.tanggal_pembayaran_melin
              FROM pengiriman_melin p
              LEFT JOIN pembayaran_melin b ON p.resi_melin = b.resi_melin
              WHERE p.resi_melin = '$resi'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $detail_paket = mysqli_fetch_assoc($result);
    } else {
        $status = "Nomor resi tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Paket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "../includes/sidebar_melin.php"; ?>

<div class="container mt-4">
    <h2>🔍 Cek Status Paket</h2>

    <!-- Form Cek Resi -->
    <form method="POST" class="mb-4">
        <div class="input-group">
            <input type="text" name="resi_melin" class="form-control" placeholder="Masukkan Nomor Resi" required>
            <button type="submit" name="cek_status" class="btn btn-primary">Cek Status</button>
        </div>
    </form>

    <!-- Hasil Pengecekan -->
    <?php if ($status) : ?>
        <div class="alert alert-danger"><?= $status ?></div>
    <?php endif; ?>

    <?php if ($detail_paket) : ?>
        <div class="card">
            <div class="card-header bg-info text-white">📦 Detail Paket</div>
            <div class="card-body">
                <p><strong>Resi:</strong> <?= $detail_paket['resi_melin'] ?></p>
                <p><strong>Nama Pengirim:</strong> <?= $detail_paket['nama_pengirim_melin'] ?></p>
                <p><strong>Nama Penerima:</strong> <?= $detail_paket['nama_penerima_melin'] ?></p>
                <p><strong>Kota Asal:</strong> <?= $detail_paket['kota_asal_melin'] ?></p>
                <p><strong>Kota Tujuan:</strong> <?= $detail_paket['kota_tujuan_melin'] ?></p>
                <p><strong>Total Harga:</strong> Rp <?= number_format($detail_paket['harga_melin'], 0, ',', '.') ?></p>
                <p><strong>Status Pembayaran:</strong> 
                    <?= $detail_paket['status_pembayaran_melin'] == 'Lunas' ? 
                        "<span class='badge bg-success'>Lunas</span>" : 
                        "<span class='badge bg-danger'>Belum Lunas</span>" ?>
                </p>
                <p><strong>Tanggal Pembayaran:</strong> 
                    <?= !empty($detail_paket['tanggal_pembayaran_melin']) ? $detail_paket['tanggal_pembayaran_melin'] : '-' ?>
                </p>
                <p><strong>Status Pengiriman:</strong> 
                    <?php
                    $status_pengiriman = $detail_paket['status_melin'];
                    if ($status_pengiriman == 'Belum Dikirim') {
                        echo "<span class='badge bg-warning'>Belum Dikirim</span>";
                    } elseif ($status_pengiriman == 'Sedang Dikirim') {
                        echo "<span class='badge bg-primary'>Sedang Dikirim</span>";
                    } else {
                        echo "<span class='badge bg-success'>Selesai</span>";
                    }
                    ?>
                </p>
            </div>
        </div>
    <?php endif; ?>
</div>

</body>
</html>

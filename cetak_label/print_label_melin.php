<?php
session_start();
include "../config/database_melin.php";

if (!isset($_GET['id'])) {
    echo "ID pengiriman tidak ditemukan!";
    exit();
}

$id_pengiriman = $_GET['id'];

// Mengambil data pengiriman
$query_pengiriman = mysqli_query($conn, "SELECT * FROM pengiriman_melin WHERE id_pengiriman_melin = '$id_pengiriman'");
$data_pengiriman = mysqli_fetch_assoc($query_pengiriman);

if (!$data_pengiriman) {
    echo "Data pengiriman tidak ditemukan!";
    exit();
}

// Mengambil data pembayaran berdasarkan id_pengiriman_melin
$query_pembayaran = mysqli_query($conn, "SELECT metode_pembayaran_melin, total_harga_melin FROM pembayaran_melin WHERE id_pengiriman_melin = '$id_pengiriman'");
$data_pembayaran = mysqli_fetch_assoc($query_pembayaran);

$metode_pembayaran = $data_pembayaran ? $data_pembayaran['metode_pembayaran_melin'] : 'Belum Dibayar';
$total_harga = $data_pembayaran ? number_format($data_pembayaran['total_harga_melin'], 0, ',', '.') : '0';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Label Pengiriman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body onload="printPage()">

<div class="container mt-4">
    <div class="card p-4">
        <h2 class="text-center">📦 Label Pengiriman</h2>
        <hr>
        <p><strong>Nomor Resi:</strong> <?= $data_pengiriman['resi_melin']; ?></p>
        <p><strong>Pengirim:</strong> <?= $data_pengiriman['nama_pengirim_melin']; ?></p>
        <p><strong>Penerima:</strong> <?= $data_pengiriman['nama_penerima_melin']; ?></p>
        <p><strong>Alamat Penerima:</strong> <?= $data_pengiriman['alamat_penerima_melin']; ?></p>
        <p><strong>Kota Tujuan:</strong> <?= $data_pengiriman['kota_tujuan_melin']; ?></p>

        <!-- Menambahkan detail layanan pengiriman -->
        <p><strong>Layanan Pengiriman:</strong> <?= $data_pengiriman['layanan_melin']; ?></p>
        <p><strong>Berat:</strong> <?= $data_pengiriman['berat_melin']; ?> Kg</p>
        <p><strong>Metode Pembayaran:</strong> <?= $metode_pembayaran; ?></p>
        
        <hr>
        
        <!-- Menambahkan detail produk -->
        <p><strong>Produk:</strong> LCD TOUCHSCREEN OPPO A37F - FULLSET</p>
        <p><strong>SKU:</strong> Putih OG SUPER</p>
        <p><strong>Jumlah:</strong> 1 pc</p>

        <hr>
        
        <p><strong>Total Harga:</strong> Rp. <?= $total_harga; ?></p>
    </div>
</div>

</body>
</html>

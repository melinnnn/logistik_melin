<?php
session_start();
include "../config/database_melin.php";

if (!isset($_GET['id'])) {
    echo "ID pengiriman tidak ditemukan!";
    exit();
}

$id_pengiriman = $_GET['id'];

// Query INNER JOIN untuk mengambil data pengiriman dan pembayaran
$query = mysqli_query($conn, "
    SELECT 
        p.resi_melin, 
        p.nama_pengirim_melin, 
        p.nama_penerima_melin, 
        p.alamat_penerima_melin, 
        p.kota_tujuan_melin, 
        p.layanan_melin, 
        p.berat_melin, 
        COALESCE(pb.metode_pembayaran_melin, 'Belum Dibayar') AS metode_pembayaran_melin, 
        COALESCE(pb.total_harga_melin, 0) AS total_harga_melin
    FROM pengiriman_melin p
    LEFT JOIN pembayaran_melin pb ON p.id_pengiriman_melin = pb.id_pengiriman_melin
    WHERE p.id_pengiriman_melin = '$id_pengiriman'
");


$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit();
}
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
    <div class="card p-4 border">
        <h2 class="text-center">📦 Label Pengiriman</h2>
        <hr>
        
        <!-- Detail Pengiriman -->
        <p><strong>Nomor Resi:</strong> <?= $data['resi_melin']; ?></p>
        <p><strong>Pengirim:</strong> <?= $data['nama_pengirim_melin']; ?></p>
        <p><strong>Penerima:</strong> <?= $data['nama_penerima_melin']; ?></p>
        <p><strong>Alamat Penerima:</strong> <?= $data['alamat_penerima_melin']; ?></p>
        <p><strong>Kota Tujuan:</strong> <?= $data['kota_tujuan_melin']; ?></p>

        <!-- Detail Layanan -->
        <p><strong>Layanan Pengiriman:</strong> <?= $data['layanan_melin']; ?></p>
        <p><strong>Berat:</strong> <?= $data['berat_melin']; ?> Kg</p>
        <p><strong>Metode Pembayaran:</strong> <?= $data['metode_pembayaran_melin']; ?></p>
        
        <hr>

        <!-- Detail Produk -->
        <p><strong>Produk:</strong> LCD TOUCHSCREEN OPPO A37F - FULLSET</p>
        <p><strong>SKU:</strong> Putih OG SUPER</p>
        <p><strong>Jumlah:</strong> 1 pc</p>

        <hr>

        <p><strong>Total Harga:</strong> Rp. <?= number_format($data['total_harga_melin'], 0, ',', '.'); ?></p>
    </div>
</div>

</body>
</html>

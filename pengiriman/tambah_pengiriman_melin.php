<?php 
session_start();
if (!isset($_SESSION['login_melin'])) {
    header("Location: ../auth/login_melin.php");
    exit();
}
include "../config/database_melin.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengiriman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "../includes/sidebar_melin.php"; ?>

<div class="container mt-4">
    <h2>📦 Form Pengisian Data Pengiriman</h2>
    <form action="proses_pengiriman_melin.php" method="POST">
        <div class="mb-3">
            <label>Nama Pengirim</label>
            <input type="text" name="nama_pengirim_melin" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nomor Telepon Pengirim</label>
            <input type="text" name="telepon_pengirim_melin" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat Pengirim</label>
            <textarea name="alamat_pengirim_melin" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Kota Asal</label>
            <select name="kota_asal_melin" class="form-control">
                <?php
                $query = "SELECT nama_kota FROM kota_melin";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['nama_kota']}'>{$row['nama_kota']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Nama Penerima</label>
            <input type="text" name="nama_penerima_melin" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nomor Telepon Penerima</label>
            <input type="text" name="telepon_penerima_melin" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat Penerima</label>
            <textarea name="alamat_penerima_melin" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Kota Tujuan</label>
            <select name="kota_tujuan_melin" class="form-control">
                <?php
                $query = "SELECT nama_kota FROM kota_melin";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['nama_kota']}'>{$row['nama_kota']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Berat Barang (Kg)</label>
            <input type="number" name="berat_melin" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jenis Layanan</label>
            <select name="layanan_melin" class="form-control">
                <option value="Ekspres">Ekspres</option>
                <option value="Reguler">Reguler</option>
                <option value="Hemat">Hemat</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Data</button>
    </form>
</div>

</body>
</html>

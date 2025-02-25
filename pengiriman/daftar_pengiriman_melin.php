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
    <title>Daftar Pengiriman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "../includes/sidebar_melin.php"; ?>

<div class="container mt-4">
    <h2>📦 Daftar Pengiriman</h2>

    <!-- Tombol Tambah Pengiriman -->
    <a href="tambah_pengiriman_melin.php" class="btn btn-primary mb-3">➕ Tambah Pengiriman</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Resi</th>
                <th>Nama Pengirim</th>
                <th>Nama Penerima</th>
                <th>Kota Asal</th>
                <th>Kota Tujuan</th>
                <th>Total Harga</th>
                <th>Status Pembayaran</th>
                <th>Status Pengiriman</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT p.*, b.status_pembayaran_melin 
                      FROM pengiriman_melin p
                      LEFT JOIN pembayaran_melin b ON p.resi_melin = b.resi_melin";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['resi_melin']}</td>
                        <td>{$row['nama_pengirim_melin']}</td>
                        <td>{$row['nama_penerima_melin']}</td>
                        <td>{$row['kota_asal_melin']}</td>
                        <td>{$row['kota_tujuan_melin']}</td>
                        <td>Rp " . number_format($row['harga_melin'], 0, ',', '.') . "</td>
                        <td>" . ($row['status_pembayaran_melin'] == 'Lunas' ? "<span class='badge bg-success'>Lunas</span>" : "<span class='badge bg-danger'>Belum Lunas</span>") . "</td>
                        <td>
                            <form method='POST' action='update_status_melin.php' class='d-inline'>
                                <input type='hidden' name='resi_melin' value='{$row['resi_melin']}'>
                                <select name='status_melin' class='form-select d-inline' style='width: auto; display: inline-block;'>
                                    <option value='Belum Dikirim' " . ($row['status_melin'] == 'Belum Dikirim' ? 'selected' : '') . ">Belum Dikirim</option>
                                    <option value='Sedang Dikirim' " . ($row['status_melin'] == 'Sedang Dikirim' ? 'selected' : '') . ">Sedang Dikirim</option>
                                    <option value='Selesai' " . ($row['status_melin'] == 'Selesai' ? 'selected' : '') . ">Selesai</option>
                                </select>
                                <button type='submit' class='btn btn-sm btn-primary'>✅</button>
                            </form>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

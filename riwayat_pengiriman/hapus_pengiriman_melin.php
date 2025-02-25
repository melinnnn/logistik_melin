<?php
session_start();
if (!isset($_SESSION['login_melin'])) {
    header("Location: ../auth/login_melin.php");
    exit();
}
include "../config/database_melin.php";

if (!isset($_GET['id'])) {
    header("Location: riwayat_pengiriman_melin.php");
    exit();
}

$id_pengiriman = $_GET['id'];

// Cek apakah pembayaran sudah dilakukan
$cek_pembayaran = mysqli_query($conn, "SELECT * FROM pembayaran_melin WHERE id_pengiriman_melin = '$id_pengiriman'");
if (mysqli_num_rows($cek_pembayaran) > 0) {
    echo "<script>
        alert('Gagal! Pengiriman ini sudah memiliki pembayaran.');
        window.location.href='riwayat_pengiriman_melin.php';
    </script>";
    exit();
}

// Hapus data pengiriman
$delete_query = "DELETE FROM pengiriman_melin WHERE id_pengiriman_melin = '$id_pengiriman'";
if (mysqli_query($conn, $delete_query)) {
    header("Location: riwayat_pengiriman_melin.php?pesan=hapus_sukses");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>

<?php
session_start();
include "../config/database_melin.php";

if (!isset($_GET['resi']) || !isset($_GET['aksi'])) {
    die("Invalid request.");
}

$resi = $_GET['resi'];
$aksi = $_GET['aksi'];

if ($aksi == 'bayar') {
    $query = "UPDATE pembayaran_melin SET status_pembayaran_melin = 'Lunas' WHERE resi_melin = '$resi'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pembayaran Berhasil!'); window.location.href = 'daftar_pembayaran_melin.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

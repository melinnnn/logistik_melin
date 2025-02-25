<?php
session_start();
include "../config/database_melin.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resi = $_POST['resi_melin'];
    $status = $_POST['status_melin'];

    $query = "UPDATE pengiriman_melin SET status_melin = '$status' WHERE resi_melin = '$resi'";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Status Pengiriman Berhasil Diperbarui!'); window.location.href = 'daftar_pengiriman_melin.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

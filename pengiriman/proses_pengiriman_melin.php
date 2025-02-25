<?php
session_start();
include "../config/database_melin.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kota_asal = $_POST['kota_asal_melin'] ?? '';
    $kota_tujuan = $_POST['kota_tujuan_melin'] ?? '';
    $berat = $_POST['berat_melin'] ?? 1;
    $layanan = $_POST['layanan_melin'] ?? 'Reguler';

    if ($kota_asal == '' || $kota_tujuan == '') {
        die("Error: Kota asal dan kota tujuan wajib diisi.");
    }

    $harga_per_kg = [
        "Ekspres" => 10000,
        "Reguler" => 7000,
        "Hemat" => 5000
    ];

    $query = "SELECT jarak FROM jarak_melin WHERE kota_asal='$kota_asal' AND kota_tujuan='$kota_tujuan'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $jarak = $row['jarak'] ?? 1;

    $total_harga = $jarak * $harga_per_kg[$layanan] * $berat;

    $resi = "RESI-" . date("Ymd") . "-" . rand(1000, 9999);

    // Insert ke tabel pengiriman_melin
    $query_pengiriman = "INSERT INTO pengiriman_melin (resi_melin, nama_pengirim_melin, telepon_pengirim_melin, 
    alamat_pengirim_melin, kota_asal_melin, nama_penerima_melin, telepon_penerima_melin, 
    alamat_penerima_melin, kota_tujuan_melin, berat_melin, layanan_melin, harga_melin, status_melin) 
    VALUES ('$resi', '$_POST[nama_pengirim_melin]', '$_POST[telepon_pengirim_melin]', '$_POST[alamat_pengirim_melin]', 
    '$kota_asal', '$_POST[nama_penerima_melin]', '$_POST[telepon_penerima_melin]', '$_POST[alamat_penerima_melin]', 
    '$kota_tujuan', '$berat', '$layanan', '$total_harga', 'Belum Dikirim')";

    if (mysqli_query($conn, $query_pengiriman)) {
        // Jika pengiriman berhasil, otomatis tambahkan ke pembayaran_melin
        $query_pembayaran = "INSERT INTO pembayaran_melin (resi_melin, total_harga_melin, status_pembayaran_melin) 
        VALUES ('$resi', '$total_harga', 'Belum Lunas')";
        
        if (mysqli_query($conn, $query_pembayaran)) {
            header("Location: ../pembayaran/pembayaran_melin.php?resi=$resi");
            exit();
        } else {
            echo "Error Insert Pembayaran: " . mysqli_error($conn);
        }
    } else {
        echo "Error Insert Pengiriman: " . mysqli_error($conn);
    }
}
?>

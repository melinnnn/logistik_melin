<?php
$host = "localhost";  // Sesuaikan dengan server MySQL kamu
$user = "root";       // Sesuaikan dengan username MySQL
$pass = "";           // Sesuaikan dengan password MySQL (kosongkan jika tidak ada)
$db   = "logistik_melin"; // Nama database yang sudah kita buat

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

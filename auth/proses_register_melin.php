<?php
include "../config/database_melin.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_melin'];
    $username = $_POST['username_melin'];
    $password = $_POST['password_melin'];
    $role = $_POST['role_melin'];

    // Enkripsi password
    $password_hash = md5($password);

    // Cek apakah username sudah digunakan
    $cek_user = mysqli_query($conn, "SELECT * FROM users_melin WHERE username_melin='$username'");
    if (mysqli_num_rows($cek_user) > 0) {
        echo "<script>alert('Username sudah terdaftar!'); window.location='register_melin.php';</script>";
    } else {
        // Insert data ke database
        $query = "INSERT INTO users_melin (nama_melin, username_melin, password_melin, role_melin) VALUES ('$nama', '$username', '$password_hash', '$role')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login_melin.php';</script>";
        } else {
            echo "<script>alert('Registrasi gagal!'); window.location='register_melin.php';</script>";
        }
    }
}
?>

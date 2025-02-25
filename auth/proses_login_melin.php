<?php
session_start();
include "../config/database_melin.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username_melin'];
    $password = md5($_POST['password_melin']);

    // Cek data di database
    $query = "SELECT * FROM users_melin WHERE username_melin='$username' AND password_melin='$password'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['login_melin'] = true;
        $_SESSION['id_user_melin'] = $user['id_user_melin'];
        $_SESSION['nama_melin'] = $user['nama_melin'];
        $_SESSION['role_melin'] = $user['role_melin'];

        echo "<script>alert('Login berhasil!'); window.location='../dashboard/index_melin.php';</script>";
    } else {
        echo "<script>alert('Username atau password salah!'); window.location='login_melin.php';</script>";
    }
}
?>

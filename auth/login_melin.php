<?php
session_start();
include "../config/database_melin.php";

if (isset($_SESSION['login_melin'])) {
    header("Location: ../dashboard/index_melin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Logistik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Login</h4>
                        <form action="proses_login_melin.php" method="POST">
                            <div class="mb-3">
                                <label>Username</label>
                                <input type="text" name="username_melin" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password_melin" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                        <p class="mt-3 text-center">Belum punya akun? <a href="register_melin.php">Daftar</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

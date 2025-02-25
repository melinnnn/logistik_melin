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
    <title>Dashboard | Logistik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "../includes/sidebar_melin.php"; ?>

<div class="container mt-4">
    <h2>Selamat Datang, <?= $_SESSION['nama_melin']; ?> 👋</h2>
    <p>Anda login sebagai <strong><?= $_SESSION['role_melin']; ?></strong></p>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Pengiriman</h5>
                    <p class="card-text">
                        <?php
                        $query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM pengiriman_melin");
                        $data = mysqli_fetch_assoc($query);
                        echo $data['total'] . " Paket";
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Paket Sedang Dikirim</h5>
                    <p class="card-text">
                        <?php
                        $query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM pengiriman_melin WHERE status_melin='Sedang Dikirim'");
                        $data = mysqli_fetch_assoc($query);
                        echo $data['total'] . " Paket";
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Paket Belum Lunas</h5>
                    <p class="card-text">
                        <?php
                        $query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM pembayaran_melin WHERE status_pembayaran_melin='Belum Lunas'");
                        $data = mysqli_fetch_assoc($query);
                        echo $data['total'] . " Paket";
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>

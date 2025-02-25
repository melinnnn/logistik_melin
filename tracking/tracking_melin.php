<?php
session_start();
if (!isset($_SESSION['login_melin'])) {
    header("Location: ../auth/login_melin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Resi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "../includes/sidebar_melin.php"; ?>

<div class="p-4">
    <h2>🚚 Cek Status Pengiriman</h2>
    <form action="hasil_tracking_melin.php" method="GET">
        <div class="mb-3">
            <label>Masukkan Nomor Resi</label>
            <input type="text" name="resi_melin" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Cek Resi</button>
    </form>
</div>

</body>
</html>

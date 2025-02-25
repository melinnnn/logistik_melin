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
$query = mysqli_query($conn, "SELECT * FROM pengiriman_melin WHERE id_pengiriman_melin = '$id_pengiriman'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $status_baru = $_POST['status_melin'];
    $update_query = "UPDATE pengiriman_melin SET status_melin = '$status_baru' WHERE id_pengiriman_melin = '$id_pengiriman'";

    if (mysqli_query($conn, $update_query)) {
        header("Location: riwayat_pengiriman_melin.php?pesan=update_sukses");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Pengiriman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "../includes/sidebar_melin.php"; ?>

<div class="p-4">
    <h2>✏️ Update Status Pengiriman</h2>
    <p>Nomor Resi: <strong><?= $data['resi_melin']; ?></strong></p>

    <form method="POST">
        <div class="mb-3">
            <label>Status Pengiriman</label>
            <select name="status_melin" class="form-control">
                <option value="Paket Diterima" <?= ($data['status_melin'] == 'Paket Diterima') ? 'selected' : ''; ?>>Paket Diterima</option>
                <option value="Sedang Dikirim" <?= ($data['status_melin'] == 'Sedang Dikirim') ? 'selected' : ''; ?>>Sedang Dikirim</option>
                <option value="Paket Terkirim" <?= ($data['status_melin'] == 'Paket Terkirim') ? 'selected' : ''; ?>>Paket Terkirim</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>

</body>
</html>

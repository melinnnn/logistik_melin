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
    <title>Cetak Label Pengiriman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include "../includes/sidebar_melin.php"; ?>

<div class="p-4">
    <h2>🖨️ Cetak Label Pengiriman</h2>
    <p>Pilih pengiriman untuk mencetak label.</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Resi</th>
                <th>Penerima</th>
                <th>Kota Tujuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM pengiriman_melin");
            $no = 1;
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['resi_melin']}</td>
                        <td>{$row['nama_penerima_melin']}</td>
                        <td>{$row['kota_tujuan_melin']}</td>
                        <td>
                            <a href='print_label_melin.php?id={$row['id_pengiriman_melin']}' target='_blank' class='btn btn-primary btn-sm'>Cetak Label</a>
                        </td>
                    </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

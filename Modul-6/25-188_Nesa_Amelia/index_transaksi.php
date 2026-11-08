<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Transaksi</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Daftar Transaksi (Master)</h2>
    <a href="index_barang.php">&laquo; Kelola Data Barang</a>
    <table>
        <tr>
            <th>ID Transaksi</th>
            <th>Tanggal</th>
            <th>Pelanggan ID</th>
            <th>Keterangan</th>
            <th>Total Belanja</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM transaksi");
        while ($row = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td>TRX-<?php echo $row['id']; ?></td>
            <td><?php echo $row['waktu_transaksi']; ?></td>
            <td><?php echo $row['pelanggan_id']; ?></td>
            <td><?php echo $row['keterangan']; ?></td>
            <td><strong>Rp <?php echo number_format($row['total'], 0, ',', '.'); ?></strong></td>
            <td>
                <a href="transaksi_detail.php?id=<?php echo $row['id']; ?>">Kelola Detail Barang</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
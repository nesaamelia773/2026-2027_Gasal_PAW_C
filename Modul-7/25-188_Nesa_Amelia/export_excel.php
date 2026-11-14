<?php
// Koneksi ke Database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_penjualan";

$koneksi = mysqli_connect($host, $user, $pass, $db);

$mulai = isset($_GET['mulai']) ? $_GET['mulai'] : '';
$selesai = isset($_GET['selesai']) ? $_GET['selesai'] : '';

// Query disesuaikan dengan nama tabel asli di phpMyAdmin
$sq = "SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total_harian 
       FROM transaksi
       WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai' 
       GROUP BY DATE(waktu_transaksi) 
       ORDER BY tgl ASC";
$res = mysqli_query($koneksi, $sq);

$sqp = "SELECT COUNT(DISTINCT pelanggan_id) AS jml 
        FROM transaksi
        WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'";
$rp = mysqli_fetch_assoc(mysqli_query($koneksi, $sqp));
$total_pelanggan = $rp['jml'] ?? 0;

$total_pendapatan_kumulatif = 0;

// Header HTTP untuk Ekspor Excel secara natif
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_laporan_penjualan_" . $mulai . "_sampai_" . $selesai . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<h3>Rekap Laporan Penjualan (Periode: <?= $mulai; ?> s/d <?= $selesai; ?>)</h3>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Transaksi</th>
            <th>Total Pendapatan Harian</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1; 
        while ($row = mysqli_fetch_assoc($res)): 
            $total_pendapatan_kumulatif += $row['total_harian'];
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['tgl']; ?></td>
            <td><?= $row['total_harian']; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" style="font-weight: bold; text-align: right;">Total Keseluruhan Pendapatan:</td>
            <td style="font-weight: bold;"><?= $total_pendapatan_kumulatif; ?></td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight: bold; text-align: right;">Jumlah Pelanggan Unik:</td>
            <td style="font-weight: bold;"><?= $total_pelanggan; ?> Orang</td>
        </tr>
    </tfoot>
</table>
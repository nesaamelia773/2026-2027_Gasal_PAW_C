<?php
// Koneksi ke Database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_penjualan";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Ambil nilai filter tanggal jika ada
$mulai = isset($_GET['mulai']) ? $_GET['mulai'] : '';
$selesai = isset($_GET['selesai']) ? $_GET['selesai'] : '';

$labels = []; 
$data_total = []; 
$rekap = [];
$total_pendapatan = 0; 
$total_pelanggan = 0;

if (!empty($mulai) && !empty($selesai)) {
    // 1. Query agregasi total pendapatan harian (menggunakan tabel pengelolaan_transaksi)
    $sq = "SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total_harian 
           FROM transaksi 
           WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai' 
           GROUP BY DATE(waktu_transaksi) 
           ORDER BY tgl ASC";
    $res = mysqli_query($koneksi, $sq);
    while ($r = mysqli_fetch_assoc($res)) {
        $labels[] = $r['tgl'];
        $data_total[] = $r['total_harian'];
        $rekap[] = $r;
        $total_pendapatan += $r['total_harian'];
    }

    // 2. Query jumlah pelanggan unik (menggunakan tabel pengelolaan_transaksi)
    $sqp = "SELECT COUNT(DISTINCT pelanggan_id) AS jml 
            FROM transaksi 
            WHERE waktu_transaksi BETWEEN '$mulai' AND '$selesai'";
    $rp = mysqli_fetch_assoc(mysqli_query($koneksi, $sqp));
    $total_pelanggan = $rp['jml'] ?? 0;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan dan Grafik Elektronik</title>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* CSS Styling Modern & Responsif */
        :root {
            --primary-color: #007bff;
            --success-color: #28a745;
            --info-color: #17a2b8;
            --dark-color: #343a40;
            --light-bg: #f8f9fa;
            --border-color: #ced4da;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 30px;
            background-color: #f4f6f9;
            color: var(--dark-color);
        }

        h2 {
            color: #2c3e50;
            margin-top: 30px;
            font-size: 1.5rem;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 8px;
        }

        /* Form Filter Box */
        .filter-box {
            background: #ffffff;
            padding: 20px 25px;
            border: 1px solid #e3e6f0;
            border-radius: 8px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 30px;
        }

        .filter-box h3 {
            margin-top: 0;
            color: var(--primary-color);
            font-size: 1.25rem;
            margin-bottom: 15px;
        }

        .form-group {
            display: inline-block;
            margin-right: 15px;
            margin-bottom: 10px;
        }

        .form-group label {
            font-weight: 600;
            margin-right: 5px;
        }

        input[type="date"] {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 14px;
            outline: none;
        }

        input[type="date"]:focus {
            border-color: var(--primary-color);
        }

        /* Buttons Styling */
        .btn {
            padding: 8px 16px;
            cursor: pointer;
            background: var(--primary-color);
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: background 0.2s;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-print { background: var(--info-color); }
        .btn-excel { background: var(--success-color); }

        /* Container Grafik */
        .chart-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            width: 100%;
            max-width: 800px;
            height: 400px;
            margin-bottom: 30px;
        }

        /* Tabel Rekapitulasi */
        table {
            border-collapse: collapse;
            width: 100%;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 25px;
        }

        th, td {
            border: 1px solid #e3e6f0;
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #eaecf0;
            color: #4e73df;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 13px;
        }

        tr:nth-child(even) {
            background-color: #f8f9fc;
        }

        tr:hover {
            background-color: #eaecf0;
        }

        /* Card Ringkasan Total Kumulatif */
        .summary-card {
            background: #ffffff;
            border-left: 5px solid var(--success-color);
            padding: 15px 20px;
            border-radius: 4px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            font-size: 16px;
            margin-top: 20px;
        }

        .welcome-msg {
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            border: 1px solid #e3e6f0;
            color: #6c757d;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }

        /* CSS khusus untuk mode cetak (Print) */
        @media print {
            .no-print { display: none !important; }
            body { background-color: #ffffff; padding: 0; color: #000; }
            table { box-shadow: none; border: 1px solid #000; }
            th, td { border: 1px solid #000; }
            .chart-container { box-shadow: none; max-width: 100%; height: auto; }
            .summary-card { border: 1px solid #000; box-shadow: none; }
        }
    </style>
</head>
<body>

    <!-- Form Filter & Tombol Aksi -->
    <div class="filter-box no-print">
        <h3>Filter Laporan Penjualan Elektronik</h3>
        <form method="GET" action="">
            <div class="form-group">
                <label>Dari:</label> 
                <input type="date" name="mulai" value="<?= htmlspecialchars($mulai); ?>" required>
            </div>
            <div class="form-group">
                <label>Sampai:</label> 
                <input type="date" name="selesai" value="<?= htmlspecialchars($selesai); ?>" required>
            </div>
            <button type="submit" class="btn">Tampilkan</button>
        </form>
        
        <div style="margin-top: 15px;">
            <button onclick="window.print()" class="btn btn-print">🖨️ Cetak Laporan</button>
            <?php if (!empty($mulai) && !empty($selesai)): ?>
                <a href="export_excel.php?mulai=<?= $mulai; ?>&selesai=<?= $selesai; ?>" class="btn btn-excel">📊 Ekspor Excel</a>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($labels)): ?>
        <h2>Grafik Tren Pendapatan Harian</h2>
        <div class="chart-container">
            <canvas id="myChart"></canvas>
        </div>
        
        <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= json_encode($labels); ?>,
                    datasets: [{
                        label: 'Total Pendapatan (Rp)',
                        data: <?= json_encode($data_total); ?>,
                        backgroundColor: 'rgba(78, 115, 223, 0.7)',
                        borderColor: 'rgba(78, 115, 223, 1)',
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
        </script>

        <h2>Rekapitulasi Penjualan Harian</h2>
        <table>
            <tr>
                <th>No</th>
                <th>Total Pendapatan</th>
                <th>Tanggal Transaksi</th>
            </tr>
            <?php $no = 1; foreach ($rekap as $row): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td>Rp. <?= number_format($row['total_harian'], 0, ',', '.'); ?></td>
                <td><?= $row['tgl']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <!-- Ringkasan Total Kumulatif (Card Style) -->
        <div class="summary-card">
            <b>Ringkasan Periode Ini:</b><br>
             Jumlah Pelanggan Unik: <b><?= $total_pelanggan; ?> Orang</b> &nbsp;|&nbsp; 
             Total Keseluruhan Pendapatan: <b>Rp. <?= number_format($total_pendapatan, 0, ',', '.'); ?></b>
        </div>
    <?php else: ?>
        <div class="welcome-msg">
            <p style="margin: 0;">Silakan pilih rentang tanggal pada form di atas lalu klik tombol <b>Tampilkan</b> untuk melihat grafik dan rekapitulasi laporan penjualan.</p>
        </div>
    <?php endif; ?>

</body>
</html>
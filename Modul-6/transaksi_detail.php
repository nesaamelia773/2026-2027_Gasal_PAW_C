<?php
include 'koneksi.php';
$transaksi_id = $_GET['id'];

// JAWABAN SOAL NO. 4: Simpan detail & hitung total otomatis
if (isset($_POST['simpan'])) {
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    // Ambil harga barang
    $q_brg = mysqli_query($koneksi, "SELECT harga FROM barang WHERE id = '$barang_id'");
    $d_brg = mysqli_fetch_assoc($q_brg);
    $harga = $d_brg['harga'];

    // Insert ke tabel transaksi_detail
    $insert = mysqli_query($koneksi, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ('$transaksi_id', '$barang_id', '$harga', '$qty')");

    if ($insert) {
        // Hitung ulang total belanjaan transaksi ini
        $q_hitung = mysqli_query($koneksi, "SELECT SUM(harga * qty) AS total_belanja FROM transaksi_detail WHERE transaksi_id = '$transaksi_id'");
        $d_tot = mysqli_fetch_assoc($q_hitung);
        $total_baru = $d_tot['total_belanja'];

        // Update kolom total di tabel transaksi secara otomatis
        mysqli_query($koneksi, "UPDATE transaksi SET total = '$total_baru' WHERE id = '$transaksi_id'");

        echo "<script>alert('Item berhasil ditambah & total diperbarui!'); window.location='transaksi_detail.php?id=$transaksi_id';</script>";
    }
}

// JAWABAN SOAL NO. 2: Ambil barang yang sudah dipilih agar bisa di-disable
$q_cek = mysqli_query($koneksi, "SELECT barang_id FROM transaksi_detail WHERE transaksi_id = '$transaksi_id'");
$barang_terpilih = [];
while ($row = mysqli_fetch_assoc($q_cek)) {
    $barang_terpilih[] = $row['barang_id'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Detail Transaksi ID: <?php echo $transaksi_id; ?></h2>
    <a href="index_transaksi.php">&laquo; Kembali ke Daftar Transaksi</a>

    <!-- Form Input Detail & Dropdown Barang (Soal No. 2) -->
    <form method="POST" style="margin-top: 20px; background: #f9f9f9; padding: 15px;">
        <h3>Tambah Barang ke Transaksi</h3>
        <label>Pilih Barang:</label>
        <select name="barang_id" required>
            <option value="">-- Pilih Barang --</option>
            <?php
            $q_barang = mysqli_query($koneksi, "SELECT * FROM barang");
            while ($b = mysqli_fetch_assoc($q_barang)) {
                // Nonaktifkan jika barang sudah dipilih sebelumnya di transaksi ini (Soal No. 2)
                $is_disabled = in_array($b['id'], $barang_terpilih) ? 'disabled' : '';
                $status_teks = in_array($b['id'], $barang_terpilih) ? ' (Sudah Dipilih)' : '';
                
                echo "<option value='{$b['id']}' {$is_disabled}>{$b['nama_barang']} - Rp " . number_format($b['harga']) . "{$status_teks}</option>";
            }
            ?>
        </select>
        
        <label>Qty:</label>
        <input type="number" name="qty" value="1" min="1" required style="width: 50px;">
        <button type="submit" name="simpan">Simpan Item</button>
    </form>

    <h3>Daftar Barang dalam Transaksi Ini</h3>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Harga Satuan</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
        <?php
        $no = 1;
        $q_detail = mysqli_query($koneksi, "SELECT transaksi_detail.*, barang.nama_barang FROM transaksi_detail JOIN barang ON transaksi_detail.barang_id = barang.id WHERE transaksi_id = '$transaksi_id'");
        $grand_total = 0;
        while ($d = mysqli_fetch_assoc($q_detail)) {
            $subtotal = $d['harga'] * $d['qty'];
            $grand_total += $subtotal;
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $d['nama_barang']; ?></td>
            <td>Rp <?php echo number_format($d['harga'], 0, ',', '.'); ?></td>
            <td><?php echo $d['qty']; ?></td>
            <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
        </tr>
        <?php } ?>
    </table>
    <h3>Total Keseluruhan Transaksi: Rp <?php echo number_format($grand_total, 0, ',', '.'); ?></h3>
</body>
</html>
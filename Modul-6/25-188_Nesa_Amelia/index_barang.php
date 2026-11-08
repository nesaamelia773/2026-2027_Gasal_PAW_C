<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_barang = $_GET['id'];

    // Cek apakah barang sudah dipakai di transaksi_detail
    $cek = mysqli_query($koneksi, "SELECT * FROM transaksi_detail WHERE barang_id = '$id_barang'");

    if (mysqli_num_rows($cek) > 0) {
        // Jika sudah dipakai, tampilkan peringatan dan batalkan hapus (Soal No. 3)
        echo "<script>alert('Data tidak boleh dihapus, karena barang tersebut masih digunakan pada transaksi!'); window.location='index_barang.php';</script>";
    } else {
        // Jika belum dipakai, hapus seperti biasa
        $hapus = mysqli_query($koneksi, "DELETE FROM barang WHERE id = '$id_barang'");
        if ($hapus) {
            echo "<script>alert('Data barang berhasil dihapus.'); window.location='index_barang.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Barang</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Daftar Barang</h2>
    <a href="index_transaksi.php">Lihat Data Transaksi Master</a>
    <table>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM barang");
        while ($data = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['kode_barang']; ?></td>
            <td><?php echo $data['nama_barang']; ?></td>
            <td>Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
            <td><?php echo $data['stok']; ?></td>
            <td>
                <a href="index_barang.php?id=<?php echo $data['id']; ?>" onclick="return confirm('Yakin ingin hapus barang ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
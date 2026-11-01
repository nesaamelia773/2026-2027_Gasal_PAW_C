<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Master Supplier</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; border-radius: 3px; }
        .btn-tambah { background-color: green; margin-bottom: 10px; display: inline-block; }
        .btn-edit { background-color: orange; }
        .btn-hapus { background-color: red; }
    </style>
</head>
<body>

    <h2>Data Master Supplier</h2>
    <a href="tambah_supplier.php" class="btn btn-tambah">Tambah Data</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Telp</th>
            <th>Alamat</th>
            <th>Tindakan</th>
        </tr>
        <?php
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM supplier");
        while($row = mysqli_fetch_assoc($data)){
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['telp']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
            <td>
                <a href="edit_supplier.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                <a href="hapus_supplier.php?id=<?php echo $row['id']; ?>" class="btn btn-hapus" onclick="return confirm('Apakah yakin akan menghapus supplier ini?');">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>
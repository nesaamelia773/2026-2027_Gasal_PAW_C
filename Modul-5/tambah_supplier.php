<?php
include 'koneksi.php';

if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama', '$telp', '$alamat')";
    if(mysqli_query($koneksi, $query)){
        header("location: index.php");
    } else {
        echo "Gagal menambah data!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Master Supplier Baru</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table td { padding: 5px; }
    </style>
</head>
<body>
    <h2>Tambah Data Master Supplier Baru</h2>
    <form method="POST" action="">
        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td>Telp</td>
                <td><input type="text" name="telp" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat" required></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" name="simpan" style="background:green; color:white; padding:5px 10px; border:none; border-radius:3px;">Simpan</button>
                    <a href="index.php"><button type="button" style="background:red; color:white; padding:5px 10px; border:none; border-radius:3px;">Batal</button></a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
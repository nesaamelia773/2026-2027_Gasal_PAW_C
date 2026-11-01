<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $query = "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'";
    if(mysqli_query($koneksi, $query)){
        header("location: index.php");
    } else {
        echo "Gagal mengupdate data!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Master Supplier</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table td { padding: 5px; }
    </style>
</head>
<body>
    <h2>Edit Data Master Supplier</h2>
    <form method="POST" action="">
        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $row['nama']; ?>" required></td>
            </tr>
            <tr>
                <td>Telp</td>
                <td><input type="text" name="telp" value="<?php echo $row['telp']; ?>" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat" required><?php echo $row['alamat']; ?></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" name="update" style="background:green; color:white; padding:5px 10px; border:none; border-radius:3px;">Update</button>
                    <a href="index.php"><button type="button" style="background:red; color:white; padding:5px 10px; border:none; border-radius:3px;">Batal</button></a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
<?php
require_once 'auth.php';
wajibLogin();
$message='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $id_barang=(int)($_POST['id_barang']??0);
    $jumlah=(int)($_POST['jumlah']??0);
    $id_pelanggan=($_POST['id_pelanggan']??'')!==''?(int)$_POST['id_pelanggan']:null;
    if ($jumlah<1) $message='Jumlah harus lebih dari 0.';
    else {
        try {
            $pdo->beginTransaction();
            $q=$pdo->prepare('SELECT * FROM barang WHERE id=? FOR UPDATE'); $q->execute([$id_barang]); $barang=$q->fetch();
            if (!$barang || $barang['stok']<$jumlah) throw new Exception('Barang tidak tersedia atau stok tidak mencukupi.');
            $subtotal=$barang['harga']*$jumlah;
            $q=$pdo->prepare('INSERT INTO transaksi (id_user,id_pelanggan,total) VALUES (?,?,?)');
            $q->execute([$_SESSION['user']['id'],$id_pelanggan,$subtotal]); $id_transaksi=$pdo->lastInsertId();
            $q=$pdo->prepare('INSERT INTO detail_transaksi (id_transaksi,id_barang,jumlah,harga,subtotal) VALUES (?,?,?,?,?)');
            $q->execute([$id_transaksi,$id_barang,$jumlah,$barang['harga'],$subtotal]);
            $q=$pdo->prepare('UPDATE barang SET stok=stok-? WHERE id=?'); $q->execute([$jumlah,$id_barang]);
            $pdo->commit(); $message='Transaksi berhasil disimpan.';
        } catch (Throwable $e) {
            if ($pdo->inTransaction()) $pdo->rollBack();
            $message=$e instanceof PDOException?'Transaksi gagal disimpan.':$e->getMessage();
        }
    }
}
$barang=$pdo->query('SELECT * FROM barang ORDER BY nama_barang')->fetchAll();
$pelanggan=$pdo->query('SELECT * FROM pelanggan ORDER BY nama_pelanggan')->fetchAll();
require 'header.php';
?>
<h2>Transaksi</h2>
<?php if ($message): ?><div class="alert"><?= e($message) ?></div><?php endif; ?>
<form method="post" class="form-card">
<label>Barang</label><select name="id_barang" required><option value="">Pilih Barang</option><?php foreach($barang as $b): ?><option value="<?= e($b['id']) ?>"><?= e($b['nama_barang']) ?> - Stok: <?= e($b['stok']) ?> - Rp <?= number_format($b['harga'],0,',','.') ?></option><?php endforeach; ?></select>
<label>Jumlah</label><input type="number" name="jumlah" min="1" required>
<label>Pelanggan</label><select name="id_pelanggan"><option value="">Umum</option><?php foreach($pelanggan as $p): ?><option value="<?= e($p['id']) ?>"><?= e($p['nama_pelanggan']) ?></option><?php endforeach; ?></select>
<button type="submit">Simpan Transaksi</button>
</form>
<?php require 'footer.php'; ?>

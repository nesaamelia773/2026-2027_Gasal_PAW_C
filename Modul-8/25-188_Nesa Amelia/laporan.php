<?php
require_once 'auth.php';
wajibLogin();
$data=$pdo->query("SELECT t.id,t.tanggal,t.total,u.nama AS nama_user,p.nama_pelanggan
 FROM transaksi t JOIN users u ON t.id_user=u.id
 LEFT JOIN pelanggan p ON t.id_pelanggan=p.id ORDER BY t.id DESC")->fetchAll();
require 'header.php';
?>
<h2>Laporan</h2>
<table><thead><tr><th>No</th><th>Tanggal</th><th>User</th><th>Pelanggan</th><th>Total</th></tr></thead><tbody>
<?php foreach($data as $r): ?><tr><td><?= e($r['id']) ?></td><td><?= e($r['tanggal']) ?></td><td><?= e($r['nama_user']) ?></td><td><?= e($r['nama_pelanggan']??'Umum') ?></td><td>Rp <?= number_format($r['total'],0,',','.') ?></td></tr><?php endforeach; ?>
<?php if(!$data): ?><tr><td colspan="5">Belum ada transaksi.</td></tr><?php endif; ?>
</tbody></table>
<?php require 'footer.php'; ?>

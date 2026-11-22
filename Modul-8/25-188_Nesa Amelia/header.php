<?php
require_once 'auth.php';
wajibLogin();
$level = (int)$_SESSION['user']['level'];
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Sistem Penjualan</title><link rel="stylesheet" href="style.css"></head><body>
<nav class="navbar">
  <a class="brand" href="home.php">Sistem Penjualan</a>
  <a href="home.php">Home</a>
  <?php if ($level === 1): ?>
  <div class="dropdown"><span>Data Master</span><div class="dropdown-content">
    <a href="barang.php">Data Barang</a><a href="supplier.php">Data Supplier</a><a href="pelanggan.php">Data Pelanggan</a><a href="users.php">Data User</a>
  </div></div>
  <?php endif; ?>
  <a href="transaksi.php">Transaksi</a>
  <a href="laporan.php">Laporan</a>
  <div class="nav-right"><span><?= e($_SESSION['user']['nama']) ?></span><a href="logout.php">Logout</a></div>
</nav>
<main class="container">

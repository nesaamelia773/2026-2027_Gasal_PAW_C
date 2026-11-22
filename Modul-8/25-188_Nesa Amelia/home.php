<?php require_once 'header.php'; ?>
<h2>Home</h2>
<p>Selamat datang, <?= e($_SESSION['user']['nama']) ?>.</p>
<?php require_once 'footer.php'; ?>

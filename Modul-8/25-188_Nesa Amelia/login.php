<?php
require_once 'auth.php';
if (!empty($_SESSION['user'])) {
    header('Location: home.php');
    exit;
}
$error = '';
// Membuat akun contoh pertama kali agar password tersimpan dengan hash PHP yang valid.
$totalUser = (int)$pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
if ($totalUser === 0) {
    $buat = $pdo->prepare('INSERT INTO users (username,password,nama,level) VALUES (?,?,?,?)');
    $buat->execute(['owner', password_hash('password', PASSWORD_DEFAULT), 'Owner', 1]);
    $buat->execute(['kasir', password_hash('password', PASSWORD_DEFAULT), 'Kasir', 2]);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare('SELECT id,username,password,nama,level FROM users WHERE username=? LIMIT 1');
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        unset($user['password']);
        $_SESSION['user'] = $user;
        header('Location: home.php');
        exit;
    }
    $error = 'Username atau password salah.';
}
?>
<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Login</title><link rel="stylesheet" href="style.css"></head>
<body class="login-body">
<div class="login-box">
  <h2>Sistem Penjualan</h2>
  <?php if ($error): ?><div class="alert"><?= e($error) ?></div><?php endif; ?>
  <form method="post">
    <label>Username</label><input type="text" name="username" required autofocus>
    <label>Password</label><input type="password" name="password" required>
    <button type="submit">Login</button>
  </form>
</div>
</body></html>

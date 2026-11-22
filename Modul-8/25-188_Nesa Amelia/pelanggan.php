<?php
require_once 'auth.php';
wajibOwner();

$table = 'pelanggan';
$title = 'Data Pelanggan';
$fields = [
    'nama_pelanggan' => 'Nama Pelanggan', 
    'alamat' => 'Alamat', 
    'telepon' => 'Telepon'
];

if (isset($_GET['hapus'])) {
    $stmt = $pdo->prepare("DELETE FROM `$table` WHERE id=?");
    $stmt->execute([(int)$_GET['hapus']]);
    header("Location: pelanggan.php"); 
    exit;
}

$edit = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM `$table` WHERE id=?");
    $stmt->execute([(int)$_GET['edit']]);
    $edit = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values = [];
    foreach ($fields as $key => $label) {
        $values[$key] = trim($_POST[$key] ?? '');
    }

    if ($table === 'barang' && ($values['harga'] < 0 || $values['stok'] < 0)) {
        die('Harga dan stok tidak boleh negatif.');
    }

    if ($table === 'users') {
        $values['password'] = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
        if (empty($_POST['password']) && !empty($_POST['id'])) {
            unset($values['password']);
        }
        if (!in_array((int)$values['level'], [1, 2], true)) {
            die('Level tidak valid.');
        }
    }

    if (!empty($_POST['id'])) {
        $sets = [];
        foreach (array_keys($values) as $key) {
            $sets[] = "`$key`=?";
        }
        $sql = "UPDATE `$table` SET " . implode(',', $sets) . " WHERE id=?";
        $pdo->prepare($sql)->execute([...array_values($values), (int)$_POST['id']]);
    } else {
        $cols = array_keys($values);
        $sql = "INSERT INTO `$table` (`" . implode('`,`', $cols) . "`) VALUES (" . implode(',', array_fill(0, count($cols), '?')) . ")";
        $pdo->prepare($sql)->execute(array_values($values));
    }

    header("Location: pelanggan.php"); 
    exit;
}

$data = $pdo->query("SELECT * FROM `$table` ORDER BY id DESC")->fetchAll();
require 'header.php';
?>

<h2><?= e($title) ?></h2>

<form method="post" class="form-card">
  <input type="hidden" name="id" value="<?= e($edit['id'] ?? '') ?>">
  
  <?php foreach ($fields as $key => $label): ?>
    <label><?= e($label) ?></label>
    
    <?php if ($key === 'alamat'): ?>
      <textarea name="<?= e($key) ?>"><?= e($edit[$key] ?? '') ?></textarea>
    <?php elseif ($key === 'level'): ?>
      <select name="level" required>
        <option value="1" <?= (($edit['level'] ?? '') == 1 ? 'selected' : '') ?>>1 - Owner</option>
        <option value="2" <?= (($edit['level'] ?? '') == 2 ? 'selected' : '') ?>>2 - Kasir</option>
      </select>
    <?php elseif ($key === 'password'): ?>
      <input type="password" name="password" <?= $edit ? '' : 'required' ?> placeholder="<?= $edit ? 'Kosongkan jika tidak diubah' : '' ?>">
    <?php else: ?>
      <input type="<?= in_array($key, ['harga', 'stok']) ? 'number' : 'text' ?>" <?= $key === 'harga' ? 'step="0.01" min="0"' : '' ?> <?= $key === 'stok' ? 'min="0"' : '' ?> name="<?= e($key) ?>" value="<?= e($edit[$key] ?? '') ?>" required>
    <?php endif; ?>
    
  <?php endforeach; ?>
  
  <button type="submit"><?= $edit ? 'Update' : 'Simpan' ?></button>
  <?php if ($edit): ?>
    <a class="button secondary" href="pelanggan.php">Batal</a>
  <?php endif; ?>
</form>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <?php foreach ($fields as $key => $label): ?>
        <th><?= e($label) ?></th>
      <?php endforeach; ?>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $row): ?>
      <tr>
        <td><?= e($row['id']) ?></td>
        <?php foreach ($fields as $key => $label): ?>
          <td><?= $key === 'password' ? '••••••' : e($row[$key]) ?></td>
        <?php endforeach; ?>
        <td>
          <a href="pelanggan.php?edit=<?= e($row['id']) ?>">Edit</a> | 
          <a href="pelanggan.php?hapus=<?= e($row['id']) ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
    
    <?php if (!$data): ?>
      <tr>
        <td colspan="<?= count($fields) + 2 ?>">Belum ada data.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>

<?php require 'footer.php'; ?>
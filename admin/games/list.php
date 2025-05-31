<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/db_config.php';
require_once __DIR__ . '/../../functions/admin_functions.php';
$games = admin_get_all_games();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Játékok kezelése - Admin</title>
    <link rel="stylesheet" href="../../public/assets/css/main.css">
</head>
<body>
<?php include '../includes/header.php'; ?>
<main>
    <h1>Játékok</h1>
    <a class="btn" href="create.php">Új játék hozzáadása</a>
    <div class="table-responsive">
      <table>
          <tr><th>ID</th><th>Cím</th><th>Platform</th><th>Ár</th><th>Készlet</th><th>Művelet</th></tr>
          <?php foreach ($games as $g): ?>
          <tr>
              <td><?= $g['id'] ?></td>
              <td><?= htmlspecialchars($g['title']) ?></td>
              <td><?= htmlspecialchars($g['platform']) ?></td>
              <td><?= number_format($g['price'],0,',',' ') ?> Ft</td>
              <td><?= $g['stock'] ?></td>
              <td style="min-width:110px; display:flex; gap:0.3em; flex-wrap:wrap;">
                  <a class="btn" style="padding:0.3em 0.6em; font-size:0.95em;" href="edit.php?id=<?= $g['id'] ?>">Szerkeszt</a>
                  <a class="btn" style="padding:0.3em 0.6em; font-size:0.95em; background:#b71c1c;" href="delete.php?id=<?= $g['id'] ?>" onclick="return confirm('Biztosan törlöd?')">Töröl</a>
              </td>
          </tr>
          <?php endforeach; ?>
      </table>
    </div>
</main>
<?php include '../includes/footer.php'; ?>
</body>
</html>

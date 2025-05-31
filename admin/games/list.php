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
    <table>
        <tr><th>ID</th><th>Cím</th><th>Platform</th><th>Ár</th><th>Készlet</th><th>Művelet</th></tr>
        <?php foreach ($games as $g): ?>
        <tr>
            <td><?= $g['id'] ?></td>
            <td><?= htmlspecialchars($g['title']) ?></td>
            <td><?= htmlspecialchars($g['platform']) ?></td>
            <td><?= number_format($g['price'],0,',',' ') ?> Ft</td>
            <td><?= $g['stock'] ?></td>
            <td>
                <a class="btn" href="edit.php?id=<?= $g['id'] ?>">Szerkeszt</a>
                <a class="btn" href="delete.php?id=<?= $g['id'] ?>" onclick="return confirm('Biztosan törlöd?')">Töröl</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>
<?php include '../includes/footer.php'; ?>
</body>
</html>

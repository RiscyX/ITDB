<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/db_config.php';
require_once __DIR__ . '/../../functions/admin_functions.php';
$orders = admin_get_all_orders();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendelések - Admin</title>
    <link rel="stylesheet" href="../../public/assets/css/main.css">
</head>
<body>
<?php include '../includes/header.php'; ?>
<main>
    <h1>Rendelések</h1>
    <table>
        <tr><th>ID</th><th>Név</th><th>Email</th><th>Összeg</th><th>Dátum</th><th>Játékok</th></tr>
        <?php foreach ($orders as $o): ?>
        <tr>
            <td><?= $o['id'] ?></td>
            <td><?= htmlspecialchars($o['customer_name']) ?></td>
            <td><?= htmlspecialchars($o['customer_email']) ?></td>
            <td><?= number_format($o['total'],0,',',' ') ?> Ft</td>
            <td><?= $o['created_at'] ?></td>
            <td>
                <ul>
                <?php foreach ($o['items'] as $item): ?>
                    <li><?=htmlspecialchars($item['title'])?> (<?= $item['quantity'] ?> db)</li>
                <?php endforeach; ?>
                </ul>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>
<?php include '../includes/footer.php'; ?>
</body>
</html>

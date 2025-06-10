<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/db_config.php';
require_once __DIR__ . '/../../functions/admin_functions.php';

$messages = admin_get_all_messages();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üzenetek - <?=$site_name?></title>
    <link rel="stylesheet" href="../../public/assets/css/main.css">
</head>
<body>
<?php include '../includes/header.php'; ?>

<main>
    <h1>Kapcsolatfelvételi üzenetek</h1>

    <?php if (!$messages): ?>
        <p>Nincs egyetlen üzenet sem.</p>
    <?php else: ?>
        <div class="table-responsive">
            <table>
                <thead>
                <tr>
                    <th>Név</th>
                    <th>Email</th>
                    <th>Üzenet (rövidítve)</th>
                    <th>Dátum</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($messages as $m): ?>
                    <tr>
                        <td><?= htmlspecialchars($m['name']) ?></td>
                        <td><?= htmlspecialchars($m['email']) ?></td>
                        <td class="align-left">
                            <?php
                            $short = mb_strimwidth($m['message'], 0, 100, '…', 'UTF-8');
                            echo nl2br(htmlspecialchars($short));
                            ?>
                        </td>
                        <td><?= $m['date'] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</main>

<?php include '../includes/footer.php'; ?>
</body>
</html>

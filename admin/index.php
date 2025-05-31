<?php
require_once __DIR__ . '/../config/config.php';
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?=$site_name?></title>
    <link rel="stylesheet" href="../public/assets/css/main.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <main>
        <h1>Admin felület</h1>
        <ul>
            <li><a href="games/list.php">Játékok kezelése</a></li>
            <li><a href="orders/list.php">Rendelések megtekintése</a></li>
        </ul>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>

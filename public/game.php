<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/db_config.php';
require_once __DIR__ . '/../functions/public_functions.php';
if (!isset($_GET['id'])) die('Hiányzó játék azonosító!');
$game = get_game_by_id($_GET['id']);
if (!$game) die('Nincs ilyen játék!');
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $game['title'] ?> - <?= $site_name ?></title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <div class="card">
        <img src="assets/images/<?= htmlspecialchars($game['image']) ?>" alt="<?= htmlspecialchars($game['title']) ?>">
        <h1><?= htmlspecialchars($game['title']) ?></h1>
        <p><?= htmlspecialchars($game['platform']) ?></p>
        <p><?= htmlspecialchars($game['description']) ?></p>
        <p><b><?= number_format($game['price'], 0, ',', ' ') ?> Ft</b></p>
        <form method="post" action="cart.php">
            <input type="hidden" name="game_id" value="<?= $game['id'] ?>">
            <input type="number" name="quantity" value="1" min="1" max="<?= $game['stock'] ?>">
            <button class="btn" type="submit">Kosárba</button>
        </form>
    </div>
</main>
</body>
</html>

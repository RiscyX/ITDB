<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/db_config.php';
require_once __DIR__ . '/../functions/public_functions.php';
$results = [];
$q = '';
if (isset($_GET['q'])) {
    $q = trim($_GET['q']);
    $results = search_games($q);
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keresés - <?=$site_name?></title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<?php include 'header.php'; ?>
    <main>
        <h1>Keresés</h1>
        <form method="get">
            <input type="text" name="q" value="<?=htmlspecialchars($q)?>" placeholder="Játék címe vagy platform">
            <button class="btn" type="submit">Keresés</button>
        </form>
        <div class="games">
            <?php foreach ($results as $game): ?>
                <div class="card">
                    <img src="assets/images/<?=htmlspecialchars($game['image'])?>" alt="<?=htmlspecialchars($game['title'])?>">
                    <h2><?=htmlspecialchars($game['title'])?></h2>
                    <p><?=htmlspecialchars($game['platform'])?></p>
                    <p><b><?=number_format($game['price'],0,',',' ')?> Ft</b></p>
                    <a class="btn" href="game.php?id=<?= $game['id'] ?>">Részletek</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>

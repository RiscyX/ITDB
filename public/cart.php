<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/db_config.php';
require_once __DIR__ . '/../functions/public_functions.php';
session_start();
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['game_id'], $_POST['quantity'])) {
    $game_id = (int)$_POST['game_id'];
    $qty = max(1, (int)$_POST['quantity']);
    $_SESSION['cart'][$game_id] = ($qty);
}
if (isset($_GET['remove'])) {
    unset($_SESSION['cart'][(int)$_GET['remove']]);
}
$cart_games = get_games_by_ids(array_keys($_SESSION['cart']));
$total = 0;
foreach ($cart_games as $g) {
    $total += $g['price'] * $_SESSION['cart'][$g['id']];
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kosár - <?=$site_name?></title>
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="assets/js/cart.js" defer></script>
</head>
<body>
    <nav class="navbar">
        <a href="index.php">Főoldal</a>
        <a href="search.php">Keresés</a>
        <a href="cart.php">Kosár</a>
        <a href="about.php">Rólunk</a>
        <a href="contact.php">Kapcsolat</a>
    </nav>
    <main>
        <h1>Kosár</h1>
        <div class="cart-list">
            <?php foreach ($cart_games as $game): ?>
                <div class="card">
                    <img src="assets/images/<?=htmlspecialchars($game['image'])?>" alt="<?=htmlspecialchars($game['title'])?>">
                    <h2><?=htmlspecialchars($game['title'])?></h2>
                    <p><?=htmlspecialchars($game['platform'])?></p>
                    <p><b><?=number_format($game['price'],0,',',' ')?> Ft</b></p>
                    <p>Mennyiség: <?= $_SESSION['cart'][$game['id']] ?></p>
                    <a class="btn" href="cart.php?remove=<?=$game['id'] ?>">Eltávolítás</a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="alert">Végösszeg: <b><?=number_format($total,0,',',' ')?> Ft</b></div>
        <?php if ($cart_games): ?>
            <form method="post" action="order.php">
                <input type="text" name="customer_name" placeholder="Név" required>
                <input type="email" name="customer_email" placeholder="Email" required>
                <button class="btn" type="submit">Megrendelés</button>
            </form>
        <?php endif; ?>
    </main>
</body>
</html>

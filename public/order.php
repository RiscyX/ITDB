<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/db_config.php';
require_once __DIR__ . '/../functions/public_functions.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['cart']) && $_SESSION['cart']) {
    $name = trim($_POST['customer_name'] ?? '');
    $email = trim($_POST['customer_email'] ?? '');
    if ($name && $email) {
        $order_id = create_order($name, $email, $_SESSION['cart']);
        if ($order_id) {
            $_SESSION['cart'] = [];
            $msg = 'Sikeres rendelés!';
        } else {
            $msg = 'Hiba a rendelés során!';
        }
    } else {
        $msg = 'Minden mező kötelező!';
    }
} else {
    $msg = 'Üres kosár vagy hibás kérés!';
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Megrendelés - <?=$site_name?></title>
    <link rel="stylesheet" href="assets/css/main.css">
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
        <div class="alert"> <?=htmlspecialchars($msg)?> </div>
        <a class="btn" href="index.php">Vissza a főoldalra</a>
    </main>
</body>
</html>

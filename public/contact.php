<?php
require_once __DIR__ . '/../config/config.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    if ($name && $email && $message) {
        $msg = 'Köszönjük az üzenetet!';
    } else {
        $msg = 'Minden mező kitöltése kötelező!';
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kapcsolat - <?=$site_name?></title>
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
        <h1>Kapcsolat</h1>
        <?php if ($msg): ?>
            <div class="alert"> <?=htmlspecialchars($msg)?> </div>
        <?php endif; ?>
        <form method="post">
            <input type="text" name="name" placeholder="Név">
            <input type="email" name="email" placeholder="Email">
            <textarea name="message" placeholder="Üzenet"></textarea>
            <button class="btn" type="submit">Küldés</button>
        </form>
    </main>
</body>
</html>

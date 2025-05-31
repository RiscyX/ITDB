<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/db_config.php';
require_once __DIR__ . '/../../functions/admin_functions.php';
if (!isset($_GET['id'])) die('Hiányzó azonosító!');
$game = admin_get_game_by_id($_GET['id']);
if (!$game) die('Nincs ilyen játék!');
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $platform = trim($_POST['platform'] ?? '');
    $price = (float)($_POST['price'] ?? 0);
    $stock = (int)($_POST['stock'] ?? 0);
    $image = $game['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif','webp'];
        if (in_array($ext, $allowed)) {
            $fname = uniqid('game_', true) . '.' . $ext;
            $target = __DIR__ . '/../../public/assets/images/' . $fname;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $image = $fname;
            }
        }
    }
    $desc = trim($_POST['description'] ?? '');
    if ($title && $platform && $price > 0 && $stock >= 0) {
        if (admin_update_game($game['id'], $title, $platform, $price, $stock, $image, $desc)) {
            $msg = 'Sikeres mentés!';
        } else {
            $msg = 'Hiba mentéskor!';
        }
    } else {
        $msg = 'Minden mező kötelező!';
    }
}
$game = admin_get_game_by_id($_GET['id']);
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Játék szerkesztése - Admin</title>
    <link rel="stylesheet" href="../../public/assets/css/main.css">
</head>
<body>
<?php include '../includes/header.php'; ?>
<main>
    <h1>Játék szerkesztése</h1>
    <?php if ($msg): ?><div class="alert"> <?=htmlspecialchars($msg)?> </div><?php endif; ?>
    <form class="admin-form" method="post" enctype="multipart/form-data">
        <input type="text" name="title" value="<?=htmlspecialchars($game['title'])?>" required>
        <input type="text" name="platform" value="<?=htmlspecialchars($game['platform'])?>" required>
        <input type="number" name="price" value="<?=htmlspecialchars($game['price'])?>" required>
        <input type="number" name="stock" value="<?=htmlspecialchars($game['stock'])?>" required>
        <input type="file" name="image" accept="image/*">
        <?php if ($game['image']): ?>
            <div><img src="../../public/assets/images/<?=htmlspecialchars($game['image'])?>" alt="Jelenlegi kép" style="max-width:120px;"></div>
        <?php endif; ?>
        <textarea name="description"><?=htmlspecialchars($game['description'])?></textarea>
        <button class="btn" type="submit">Mentés</button>
    </form>
    <a class="btn" href="list.php">Vissza</a>
</main>
<?php include '../includes/footer.php'; ?>
</body>
</html>

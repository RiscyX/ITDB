<?php
function admin_get_all_games() {
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM games ORDER BY created_at DESC');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function admin_get_game_by_id($id) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM games WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function admin_create_game($title, $platform, $price, $stock, $image, $desc) {
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO games (title, platform, price, stock, image, description) VALUES (?, ?, ?, ?, ?, ?)');
    return $stmt->execute([$title, $platform, $price, $stock, $image, $desc]);
}
function admin_update_game($id, $title, $platform, $price, $stock, $image, $desc) {
    global $pdo;
    $stmt = $pdo->prepare('UPDATE games SET title=?, platform=?, price=?, stock=?, image=?, description=? WHERE id=?');
    return $stmt->execute([$title, $platform, $price, $stock, $image, $desc, $id]);
}
function admin_delete_game($id) {
    global $pdo;
    $stmt = $pdo->prepare('DELETE FROM games WHERE id=?');
    return $stmt->execute([$id]);
}
function admin_get_all_orders() {
    global $pdo;
    $orders = $pdo->query('SELECT * FROM orders ORDER BY created_at DESC')->fetchAll(PDO::FETCH_ASSOC);
    foreach ($orders as &$o) {
        $stmt = $pdo->prepare('SELECT oi.*, g.title FROM order_items oi JOIN games g ON oi.game_id = g.id WHERE oi.order_id = ?');
        $stmt->execute([$o['id']]);
        $o['items'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $orders;
}

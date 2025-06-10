<?php
function get_all_games() {
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM games ORDER BY created_at DESC');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function get_game_by_id($id) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM games WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function search_games($q) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM games WHERE title LIKE ? OR platform LIKE ?');
    $like = "%$q%";
    $stmt->execute([$like, $like]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function get_games_by_ids($ids) {
    global $pdo;
    if (!$ids) return [];
    $in = str_repeat('?,', count($ids)-1) . '?';
    $stmt = $pdo->prepare('SELECT * FROM games WHERE id IN (' . $in . ')');
    $stmt->execute($ids);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function create_order($name, $email, $cart) {
    global $pdo;
    $pdo->beginTransaction();
    try {
        $total = 0;
        foreach ($cart as $gid => $qty) {
            $stmt = $pdo->prepare('SELECT price, stock FROM games WHERE id = ?');
            $stmt->execute([$gid]);
            $g = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$g || $g['stock'] < $qty) throw new Exception('Nincs elég készlet!');
            $total += $g['price'] * $qty;
        }
        $stmt = $pdo->prepare('INSERT INTO orders (customer_name, customer_email, total) VALUES (?, ?, ?)');
        $stmt->execute([$name, $email, $total]);
        $order_id = $pdo->lastInsertId();
        foreach ($cart as $gid => $qty) {
            $stmt = $pdo->prepare('SELECT price FROM games WHERE id = ?');
            $stmt->execute([$gid]);
            $g = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = $pdo->prepare('INSERT INTO order_items (order_id, game_id, quantity, price) VALUES (?, ?, ?, ?)');
            $stmt->execute([$order_id, $gid, $qty, $g['price']]);
            $pdo->prepare('UPDATE games SET stock = stock - ? WHERE id = ?')->execute([$qty, $gid]);
        }
        $pdo->commit();
        return $order_id;
    } catch (Exception $e) {
        $pdo->rollBack();
        return false;
    }
}
function create_message($name, $email, $message)
{
    global $pdo;

    $name    = trim($name);
    $email   = trim($email);
    $message = trim($message);

    try {
        $stmt = $pdo->prepare(
            'INSERT INTO messages (name, email, message, date)
             VALUES (?, ?, ?, NOW())'
        );
        $stmt->execute([$name, $email, $message]);

        return (int) $pdo->lastInsertId();
    } catch (PDOException $e) {
        return false;
    }
}


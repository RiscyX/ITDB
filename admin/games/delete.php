<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/db_config.php';
require_once __DIR__ . '/../../functions/admin_functions.php';
if (!isset($_GET['id'])) die('Hiányzó azonosító!');
$id = (int)$_GET['id'];
if (admin_delete_game($id)) {
    header('Location: list.php');
    exit;
} else {
    die('Hiba törléskor!');
}

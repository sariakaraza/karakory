<?php
session_start();
require_once __DIR__ . '/../../inc/category/fonctions.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: /category/list');
    exit;
}

$id = (int) $_GET['id'];
if (deleteCategory($id)) {
    header('Location: /category/list?success=category_deleted');
    exit;
} else {
    header('Location: /category/list?error=delete_failed');
    exit;
}

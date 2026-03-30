<?php
session_start();
require_once __DIR__ . '/../../inc/category/fonctions.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: list.php');
    exit;
}

$id = (int) $_GET['id'];
if (deleteCategory($id)) {
    header('Location: list.php?success=category_deleted');
    exit;
} else {
    header('Location: list.php?error=delete_failed');
    exit;
}

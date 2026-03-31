<?php
session_start();
require_once __DIR__ . '/../../inc/article/fonctions.php';

// Récupération de l'ID de l'article
$id_article = $_GET['id'] ?? null;
if (!$id_article || !is_numeric($id_article)) {
    header('Location: /article/list?error=invalid_id');
    exit;
}

// Vérifier que l'article existe
$article = getArticle((int) $id_article);
if (!$article) {
    header('Location: /article/list?error=article_not_found');
    exit;
}

try {
    // Supprimer l'article
    if (deleteArticle((int) $id_article)) {
        header('Location: /article/list?success=article_deleted');
        exit;
    } else {
        header('Location: /article/view?id=' . urlencode($id_article) . '&error=delete_failed');
        exit;
    }
} catch (Exception $e) {
    error_log('Erreur lors de la suppression de l\'article: ' . $e->getMessage());
    header('Location: /article/view?id=' . urlencode($id_article) . '&error=database_error');
    exit;
}
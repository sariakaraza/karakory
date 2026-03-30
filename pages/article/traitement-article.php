<?php
require_once __DIR__ . '/../../inc/article/fonctions.php';
session_start();

// Traitement des soumissions (ajout et modification)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'] ?? '';
    $slug = $_POST['slug'] ?? '';
    $contenu = $_POST['contenu'] ?? '';
    $id_categorie = $_POST['id_categorie'] ?? '';
    $id_article = $_POST['id_article'] ?? '';

    // Validation basique
    if (empty($titre) || empty($slug) || empty($contenu) || empty($id_categorie)) {
        if (!empty($id_article)) {
            header('Location: edit.php?id=' . urlencode($id_article) . '&error=missing_fields');
        } else {
            header('Location: form.php?error=missing_fields');
        }
        exit;
    }

    $id_user = $_SESSION['user_id'] ?? 1;
    $data = [
        'titre' => trim($titre),
        'slug' => trim($slug),
        'contenu' => trim($contenu),
        'id_user' => $id_user,
        'id_categorie' => (int) $id_categorie
    ];

    try {
        if (!empty($id_article)) {
            // Mise à jour
            $ok = updateArticle((int) $id_article, $data);
            if ($ok) {
                header('Location: list.php?success=article_updated');
                exit;
            } else {
                header('Location: edit.php?id=' . urlencode($id_article) . '&error=update_failed');
                exit;
            }
        } else {
            // Ajout
            $data['date_publication'] = date('Y-m-d H:i:s');
            $articleId = saveArticle($data);
            if ($articleId > 0) {
                header('Location: list.php?success=article_created');
                exit;
            } else {
                header('Location: form.php?error=insert_failed');
                exit;
            }
        }
    } catch (Exception $e) {
        error_log('Erreur lors du traitement de l\'article: ' . $e->getMessage());
        if (!empty($id_article)) {
            header('Location: edit.php?id=' . urlencode($id_article) . '&error=database_error');
        } else {
            header('Location: form.php?error=database_error');
        }
        exit;
    }
}

// Si pas de POST, on charge les articles pour l'affichage dans list.php
$articles = getArticles();

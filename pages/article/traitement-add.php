<?php
require_once __DIR__ . '/../../inc/article/fonctions.php';

// Vérification que le formulaire a été soumis en POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: add.php');
    exit;
}

// Récupération des données du formulaire
$titre = $_POST['titre'] ?? '';
$slug = $_POST['slug'] ?? '';
$contenu = $_POST['contenu'] ?? '';
$id_categorie = $_POST['id_categorie'] ?? '';

// Validation basique
if (empty($titre) || empty($slug) || empty($contenu) || empty($id_categorie)) {
    // Redirection vers le formulaire en cas de données manquantes
    header('Location: add.php?error=missing_fields');
    exit;
}

// TODO: Récupérer l'id de l'utilisateur connecté depuis la session
// Pour l'instant on utilise l'id 1 par défaut
session_start();
$id_user = $_SESSION['user_id'] ?? 1; // ID par défaut en attendant la gestion des sessions

// Préparation des données pour l'insertion
$data = [
    'titre' => trim($titre),
    'slug' => trim($slug),
    'contenu' => trim($contenu),
    'date_publication' => date('Y-m-d H:i:s'), // Date actuelle
    'id_user' => $id_user,
    'id_categorie' => (int) $id_categorie
];

try {
    // Appel de la fonction saveArticle()
    $articleId = saveArticle($data);

    // Si l'insertion a réussi, redirection vers la liste
    if ($articleId > 0) {
        header('Location: list.php?success=article_created');
        exit;
    } else {
        // En cas d'échec
        header('Location: add.php?error=insert_failed');
        exit;
    }
} catch (Exception $e) {
    // En cas d'erreur
    error_log('Erreur lors de l\'insertion de l\'article: ' . $e->getMessage());
    header('Location: add.php?error=database_error');
    exit;
}

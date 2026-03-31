<?php
session_start();
require_once __DIR__ . '/../../inc/category/fonctions.php';


// Vérifier que la requête est POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /dashboard/first');
    exit;
}

// Récupérer et valider les données
$nom = trim($_POST['nom'] ?? '');
$slug = trim($_POST['slug'] ?? '');
$id = isset($_POST['id']) ? (int) $_POST['id'] : null;

// Validation des champs
if (empty($nom) || empty($slug)) {
    $error = 'Tous les champs sont requis';
    $redirectUrl = $id ? "/category/edit?id=$id&error=" . urlencode($error) : "/category/form?error=" . urlencode($error);
    header("Location: $redirectUrl");
    exit;
}

// Vérifier si le slug est unique (sauf pour l'édition de la même catégorie)
if ($id) {
    // Édition
    $existingCategory = getCategoryById($id);
    if (!$existingCategory) {
        header('Location: /category/list?error=category_not_found');
        exit;
    }

    // Vérifier unicité du slug (sauf si c'est le même)
    $pdo = getPDO();
    $stmt = $pdo->prepare('SELECT id_categorie FROM categories WHERE slug = :slug AND id_categorie != :id');
    $stmt->execute([':slug' => $slug, ':id' => $id]);
    if ($stmt->fetch()) {
        $error = 'Ce slug est déjà utilisé par une autre catégorie';
        header("Location: /category/edit?id=$id&error=" . urlencode($error));
        exit;
    }

    // Mettre à jour
    if (updateCategory($id, ['nom' => $nom, 'slug' => $slug])) {
        header('Location: /category/list?success=category_updated');
    } else {
        $error = 'Erreur lors de la mise à jour';
        header("Location: /category/edit?id=$id&error=" . urlencode($error));
    }
} else {
    // Création
    // Vérifier unicité du slug
    $pdo = getPDO();
    $stmt = $pdo->prepare('SELECT id_categorie FROM categories WHERE slug = :slug');
    $stmt->execute([':slug' => $slug]);
    if ($stmt->fetch()) {
        $error = 'Ce slug est déjà utilisé';
        header("Location: /category/form?error=" . urlencode($error));
        exit;
    }

    // Insérer
    if (saveCategory(['nom' => $nom, 'slug' => $slug])) {
        header('Location: /category/list?success=category_created');
    } else {
        $error = 'Erreur lors de la création';
        header("Location: /category/form?error=" . urlencode($error));
    }
}
exit;
?>
<?php
session_start();
require_once __DIR__ . '/../../inc/category/fonctions.php';

$category = null;
$isEdit = false;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
    $category = getCategoryById($id);
    $isEdit = $category !== null;
}

if (!$isEdit) {
    header('Location: list.php');
    exit;
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $slug = trim($_POST['slug'] ?? '');

    if (!empty($nom) && !empty($slug)) {
        if (updateCategory($category['id_categorie'], ['nom' => $nom, 'slug' => $slug])) {
            header('Location: list.php?success=category_updated');
            exit;
        } else {
            $error = 'Erreur lors de la mise à jour';
        }
    } else {
        $error = 'Tous les champs sont requis';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karakory - Modifier Catégorie</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/category.css">
</head>
<body>
    <div class="app-layout">
        <?php include __DIR__ . '/../../inc/components/sidebar.php'; ?>

        <main class="main-content">
            <div class="form-container">
                <div class="form-header">
                    <h1>Modifier la Catégorie</h1>
                    <p>Modifiez les informations de la catégorie</p>
                </div>

                <?php if (isset($error)): ?>
                    <div class="alert alert-error">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" class="form-card">
                    <div class="form-group">
                        <label for="nom">Nom de la catégorie *</label>
                        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($category['nom']); ?>" required>
                        <small>Le nom affiché de la catégorie</small>
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug *</label>
                        <input type="text" id="slug" name="slug" value="<?php echo htmlspecialchars($category['slug']); ?>" required>
                        <small>Identifiant unique pour les URLs (minuscules, pas d'espaces)</small>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            Mettre à jour
                        </button>
                        <a href="list.php" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        // Génération automatique du slug à partir du nom
        document.getElementById('nom').addEventListener('input', function() {
            const slug = this.value
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '') // Supprime les accents
                .replace(/[^a-z0-9\s-]/g, '')    // Supprime les caractères spéciaux
                .replace(/\s+/g, '-')             // Remplace les espaces par des tirets
                .replace(/-+/g, '-')              // Supprime les tirets multiples
                .trim();
            document.getElementById('slug').value = slug;
        });
    </script>
</body>
</html>
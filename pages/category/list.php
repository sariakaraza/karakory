<?php
session_start();
require_once __DIR__ . '/../../inc/category/fonctions.php';

// Charger les catégories
$categories = getCategories();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karakory - Catégories</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/category.css">
</head>
<body>
    <div class="app-layout">
        <?php include __DIR__ . '/../../inc/components/sidebar.php'; ?>

        <main class="main-content">
            <div class="dashboard-container">
                <header class="dashboard-header">
                    <div class="header-content">
                        <h1>Catégories</h1>
                        <p>Affichage des catégories par ordre descendant</p>
                    </div>
                    <div class="header-actions">
                        <a href="form.php" class="btn-add">Ajouter une catégorie</a>
                    </div>
                </header>

                <!-- Messages -->
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">
                        <?php
                        switch ($_GET['success']) {
                            case 'category_created':
                                echo '✓ Catégorie créée avec succès';
                                break;
                            case 'category_updated':
                                echo '✓ Catégorie modifiée avec succès';
                                break;
                            case 'category_deleted':
                                echo '✓ Catégorie supprimée avec succès';
                                break;
                            default:
                                echo '✓ Opération réussie';
                        }
                        ?>
                    </div>
                <?php endif; ?>

                <div class="categories-container">
                    <?php if (count($categories) > 0): ?>
                        <?php foreach ($categories as $cat): ?>
                            <article class="category-card">
                                <div class="category-main">
                                    <h2 class="category-name"><?php echo htmlspecialchars($cat['nom']); ?></h2>
                                    <span class="category-slug"><?php echo htmlspecialchars($cat['slug']); ?></span>
                                </div>
                                <div class="category-meta">
                                    <span class="category-date">
                                        <?php echo date('d/m/Y H:i', strtotime($cat['date_creation'])); ?>
                                    </span>
                                    <div class="category-actions">
                                        <a href="edit.php?id=<?php echo $cat['id_categorie']; ?>" class="btn-edit">Modifier</a>
                                        <a href="delete.php?id=<?php echo $cat['id_categorie']; ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">Supprimer</a>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="empty-state">
                            <h3>Aucune catégorie</h3>
                            <p>Créez votre première catégorie.</p>
                            <a href="form.php" class="btn-add">Créer une catégorie</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

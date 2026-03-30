<?php
session_start();
require_once __DIR__ . '/../../inc/article/fonctions.php';

// Charger les articles
$articles = getArticles();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karakory - Articles</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>
<body>
    <div class="app-layout">
        <?php include __DIR__ . '/../../inc/components/sidebar.php'; ?>

        <main class="main-content">
            <div class="dashboard-container">
                <!-- Header -->
                <header class="dashboard-header">
                    <div class="header-content">
                        <h1>Articles</h1>
                        <p>Affichage des articles par ordre descendant</p>
                    </div>
                    <div class="header-actions">
                        <a href="form.php" class="btn-add">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Ajouter un article
                        </a>
                    </div>
                </header>

                <!-- Messages de succès/erreur -->
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">
                        <?php
                        switch ($_GET['success']) {
                            case 'article_created':
                                echo '✓ Article créé avec succès';
                                break;
                            case 'article_updated':
                                echo '✓ Article modifié avec succès';
                                break;
                            case 'article_deleted':
                                echo '✓ Article supprimé avec succès';
                                break;
                            default:
                                echo '✓ Opération réussie';
                        }
                        ?>
                    </div>
                <?php endif; ?>

                <!-- Articles List -->
                <div class="articles-container">
                    <?php if (count($articles) > 0): ?>
                        <?php foreach ($articles as $article): ?>
                            <article class="article-card">
                                <div class="article-header">
                                    <h2 class="article-title"><?php echo htmlspecialchars($article['titre']); ?></h2>
                                    <span class="article-category"><?php echo htmlspecialchars($article['categorie_nom'] ?? 'Sans catégorie'); ?></span>
                                </div>
                                <div class="article-content">
                                    <p><?php echo nl2br(htmlspecialchars(substr($article['contenu'], 0, 200))); ?>...</p>
                                </div>
                                <div class="article-footer">
                                    <div class="article-date">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        <span>
                                            <?php
                                            if ($article['date_publication']) {
                                                echo date('d/m/Y à H:i', strtotime($article['date_publication']));
                                            } else {
                                                echo 'Non publié';
                                            }
                                            ?>
                                        </span>
                                    </div>
                                    <div class="article-actions">
                                        <a href="view.php?id=<?php echo $article['id_article']; ?>" class="btn-view">Voir</a>
                                        <a href="edit.php?id=<?php echo $article['id_article']; ?>" class="btn-edit">Modifier</a>
                                        <a href="delete.php?id=<?php echo $article['id_article']; ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</a>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="empty-state">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                            </svg>
                            <h3>Aucun article</h3>
                            <p>Commencez par créer votre premier article</p>
                            <a href="form.php" class="btn-add">Créer un article</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

    <style>
        .alert {
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
    </style>
</body>
</html>

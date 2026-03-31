<?php
require_once __DIR__ . '/../../inc/article/fonctions.php';

// Récupérer tous les articles
$articles = getArticles();

// Séparer le premier article (le plus récent) des autres
$mainArticle = null;
$otherArticles = [];

if (count($articles) > 0) {
    $mainArticle = array_shift($articles);
    $otherArticles = $articles;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karakory - Blog</title>
    <link rel="stylesheet" href="../../assets/css/fo-home.css">
</head>
<body>
    <?php include __DIR__ . '/../../inc/components/navbar.php'; ?>

    <!-- Main Container -->
    <div class="home-container">
        <?php if ($mainArticle): ?>
            <!-- Featured Article -->
            <section class="featured-section">
                <div class="featured-image-wrapper">
                    <img 
                        src="https://via.placeholder.com/500x400?text=<?php echo urlencode($mainArticle['titre']); ?>" 
                        alt="<?php echo htmlspecialchars($mainArticle['titre']); ?>" 
                        class="featured-image"
                    >
                </div>
                <div class="featured-content">
                    <span class="featured-category">
                        <?php echo htmlspecialchars($mainArticle['categorie_nom'] ?? 'Général'); ?>
                    </span>
                    <h1 class="featured-title">
                        <?php echo htmlspecialchars($mainArticle['titre']); ?>
                    </h1>
                    <p class="featured-excerpt">
                        <?php echo htmlspecialchars(substr($mainArticle['contenu'], 0, 300)); ?>...
                    </p>
                    <div class="featured-meta">
                        <span>
                            <?php 
                            if ($mainArticle['date_publication']) {
                                echo date('d/m/Y', strtotime($mainArticle['date_publication']));
                            }
                            ?>
                        </span>
                    </div>
                    <a href="/fo/article?slug=<?php echo urlencode($mainArticle['slug']); ?>" class="featured-link">Lire l'article</a>
                </div>
            </section>

            <!-- Other Articles -->
            <?php if (count($otherArticles) > 0): ?>
                <h2 class="articles-title">Derniers articles</h2>
                <div class="articles-grid">
                    <?php foreach ($otherArticles as $article): ?>
                        <a href="/fo/article?slug=<?php echo urlencode($article['slug']); ?>" style="text-decoration: none; color: inherit;">
                            <div class="article-card">
                                <div class="article-card-image-wrapper">
                                    <img 
                                        src="https://via.placeholder.com/300x200?text=<?php echo urlencode($article['titre']); ?>" 
                                        alt="<?php echo htmlspecialchars($article['titre']); ?>"
                                        class="article-card-image"
                                    >
                                </div>
                                <div class="article-card-body">
                                    <span class="article-card-category">
                                        <?php echo htmlspecialchars($article['categorie_nom'] ?? 'Général'); ?>
                                    </span>
                                    <h3 class="article-card-title">
                                        <?php echo htmlspecialchars($article['titre']); ?>
                                    </h3>
                                    <p class="article-card-excerpt">
                                        <?php echo htmlspecialchars(substr($article['contenu'], 0, 150)); ?>
                                    </p>
                                    <p class="article-card-date">
                                        <?php 
                                        if ($article['date_publication']) {
                                            echo date('d/m/Y', strtotime($article['date_publication']));
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </a>                        </a>                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="empty-state">
                <h2>Aucun article</h2>
                <p>Les articles n'ont pas encore été publiés. Revenez bientôt!</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

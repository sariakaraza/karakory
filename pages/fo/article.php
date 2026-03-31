<?php
require_once __DIR__ . '/../../inc/article/fonctions.php';

// Récupération du slug
$slug = $_GET['slug'] ?? null;
if (!$slug) {
    header('Location: home.php');
    exit;
}

// Récupération de l'article via le slug
$article = show($slug);
if (!$article) {
    header('Location: home.php?error=article_not_found');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['titre']); ?> - Karakory</title>
    <link rel="stylesheet" href="../../assets/css/fo-home.css">
    <link rel="stylesheet" href="../../assets/css/fo-article.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="/fo/home" class="navbar-brand">Karakory</a>
        
        <div class="navbar-center">
            <div class="search-box">
                <form method="GET" action="/search/results" style="display: flex; width: 100%; align-items: center;">
                    <input 
                        type="text" 
                        name="q"
                        placeholder="Rechercher un article..."
                        id="searchInput"
                        required
                    >
                    <button type="submit" title="Rechercher">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <div class="navbar-right">
            <a href="/login/form" class="btn-login">Se connecter</a>
        </div>
    </nav>

    <!-- Article Header -->
    <div class="article-header">
        <div class="article-container">
            <a href="/fo/home" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Retour
            </a>
            
            <h1 class="article-nofocus"><?php echo htmlspecialchars($article['titre']); ?></h1>
            
            <div class="article-header-meta">
                <span class="article-category-badge">
                    <?php echo htmlspecialchars($article['categorie_nom'] ?? 'Général'); ?>
                </span>
                <span class="article-header-date">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <?php 
                    if ($article['date_publication']) {
                        echo date('d/m/Y', strtotime($article['date_publication']));
                    }
                    ?>
                </span>
            </div>
        </div>
    </div>

    <!-- Article Content -->
    <div class="article-container">
        <div class="article-content">
            <?php echo nl2br(htmlspecialchars($article['contenu'])); ?>
        </div>

        <!-- Back Button -->
        <div style="text-align: center; margin-top: 3rem;">
            <a href="/fo/home" style="display: inline-block; background: #2c5aa0; color: white; padding: 0.8rem 1.5rem; border-radius: 4px; text-decoration: none; font-weight: 600; transition: background 0.2s;">
                ← Retour à l'accueil
            </a>
        </div>
    </div>
</body>
</html>
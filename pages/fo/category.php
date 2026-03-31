<?php
require_once __DIR__ . '/../../inc/article/fonctions.php';
require_once __DIR__ . '/../../inc/category/fonctions.php';

// Récupérer le slug de la catégorie depuis les paramètres GET
$categorySlug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
$articles = [];
$category = null;

if (!empty($categorySlug)) {
    // Récupérer la catégorie
    $category = showCategory($categorySlug);
    
    if ($category) {
        // Récupérer les articles de cette catégorie
        $articles = getArticlesByCategory($category['id_categorie']);
    } else {
        // Catégorie non trouvée - redirection vers l'accueil
        header('Location: /fo/home');
        exit;
    }
} else {
    // Pas de slug fourni - redirection vers l'accueil
    header('Location: /fo/home');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($category['nom']); ?> - Karakory</title>
    <link rel="stylesheet" href="../../assets/css/fo-home.css">
    <link rel="stylesheet" href="../../assets/css/search.css">
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

    <!-- Category Header -->
    <div class="search-header">
        <div class="search-header-content">
            <h1><?php echo htmlspecialchars($category['nom']); ?></h1>
            <div class="search-info">
                Catégorie : <strong><?php echo htmlspecialchars($category['nom']); ?></strong>
            </div>
        </div>
    </div>

    <!-- Results Container -->
    <div class="results-container">
        <?php if (count($articles) > 0): ?>
            <div class="results-count">
                <strong><?php echo count($articles); ?></strong> 
                article<?php echo count($articles) > 1 ? 's' : ''; ?> trouvé<?php echo count($articles) > 1 ? 's' : ''; ?>
            </div>

            <div class="articles-grid">
                <?php foreach ($articles as $article): ?>
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
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-results">
                <h2>Aucun article trouvé</h2>
                <p>Désolé, aucun article n'a été trouvé dans la catégorie "<strong><?php echo htmlspecialchars($category['nom']); ?></strong>".</p>
                <p>Consultez d'autres catégories ou retournez à l'accueil.</p>

            </div>
        <?php endif; ?>
    </div>

    <div style="text-align: center; margin-top: 3rem;">
        <a href="/fo/home" style="display: inline-block; background: #2c5aa0; color: white; padding: 0.8rem 1.5rem; border-radius: 4px; text-decoration: none; font-weight: 600; transition: background 0.2s;">
            ← Retour à l'accueil
        </a>
    </div>
    <script>
        // Focus sur le champ de recherche
        document.getElementById('searchInput').focus();
    </script>
</body>
</html>

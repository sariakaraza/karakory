<?php
require_once __DIR__ . '/traitement-search.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche - Karakory</title>
    <link rel="stylesheet" href="../../assets/css/fo-home.css">
    <link rel="stylesheet" href="../../assets/css/search.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="/fo/home" class="navbar-brand">Karakory</a>
        
        <div class="navbar-center">
            <div class="search-box">
                <form method="GET" style="display: flex; width: 100%; align-items: center;">
                    <input 
                        type="text" 
                        name="q"
                        placeholder="Rechercher un article..."
                        value="<?php echo htmlspecialchars($keyword); ?>"
                        id="searchInput"
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

    <!-- Search Header -->
    <div class="search-header">
        <div class="search-header-content">
            <h1>Résultats de recherche</h1>
            <div class="search-info">
                Recherche : "<strong><?php echo htmlspecialchars($keyword); ?></strong>"
            </div>
        </div>
    </div>

    <!-- Results Container -->
    <div class="results-container">
        <?php if (count($results) > 0): ?>
            <div class="results-count">
                <strong><?php echo count($results); ?></strong> 
                résultat<?php echo count($results) > 1 ? 's' : ''; ?> trouvé<?php echo count($results) > 1 ? 's' : ''; ?>
            </div>

            <div class="articles-grid">
                <?php foreach ($results as $article): ?>
                    <a href="/fo/article?slug=<?php echo urlencode($article['slug']); ?>" style="text-decoration: none; color: inherit;">
                        <div class="article-card">
                            <div class="article-card-image-wrapper">
                                <?php
                                $imageUrl = !empty($article['image_url'])
                                    ? '/' . $article['image_url']
                                    : 'https://via.placeholder.com/300x200?text=' . urlencode($article['titre']);
                                $imageAlt = $article['image_alt'] ?? htmlspecialchars($article['titre']);
                                ?>
                                <img
                                    src="<?php echo htmlspecialchars($imageUrl); ?>"
                                    alt="<?php echo htmlspecialchars($imageAlt); ?>"
                                    class="article-card-image"
                                    onerror="this.src='https://via.placeholder.com/300x200?text=Image+non+disponible'"
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
                <h2>Aucun résultat trouvé</h2>
                <p>Désolé, aucun article ne correspond à votre recherche pour "<strong><?php echo htmlspecialchars($keyword); ?></strong>".</p>
                <p>Essayez avec d'autres mots-clés ou <a href="/fo/home">retournez à l'accueil</a>.</p>
                <a href="/fo/home" class="back-home-btn">Retour à l'accueil</a>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Focus sur le champ de recherche
        document.getElementById('searchInput').focus();
    </script>
</body>
</html>

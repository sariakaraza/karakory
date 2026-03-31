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
    <style>
        .search-header {
            background: linear-gradient(135deg, #0a1f3e 0%, #1a3055 100%);
            color: white;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .search-header-content {
            max-width: 1320px;
            margin: 0 auto;
        }

        .search-header h1 {
            font-size: 2rem;
            font-family: 'Georgia', serif;
            font-weight: 900;
            margin-bottom: 0.5rem;
        }

        .search-info {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .results-container {
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 2rem 2rem;
        }

        .results-count {
            font-size: 1.05rem;
            color: #495057;
            margin-bottom: 2rem;
        }

        .search-again {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .search-again input {
            flex: 1;
            padding: 0.8rem 1rem;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            font-size: 1rem;
        }

        .search-again button {
            background: #2c5aa0;
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .search-again button:hover {
            background: #1a3055;
        }

        .no-results {
            text-align: center;
            padding: 3rem 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .no-results h2 {
            font-family: 'Georgia', serif;
            color: #0a1f3e;
            margin-bottom: 1rem;
        }

        .no-results p {
            color: #6c757d;
            margin-bottom: 1.5rem;
        }

        .back-home-btn {
            display: inline-block;
            background: #2c5aa0;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.2s;
        }

        .back-home-btn:hover {
            background: #1a3055;
        }

        @media (max-width: 768px) {
            .search-header h1 {
                font-size: 1.5rem;
            }

            .search-again {
                flex-direction: column;
            }

            .search-again input {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="../fo/home.php" class="navbar-brand">Karakory</a>
        
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
            <a href="../../pages/login/form.php" class="btn-login">Se connecter</a>
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
                    <a href="../fo/article.php?slug=<?php echo urlencode($article['slug']); ?>" style="text-decoration: none; color: inherit;">
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
                <h2>Aucun résultat trouvé</h2>
                <p>Désolé, aucun article ne correspond à votre recherche pour "<strong><?php echo htmlspecialchars($keyword); ?></strong>".</p>
                <p>Essayez avec d'autres mots-clés ou <a href="../fo/home.php">retournez à l'accueil</a>.</p>
                <a href="../fo/home.php" class="back-home-btn">Retour à l'accueil</a>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Focus sur le champ de recherche
        document.getElementById('searchInput').focus();
    </script>
</body>
</html>

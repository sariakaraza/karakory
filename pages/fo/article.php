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
    <style>
        /* Article Page Styles */
        .article-header {
            background: linear-gradient(135deg, #0a1f3e 0%, #1a3055 100%);
            color: white;
            padding: 3rem 2rem;
            margin-bottom: 2rem;
        }

        .article-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .article-header h1 {
            font-size: 2.5rem;
            font-family: 'Georgia', serif;
            font-weight: 900;
            line-height: 1.3;
            margin-bottom: 1rem;
        }

        .article-header-meta {
            display: flex;
            gap: 2rem;
            align-items: center;
            font-size: 0.95rem;
        }

        .article-header-date {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .article-category-badge {
            display: inline-block;
            background: #2c5aa0;
            padding: 0.4rem 1rem;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .article-content {
            background: white;
            padding: 2.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            line-height: 1.8;
            font-size: 1.05rem;
            color: #495057;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .article-content h2 {
            font-family: 'Georgia', serif;
            color: #0a1f3e;
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-size: 1.8rem;
        }

        .article-content h3 {
            font-family: 'Georgia', serif;
            color: #1a3055;
            margin-top: 1.5rem;
            margin-bottom: 0.8rem;
            font-size: 1.3rem;
        }

        .article-content strong {
            color: #0a1f3e;
        }

        .article-nofocus {
            margin-top: 0;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 2rem;
            color: white;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: opacity 0.2s;
        }

        .back-link:hover {
            opacity: 0.8;
        }

        .back-link svg {
            width: 20px;
            height: 20px;
        }

        @media (max-width: 768px) {
            .article-header {
                padding: 2rem 1rem;
            }

            .article-header h1 {
                font-size: 1.8rem;
            }

            .article-content {
                padding: 1.5rem;
            }

            .article-header-meta {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="home.php" class="navbar-brand">Karakory</a>
        
        <div class="navbar-center">
            <div class="search-box">
                <input 
                    type="text" 
                    placeholder="Rechercher un article..."
                    id="searchInput"
                >
                <button type="submit" title="Rechercher">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
            </div>
        </div>

        <div class="navbar-right">
            <a href="../../pages/login/form.php" class="btn-login">Se connecter</a>
        </div>
    </nav>

    <!-- Article Header -->
    <div class="article-header">
        <div class="article-container">
            <a href="home.php" class="back-link">
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
            <a href="home.php" style="display: inline-block; background: #2c5aa0; color: white; padding: 0.8rem 1.5rem; border-radius: 4px; text-decoration: none; font-weight: 600; transition: background 0.2s;">
                ← Retour à l'accueil
            </a>
        </div>
    </div>

    <script>
        // Fonction de recherche
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const query = this.value;
                if (query) {
                    console.log('Recherche pour:', query);
                }
            }
        });
    </script>
</body>
</html>
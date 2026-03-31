<?php
session_start();
require_once __DIR__ . '/../../inc/article/fonctions.php';
require_once __DIR__ . '/../../inc/category/fonctions.php';

// Récupération de l'ID de l'article
$id_article = $_GET['id'] ?? null;
if (!$id_article || !is_numeric($id_article)) {
    header('Location: /article/list?error=invalid_id');
    exit;
}

// Récupération de l'article
$article = getArticle((int) $id_article);
if (!$article) {
    header('Location: /article/list?error=article_not_found');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karakory - <?php echo htmlspecialchars($article['titre']); ?></title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/article-bo.css">
</head>
<body>
    <div class="app-layout">
        <?php include __DIR__ . '/../../inc/components/sidebar.php'; ?>

        <main class="main-content">
            <div class="articles-bo-container">
                <!-- Header -->
                <header class="articles-bo-header">
                    <div>
                        <h1>Détails de l'article</h1>
                        <p><?php echo htmlspecialchars($article['titre']); ?></p>
                    </div>
                    <a href="/article/list" class="btn-bo-add">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                        Retour à la liste
                    </a>
                </header>

                <!-- Détails article -->
                <div class="article-view-container">
                    <article class="article-details">
                        <!-- Titre -->
                        <div class="detail-section">
                            <h2 class="detail-title"><?php echo htmlspecialchars($article['titre']); ?></h2>
                        </div>

                        <!-- Métadonnées -->
                        <div class="detail-metadata">
                            <div class="metadata-item">
                                <strong>Catégorie :</strong>
                                <span class="article-category"><?php echo htmlspecialchars($article['categorie_nom'] ?? 'Sans catégorie'); ?></span>
                            </div>
                            <div class="metadata-item">
                                <strong>Slug :</strong>
                                <code><?php echo htmlspecialchars($article['slug']); ?></code>
                            </div>
                            <div class="metadata-item">
                                <strong>Date de publication :</strong>
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
                            <?php if ($article['date_modification']): ?>
                                <div class="metadata-item">
                                    <strong>Dernière modification :</strong>
                                    <span><?php echo date('d/m/Y à H:i', strtotime($article['date_modification'])); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Contenu -->
                        <div class="detail-section">
                            <h3>Contenu</h3>
                            <div class="article-body">
                                <?php echo nl2br(htmlspecialchars($article['contenu'])); ?>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="form-actions">
                            <a href="/article/list" class="btn-cancel">Retour</a>
                            <a href="/article/edit?id=<?php echo $article['id_article']; ?>" class="btn-submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                Modifier
                            </a>
                        </div>
                    </article>
                </div>
            </div>
        </main>
    </div>

    <style>
        .article-view-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .article-details {
            background: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .detail-title {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .detail-metadata {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 6px;
        }

        .metadata-item {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .metadata-item strong {
            font-weight: 600;
            color: #555;
        }

        .metadata-item code {
            background: white;
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            color: #d63384;
        }

        .detail-section {
            margin-bottom: 2rem;
        }

        .detail-section h3 {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .article-body {
            line-height: 1.8;
            color: #444;
            background: #fafbfc;
            padding: 1.5rem;
            border-left: 4px solid #007bff;
            border-radius: 4px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</body>
</html>
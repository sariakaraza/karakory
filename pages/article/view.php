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

// Récupération des images
$images = getArticleImages((int) $id_article);
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

                        <!-- Galerie d'images -->
                        <div class="detail-section">
                            <div class="images-section-header">
                                <h3>Images de l'article</h3>
                                <?php if (count($images) > 0): ?>
                                    <span class="image-count"><?php echo count($images); ?> image<?php echo count($images) > 1 ? 's' : ''; ?></span>
                                <?php endif; ?>
                            </div>
                            
                            <?php if (count($images) > 0): ?>
                                <div class="images-gallery">
                                    <?php foreach ($images as $index => $image): ?>
                                        <div class="image-card">
                                            <div class="image-card-wrapper">
                                                <img 
                                                    src="<?php 
                                                        $imagePath = $image['url'];
                                                        if (strpos($imagePath, '/') !== 0) {
                                                            $imagePath = '/' . $imagePath;
                                                        }
                                                        echo htmlspecialchars($imagePath);
                                                    ?>" 
                                                    alt="<?php echo htmlspecialchars($image['alt'] ?? 'Image'); ?>"
                                                    class="image-card-img"
                                                >
                                                <div class="image-overlay">
                                                    <a href="<?php 
                                                        $imagePath = $image['url'];
                                                        if (strpos($imagePath, '/') !== 0) {
                                                            $imagePath = '/' . $imagePath;
                                                        }
                                                        echo htmlspecialchars($imagePath);
                                                    ?>" target="_blank" class="btn-view-image" title="Afficher l'image">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="image-card-info">
                                                <p class="image-alt-text"><?php echo htmlspecialchars($image['alt'] ?? 'Sans description'); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="no-images">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                        <polyline points="21 15 16 10 5 21"></polyline>
                                    </svg>
                                    <p>Aucune image associée à cet article</p>
                                </div>
                            <?php endif; ?>
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

        /* Images Gallery Styles */
        .images-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .images-section-header h3 {
            margin: 0;
        }

        .image-count {
            background: #e7f3ff;
            color: #0066cc;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .images-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .image-card {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .image-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-color: #007bff;
        }

        .image-card-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 66.67%;
            overflow: hidden;
            background: #f5f5f5;
        }

        .image-card-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .image-card:hover .image-overlay {
            opacity: 1;
        }

        .btn-view-image {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            background: #007bff;
            color: white;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-view-image:hover {
            background: #0056b3;
            transform: scale(1.1);
        }

        .image-card-info {
            padding: 1rem;
        }

        .image-alt-text {
            margin: 0;
            font-size: 0.95rem;
            color: #333;
            font-weight: 500;
            line-height: 1.4;
            word-break: break-word;
        }

        .image-meta {
            margin: 0.5rem 0 0 0;
            font-size: 0.8rem;
            color: #999;
        }

        .no-images {
            text-align: center;
            padding: 2rem;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px dashed #ddd;
        }

        .no-images svg {
            color: #ccc;
            margin-bottom: 1rem;
        }

        .no-images p {
            margin: 0;
            color: #999;
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            .images-gallery {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 1rem;
            }

            .images-section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }
    </style>
</body>
</html>
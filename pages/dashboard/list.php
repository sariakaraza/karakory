<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karakory - Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>
<body>
    <?php require_once __DIR__ . '/traitement-dashboard.php'; ?>
    <div class="app-layout">
        <?php include __DIR__ . '/../../inc/components/sidebar.php'; ?>

        <main class="main-content">
            <div class="dashboard-container">
                <!-- Header -->
                <header class="dashboard-header">
                    <div class="header-content">
                        <h1>Dashboard</h1>
                        <p>Gérez vos articles et catégories</p>
                    </div>
                    <div class="header-filters">
                        <select name="period" id="period" class="filter-select" onchange="window.location.href='list.php?period=' + this.value">
                            <option value="all" <?php echo $period === 'all' ? 'selected' : ''; ?>>Tout voir</option>
                            <option value="today" <?php echo $period === 'today' ? 'selected' : ''; ?>>Aujourd'hui</option>
                            <option value="week" <?php echo $period === 'week' ? 'selected' : ''; ?>>Cette semaine</option>
                            <option value="month" <?php echo $period === 'month' ? 'selected' : ''; ?>>Ce mois</option>
                        </select>
                    </div>
                </header>

                <!-- Stats Cards -->
                <div class="stats-grid">
            <!-- Card Articles -->
            <div class="stat-card">
                <div class="stat-icon articles-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </div>
                <div class="stat-info">
                    <h3>Articles</h3>
                    <p class="stat-number"><?php echo $articlesCount; ?></p>
                    <p class="stat-subtitle">articles publiés</p>
                </div>
                <a href="#" class="btn-add">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Ajouter un article
                </a>
            </div>

            <!-- Card Catégories -->
            <div class="stat-card">
                <div class="stat-icon categories-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                </div>
                <div class="stat-info">
                    <h3>Catégories</h3>
                    <p class="stat-number"><?php echo $categoriesCount; ?></p>
                    <p class="stat-subtitle">catégories actives</p>
                </div>
                <a href="#" class="btn-add">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Ajouter une catégorie
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="recent-section">
            <h2>Activité récente</h2>
            <div class="activity-grid">
                <!-- Recent Articles -->
                <div class="activity-card">
                    <div class="activity-header">
                        <h3>Derniers articles</h3>
                        <span class="count-badge"><?php echo $newArticlesToday; ?> nouveaux</span>
                    </div>
                    <ul class="activity-list">
                        <?php if (count($recentArticles) > 0): ?>
                            <?php foreach ($recentArticles as $article): ?>
                                <li class="activity-item">
                                    <div class="item-info">
                                        <p class="item-title"><?php echo htmlspecialchars($article['titre']); ?></p>
                                        <span class="item-date"><?php echo timeAgo($article['date_creation']); ?></span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="activity-item">
                                <div class="item-info">
                                    <p class="item-title">Aucun article aujourd'hui</p>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Recent Categories -->
                <div class="activity-card">
                    <div class="activity-header">
                        <h3>Dernières catégories</h3>
                        <span class="count-badge"><?php echo $newCategoriesToday; ?> nouvelles</span>
                    </div>
                    <ul class="activity-list">
                        <?php if (count($recentCategories) > 0): ?>
                            <?php foreach ($recentCategories as $category): ?>
                                <li class="activity-item">
                                    <div class="item-info">
                                        <p class="item-title"><?php echo htmlspecialchars($category['nom']); ?></p>
                                        <span class="item-date"><?php echo timeAgo($category['date_creation']); ?></span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="activity-item">
                                <div class="item-info">
                                    <p class="item-title">Aucune catégorie aujourd'hui</p>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            </div>
        </div>
    </main>
    </div>
</body>
</html>

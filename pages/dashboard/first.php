<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karakory - Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>
<body>
    <div class="app-layout">
        <?php include __DIR__ . '/../../inc/components/sidebar.php'; ?>

        <main class="main-content">
            <div class="welcome-container">
                <h1>Bienvenue sur Karakory</h1>
                <p class="subtitle">Système de gestion de contenu</p>

                <div class="welcome-cards">
                    <div class="welcome-card">
                        <div class="card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                            </svg>
                        </div>
                        <h3>Gérez vos articles</h3>
                        <p>Créez, modifiez et publiez vos articles en toute simplicité</p>
                    </div>

                    <div class="welcome-card">
                        <div class="card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                        </div>
                        <h3>Organisez par catégories</h3>
                        <p>Structurez votre contenu avec des catégories personnalisées</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

<?php
// Détection du chemin actuel pour les liens du sidebar
$currentPath = $_SERVER['PHP_SELF'];
$isInDashboard = strpos($currentPath, '/dashboard/') !== false;
$isInArticle = strpos($currentPath, '/article/') !== false;

// Construction des liens selon la page actuelle
if ($isInDashboard) {
    $dashboardLink = 'list.php';
    $articleLink = '../article/list.php';
    $homeLink = 'first.php';
} elseif ($isInArticle) {
    $dashboardLink = '../dashboard/list.php';
    $articleLink = 'list.php';
    $homeLink = '../dashboard/first.php';
} else {
    $dashboardLink = 'dashboard/list.php';
    $articleLink = 'article/list.php';
    $homeLink = 'first.php';
}
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <h2>Karakory</h2>
    </div>

    <nav class="sidebar-nav">
        <a href="<?php echo $homeLink; ?>" class="nav-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            <span>Accueil</span>
        </a>

        <a href="<?php echo $dashboardLink; ?>" class="nav-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="3" y1="9" x2="21" y2="9"></line>
                <line x1="9" y1="21" x2="9" y2="9"></line>
            </svg>
            <span>Dashboard</span>
        </a>

        <a href="<?php echo $articleLink; ?>" class="nav-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
            </svg>
            <span>Articles</span>
        </a>
    </nav>
</aside>


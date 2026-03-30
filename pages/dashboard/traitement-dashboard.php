<?php
require_once __DIR__ . '/../../inc/article/fonctions.php';
require_once __DIR__ . '/../../inc/category/fonctions.php';

/**
 * Calcule le temps écoulé depuis une date et retourne un texte lisible
 * @param string $datetime La date au format SQL
 * @return string Le texte formaté (ex: "Il y a 2 heures")
 */
function timeAgo(string $datetime): string
{
	$now = new DateTime();
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	if ($diff->d == 0) {
		if ($diff->h == 0) {
			if ($diff->i == 0) {
				return 'À l\'instant';
			}
			return 'Il y a ' . $diff->i . ' minute' . ($diff->i > 1 ? 's' : '');
		}
		return 'Il y a ' . $diff->h . ' heure' . ($diff->h > 1 ? 's' : '');
	} elseif ($diff->d == 1) {
		return 'Hier';
	} elseif ($diff->d < 7) {
		return 'Il y a ' . $diff->d . ' jour' . ($diff->d > 1 ? 's' : '');
	} else {
		return date('d/m/Y', strtotime($datetime));
	}
}

// Récupération de la période depuis le formulaire (GET ou POST)
$period = $_GET['period'] ?? 'all';

// Validation de la période
$validPeriods = ['all', 'today', 'week', 'month'];
if (!in_array($period, $validPeriods)) {
	$period = 'all';
}

// Comptage des articles et catégories selon la période
$articlesCount = countArticlesByPeriod($period);
$categoriesCount = countCategoriesByPeriod($period);

// Récupération des activités récentes (aujourd'hui uniquement)
$recentArticles = getRecentArticles(5);
$recentCategories = getRecentCategories(5);

// Calcul du nombre de nouveaux éléments aujourd'hui
$newArticlesToday = count($recentArticles);
$newCategoriesToday = count($recentCategories);

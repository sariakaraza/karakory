<?php
require_once __DIR__ . '/../../inc/article/fonctions.php';

/**
 * Fonction de recherche - effectue la recherche et retourne les résultats
 * @param string $keyword
 * @return array
 */
function search(string $keyword): array
{
	return searchArticles($keyword);
}

// Traitement de la recherche
$keyword = '';
$results = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$keyword = isset($_POST['search']) ? trim($_POST['search']) : '';
	
	if (!empty($keyword) && strlen($keyword) >= 2) {
		// Effectuer la recherche
		$results = search($keyword);
	} elseif (empty($keyword)) {
		// Redirection si le champ est vide
		header('Location: /fo/home');
		exit;
	}
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
	
	if (!empty($keyword) && strlen($keyword) >= 2) {
		// Effectuer la recherche
		$results = search($keyword);
	} elseif (empty($keyword)) {
		// Redirection si le paramètre est vide
		header('Location: /fo/home');
		exit;
	}
}

<?php
require_once __DIR__ . '/../connexion.php';

/**
 * Récupère tous les articles triés par date_publication décroissante avec le nom de la catégorie.
 * @return array
 */
function getArticles(): array
{
	$pdo = getPDO();
	$sql = 'SELECT a.*, c.nom as categorie_nom
	        FROM articles a
	        LEFT JOIN categories c ON a.id_categorie = c.id_categorie
	        ORDER BY a.date_publication DESC';
	$stmt = $pdo->query($sql);
	return $stmt->fetchAll();
}

/**
 * Récupère un article par son ID avec le nom de la catégorie
 * @param int $id
 * @return array|false
 */
function getArticleById(int $id)
{
	$pdo = getPDO();
	$sql = 'SELECT a.*, c.nom as categorie_nom
	        FROM articles a
	        LEFT JOIN categories c ON a.id_categorie = c.id_categorie
	        WHERE a.id_article = :id_article';
	$stmt = $pdo->prepare($sql);
	$stmt->execute([':id_article' => $id]);
	return $stmt->fetch();
}

/**
 * Récupère tous les articles d'une catégorie donnée, triés par date_publication décroissante avec le nom de la catégorie.
 * @param int $id_category
 * @return array
 */
function getArticlesByCategory(int $id_category): array
{
	$pdo = getPDO();
	$sql = 'SELECT a.*, c.nom as categorie_nom
	        FROM articles a
	        LEFT JOIN categories c ON a.id_categorie = c.id_categorie
	        WHERE a.id_categorie = :id_categorie
	        ORDER BY a.date_publication DESC';
	$stmt = $pdo->prepare($sql);
	$stmt->execute([':id_categorie' => $id_category]);
	return $stmt->fetchAll();
}

/**
 * Insère un nouvel article.
 * @param array $data Associative array: titre, slug, contenu, date_publication (nullable), id_user, id_categorie
 * @return int id inséré
 */
function saveArticle(array $data): int
{
	$pdo = getPDO();
	$sql = 'INSERT INTO articles (titre, slug, contenu, date_publication, id_user, id_categorie) VALUES (:titre, :slug, :contenu, :date_publication, :id_user, :id_categorie) RETURNING id_article';
	$stmt = $pdo->prepare($sql);

	$params = [
		':titre' => $data['titre'] ?? null,
		':slug' => $data['slug'] ?? null,
		':contenu' => $data['contenu'] ?? null,
		':date_publication' => $data['date_publication'] ?? null,
		':id_user' => $data['id_user'] ?? null,
		':id_categorie' => $data['id_categorie'] ?? null,
	];

	$stmt->execute($params);
	$id = $stmt->fetchColumn();
	return (int) $id;
}

/**
 * Met à jour un article existant.
 * @param int $id
 * @param array $data Associative array: titre, slug, contenu, id_user, id_categorie
 * @return bool
 */
function updateArticle(int $id, array $data): bool
{
	$pdo = getPDO();
	$sql = 'UPDATE articles SET titre = :titre, slug = :slug, contenu = :contenu, id_user = :id_user, id_categorie = :id_categorie, date_modification = CURRENT_TIMESTAMP WHERE id_article = :id_article';
	$stmt = $pdo->prepare($sql);

	$params = [
		':titre' => $data['titre'] ?? null,
		':slug' => $data['slug'] ?? null,
		':contenu' => $data['contenu'] ?? null,
		':id_user' => $data['id_user'] ?? null,
		':id_categorie' => $data['id_categorie'] ?? null,
		':id_article' => $id,
	];

	return $stmt->execute($params);
}

/**
 * Supprime un article par son id.
 * @param int $id
 * @return bool
 */
function deleteArticle(int $id): bool
{
	$pdo = getPDO();
	$sql = 'DELETE FROM articles WHERE id_article = :id_article';
	$stmt = $pdo->prepare($sql);
	return $stmt->execute([':id_article' => $id]);
}

/**
 * Compte le nombre d'articles selon la période
 * @param string $period 'today', 'week', 'month', 'all'
 * @return int
 */
function countArticlesByPeriod(string $period = 'all'): int
{
	$pdo = getPDO();

	$sql = 'SELECT COUNT(*) FROM articles WHERE 1=1';

	switch ($period) {
		case 'today':
			$sql .= ' AND DATE(date_creation) = CURRENT_DATE';
			break;
		case 'week':
			$sql .= ' AND date_creation >= CURRENT_DATE - INTERVAL \'7 days\'';
			break;
		case 'month':
			$sql .= ' AND date_creation >= CURRENT_DATE - INTERVAL \'1 month\'';
			break;
		case 'all':
		default:
			// Pas de filtre supplémentaire
			break;
	}

	$stmt = $pdo->query($sql);
	return (int) $stmt->fetchColumn();
}

/**
 * Récupère les articles récents d'aujourd'hui
 * @param int $limit Nombre maximum d'articles à récupérer
 * @return array
 */
function getRecentArticles(int $limit = 5): array
{
	$pdo = getPDO();
	$sql = 'SELECT id_article, titre, date_creation
	        FROM articles
	        WHERE DATE(date_creation) = CURRENT_DATE
	        ORDER BY date_creation DESC
	        LIMIT :limit';

	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
	$stmt->execute();

	return $stmt->fetchAll();
}

/**
 * Récupère un article (alias de getArticleById pour compatibilité)
 * @param int $id
 * @return array|false
 */
function getArticle(int $id)
{
	return getArticleById($id);
}

/**
 * Récupère tous les articles pour le frontend (même que getArticles)
 * @return array
 */
function getAllArticles(): array
{
	return getArticles();
}

/**
 * Récupère un article par son slug avec le nom de la catégorie
 * @param string $slug
 * @return array|false
 */
function getArticleBySlug(string $slug)
{
	$pdo = getPDO();
	$sql = 'SELECT a.*, c.nom as categorie_nom
	        FROM articles a
	        LEFT JOIN categories c ON a.id_categorie = c.id_categorie
	        WHERE a.slug = :slug';
	$stmt = $pdo->prepare($sql);
	$stmt->execute([':slug' => $slug]);
	return $stmt->fetch();
}

/**
 * Affiche un article avec ses détails complets
 * @param string $slug
 * @return array|false
 */
function show(string $slug)
{
	return getArticleBySlug($slug);
}

/**
 * Recherche des articles par mot-clé
 * Cherche dans le titre, le contenu et la catégorie
 * @param string $keyword
 * @return array
 */
function searchArticles(string $keyword): array
{
	$pdo = getPDO();
	$keyword = '%' . $keyword . '%';
	
	$sql = 'SELECT a.*, c.nom as categorie_nom
	        FROM articles a
	        LEFT JOIN categories c ON a.id_categorie = c.id_categorie
	        WHERE a.titre ILIKE :keyword 
	           OR a.contenu ILIKE :keyword 
	           OR c.nom ILIKE :keyword
	        ORDER BY a.date_publication DESC';
	
	$stmt = $pdo->prepare($sql);
	$stmt->execute([':keyword' => $keyword]);
	
	return $stmt->fetchAll();
}
/*
 * Sauvegarde une image pour un article
 * @param array $data Associative array: url, alt, id_article
 * @return int id inséré
 */
function saveArticleImage(array $data): int
{
	$pdo = getPDO();
	$sql = 'INSERT INTO images_articles (url, alt, id_article) VALUES (:url, :alt, :id_article) RETURNING id_image';
	$stmt = $pdo->prepare($sql);

	$params = [
		':url' => $data['url'] ?? null,
		':alt' => $data['alt'] ?? null,
		':id_article' => $data['id_article'] ?? null,
	];

	$stmt->execute($params);
	$id = $stmt->fetchColumn();
	return (int) $id;
}

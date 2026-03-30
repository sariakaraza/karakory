<?php
require_once __DIR__ . '/../connexion.php';

/**
 * Récupère toutes les catégories triées par date_creation décroissante.
 * @return array
 */
function getCategories(): array
{
	$pdo = getPDO();
	$sql = 'SELECT * FROM categories ORDER BY date_creation DESC';
	$stmt = $pdo->query($sql);
	return $stmt->fetchAll();
}

/**
 * Compte le nombre de catégories selon la période
 * @param string $period 'today', 'week', 'month', 'all'
 * @return int
 */
function countCategoriesByPeriod(string $period = 'all'): int
{
	$pdo = getPDO();

	$sql = 'SELECT COUNT(*) FROM categories WHERE 1=1';

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
 * Récupère les catégories récentes d'aujourd'hui
 * @param int $limit Nombre maximum de catégories à récupérer
 * @return array
 */
function getRecentCategories(int $limit = 5): array
{
	$pdo = getPDO();
	$sql = 'SELECT id_categorie, nom, date_creation
	        FROM categories
	        WHERE DATE(date_creation) = CURRENT_DATE
	        ORDER BY date_creation DESC
	        LIMIT :limit';

	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
	$stmt->execute();

	return $stmt->fetchAll();
}

/**
 * Insère une nouvelle catégorie.
 * @param array $data Associative array: nom, slug
 * @return int id inséré
 */
function saveCategory(array $data): int
{
	$pdo = getPDO();
	$sql = 'INSERT INTO categories (nom, slug) VALUES (:nom, :slug) RETURNING id_categorie';
	$stmt = $pdo->prepare($sql);

	$params = [
		':nom' => $data['nom'] ?? null,
		':slug' => $data['slug'] ?? null,
	];

	$stmt->execute($params);
	$id = $stmt->fetchColumn();
	return (int) $id;
}

/**
 * Met à jour une catégorie existante.
 * @param int $id
 * @param array $data Associative array: nom, slug
 * @return bool
 */
function updateCategory(int $id, array $data): bool
{
	$pdo = getPDO();
	$sql = 'UPDATE categories SET nom = :nom, slug = :slug WHERE id_categorie = :id_categorie';
	$stmt = $pdo->prepare($sql);

	$params = [
		':nom' => $data['nom'] ?? null,
		':slug' => $data['slug'] ?? null,
		':id_categorie' => $id,
	];

	return $stmt->execute($params);
}

/**
 * Supprime une catégorie par son id.
 * @param int $id
 * @return bool
 */
function deleteCategory(int $id): bool
{
	$pdo = getPDO();
	$sql = 'DELETE FROM categories WHERE id_categorie = :id_categorie';
	$stmt = $pdo->prepare($sql);
	return $stmt->execute([':id_categorie' => $id]);
}

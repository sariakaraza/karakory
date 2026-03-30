<?php
require_once __DIR__ . '/../connexion.php';

/**
 * Récupère tous les articles triés par date_creation décroissante.
 * @return array
 */
function getArticles(): array
{
	$pdo = getPDO();
	$sql = 'SELECT * FROM articles ORDER BY date_creation DESC';
	$stmt = $pdo->query($sql);
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
 * @param array $data Associative array: titre, slug, contenu, date_publication, id_user, id_categorie
 * @return bool
 */
function updateArticle(int $id, array $data): bool
{
	$pdo = getPDO();
	$sql = 'UPDATE articles SET titre = :titre, slug = :slug, contenu = :contenu, date_publication = :date_publication, id_user = :id_user, id_categorie = :id_categorie WHERE id_article = :id_article';
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


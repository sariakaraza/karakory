<?php
function getPDO(): PDO
{
	$host = getenv('DB_HOST') ?: 'localhost';
	$port = getenv('DB_PORT') ?: '5432';
	$db   = getenv('DB_NAME') ?: 'karakory_db';
	$user = getenv('DB_USER') ?: 'postgres';
	$pass = getenv('DB_PASS') ?: 'postgres';

	$dsn = sprintf('pgsql:host=%s;port=%s;dbname=%s', $host, $port, $db);

	try {
		$pdo = new PDO($dsn, $user, $pass, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		]);
		return $pdo;
	} catch (PDOException $e) {
		error_log('PDO connection error: ' . $e->getMessage());
		// En développement on peut afficher l'erreur, en production on lèvera une exception générique
		throw $e;
	}
}


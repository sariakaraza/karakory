<?php
require_once __DIR__ . '/../connexion.php';

/**
 * Vérifie si un utilisateur est administrateur
 *
 * @param int $id_user L'identifiant de l'utilisateur
 * @return bool true si l'utilisateur est admin, false sinon
 */
function isAdmin(int $id_user): bool
{
    try {
        $pdo = getPDO();

        $stmt = $pdo->prepare("
            SELECT role
            FROM users
            WHERE id_user = :id_user
        ");

        $stmt->execute(['id_user' => $id_user]);
        $user = $stmt->fetch();

        if (!$user) {
            return false;
        }

        return $user['role'] === 'admin';

    } catch (PDOException $e) {
        error_log('Erreur isAdmin: ' . $e->getMessage());
        return false;
    }
}

/**
 * Vérifie les identifiants de connexion
 *
 * @param string $username Le nom d'utilisateur
 * @param string $pwd Le mot de passe en clair
 * @return array|false Retourne les données de l'utilisateur si connexion réussie, false sinon
 */
function checkLogin(string $username, string $pwd)
{
    try {
        $pdo = getPDO();

        $stmt = $pdo->prepare("
            SELECT id_user, username, email, mot_de_passe, role, date_creation
            FROM users
            WHERE username = :username
        ");

        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if (!$user) {
            return false;
        }

        // Comparaison directe du mot de passe
        if ($pwd === $user['mot_de_passe']) {
            // On retire le mot de passe des données retournées pour des raisons de sécurité
            unset($user['mot_de_passe']);
            return $user;
        }

        return false;

    } catch (PDOException $e) {
        error_log('Erreur checkLogin: ' . $e->getMessage());
        return false;
    }
}

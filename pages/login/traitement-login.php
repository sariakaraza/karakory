<?php
session_start();

require_once __DIR__ . '/../../inc/login/fonctions.php';

// Vérifie que la requête est en POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form.php');
    exit;
}

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if ($username === '' || $password === '') {
    header('Location: /login/form?error=' . urlencode('Veuillez renseigner tous les champs'));
    exit;
}

$user = checkLogin($username, $password);

if ($user === false) {
    // Utilisateur non trouvé ou mot de passe incorrect
    header('Location: /login/form?error=' . urlencode("Vos identifiants sont incorrects"));
    exit;
}

// $user existe — vérifier le rôle
$id_user = (int) $user['id_user'];
if (isAdmin($id_user)) {
    // Connexion réussie pour un administrateur
    // Stocker les informations utiles en session
    $_SESSION['user'] = $user;

    header('Location: /dashboard/first');
    exit;
} else {
    // Utilisateur authentifié mais pas admin
    header('Location: /login/form?error=' . urlencode('Vous n\'êtes pas administrateur'));
    exit;
}

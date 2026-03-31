<?php
// Inclure la connexion à la base de données si nécessaire
require_once 'inc/connexion.php';

// Récupérer l'URL demandée
$url = $_GET['url'] ?? 'fo/home';

// Sécuriser l'URL : supprimer les caractères dangereux et les ..
$url = str_replace('..', '', $url);
$url = preg_replace('/[^a-zA-Z0-9\/_-]/', '', $url);

// Construire le chemin du fichier PHP correspondant
$file = "pages/$url.php";

// Vérifier si le fichier existe
if (file_exists($file)) {
    // Inclure le fichier de la page
    include $file;
} else {
    // Page non trouvée - afficher une erreur 404
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 - Page non trouvée</h1>";
    echo "<p>La page demandée n'existe pas.</p>";
}
?>
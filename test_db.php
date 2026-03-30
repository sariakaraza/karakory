<?php
require __DIR__ . '/inc/connexion.php';

try {
    $pdo = getPDO();
    $stmt = $pdo->query('SELECT NOW()');
    $row = $stmt->fetch();
    var_dump($row);
} catch (Exception $e) {
    echo 'Erreur DB: ' . $e->getMessage() . PHP_EOL;
}
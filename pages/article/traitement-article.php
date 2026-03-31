<?php
session_start();
require_once __DIR__ . '/../../inc/article/fonctions.php';

// Traitement des soumissions (ajout et modification)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'] ?? '';
    $slug = $_POST['slug'] ?? '';
    $contenu = $_POST['contenu'] ?? '';
    $id_categorie = $_POST['id_categorie'] ?? '';
    $id_article = $_POST['id_article'] ?? '';

    // Validation basique
    if (empty($titre) || empty($slug) || empty($contenu) || empty($id_categorie)) {
        if (!empty($id_article)) {
            header('Location: /article/edit?id=' . urlencode($id_article) . '&error=missing_fields');
        } else {
            header('Location: /article/form?error=missing_fields');
        }
        exit;
    }

    $id_user = $_SESSION['user_id'] ?? 1;
    $data = [
        'titre' => trim($titre),
        'slug' => trim($slug),
        'contenu' => trim($contenu),
        'id_user' => $id_user,
        'id_categorie' => (int) $id_categorie
    ];

    try {
        if (!empty($id_article)) {
            // Mise à jour
            $ok = updateArticle((int) $id_article, $data);
            if ($ok) {
                header('Location: /article/list?success=article_updated');
                exit;
            } else {
                header('Location: /article/edit?id=' . urlencode($id_article) . '&error=update_failed');
                exit;
            }
        } else {
            // Ajout
            $data['date_publication'] = date('Y-m-d H:i:s');
            $articleId = saveArticle($data);
            if ($articleId > 0) {
                // Traitement des images uploadées
                $imageErrors = [];
                if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
                    $uploadDir = __DIR__ . '/../../assets/images/articles/';
                    
                    // Créer le dossier s'il n'existe pas
                    if (!is_dir($uploadDir)) {
                        if (!mkdir($uploadDir, 0755, true)) {
                            $imageErrors[] = 'Impossible de créer le dossier d\'upload';
                        }
                    }

                    if (empty($imageErrors)) {
                        $images = $_FILES['images'];
                        $altTexts = $_POST['alt_texts'] ?? [];
                        
                        for ($i = 0; $i < count($images['name']); $i++) {
                            if ($images['error'][$i] === UPLOAD_ERR_OK) {
                                $fileName = $images['name'][$i];
                                $fileTmp = $images['tmp_name'][$i];
                                $fileSize = $images['size'][$i];
                                
                                // Vérifier le type de fichier
                                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                                $fileType = mime_content_type($fileTmp);
                                
                                if (!in_array($fileType, $allowedTypes)) {
                                    $imageErrors[] = "Type de fichier non autorisé pour {$fileName}";
                                    continue;
                                }
                                
                                // Vérifier la taille (max 5MB)
                                if ($fileSize > 5 * 1024 * 1024) {
                                    $imageErrors[] = "Fichier trop volumineux pour {$fileName}";
                                    continue;
                                }
                                
                                // Générer un nom unique pour éviter les conflits
                                $extension = pathinfo($fileName, PATHINFO_EXTENSION);
                                $uniqueName = uniqid('article_' . $articleId . '_') . '.' . $extension;
                                $filePath = $uploadDir . $uniqueName;
                                
                                if (move_uploaded_file($fileTmp, $filePath)) {
                                    // Sauvegarder en base de données
                                    $imageData = [
                                        'url' => 'assets/images/articles/' . $uniqueName,
                                        'alt' => $altTexts[$i] ?? '',
                                        'id_article' => $articleId
                                    ];
                                    saveArticleImage($imageData);
                                } else {
                                    $imageErrors[] = "Erreur lors de l'upload de {$fileName}";
                                }
                            } elseif ($images['error'][$i] !== UPLOAD_ERR_NO_FILE) {
                                $imageErrors[] = "Erreur d'upload pour {$images['name'][$i]}";
                            }
                        }
                    }
                }
                
                // Redirection avec message de succès, même s'il y a des erreurs d'images
                $redirectUrl = '/article/list?success=article_created';
                if (!empty($imageErrors)) {
                    $redirectUrl .= '&image_errors=' . urlencode(implode('; ', $imageErrors));
                }
                header('Location: ' . $redirectUrl);
                exit;
            } else {
                header('Location: /article/form?error=insert_failed');
                exit;
            }
        }
    } catch (Exception $e) {
        error_log('Erreur lors du traitement de l\'article: ' . $e->getMessage());
        if (!empty($id_article)) {
            header('Location: /article/edit?id=' . urlencode($id_article) . '&error=database_error');
        } else {
            header('Location: /article/form?error=database_error');
        }
        exit;
    }
}

// Si pas de POST, on charge les articles pour l'affichage dans list.php
$articles = getArticles();

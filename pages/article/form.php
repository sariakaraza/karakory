<?php
session_start();
require_once __DIR__ . '/../../inc/category/fonctions.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karakory - Ajouter un article</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/article-bo.css">
    <script src="../../assets/lib/node_modules/tinymce/tinymce.min.js"></script>
</head>
<body>
    <?php

    // Récupération des catégories pour le select
    $categories = getCategories();
    ?>

    <div class="app-layout">
        <?php include __DIR__ . '/../../inc/components/sidebar.php'; ?>
        
        <main class="main-content">
            <div class="articles-bo-container">
                <!-- Header -->
                <header class="articles-bo-header">
                    <div>
                        <h1>Ajouter un article</h1>
                        <p>Créez un nouvel article pour votre blog</p>
                    </div>
                    <a href="/article/list" class="btn-bo-add">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                        Retour à la liste
                    </a>
                </header>

                <!-- Messages d'erreur -->
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-error">
                        <?php
                        switch ($_GET['error']) {
                            case 'missing_fields':
                                echo '✗ Tous les champs sont obligatoires';
                                break;
                            case 'insert_failed':
                                echo '✗ Erreur lors de la création de l\'article';
                                break;
                            case 'database_error':
                                echo '✗ Erreur de connexion à la base de données';
                                break;
                            default:
                                echo '✗ Une erreur est survenue';
                        }
                        ?>
                    </div>
                <?php endif; ?>

                <!-- Formulaire -->
                <div class="form-container">
                    <form method="POST" action="/article/traitement-article" enctype="multipart/form-data" class="article-form">

                        <!-- Titre -->
                        <div class="form-group">
                            <label for="titre">Titre de l'article *</label>
                            <input
                                type="text"
                                id="titre"
                                name="titre"
                                class="form-input"
                                placeholder="Entrez le titre de l'article"
                                required
                            >
                        </div>

                        <!-- Slug -->
                        <div class="form-group">
                            <label for="slug">Slug (URL) *</label>
                            <input
                                type="text"
                                id="slug"
                                name="slug"
                                class="form-input"
                                placeholder="exemple-slug-article"
                                required
                            >
                            <small class="form-hint">Le slug est utilisé dans l'URL de l'article (sans espaces, minuscules)</small>
                        </div>

                        <!-- Catégorie -->
                        <div class="form-group">
                            <label for="id_categorie">Catégorie *</label>
                            <select id="id_categorie" name="id_categorie" class="form-select" required>
                                <option value="">-- Sélectionnez une catégorie --</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['id_categorie']; ?>">
                                        <?php echo htmlspecialchars($category['nom']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Contenu -->
                        <div class="form-group">
                            <label for="contenu">Contenu de l'article *</label>
                            <textarea
                                id="contenu"
                                name="contenu"
                                class="form-textarea"
                                rows="15"
                                placeholder="Rédigez le contenu de votre article..."
                            ></textarea>
                        </div>

                        <!-- Images -->
                        <div class="form-group">
                            <label>Images de l'article</label>
                            <small class="form-hint">Ajoutez des images pour illustrer votre article (optionnel)</small>
                            <div id="images-container">
                                <!-- Les champs d'images seront ajoutés ici dynamiquement -->
                            </div>
                            <button type="button" id="add-image-btn" class="btn-add-image">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                Ajouter une image
                            </button>
                        </div>

                        <!-- Boutons -->
                        <div class="form-actions">
                            <a href="/article/list" class="btn-cancel">Annuler</a>
                            <button type="submit" class="btn-submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="9 11 12 14 22 4"></polyline>
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                </svg>
                                Publier l'article
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Initialisation de TinyMCE
        tinymce.init({
            selector: '#contenu',
            height: 400,
            menubar: true,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; font-size: 14px; }',
            license_key: 'gpl'
        });

        // Auto-génération du slug depuis le titre
        document.getElementById('titre').addEventListener('input', function() {
            const titre = this.value;
            const slug = titre
                .toLowerCase()
                .normalize("NFD").replace(/[\u0300-\u036f]/g, "") // Enlever les accents
                .replace(/[^a-z0-9\s-]/g, '') // Garder seulement lettres, chiffres, espaces et tirets
                .trim()
                .replace(/\s+/g, '-') // Remplacer espaces par tirets
                .replace(/-+/g, '-'); // Éviter les tirets multiples

            document.getElementById('slug').value = slug;
        });

        // Gestion des images
        let imageIndex = 0;

        document.getElementById('add-image-btn').addEventListener('click', function() {
            addImageField();
        });

        function addImageField() {
            const container = document.getElementById('images-container');
            const imageDiv = document.createElement('div');
            imageDiv.className = 'image-field';
            imageDiv.innerHTML = `
                <div class="image-input-group">
                    <input type="file" name="images[]" accept="image/*" class="form-file" required>
                    <input type="text" name="alt_texts[]" placeholder="Texte alternatif (pour le SEO)" class="form-input-alt" required>
                    <button type="button" class="btn-remove-image" onclick="removeImageField(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
            `;
            container.appendChild(imageDiv);
            imageIndex++;
        }

        function removeImageField(button) {
            button.closest('.image-field').remove();
        }

        // Ajouter un champ d'image par défaut
        addImageField();
    </script>
</body>
</html>

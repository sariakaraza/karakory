<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karakory - Nouvelle Catégorie</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h1 {
            color: #001f3f;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #6c757d;
            font-size: 1rem;
        }

        .form-card {
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .form-card:hover {
            border-color: #001f3f;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: #001f3f;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .form-group input {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }

        .form-group input:focus {
            outline: none;
            border-color: #001f3f;
            background-color: white;
            box-shadow: 0 0 0 4px rgba(0, 31, 63, 0.1);
        }

        .form-group input::placeholder {
            color: #adb5bd;
        }

        .form-group small {
            display: block;
            margin-top: 8px;
            color: #6c757d;
            font-size: 0.85rem;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 35px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #001f3f 0%, #003366 100%);
            color: white;
            flex: 1;
            box-shadow: 0 4px 12px rgba(0, 31, 63, 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #003366 0%, #004d99 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 31, 63, 0.3);
        }

        .btn-secondary {
            background-color: #f8f9fa;
            color: #001f3f;
            border: 2px solid #e0e0e0;
        }

        .btn-secondary:hover {
            background-color: #e9ecef;
            border-color: #001f3f;
        }

        .btn svg {
            width: 20px;
            height: 20px;
        }

        /* Message de succès/erreur */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 30px 15px;
            }

            .form-card {
                padding: 25px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="app-layout">
        <?php include __DIR__ . '/../../inc/components/sidebar.php'; ?>

        <main class="main-content">
            <div class="form-container">
                <div class="form-header">
                    <h1>Nouvelle Catégorie</h1>
                    <p>Créez une nouvelle catégorie pour organiser vos articles</p>
                </div>

                <div class="form-card">
                    <?php if (isset($_GET['success'])): ?>
                        <div class="alert alert-success">
                            Catégorie créée avec succès !
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-error">
                            Une erreur est survenue. Veuillez réessayer.
                        </div>
                    <?php endif; ?>

                    <form action="/category/traitement-category" method="POST">
                        <div class="form-group">
                            <label for="nom">Nom de la catégorie</label>
                            <input
                                type="text"
                                id="nom"
                                name="nom"
                                placeholder="Ex: Technologie, Sport, Culture..."
                                required
                            >
                            <small>Le nom sera affiché sur votre site</small>
                        </div>

                        <div class="form-group">
                            <label for="slug">Slug (URL)</label>
                            <input
                                type="text"
                                id="slug"
                                name="slug"
                                placeholder="Ex: technologie, sport, culture..."
                                required
                            >
                            <small>Identifiant unique utilisé dans l'URL (sans espaces ni caractères spéciaux)</small>
                        </div>

                        <div class="form-actions">
                            <a href="/dashboard/first" class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                                </svg>
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 5v14M5 12h14"/>
                                </svg>
                                Créer la catégorie
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Génération automatique du slug à partir du nom
        document.getElementById('nom').addEventListener('input', function() {
            const slug = this.value
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '') // Supprime les accents
                .replace(/[^a-z0-9\s-]/g, '')    // Supprime les caractères spéciaux
                .replace(/\s+/g, '-')             // Remplace les espaces par des tirets
                .replace(/-+/g, '-')              // Supprime les tirets multiples
                .trim();
            document.getElementById('slug').value = slug;
        });
    </script>
</body>
</html>

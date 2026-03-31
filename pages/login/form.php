<?php
// Affichage sécurisé du message d'erreur passé en GET
$error = '';
if (isset($_GET['error']) && is_string($_GET['error'])) {
    $error = htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karakory - Connexion</title>
    <link rel="stylesheet" href="../../assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <img src="../../assets/images/karakory-login.png" alt="Karakory Logo">
        </div>
        <div class="login-right">
            <div class="login-form-wrapper">
                <h1>Connexion</h1>
                <form method="POST" action="/login/traitement-login" class="login-form">
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" id="username" name="username" value="rakoto" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" value="rakotoAdmin" required>
                    </div>
                    <button type="submit" class="btn-login">Se connecter</button>
                </form>
                <?php if ($error !== ''): ?>
                    <div class="error-message" style="color:#b00020;margin-bottom:12px;">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení | SocialHero Admin</title>
    <link rel="icon" type="image/svg+xml" href="/assets/images/favicon.svg">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/css/admin.css">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-box">
            <div class="login-logo">
                <span class="logo-text">Social<span class="logo-highlight">Hero</span></span>
                <span class="logo-subtitle">Admin Panel</span>
            </div>

            <?php if (isset($error)): ?>
            <div class="alert alert--error">
                <?= htmlspecialchars($error) ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="/admin/login" class="login-form">
                <div class="form-group">
                    <label class="form-label" for="email">E-mail</label>
                    <input type="email" id="email" name="email" class="form-input" required autofocus
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Heslo</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                </div>

                <button type="submit" class="btn btn--primary btn--full">
                    Přihlásit se
                </button>
            </form>

            <p class="login-footer">
                <a href="/">Zpět na web</a>
            </p>
        </div>
    </div>
</body>
</html>

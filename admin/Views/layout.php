<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Dashboard' ?> | SocialHero Admin</title>
    <link rel="icon" type="image/svg+xml" href="/assets/images/favicon.svg">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/css/admin.css">
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="admin-page">
    <aside class="sidebar">
        <div class="sidebar__header">
            <a href="/admin/dashboard" class="sidebar__logo">
                <span class="logo-text">Social<span class="logo-highlight">Hero</span></span>
            </a>
        </div>

        <nav class="sidebar__nav">
            <a href="/admin/dashboard" class="sidebar__link <?= ($currentPage ?? '') === 'dashboard' ? 'active' : '' ?>">
                <i data-feather="home"></i>
                Dashboard
            </a>
            <a href="/admin/contacts" class="sidebar__link <?= ($currentPage ?? '') === 'contacts' ? 'active' : '' ?>">
                <i data-feather="mail"></i>
                Poptávky
            </a>

            <div class="sidebar__divider">Obsah</div>

            <a href="/admin/services" class="sidebar__link <?= ($currentPage ?? '') === 'services' ? 'active' : '' ?>">
                <i data-feather="layers"></i>
                Služby
            </a>
            <a href="/admin/pricing" class="sidebar__link <?= ($currentPage ?? '') === 'pricing' ? 'active' : '' ?>">
                <i data-feather="credit-card"></i>
                Ceník
            </a>
            <a href="/admin/faqs" class="sidebar__link <?= ($currentPage ?? '') === 'faqs' ? 'active' : '' ?>">
                <i data-feather="help-circle"></i>
                FAQ
            </a>
            <a href="/admin/testimonials" class="sidebar__link <?= ($currentPage ?? '') === 'testimonials' ? 'active' : '' ?>">
                <i data-feather="message-square"></i>
                Testimonials
            </a>
            <a href="/admin/case-studies" class="sidebar__link <?= ($currentPage ?? '') === 'case-studies' ? 'active' : '' ?>">
                <i data-feather="briefcase"></i>
                Reference
            </a>
            <a href="/admin/team" class="sidebar__link <?= ($currentPage ?? '') === 'team' ? 'active' : '' ?>">
                <i data-feather="users"></i>
                Tým
            </a>
            <a href="/admin/blog" class="sidebar__link <?= ($currentPage ?? '') === 'blog' ? 'active' : '' ?>">
                <i data-feather="edit-3"></i>
                Blog
            </a>
            <a href="/admin/clients" class="sidebar__link <?= ($currentPage ?? '') === 'clients' ? 'active' : '' ?>">
                <i data-feather="award"></i>
                Klienti
            </a>

            <div class="sidebar__divider">Homepage</div>

            <a href="/admin/process-steps" class="sidebar__link <?= ($currentPage ?? '') === 'process-steps' ? 'active' : '' ?>">
                <i data-feather="list"></i>
                Kroky spolupráce
            </a>
            <a href="/admin/certifications" class="sidebar__link <?= ($currentPage ?? '') === 'certifications' ? 'active' : '' ?>">
                <i data-feather="shield"></i>
                Certifikace
            </a>

            <div class="sidebar__divider">Systém</div>

            <a href="/admin/page-content" class="sidebar__link <?= ($currentPage ?? '') === 'page-content' ? 'active' : '' ?>">
                <i data-feather="file-text"></i>
                Obsah stránek
            </a>
            <a href="/admin/page-seo" class="sidebar__link <?= ($currentPage ?? '') === 'page-seo' ? 'active' : '' ?>">
                <i data-feather="search"></i>
                SEO Stránek
            </a>
            <a href="/admin/settings" class="sidebar__link <?= ($currentPage ?? '') === 'settings' ? 'active' : '' ?>">
                <i data-feather="settings"></i>
                Nastavení
            </a>
        </nav>

        <div class="sidebar__footer">
            <a href="/" target="_blank" class="sidebar__link">
                <i data-feather="external-link"></i>
                Zobrazit web
            </a>
            <a href="/admin/logout" class="sidebar__link sidebar__link--logout">
                <i data-feather="log-out"></i>
                Odhlásit se
            </a>
        </div>
    </aside>

    <main class="main-content">
        <header class="main-header">
            <div class="main-header__title">
                <h1><?= $pageTitle ?? 'Dashboard' ?></h1>
            </div>
            <div class="main-header__user">
                <span><?= htmlspecialchars($_SESSION['admin_user']['name'] ?? 'Admin') ?></span>
                <div class="user-avatar">
                    <i data-feather="user"></i>
                </div>
            </div>
        </header>

        <div class="main-body<?= ($currentPage ?? '') === 'settings' ? ' main-body--has-floating-actions' : '' ?>">
            <?php if (isset($_SESSION['flash_success'])): ?>
            <div class="alert alert--success">
                <?= htmlspecialchars($_SESSION['flash_success']) ?>
            </div>
            <?php unset($_SESSION['flash_success']); endif; ?>

            <?php if (isset($_SESSION['flash_error'])): ?>
            <div class="alert alert--error">
                <?= htmlspecialchars($_SESSION['flash_error']) ?>
            </div>
            <?php unset($_SESSION['flash_error']); endif; ?>

            <?php if (!empty($errors)): ?>
            <div class="alert alert--error">
                <ul style="margin:0;padding-left:1.5rem;">
                    <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?= $content ?? '' ?>
        </div>
    </main>

    <script>
        feather.replace();
    </script>
</body>
</html>

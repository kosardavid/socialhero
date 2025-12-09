<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $config['meta']['description'] ?? '' ?>">
    <meta name="keywords" content="<?= $config['meta']['keywords'] ?? '' ?>">
    <meta name="author" content="<?= $config['meta']['author'] ?? '' ?>">

    <title><?= isset($pageTitle) ? $pageTitle . ' | ' . $config['name'] : $config['meta']['title'] ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?= \App\Core\View::asset('images/favicon.svg') ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="<?= \App\Core\View::asset('css/style.css') ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= isset($pageTitle) ? $pageTitle . ' | ' . $config['name'] : $config['meta']['title'] ?>">
    <meta property="og:description" content="<?= $pageDescription ?? $config['meta']['description'] ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $config['url'] ?>">
    <meta property="og:image" content="<?= $config['url'] ?>/assets/images/og-image.jpg">

    <!-- Icons (Feather Icons via CDN) -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
    <?php \App\Core\View::partial('header'); ?>

    <main>
        <?= $content ?>
    </main>

    <?php \App\Core\View::partial('footer'); ?>

    <!-- Scripts -->
    <script src="<?= \App\Core\View::asset('js/main.js') ?>"></script>
    <script>
        feather.replace();
    </script>
</body>
</html>

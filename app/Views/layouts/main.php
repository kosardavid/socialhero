<?php
$globalSettings = \App\Core\View::getSettings();
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($pageDescription ?? $globalSettings['default_meta_description'] ?? $config['meta']['description'] ?? '') ?>">
    <meta name="keywords" content="<?= htmlspecialchars($globalSettings['default_meta_keywords'] ?? $config['meta']['keywords'] ?? '') ?>">
    <meta name="author" content="<?= htmlspecialchars($config['meta']['author'] ?? '') ?>">

    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | ' . htmlspecialchars($config['name']) : htmlspecialchars($globalSettings['default_meta_title'] ?? $config['meta']['title'] ?? '') ?></title>

    <!-- Canonical URL -->
    <link rel="canonical" href="<?= $config['url'] ?><?= $_SERVER['REQUEST_URI'] === '/' ? '' : htmlspecialchars($_SERVER['REQUEST_URI']) ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?= \App\Core\View::asset('images/favicon.svg') ?>">

    <!-- Fonts - Preload for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"></noscript>

    <!-- Styles -->
    <link rel="stylesheet" href="<?= \App\Core\View::asset('css/style.css') ?>?v=20251209">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | ' . htmlspecialchars($config['name']) : htmlspecialchars($globalSettings['default_meta_title'] ?? $config['meta']['title'] ?? '') ?>">
    <meta property="og:description" content="<?= htmlspecialchars($pageDescription ?? $globalSettings['default_meta_description'] ?? $config['meta']['description'] ?? '') ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $config['url'] ?>">
    <meta property="og:image" content="<?= $config['url'] ?>/assets/images/og-image.jpg">

    <!-- Icons (Feather Icons via CDN) -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "MarketingAgency",
        "name": "SocialHero",
        "description": "<?= htmlspecialchars($globalSettings['default_meta_description'] ?? 'Veškerý online marketing v jednom předplatném.') ?>",
        "url": "https://socialhero.cz",
        "logo": "https://socialhero.cz/assets/images/favicon.svg",
        "sameAs": [
            <?php if (!empty($globalSettings['social_facebook'])): ?>"<?= htmlspecialchars($globalSettings['social_facebook']) ?>"<?php endif; ?>
            <?php if (!empty($globalSettings['social_facebook']) && !empty($globalSettings['social_instagram'])): ?>,<?php endif; ?>
            <?php if (!empty($globalSettings['social_instagram'])): ?>"<?= htmlspecialchars($globalSettings['social_instagram']) ?>"<?php endif; ?>
            <?php if ((!empty($globalSettings['social_facebook']) || !empty($globalSettings['social_instagram'])) && !empty($globalSettings['social_linkedin'])): ?>,<?php endif; ?>
            <?php if (!empty($globalSettings['social_linkedin'])): ?>"<?= htmlspecialchars($globalSettings['social_linkedin']) ?>"<?php endif; ?>
        ],
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "CZ"
            <?php if (!empty($globalSettings['contact_address'])): ?>,"streetAddress": "<?= htmlspecialchars($globalSettings['contact_address']) ?>"<?php endif; ?>
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer service"
            <?php if (!empty($globalSettings['contact_email'])): ?>,"email": "<?= htmlspecialchars($globalSettings['contact_email']) ?>"<?php endif; ?>
            <?php if (!empty($globalSettings['contact_phone'])): ?>,"telephone": "<?= htmlspecialchars($globalSettings['contact_phone']) ?>"<?php endif; ?>
        },
        "priceRange": "$$"
    }
    </script>

    <?php // Google Tag Manager - HEAD ?>
    <?php if (!empty($globalSettings['gtm_id'])): ?>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','<?= htmlspecialchars($globalSettings['gtm_id']) ?>');</script>
    <?php endif; ?>

    <?php // Google Analytics 4 (if no GTM) ?>
    <?php if (!empty($globalSettings['ga4_id']) && empty($globalSettings['gtm_id'])): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= htmlspecialchars($globalSettings['ga4_id']) ?>"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?= htmlspecialchars($globalSettings['ga4_id']) ?>');
    </script>
    <?php endif; ?>

    <?php // Google Ads ?>
    <?php if (!empty($globalSettings['gads_id']) && empty($globalSettings['gtm_id'])): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= htmlspecialchars($globalSettings['gads_id']) ?>"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?= htmlspecialchars($globalSettings['gads_id']) ?>');
    </script>
    <?php endif; ?>

    <?php // Facebook Pixel ?>
    <?php if (!empty($globalSettings['fb_pixel_id'])): ?>
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '<?= htmlspecialchars($globalSettings['fb_pixel_id']) ?>');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=<?= htmlspecialchars($globalSettings['fb_pixel_id']) ?>&ev=PageView&noscript=1"/></noscript>
    <?php endif; ?>

    <?php // Seznam Sklik ?>
    <?php if (!empty($globalSettings['sklik_id'])): ?>
    <script>
    var seznam_retargeting_id = <?= (int)$globalSettings['sklik_id'] ?>;
    </script>
    <script src="https://c.imedia.cz/js/retargeting.js"></script>
    <?php endif; ?>

    <?php // Ecomail ?>
    <?php if (!empty($globalSettings['ecomail_id'])): ?>
    <script>
    ;(function(p,l,o,w,i,n,g){if(!p[i]){p.GlobalSnowplowNamespace=p.GlobalSnowplowNamespace||[];
    p.GlobalSnowplowNamespace.push(i);p[i]=function(){(p[i].q=p[i].q||[]).push(arguments)};
    p[i].q=p[i].q||[];n=l.createElement(o);g=l.getElementsByTagName(o)[0];n.async=1;
    n.src=w;g.parentNode.insertBefore(n,g)}}(window,document,"script","//d1fc8wv8zag5ca.cloudfront.net/2.4.2/sp.js","ecm"));
    ecm('newTracker', 'cf', 'd2jnwlgh0vmv6g.cloudfront.net', {
        appId: '<?= htmlspecialchars($globalSettings['ecomail_id']) ?>'
    });
    ecm('trackPageView');
    </script>
    <?php endif; ?>

    <?php // Custom HEAD scripts ?>
    <?php if (!empty($globalSettings['custom_head_scripts'])): ?>
    <?= $globalSettings['custom_head_scripts'] ?>
    <?php endif; ?>
</head>
<body>
    <?php // Google Tag Manager - BODY noscript ?>
    <?php if (!empty($globalSettings['gtm_id'])): ?>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= htmlspecialchars($globalSettings['gtm_id']) ?>"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <?php endif; ?>

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

    <?php // Tawk.to Live Chat ?>
    <?php if (!empty($globalSettings['tawkto_property_id']) && !empty($globalSettings['tawkto_widget_id'])): ?>
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/<?= htmlspecialchars($globalSettings['tawkto_property_id']) ?>/<?= htmlspecialchars($globalSettings['tawkto_widget_id']) ?>';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <?php endif; ?>

    <?php // Custom BODY scripts ?>
    <?php if (!empty($globalSettings['custom_body_scripts'])): ?>
    <?= $globalSettings['custom_body_scripts'] ?>
    <?php endif; ?>

    <!-- Cookie Consent Banner -->
    <div id="cookie-consent" style="display:none; position:fixed; bottom:0; left:0; right:0; background:rgba(10,10,15,0.98); border-top:1px solid rgba(124,58,237,0.3); padding:1rem 2rem; z-index:9999; backdrop-filter:blur(10px);">
        <div style="max-width:1200px; margin:0 auto; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
            <p style="margin:0; color:#a0a0b0; font-size:0.9rem; flex:1; min-width:280px;">
                Tento web používá cookies pro zlepšení uživatelského zážitku a analýzu návštěvnosti.
                <a href="/ochrana-soukromi" style="color:#a855f7;">Více informací</a>
            </p>
            <div style="display:flex; gap:0.75rem;">
                <button onclick="acceptCookies()" style="padding:0.6rem 1.5rem; background:linear-gradient(135deg,#7c3aed,#a855f7); color:#fff; border:none; border-radius:0.5rem; cursor:pointer; font-weight:600; font-size:0.9rem;">Přijmout</button>
                <button onclick="declineCookies()" style="padding:0.6rem 1.5rem; background:transparent; color:#a0a0b0; border:1px solid #333; border-radius:0.5rem; cursor:pointer; font-size:0.9rem;">Odmítnout</button>
            </div>
        </div>
    </div>
    <script>
    (function(){
        if(!localStorage.getItem('cookieConsent')){
            document.getElementById('cookie-consent').style.display='block';
        }
    })();
    function acceptCookies(){
        localStorage.setItem('cookieConsent','accepted');
        document.getElementById('cookie-consent').style.display='none';
    }
    function declineCookies(){
        localStorage.setItem('cookieConsent','declined');
        document.getElementById('cookie-consent').style.display='none';
    }
    </script>
</body>
</html>

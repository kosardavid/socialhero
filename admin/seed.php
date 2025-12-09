<?php
/**
 * Database Seed Script
 * Populates the database with initial data
 *
 * USAGE: Access via browser: /new/admin/seed.php?key=YOUR_SECRET_KEY
 * After running, DELETE THIS FILE from the server!
 */

// Security check
$secretKey = 'socialhero2025seed';
if (!isset($_GET['key']) || $_GET['key'] !== $secretKey) {
    die('Access denied. Use ?key=YOUR_SECRET_KEY');
}

// Load environment
$envFile = dirname(__DIR__) . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}

// Database connection
try {
    $pdo = new PDO(
        "mysql:host=" . ($_ENV['DB_HOST'] ?? 'localhost') . ";dbname=" . ($_ENV['DB_NAME'] ?? ''),
        $_ENV['DB_USER'] ?? '',
        $_ENV['DB_PASS'] ?? '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

echo "<pre>";
echo "=== SocialHero Database Seeder ===\n\n";

// Services
echo "Seeding services...\n";
$services = [
    [
        'title' => 'Správa sociálních sítí',
        'slug' => 'socialni-site',
        'icon' => 'share-2',
        'short_description' => 'Kompletní správa Facebooku, Instagramu, LinkedInu a dalších platforem.',
        'description' => 'Převezmeme kompletní správu vašich sociálních sítí. Od strategie, přes tvorbu obsahu až po komunitu management. Facebook, Instagram, LinkedIn, TikTok - všechny platformy pod jednou střechou.',
        'features' => json_encode(['Tvorba obsahové strategie', 'Pravidelné příspěvky a stories', 'Tvorba reels a video obsahu', 'Community management', 'Měsíční reporting']),
        'sort_order' => 1,
        'is_active' => 1
    ],
    [
        'title' => 'Meta Ads',
        'slug' => 'meta-ads',
        'icon' => 'target',
        'short_description' => 'Cílená reklama na Facebooku a Instagramu s maximální návratností.',
        'description' => 'Vytváříme a optimalizujeme reklamní kampaně na Facebooku a Instagramu. Zaměřujeme se na maximální návratnost investice a přesné cílení na vaši cílovou skupinu.',
        'features' => json_encode(['Nastavení reklamních účtů', 'Tvorba reklamních kreativ', 'A/B testování', 'Remarketing kampaně', 'Optimalizace rozpočtu']),
        'sort_order' => 2,
        'is_active' => 1
    ],
    [
        'title' => 'Google Ads',
        'slug' => 'google-ads',
        'icon' => 'search',
        'short_description' => 'PPC kampaně ve vyhledávání, Display síti a na YouTube.',
        'description' => 'Spravujeme kampaně v Google Ads - od vyhledávací reklamy přes Display síť až po YouTube. Zaměřujeme se na konverze a efektivní využití rozpočtu.',
        'features' => json_encode(['Search kampaně', 'Display reklama', 'YouTube Ads', 'Shopping kampaně', 'Performance Max']),
        'sort_order' => 3,
        'is_active' => 1
    ],
    [
        'title' => 'E-mail marketing',
        'slug' => 'email-marketing',
        'icon' => 'mail',
        'short_description' => 'Automatizované kampaně, newslettery a personalizovaná komunikace.',
        'description' => 'Navrhujeme a implementujeme e-mailové kampaně, které skutečně fungují. Od welcome sekvencí přes automatizace až po pravidelné newslettery.',
        'features' => json_encode(['Návrh e-mail strategie', 'Tvorba šablon', 'Automatizační sekvence', 'Segmentace databáze', 'A/B testování']),
        'sort_order' => 4,
        'is_active' => 1
    ],
    [
        'title' => 'SEO optimalizace',
        'slug' => 'seo',
        'icon' => 'trending-up',
        'short_description' => 'Organická viditelnost ve vyhledávačích.',
        'description' => 'Zlepšujeme pozice vašeho webu ve vyhledávačích. Technické SEO, on-page optimalizace, linkbuilding a obsahová strategie.',
        'features' => json_encode(['SEO audit', 'Keyword research', 'On-page optimalizace', 'Technické SEO', 'Linkbuilding']),
        'sort_order' => 5,
        'is_active' => 1
    ],
    [
        'title' => 'Tvorba obsahu',
        'slug' => 'tvorba-obsahu',
        'icon' => 'edit-3',
        'short_description' => 'Kreativní obsah, který zaujme.',
        'description' => 'Vytváříme obsah, který rezonuje s vaší cílovou skupinou. Texty, grafika, video - vše pod jednou střechou.',
        'features' => json_encode(['Copywriting', 'Grafický design', 'Video produkce', 'Fotografie', 'Motion grafika']),
        'sort_order' => 6,
        'is_active' => 1
    ],
];

$pdo->exec("DELETE FROM services");
$stmt = $pdo->prepare("INSERT INTO services (title, slug, icon, short_description, description, features, sort_order, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
foreach ($services as $s) {
    $stmt->execute([$s['title'], $s['slug'], $s['icon'], $s['short_description'], $s['description'], $s['features'], $s['sort_order'], $s['is_active']]);
}
echo "  - Added " . count($services) . " services\n";

// Pricing Plans
echo "Seeding pricing plans...\n";
$plans = [
    [
        'name' => 'Start',
        'slug' => 'start',
        'price' => 15000,
        'period' => 'měsíčně',
        'hours' => '20 hodin',
        'description' => 'Pro začínající firmy',
        'features' => json_encode(['Správa 2 sociálních sítí', '8 příspěvků měsíčně', 'Základní reporting', 'E-mailová podpora']),
        'is_featured' => 0,
        'sort_order' => 1,
        'is_active' => 1
    ],
    [
        'name' => 'Growth',
        'slug' => 'growth',
        'price' => 28000,
        'period' => 'měsíčně',
        'hours' => '40 hodin',
        'description' => 'Pro rostoucí firmy',
        'features' => json_encode(['Správa 4 sociálních sítí', '16 příspěvků měsíčně', 'Meta Ads nebo Google Ads', 'Detailní reporting', 'Prioritní podpora', 'Měsíční strategie call']),
        'is_featured' => 1,
        'sort_order' => 2,
        'is_active' => 1
    ],
    [
        'name' => 'Scale',
        'slug' => 'scale',
        'price' => 50000,
        'period' => 'měsíčně',
        'hours' => '80 hodin',
        'description' => 'Pro ambiciózní značky',
        'features' => json_encode(['Neomezený počet sítí', 'Neomezený obsah', 'Meta Ads + Google Ads', 'E-mail marketing', 'SEO optimalizace', 'Dedikovaný account manager', 'Týdenní reporty']),
        'is_featured' => 0,
        'sort_order' => 3,
        'is_active' => 1
    ],
];

$pdo->exec("DELETE FROM pricing_plans");
$stmt = $pdo->prepare("INSERT INTO pricing_plans (name, slug, price, period, hours, description, features, is_featured, sort_order, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
foreach ($plans as $p) {
    $stmt->execute([$p['name'], $p['slug'], $p['price'], $p['period'], $p['hours'], $p['description'], $p['features'], $p['is_featured'], $p['sort_order'], $p['is_active']]);
}
echo "  - Added " . count($plans) . " pricing plans\n";

// FAQs
echo "Seeding FAQs...\n";
$faqs = [
    ['question' => 'Jak funguje měsíční předplatné?', 'answer' => 'Vyberete si balíček podle vašich potřeb. Každý měsíc máte k dispozici určitý počet hodin našeho týmu, které můžete využít na jakékoliv marketingové aktivity. Nepropadají a můžete je flexibilně přizpůsobit aktuálním potřebám.', 'sort_order' => 1],
    ['question' => 'Mohu změnit nebo zrušit předplatné?', 'answer' => 'Ano, předplatné můžete kdykoliv upgradovat, downgradovat nebo zrušit. Nejsme agentura, která vás zamyká do dlouhodobých smluv. Věříme ve výsledky, ne v papíry.', 'sort_order' => 2],
    ['question' => 'Jak rychle uvidím výsledky?', 'answer' => 'První výsledky jsou viditelné obvykle do 2-4 týdnů. Plný potenciál kampaní se projeví po 2-3 měsících optimalizace. Vše záleží na vašem odvětví a výchozím stavu.', 'sort_order' => 3],
    ['question' => 'Co když potřebuji více hodin?', 'answer' => 'Žádný problém! Můžete buď přejít na vyšší balíček, nebo si dokoupit extra hodiny za zvýhodněnou cenu. Vždy se domluvíme.', 'sort_order' => 4],
    ['question' => 'Pracujete i s malými firmami?', 'answer' => 'Ano! Náš Start balíček je ideální pro malé firmy a živnostníky. Věříme, že kvalitní marketing si zaslouží každý, nejen velké korporace.', 'sort_order' => 5],
];

$pdo->exec("DELETE FROM faqs");
$stmt = $pdo->prepare("INSERT INTO faqs (question, answer, sort_order, is_active) VALUES (?, ?, ?, 1)");
foreach ($faqs as $f) {
    $stmt->execute([$f['question'], $f['answer'], $f['sort_order']]);
}
echo "  - Added " . count($faqs) . " FAQs\n";

// Testimonials
echo "Seeding testimonials...\n";
$testimonials = [
    [
        'name' => 'Jan Novák',
        'position' => 'CEO',
        'company' => 'E-shop Fashion',
        'text' => 'SocialHero nám pomohl zdvojnásobit tržby z online kanálů během 6 měsíců. Profesionální přístup a skvělá komunikace.',
        'rating' => 5,
        'sort_order' => 1
    ],
    [
        'name' => 'Marie Svobodová',
        'position' => 'Majitelka',
        'company' => 'Restaurace U Mlýna',
        'text' => 'Konečně máme sociální sítě, které přinášejí skutečné zákazníky. Rezervace vzrostly o 340%!',
        'rating' => 5,
        'sort_order' => 2
    ],
    [
        'name' => 'Petr Dvořák',
        'position' => 'Marketing Manager',
        'company' => 'Tech Startup',
        'text' => 'Profesionální přístup a měřitelné výsledky. Cena za lead klesla o 45%. Doporučuji!',
        'rating' => 5,
        'sort_order' => 3
    ],
];

$pdo->exec("DELETE FROM testimonials");
$stmt = $pdo->prepare("INSERT INTO testimonials (name, position, company, text, rating, sort_order, is_active) VALUES (?, ?, ?, ?, ?, ?, 1)");
foreach ($testimonials as $t) {
    $stmt->execute([$t['name'], $t['position'], $t['company'], $t['text'], $t['rating'], $t['sort_order']]);
}
echo "  - Added " . count($testimonials) . " testimonials\n";

// Case Studies
echo "Seeding case studies...\n";
$caseStudies = [
    [
        'title' => 'E-shop Fashion - Zdvojnásobení tržeb',
        'slug' => 'eshop-fashion',
        'client_name' => 'E-shop Fashion',
        'category' => 'E-commerce',
        'description' => 'Kompletní správa online marketingu pro módní e-shop. Meta Ads + Google Ads + E-mail marketing.',
        'challenge' => 'Klient měl stagnující tržby a vysoké náklady na akvizici zákazníků.',
        'solution' => 'Implementovali jsme komplexní strategii zahrnující optimalizaci reklam, remarketing a automatizované e-mailové sekvence.',
        'results' => json_encode([['label' => 'Nárůst tržeb', 'value' => '+127%'], ['label' => 'ROAS', 'value' => '4.2x'], ['label' => 'Nových zákazníků', 'value' => '+2,400']]),
        'is_featured' => 1,
        'sort_order' => 1
    ],
    [
        'title' => 'Tech Startup - B2B Lead Generation',
        'slug' => 'tech-startup',
        'client_name' => 'Tech Startup',
        'category' => 'B2B / SaaS',
        'description' => 'Lead generation kampaně pro B2B SaaS startup zaměřený na enterprise segment.',
        'challenge' => 'Startup potřeboval generovat kvalitní B2B leady při omezeném rozpočtu.',
        'solution' => 'Vytvořili jsme cílenou LinkedIn + Google Ads strategii s důrazem na decision makery.',
        'results' => json_encode([['label' => 'Leadů měsíčně', 'value' => '180+'], ['label' => 'Cena za lead', 'value' => '-45%'], ['label' => 'Konverzní poměr', 'value' => '12%']]),
        'is_featured' => 1,
        'sort_order' => 2
    ],
    [
        'title' => 'Restaurace U Mlýna - Budování značky',
        'slug' => 'restaurace-u-mlyna',
        'client_name' => 'Restaurace U Mlýna',
        'category' => 'Gastro',
        'description' => 'Budování značky a komunity pro lokální restauraci s důrazem na Instagram.',
        'challenge' => 'Lokální restaurace potřebovala zvýšit povědomí a přilákat více zákazníků.',
        'solution' => 'Zaměřili jsme se na vizuální obsah, stories a lokální cílení na Instagramu a Facebooku.',
        'results' => json_encode([['label' => 'Followerů', 'value' => '+5,200'], ['label' => 'Engagement', 'value' => '8.4%'], ['label' => 'Rezervací online', 'value' => '+340%']]),
        'is_featured' => 1,
        'sort_order' => 3
    ],
];

$pdo->exec("DELETE FROM case_studies");
$stmt = $pdo->prepare("INSERT INTO case_studies (title, slug, client_name, category, description, challenge, solution, results, is_featured, is_published, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1, ?)");
foreach ($caseStudies as $c) {
    $stmt->execute([$c['title'], $c['slug'], $c['client_name'], $c['category'], $c['description'], $c['challenge'], $c['solution'], $c['results'], $c['is_featured'], $c['sort_order']]);
}
echo "  - Added " . count($caseStudies) . " case studies\n";

// Team Members
echo "Seeding team members...\n";
$team = [
    [
        'name' => 'David Kosař',
        'position' => 'Founder & CEO',
        'bio' => 'Zakladatel SocialHero s více než 10 lety zkušeností v digitálním marketingu.',
        'email' => 'david@socialhero.cz',
        'linkedin' => 'https://linkedin.com/in/davidkosar',
        'sort_order' => 1
    ],
];

$pdo->exec("DELETE FROM team_members");
$stmt = $pdo->prepare("INSERT INTO team_members (name, position, bio, email, linkedin, sort_order, is_active) VALUES (?, ?, ?, ?, ?, ?, 1)");
foreach ($team as $t) {
    $stmt->execute([$t['name'], $t['position'], $t['bio'], $t['email'], $t['linkedin'], $t['sort_order']]);
}
echo "  - Added " . count($team) . " team members\n";

// Clients
echo "Seeding clients...\n";
$clients = [
    ['name' => 'E-shop Fashion', 'logo' => '/new/assets/images/clients/client1.svg', 'sort_order' => 1],
    ['name' => 'Tech Startup', 'logo' => '/new/assets/images/clients/client2.svg', 'sort_order' => 2],
    ['name' => 'Restaurace U Mlýna', 'logo' => '/new/assets/images/clients/client3.svg', 'sort_order' => 3],
];

$pdo->exec("DELETE FROM clients");
$stmt = $pdo->prepare("INSERT INTO clients (name, logo, sort_order, is_active) VALUES (?, ?, ?, 1)");
foreach ($clients as $c) {
    $stmt->execute([$c['name'], $c['logo'], $c['sort_order']]);
}
echo "  - Added " . count($clients) . " clients\n";

echo "\n=== Seeding completed successfully! ===\n";
echo "\n⚠️  IMPORTANT: Delete this file from the server after use!\n";
echo "</pre>";

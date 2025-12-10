<?php
namespace App\Controllers;

use App\Core\View;
use App\Core\Database;

class PageController
{
    public function services(): void
    {
        // Load services from database
        $services = Database::fetchAll(
            "SELECT * FROM services WHERE is_active = 1 ORDER BY sort_order ASC, id ASC"
        );

        // If no services in DB, use defaults
        if (empty($services)) {
            $services = $this->getDefaultServices();
        }

        View::render('pages/services', [
            'services' => $services,
            'pageTitle' => 'Naše služby',
            'pageDescription' => 'Kompletní online marketing pod jednou střechou. Od sociálních sítí přes PPC reklamu až po SEO.',
        ]);
    }

    public function serviceDetail(string $slug): void
    {
        // Fetch service from database
        $service = Database::fetch(
            "SELECT * FROM services WHERE slug = ? AND is_active = 1",
            [$slug]
        );

        if (!$service) {
            http_response_code(404);
            View::render('errors/404');
            return;
        }

        // Parse features JSON
        if (!empty($service['features'])) {
            $service['features'] = json_decode($service['features'], true) ?: [];
        } else {
            $service['features'] = [];
        }

        View::render('pages/service-detail', [
            'service' => $service,
            'pageTitle' => $service['title'],
        ]);
    }

    public function references(): void
    {
        // Load case studies from database
        $caseStudiesRaw = Database::fetchAll(
            "SELECT * FROM case_studies WHERE is_published = 1 ORDER BY sort_order ASC, id DESC"
        );

        $caseStudies = [];
        foreach ($caseStudiesRaw as $study) {
            $study['results'] = json_decode($study['results'] ?? '[]', true) ?: [];
            $caseStudies[] = $study;
        }

        // If no case studies in DB, use defaults
        if (empty($caseStudies)) {
            $caseStudies = $this->getDefaultCaseStudies();
        }

        // Load clients from database
        $clients = Database::fetchAll(
            "SELECT * FROM clients WHERE is_active = 1 ORDER BY sort_order ASC, id ASC"
        );

        // If no clients in DB, use defaults
        if (empty($clients)) {
            $clients = $this->getDefaultClients();
        }

        View::render('pages/references', [
            'caseStudies' => $caseStudies,
            'clients' => $clients,
            'pageTitle' => 'Reference',
            'pageDescription' => 'Podívejte se na výsledky, kterých jsme dosáhli pro naše klienty.',
        ]);
    }

    public function pricing(): void
    {
        // Load pricing plans from database
        $plansRaw = Database::fetchAll(
            "SELECT * FROM pricing_plans WHERE is_active = 1 ORDER BY sort_order ASC, price ASC"
        );

        $plans = [];
        foreach ($plansRaw as $plan) {
            $plan['features'] = json_decode($plan['features'] ?? '[]', true) ?: [];
            $plan['featured'] = (bool)($plan['is_featured'] ?? false);
            $plans[] = $plan;
        }

        // If no pricing in DB, use defaults
        if (empty($plans)) {
            $plans = $this->getDefaultPricing();
        }

        $addons = [
            ['name' => 'Extra hodina', 'price' => '800 Kč'],
            ['name' => 'Video produkce (den)', 'price' => '15 000 Kč'],
            ['name' => 'Fotografování (den)', 'price' => '10 000 Kč'],
            ['name' => 'Landing page', 'price' => 'od 25 000 Kč'],
        ];

        // Load calculator settings
        $settings = $this->getSettings();
        $calculatorPrices = [
            'social' => (int)($settings['calc_social'] ?? 8000),
            'meta' => (int)($settings['calc_meta'] ?? 6000),
            'google' => (int)($settings['calc_google'] ?? 6000),
            'email' => (int)($settings['calc_email'] ?? 4000),
            'seo' => (int)($settings['calc_seo'] ?? 8000),
            'content' => (int)($settings['calc_content'] ?? 5000),
        ];

        View::render('pages/pricing', [
            'plans' => $plans,
            'addons' => $addons,
            'calculatorPrices' => $calculatorPrices,
            'pageTitle' => 'Ceník',
            'pageDescription' => 'Transparentní ceny bez skrytých poplatků. Vyberte si balíček, který vám vyhovuje.',
        ]);
    }

    private function getSettings(): array
    {
        try {
            $settings = Database::fetchAll("SELECT `key`, `value` FROM settings");
            $result = [];
            foreach ($settings as $s) {
                $result[$s['key']] = $s['value'];
            }
            return $result;
        } catch (\Exception $e) {
            return [];
        }
    }

    public function about(): void
    {
        // Load team from database
        $team = Database::fetchAll(
            "SELECT * FROM team_members WHERE is_active = 1 ORDER BY sort_order ASC, id ASC"
        );

        // If no team in DB, use defaults
        if (empty($team)) {
            $team = $this->getDefaultTeam();
        }

        $values = [
            [
                'icon' => 'target',
                'title' => 'Výsledky na prvním místě',
                'description' => 'Měříme úspěch podle vašich byznysových cílů, ne podle vanity metrik.',
            ],
            [
                'icon' => 'eye',
                'title' => 'Transparentnost',
                'description' => 'Žádné skryté poplatky, jasné reporty, otevřená komunikace.',
            ],
            [
                'icon' => 'zap',
                'title' => 'Rychlost',
                'description' => 'Reagujeme do 24 hodin, implementujeme v řádu dnů, ne týdnů.',
            ],
            [
                'icon' => 'users',
                'title' => 'Partnerství',
                'description' => 'Nejsme dodavatel, jsme váš marketingový partner.',
            ],
        ];

        View::render('pages/about', [
            'team' => $team,
            'values' => $values,
            'pageTitle' => 'O nás',
            'pageDescription' => 'Jsme tým marketingových expertů, kteří milují svou práci a věří ve výsledky.',
        ]);
    }

    public function contact(): void
    {
        View::render('pages/contact', [
            'pageTitle' => 'Kontakt',
            'pageDescription' => 'Ozvěte se nám. Rádi s vámi probereme vaše marketingové potřeby.',
        ]);
    }

    public function blog(): void
    {
        // Load blog posts from database
        $posts = Database::fetchAll(
            "SELECT * FROM blog_posts WHERE is_published = 1 ORDER BY created_at DESC"
        );

        // If no posts in DB, use defaults
        if (empty($posts)) {
            $posts = $this->getDefaultBlogPosts();
        }

        View::render('pages/blog', [
            'posts' => $posts,
            'pageTitle' => 'Blog',
            'pageDescription' => 'Tipy, návody a novinky ze světa online marketingu.',
        ]);
    }

    // Default data methods (fallbacks when DB is empty)

    private function getDefaultServices(): array
    {
        return [
            [
                'slug' => 'socialni-site',
                'icon' => 'share-2',
                'title' => 'Správa sociálních sítí',
                'short_description' => 'Kompletní správa vašich profilů na všech platformách.',
                'description' => 'Převezmeme kompletní správu vašich sociálních sítí. Od strategie, přes tvorbu obsahu až po komunitu management. Facebook, Instagram, LinkedIn, TikTok - všechny platformy pod jednou střechou.',
                'features' => [
                    'Tvorba obsahové strategie',
                    'Pravidelné příspěvky a stories',
                    'Tvorba reels a video obsahu',
                    'Community management',
                    'Měsíční reporting',
                ]
            ],
            [
                'slug' => 'meta-ads',
                'icon' => 'target',
                'title' => 'Meta Ads',
                'short_description' => 'Cílená reklama na Facebooku a Instagramu.',
                'description' => 'Vytváříme a optimalizujeme reklamní kampaně na Facebooku a Instagramu. Zaměřujeme se na maximální návratnost investice a přesné cílení na vaši cílovou skupinu.',
                'features' => [
                    'Nastavení reklamních účtů',
                    'Tvorba reklamních kreativ',
                    'A/B testování',
                    'Remarketing kampaně',
                    'Optimalizace rozpočtu',
                ]
            ],
            [
                'slug' => 'google-ads',
                'icon' => 'search',
                'title' => 'Google Ads',
                'short_description' => 'PPC reklama ve vyhledávání a Display síti.',
                'description' => 'Spravujeme kampaně v Google Ads - od vyhledávací reklamy přes Display síť až po YouTube. Zaměřujeme se na konverze a efektivní využití rozpočtu.',
                'features' => [
                    'Search kampaně',
                    'Display reklama',
                    'YouTube Ads',
                    'Shopping kampaně',
                    'Performance Max',
                ]
            ],
            [
                'slug' => 'email-marketing',
                'icon' => 'mail',
                'title' => 'E-mail marketing',
                'short_description' => 'Automatizované kampaně a newslettery.',
                'description' => 'Navrhujeme a implementujeme e-mailové kampaně, které skutečně fungují. Od welcome sekvencí přes automatizace až po pravidelné newslettery.',
                'features' => [
                    'Návrh e-mail strategie',
                    'Tvorba šablon',
                    'Automatizační sekvence',
                    'Segmentace databáze',
                    'A/B testování',
                ]
            ],
        ];
    }

    private function getDefaultCaseStudies(): array
    {
        return [
            [
                'title' => 'E-shop Fashion',
                'category' => 'E-commerce',
                'featured_image' => '/assets/images/cases/fashion.jpg',
                'results' => [
                    ['label' => 'Nárůst tržeb', 'value' => '+127%'],
                    ['label' => 'ROAS', 'value' => '4.2x'],
                    ['label' => 'Nových zákazníků', 'value' => '+2,400'],
                ],
                'description' => 'Kompletní správa online marketingu pro módní e-shop.',
            ],
            [
                'title' => 'Tech Startup',
                'category' => 'B2B / SaaS',
                'featured_image' => '/assets/images/cases/tech.jpg',
                'results' => [
                    ['label' => 'Leadů měsíčně', 'value' => '180+'],
                    ['label' => 'Cena za lead', 'value' => '-45%'],
                    ['label' => 'Konverzní poměr', 'value' => '12%'],
                ],
                'description' => 'Lead generation kampaně pro B2B SaaS startup.',
            ],
            [
                'title' => 'Restaurace U Mlýna',
                'category' => 'Gastro',
                'featured_image' => '/assets/images/cases/restaurant.jpg',
                'results' => [
                    ['label' => 'Followerů', 'value' => '+5,200'],
                    ['label' => 'Engagement', 'value' => '8.4%'],
                    ['label' => 'Rezervací online', 'value' => '+340%'],
                ],
                'description' => 'Budování značky a komunity pro lokální restauraci.',
            ],
        ];
    }

    private function getDefaultClients(): array
    {
        return [
            ['name' => 'Client 1', 'logo_url' => '/assets/images/clients/1.svg'],
            ['name' => 'Client 2', 'logo_url' => '/assets/images/clients/2.svg'],
            ['name' => 'Client 3', 'logo_url' => '/assets/images/clients/3.svg'],
            ['name' => 'Client 4', 'logo_url' => '/assets/images/clients/4.svg'],
            ['name' => 'Client 5', 'logo_url' => '/assets/images/clients/5.svg'],
            ['name' => 'Client 6', 'logo_url' => '/assets/images/clients/6.svg'],
        ];
    }

    private function getDefaultPricing(): array
    {
        return [
            [
                'name' => 'Start',
                'price' => 15000,
                'period' => 'měsíčně',
                'hours' => '20 hodin',
                'description' => 'Pro začínající firmy a živnostníky',
                'features' => [
                    ['text' => 'Správa 2 sociálních sítí', 'included' => true],
                    ['text' => '8 příspěvků měsíčně', 'included' => true],
                    ['text' => 'Základní grafika', 'included' => true],
                    ['text' => 'Měsíční reporting', 'included' => true],
                    ['text' => 'E-mailová podpora', 'included' => true],
                    ['text' => 'PPC reklama', 'included' => false],
                    ['text' => 'Video obsah', 'included' => false],
                ],
                'featured' => false,
                'cta' => 'Začít s tímto plánem'
            ],
            [
                'name' => 'Growth',
                'price' => 28000,
                'period' => 'měsíčně',
                'hours' => '40 hodin',
                'description' => 'Pro rostoucí firmy',
                'features' => [
                    ['text' => 'Správa 4 sociálních sítí', 'included' => true],
                    ['text' => '16 příspěvků měsíčně', 'included' => true],
                    ['text' => 'Pokročilá grafika + Reels', 'included' => true],
                    ['text' => 'Meta Ads NEBO Google Ads', 'included' => true],
                    ['text' => 'Týdenní reporting', 'included' => true],
                    ['text' => 'Prioritní podpora', 'included' => true],
                    ['text' => 'Měsíční strategie call', 'included' => true],
                ],
                'featured' => true,
                'cta' => 'Nejoblíbenější volba'
            ],
            [
                'name' => 'Scale',
                'price' => 50000,
                'period' => 'měsíčně',
                'hours' => '80 hodin',
                'description' => 'Pro ambiciózní značky',
                'features' => [
                    ['text' => 'Neomezený počet sítí', 'included' => true],
                    ['text' => 'Neomezený obsah', 'included' => true],
                    ['text' => 'Meta Ads + Google Ads', 'included' => true],
                    ['text' => 'E-mail marketing', 'included' => true],
                    ['text' => 'SEO optimalizace', 'included' => true],
                    ['text' => 'Dedikovaný account manager', 'included' => true],
                    ['text' => 'Prioritní implementace', 'included' => true],
                ],
                'featured' => false,
                'cta' => 'Kontaktovat sales'
            ],
        ];
    }

    private function getDefaultTeam(): array
    {
        return [
            [
                'name' => 'David Kosař',
                'position' => 'Founder & CEO',
                'photo' => '/assets/images/team/david.jpg',
                'linkedin' => '#',
            ],
        ];
    }

    private function getDefaultBlogPosts(): array
    {
        return [];
    }
}

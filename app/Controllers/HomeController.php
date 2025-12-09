<?php
namespace App\Controllers;

use App\Core\View;
use App\Core\Database;

class HomeController
{
    public function index(): void
    {
        // Load services from database
        $services = Database::fetchAll(
            "SELECT * FROM services WHERE is_active = 1 ORDER BY sort_order ASC, id ASC LIMIT 8"
        );

        // If no services in DB, use defaults
        if (empty($services)) {
            $services = $this->getDefaultServices();
        }

        // Stats - these are typically static or from settings
        $stats = $this->getStats();

        // Load testimonials from database
        $testimonials = Database::fetchAll(
            "SELECT * FROM testimonials WHERE is_active = 1 ORDER BY sort_order ASC, id ASC LIMIT 6"
        );

        // If no testimonials in DB, use defaults
        if (empty($testimonials)) {
            $testimonials = $this->getDefaultTestimonials();
        }

        // Load pricing from database
        $pricingRaw = Database::fetchAll(
            "SELECT * FROM pricing_plans WHERE is_active = 1 ORDER BY sort_order ASC, price ASC"
        );

        // Process pricing - parse JSON features
        $pricing = [];
        foreach ($pricingRaw as $plan) {
            $plan['features'] = json_decode($plan['features'] ?? '[]', true) ?: [];
            $plan['featured'] = (bool)($plan['is_featured'] ?? false);
            $pricing[] = $plan;
        }

        // If no pricing in DB, use defaults
        if (empty($pricing)) {
            $pricing = $this->getDefaultPricing();
        }

        // Load FAQs from database
        $faqs = Database::fetchAll(
            "SELECT * FROM faqs WHERE is_active = 1 ORDER BY sort_order ASC, id ASC LIMIT 10"
        );

        // If no FAQs in DB, use defaults
        if (empty($faqs)) {
            $faqs = $this->getDefaultFaqs();
        }

        // Load process steps from database
        $processSteps = Database::fetchAll(
            "SELECT * FROM process_steps WHERE is_active = 1 ORDER BY sort_order ASC, id ASC"
        );

        // Load certifications from database
        $certifications = Database::fetchAll(
            "SELECT * FROM certifications WHERE is_active = 1 ORDER BY sort_order ASC, id ASC"
        );

        // Load settings for video and chat
        $settings = $this->getSettings();

        View::render('pages/home', [
            'services' => $services,
            'stats' => $stats,
            'testimonials' => $testimonials,
            'pricing' => $pricing,
            'faqs' => $faqs,
            'processSteps' => $processSteps,
            'certifications' => $certifications,
            'settings' => $settings,
            'pageTitle' => 'Online Marketing na Klíč',
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

    private function getStats(): array
    {
        return [
            ['number' => '150+', 'label' => 'Spokojených klientů'],
            ['number' => '24h', 'label' => 'Průměrná odezva'],
            ['number' => '40%', 'label' => 'Průměrný nárůst konverzí'],
            ['number' => '5+', 'label' => 'Let zkušeností'],
        ];
    }

    private function getDefaultServices(): array
    {
        return [
            [
                'icon' => 'share-2',
                'title' => 'Správa sociálních sítí',
                'description' => 'Kompletní správa Facebooku, Instagramu, LinkedInu a dalších platforem.',
                'link' => '/sluzby/socialni-site'
            ],
            [
                'icon' => 'target',
                'title' => 'Meta Ads',
                'description' => 'Cílená reklama na Facebooku a Instagramu s maximální návratností.',
                'link' => '/sluzby/meta-ads'
            ],
            [
                'icon' => 'search',
                'title' => 'Google Ads',
                'description' => 'PPC kampaně ve vyhledávání, Display síti a na YouTube.',
                'link' => '/sluzby/google-ads'
            ],
            [
                'icon' => 'mail',
                'title' => 'E-mail marketing',
                'description' => 'Automatizované kampaně, newslettery a personalizovaná komunikace.',
                'link' => '/sluzby/email-marketing'
            ],
        ];
    }

    private function getDefaultTestimonials(): array
    {
        return [
            [
                'name' => 'Jan Novák',
                'company' => 'E-shop Fashion',
                'text' => 'SocialHero nám pomohl zdvojnásobit tržby z online kanálů během 6 měsíců.',
                'image' => '/assets/images/testimonials/1.jpg',
                'rating' => 5
            ],
            [
                'name' => 'Marie Svobodová',
                'company' => 'Restaurace U Mlýna',
                'text' => 'Konečně máme sociální sítě, které přinášejí skutečné zákazníky.',
                'image' => '/assets/images/testimonials/2.jpg',
                'rating' => 5
            ],
            [
                'name' => 'Petr Dvořák',
                'company' => 'Tech Startup',
                'text' => 'Profesionální přístup a měřitelné výsledky. Doporučuji!',
                'image' => '/assets/images/testimonials/3.jpg',
                'rating' => 5
            ],
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
                'description' => 'Pro začínající firmy',
                'features' => [
                    'Správa 2 sociálních sítí',
                    '8 příspěvků měsíčně',
                    'Základní reporting',
                    'E-mailová podpora',
                ],
                'featured' => false
            ],
            [
                'name' => 'Growth',
                'price' => 28000,
                'period' => 'měsíčně',
                'hours' => '40 hodin',
                'description' => 'Pro rostoucí firmy',
                'features' => [
                    'Správa 4 sociálních sítí',
                    '16 příspěvků měsíčně',
                    'Meta Ads nebo Google Ads',
                    'Detailní reporting',
                    'Prioritní podpora',
                    'Měsíční strategie call',
                ],
                'featured' => true
            ],
            [
                'name' => 'Scale',
                'price' => 50000,
                'period' => 'měsíčně',
                'hours' => '80 hodin',
                'description' => 'Pro ambiciózní značky',
                'features' => [
                    'Neomezený počet sítí',
                    'Neomezený obsah',
                    'Meta Ads + Google Ads',
                    'E-mail marketing',
                    'SEO optimalizace',
                    'Dedikovaný account manager',
                    'Týdenní reporty',
                ],
                'featured' => false
            ],
        ];
    }

    private function getDefaultFaqs(): array
    {
        return [
            [
                'question' => 'Jak funguje měsíční předplatné?',
                'answer' => 'Vyberete si balíček podle vašich potřeb. Každý měsíc máte k dispozici určitý počet hodin našeho týmu, které můžete využít na jakékoliv marketingové aktivity. Nepropadají a můžete je flexibilně přizpůsobit aktuálním potřebám.'
            ],
            [
                'question' => 'Mohu změnit nebo zrušit předplatné?',
                'answer' => 'Ano, předplatné můžete kdykoliv upgradovat, downgradovat nebo zrušit. Nejsme agentura, která vás zamyká do dlouhodobých smluv. Věříme ve výsledky, ne v papíry.'
            ],
            [
                'question' => 'Jak rychle uvidím výsledky?',
                'answer' => 'První výsledky jsou viditelné obvykle do 2-4 týdnů. Plný potenciál kampaní se projeví po 2-3 měsících optimalizace. Vše záleží na vašem odvětví a výchozím stavu.'
            ],
            [
                'question' => 'Co když potřebuji více hodin?',
                'answer' => 'Žádný problém! Můžete buď přejít na vyšší balíček, nebo si dokoupit extra hodiny za zvýhodněnou cenu. Vždy se domluvíme.'
            ],
            [
                'question' => 'Pracujete i s malými firmami?',
                'answer' => 'Ano! Náš Start balíček je ideální pro malé firmy a živnostníky. Věříme, že kvalitní marketing si zaslouží každý, nejen velké korporace.'
            ],
        ];
    }
}

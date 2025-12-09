-- =============================================
-- SocialHero Database Update v3
-- Tracking skripty a SEO nastavení
-- =============================================

-- SEO nastavení pro jednotlivé stránky
CREATE TABLE IF NOT EXISTS `page_seo` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `page_slug` VARCHAR(100) NOT NULL UNIQUE,
    `page_name` VARCHAR(255) NOT NULL,
    `meta_title` VARCHAR(255) DEFAULT NULL,
    `meta_description` TEXT DEFAULT NULL,
    `meta_keywords` VARCHAR(500) DEFAULT NULL,
    `og_image` VARCHAR(255) DEFAULT NULL,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `idx_slug` (`page_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Výchozí stránky pro SEO
INSERT INTO `page_seo` (`page_slug`, `page_name`, `meta_title`, `meta_description`) VALUES
('home', 'Homepage', 'SocialHero - Online Marketing na Klíč', 'Veškerý online marketing v jednom předplatném. Sociální sítě, Meta Ads, Google Ads, e-mailing a více. Jeden tým, jeden kontakt, měřitelné výsledky.'),
('sluzby', 'Služby', 'Naše služby | SocialHero', 'Kompletní online marketing pod jednou střechou. Od sociálních sítí přes PPC reklamu až po SEO optimalizaci.'),
('cenik', 'Ceník', 'Ceník služeb | SocialHero', 'Transparentní ceny bez skrytých poplatků. Vyberte si balíček, který vám vyhovuje. Od 15 000 Kč měsíčně.'),
('reference', 'Reference', 'Reference a případové studie | SocialHero', 'Podívejte se na výsledky, kterých jsme dosáhli pro naše klienty. Čísla nelžou.'),
('o-nas', 'O nás', 'O nás | SocialHero', 'Jsme tým marketingových expertů, kteří milují svou práci a věří ve výsledky.'),
('kontakt', 'Kontakt', 'Kontakt | SocialHero', 'Ozvěte se nám. Rádi s vámi probereme vaše marketingové potřeby. Nezávazná konzultace zdarma.'),
('blog', 'Blog', 'Blog | SocialHero', 'Tipy, návody a novinky ze světa online marketingu.');

-- Nová nastavení pro tracking
INSERT IGNORE INTO `settings` (`key`, `value`, `type`, `group`) VALUES
('gtm_id', '', 'string', 'tracking'),
('ga4_id', '', 'string', 'tracking'),
('gads_id', '', 'string', 'tracking'),
('fb_pixel_id', '', 'string', 'tracking'),
('sklik_id', '', 'string', 'tracking'),
('ecomail_id', '', 'string', 'tracking'),
('custom_head_scripts', '', 'text', 'tracking'),
('custom_body_scripts', '', 'text', 'tracking'),
('default_meta_title', 'SocialHero - Online Marketing na Klíč', 'string', 'seo'),
('default_meta_description', 'Veškerý online marketing v jednom předplatném. Sociální sítě, Meta Ads, Google Ads a více.', 'text', 'seo'),
('default_meta_keywords', 'online marketing, sociální sítě, meta ads, google ads, seo, marketing agentura', 'string', 'seo');

-- Přidat kalkulačku settings
INSERT IGNORE INTO `settings` (`key`, `value`, `type`, `group`) VALUES
('calc_social', '8000', 'number', 'calculator'),
('calc_meta', '6000', 'number', 'calculator'),
('calc_google', '6000', 'number', 'calculator'),
('calc_email', '4000', 'number', 'calculator'),
('calc_seo', '8000', 'number', 'calculator'),
('calc_content', '5000', 'number', 'calculator');

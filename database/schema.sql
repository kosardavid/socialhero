-- =============================================
-- SocialHero CMS Database Schema
-- MariaDB 10.4
-- =============================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- =============================================
-- Users table (Admin users)
-- =============================================
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('admin', 'editor') NOT NULL DEFAULT 'editor',
    `avatar` VARCHAR(255) DEFAULT NULL,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `last_login` DATETIME DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_email` (`email`),
    INDEX `idx_role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Pages table
-- =============================================
CREATE TABLE IF NOT EXISTS `pages` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `title` VARCHAR(255) NOT NULL,
    `content` LONGTEXT,
    `meta_title` VARCHAR(255) DEFAULT NULL,
    `meta_description` TEXT DEFAULT NULL,
    `meta_keywords` VARCHAR(500) DEFAULT NULL,
    `is_published` TINYINT(1) NOT NULL DEFAULT 0,
    `created_by` INT UNSIGNED DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_slug` (`slug`),
    INDEX `idx_published` (`is_published`),
    FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Services table
-- =============================================
CREATE TABLE IF NOT EXISTS `services` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `title` VARCHAR(255) NOT NULL,
    `short_description` VARCHAR(500) DEFAULT NULL,
    `description` LONGTEXT,
    `icon` VARCHAR(50) DEFAULT NULL,
    `features` JSON DEFAULT NULL,
    `meta_title` VARCHAR(255) DEFAULT NULL,
    `meta_description` TEXT DEFAULT NULL,
    `sort_order` INT NOT NULL DEFAULT 0,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_slug` (`slug`),
    INDEX `idx_active` (`is_active`),
    INDEX `idx_sort` (`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Case Studies / References
-- =============================================
CREATE TABLE IF NOT EXISTS `case_studies` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `title` VARCHAR(255) NOT NULL,
    `client_name` VARCHAR(255) DEFAULT NULL,
    `category` VARCHAR(100) DEFAULT NULL,
    `short_description` VARCHAR(500) DEFAULT NULL,
    `description` LONGTEXT,
    `challenge` TEXT DEFAULT NULL,
    `solution` TEXT DEFAULT NULL,
    `results` JSON DEFAULT NULL,
    `image` VARCHAR(255) DEFAULT NULL,
    `gallery` JSON DEFAULT NULL,
    `testimonial` TEXT DEFAULT NULL,
    `testimonial_author` VARCHAR(255) DEFAULT NULL,
    `meta_title` VARCHAR(255) DEFAULT NULL,
    `meta_description` TEXT DEFAULT NULL,
    `is_featured` TINYINT(1) NOT NULL DEFAULT 0,
    `is_published` TINYINT(1) NOT NULL DEFAULT 0,
    `sort_order` INT NOT NULL DEFAULT 0,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_slug` (`slug`),
    INDEX `idx_category` (`category`),
    INDEX `idx_featured` (`is_featured`),
    INDEX `idx_published` (`is_published`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Clients (logos)
-- =============================================
CREATE TABLE IF NOT EXISTS `clients` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `logo` VARCHAR(255) NOT NULL,
    `website` VARCHAR(255) DEFAULT NULL,
    `sort_order` INT NOT NULL DEFAULT 0,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Testimonials
-- =============================================
CREATE TABLE IF NOT EXISTS `testimonials` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `company` VARCHAR(255) DEFAULT NULL,
    `position` VARCHAR(255) DEFAULT NULL,
    `text` TEXT NOT NULL,
    `image` VARCHAR(255) DEFAULT NULL,
    `rating` TINYINT DEFAULT 5,
    `case_study_id` INT UNSIGNED DEFAULT NULL,
    `is_featured` TINYINT(1) NOT NULL DEFAULT 0,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `sort_order` INT NOT NULL DEFAULT 0,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_featured` (`is_featured`),
    INDEX `idx_active` (`is_active`),
    FOREIGN KEY (`case_study_id`) REFERENCES `case_studies`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Pricing Plans
-- =============================================
CREATE TABLE IF NOT EXISTS `pricing_plans` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `slug` VARCHAR(100) NOT NULL UNIQUE,
    `price` DECIMAL(10,2) NOT NULL,
    `currency` VARCHAR(3) NOT NULL DEFAULT 'CZK',
    `period` VARCHAR(50) NOT NULL DEFAULT 'měsíčně',
    `hours` VARCHAR(50) DEFAULT NULL,
    `description` VARCHAR(255) DEFAULT NULL,
    `features` JSON DEFAULT NULL,
    `is_featured` TINYINT(1) NOT NULL DEFAULT 0,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `sort_order` INT NOT NULL DEFAULT 0,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_active` (`is_active`),
    INDEX `idx_sort` (`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Blog Posts
-- =============================================
CREATE TABLE IF NOT EXISTS `blog_posts` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `title` VARCHAR(255) NOT NULL,
    `excerpt` TEXT DEFAULT NULL,
    `content` LONGTEXT,
    `image` VARCHAR(255) DEFAULT NULL,
    `category` VARCHAR(100) DEFAULT NULL,
    `tags` JSON DEFAULT NULL,
    `author_id` INT UNSIGNED DEFAULT NULL,
    `meta_title` VARCHAR(255) DEFAULT NULL,
    `meta_description` TEXT DEFAULT NULL,
    `views` INT UNSIGNED NOT NULL DEFAULT 0,
    `is_featured` TINYINT(1) NOT NULL DEFAULT 0,
    `is_published` TINYINT(1) NOT NULL DEFAULT 0,
    `published_at` DATETIME DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_slug` (`slug`),
    INDEX `idx_category` (`category`),
    INDEX `idx_published` (`is_published`),
    INDEX `idx_published_at` (`published_at`),
    FOREIGN KEY (`author_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- FAQ
-- =============================================
CREATE TABLE IF NOT EXISTS `faqs` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `question` VARCHAR(500) NOT NULL,
    `answer` TEXT NOT NULL,
    `category` VARCHAR(100) DEFAULT NULL,
    `sort_order` INT NOT NULL DEFAULT 0,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_category` (`category`),
    INDEX `idx_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Contact Form Submissions
-- =============================================
CREATE TABLE IF NOT EXISTS `contacts` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(50) DEFAULT NULL,
    `company` VARCHAR(255) DEFAULT NULL,
    `service` VARCHAR(100) DEFAULT NULL,
    `budget` VARCHAR(100) DEFAULT NULL,
    `message` TEXT NOT NULL,
    `ip_address` VARCHAR(45) DEFAULT NULL,
    `user_agent` VARCHAR(500) DEFAULT NULL,
    `is_read` TINYINT(1) NOT NULL DEFAULT 0,
    `is_archived` TINYINT(1) NOT NULL DEFAULT 0,
    `notes` TEXT DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_email` (`email`),
    INDEX `idx_read` (`is_read`),
    INDEX `idx_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Newsletter Subscribers
-- =============================================
CREATE TABLE IF NOT EXISTS `newsletter_subscribers` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `unsubscribed_at` DATETIME DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_email` (`email`),
    INDEX `idx_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Media Library
-- =============================================
CREATE TABLE IF NOT EXISTS `media` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `filename` VARCHAR(255) NOT NULL,
    `original_name` VARCHAR(255) NOT NULL,
    `mime_type` VARCHAR(100) NOT NULL,
    `size` INT UNSIGNED NOT NULL,
    `path` VARCHAR(500) NOT NULL,
    `alt_text` VARCHAR(255) DEFAULT NULL,
    `caption` VARCHAR(500) DEFAULT NULL,
    `uploaded_by` INT UNSIGNED DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_mime` (`mime_type`),
    FOREIGN KEY (`uploaded_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Settings
-- =============================================
CREATE TABLE IF NOT EXISTS `settings` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `key` VARCHAR(100) NOT NULL UNIQUE,
    `value` TEXT DEFAULT NULL,
    `type` ENUM('string', 'text', 'number', 'boolean', 'json') NOT NULL DEFAULT 'string',
    `group` VARCHAR(50) DEFAULT 'general',
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_key` (`key`),
    INDEX `idx_group` (`group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- Team Members
-- =============================================
CREATE TABLE IF NOT EXISTS `team_members` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `position` VARCHAR(255) DEFAULT NULL,
    `bio` TEXT DEFAULT NULL,
    `image` VARCHAR(255) DEFAULT NULL,
    `email` VARCHAR(255) DEFAULT NULL,
    `linkedin` VARCHAR(255) DEFAULT NULL,
    `sort_order` INT NOT NULL DEFAULT 0,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

-- =============================================
-- Default Data
-- =============================================

-- Default admin user (password: admin123 - CHANGE THIS!)
INSERT INTO `users` (`name`, `email`, `password`, `role`) VALUES
('Admin', 'admin@socialhero.cz', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Default services
INSERT INTO `services` (`slug`, `title`, `short_description`, `icon`, `sort_order`) VALUES
('socialni-site', 'Správa sociálních sítí', 'Kompletní správa Facebooku, Instagramu, LinkedInu a dalších platforem.', 'share-2', 1),
('meta-ads', 'Meta Ads', 'Cílená reklama na Facebooku a Instagramu s maximální návratností.', 'target', 2),
('google-ads', 'Google Ads', 'PPC kampaně ve vyhledávání, Display síti a na YouTube.', 'search', 3),
('email-marketing', 'E-mail marketing', 'Automatizované kampaně, newslettery a personalizovaná komunikace.', 'mail', 4),
('seo', 'SEO optimalizace', 'Organická viditelnost ve vyhledávačích.', 'trending-up', 5),
('tvorba-obsahu', 'Tvorba obsahu', 'Kreativní obsah, který zaujme.', 'edit-3', 6);

-- Default pricing plans
INSERT INTO `pricing_plans` (`name`, `slug`, `price`, `hours`, `description`, `features`, `is_featured`, `sort_order`) VALUES
('Start', 'start', 15000, '20 hodin', 'Pro začínající firmy', '["Správa 2 sociálních sítí", "8 příspěvků měsíčně", "Základní grafika", "Měsíční reporting", "E-mailová podpora"]', 0, 1),
('Growth', 'growth', 28000, '40 hodin', 'Pro rostoucí firmy', '["Správa 4 sociálních sítí", "16 příspěvků měsíčně", "Pokročilá grafika + Reels", "Meta Ads NEBO Google Ads", "Týdenní reporting", "Prioritní podpora", "Měsíční strategie call"]', 1, 2),
('Scale', 'scale', 50000, '80 hodin', 'Pro ambiciózní značky', '["Neomezený počet sítí", "Neomezený obsah", "Meta Ads + Google Ads", "E-mail marketing", "SEO optimalizace", "Dedikovaný account manager", "Prioritní implementace"]', 0, 3);

-- Default FAQs
INSERT INTO `faqs` (`question`, `answer`, `sort_order`) VALUES
('Jak funguje měsíční předplatné?', 'Vyberete si balíček podle vašich potřeb. Každý měsíc máte k dispozici určitý počet hodin našeho týmu, které můžete využít na jakékoliv marketingové aktivity. Nepropadají a můžete je flexibilně přizpůsobit aktuálním potřebám.', 1),
('Mohu změnit nebo zrušit předplatné?', 'Ano, předplatné můžete kdykoliv upgradovat, downgradovat nebo zrušit. Nejsme agentura, která vás zamyká do dlouhodobých smluv. Věříme ve výsledky, ne v papíry.', 2),
('Jak rychle uvidím výsledky?', 'První výsledky jsou viditelné obvykle do 2-4 týdnů. Plný potenciál kampaní se projeví po 2-3 měsících optimalizace. Vše záleží na vašem odvětví a výchozím stavu.', 3),
('Co když potřebuji více hodin?', 'Žádný problém! Můžete buď přejít na vyšší balíček, nebo si dokoupit extra hodiny za zvýhodněnou cenu. Vždy se domluvíme.', 4),
('Pracujete i s malými firmami?', 'Ano! Náš Start balíček je ideální pro malé firmy a živnostníky. Věříme, že kvalitní marketing si zaslouží každý, nejen velké korporace.', 5);

-- Default settings
INSERT INTO `settings` (`key`, `value`, `type`, `group`) VALUES
('site_name', 'SocialHero', 'string', 'general'),
('site_description', 'Online Marketing na Klíč', 'string', 'general'),
('contact_email', 'info@socialhero.cz', 'string', 'contact'),
('contact_phone', '+420 123 456 789', 'string', 'contact'),
('contact_address', 'Praha, Česká republika', 'string', 'contact'),
('social_facebook', 'https://facebook.com/socialhero', 'string', 'social'),
('social_instagram', 'https://instagram.com/socialhero', 'string', 'social'),
('social_linkedin', 'https://linkedin.com/company/socialhero', 'string', 'social');

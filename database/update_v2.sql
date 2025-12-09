-- =============================================
-- SocialHero Database Update v2
-- Přidání nových tabulek pro editaci homepage
-- =============================================

-- Process Steps (Timeline)
CREATE TABLE IF NOT EXISTS `process_steps` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT DEFAULT NULL,
    `icon` VARCHAR(50) DEFAULT 'check',
    `sort_order` INT NOT NULL DEFAULT 0,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_active` (`is_active`),
    INDEX `idx_sort` (`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Certifications / Partners
CREATE TABLE IF NOT EXISTS `certifications` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) DEFAULT NULL,
    `icon` VARCHAR(50) DEFAULT 'award',
    `color` VARCHAR(20) DEFAULT '#7c3aed',
    `url` VARCHAR(255) DEFAULT NULL,
    `sort_order` INT NOT NULL DEFAULT 0,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    INDEX `idx_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Přidat sloupec pro kalkulačku do services
ALTER TABLE `services` ADD COLUMN IF NOT EXISTS `calculator_price` INT DEFAULT NULL;

-- Nová nastavení
INSERT IGNORE INTO `settings` (`key`, `value`, `type`, `group`) VALUES
('youtube_video_id', '', 'string', 'integrations'),
('tawkto_property_id', '', 'string', 'integrations'),
('tawkto_widget_id', '', 'string', 'integrations');

-- Výchozí process steps
INSERT INTO `process_steps` (`title`, `description`, `icon`, `sort_order`) VALUES
('Nezávazná konzultace', 'Probereme vaše cíle, aktuální stav a možnosti. Zdarma a bez závazků.', 'message-circle', 1),
('Strategie na míru', 'Připravíme detailní plán s konkrétními kroky a očekávanými výsledky.', 'file-text', 2),
('Spuštění kampaní', 'Implementujeme strategii a spouštíme kampaně s průběžným reportingem.', 'play-circle', 3),
('Optimalizace a růst', 'Kontinuálně vyhodnocujeme data a optimalizujeme pro maximální ROI.', 'trending-up', 4);

-- Výchozí certifikace
INSERT INTO `certifications` (`name`, `description`, `icon`, `color`, `sort_order`) VALUES
('Google Partner', 'Certifikovaná agentura', 'award', '#4285f4', 1),
('Meta Business Partner', 'Facebook & Instagram Ads', 'award', '#0077b5', 2),
('HubSpot Certified', 'Inbound Marketing', 'award', '#ff7a59', 3);

-- Aktualizovat services s cenami pro kalkulačku
UPDATE `services` SET `calculator_price` = 8000 WHERE `slug` = 'socialni-site';
UPDATE `services` SET `calculator_price` = 6000 WHERE `slug` = 'meta-ads';
UPDATE `services` SET `calculator_price` = 6000 WHERE `slug` = 'google-ads';
UPDATE `services` SET `calculator_price` = 4000 WHERE `slug` = 'email-marketing';
UPDATE `services` SET `calculator_price` = 8000 WHERE `slug` = 'seo';
UPDATE `services` SET `calculator_price` = 5000 WHERE `slug` = 'tvorba-obsahu';

-- =============================================
-- SocialHero CMS - Page Content Update v4
-- Editovatelné texty pro všechny stránky
-- =============================================

-- Nová tabulka pro obsah stránek
CREATE TABLE IF NOT EXISTS `page_content` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `page` VARCHAR(50) NOT NULL,
    `section` VARCHAR(50) NOT NULL,
    `field` VARCHAR(50) NOT NULL,
    `content` TEXT,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `unique_content` (`page`, `section`, `field`),
    INDEX `idx_page` (`page`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =============================================
-- HOMEPAGE
-- =============================================

-- Hero sekce
INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('home', 'hero', 'badge', 'Přijímáme nové klienty'),
('home', 'hero', 'title', 'Veškerý online marketing v jednom předplatném'),
('home', 'hero', 'subtitle', 'Sociální sítě, Meta Ads, Google Ads, e-mailing a více. Jeden tým, jeden kontakt, měřitelné výsledky.'),
('home', 'hero', 'cta_primary', 'Nezávazná konzultace'),
('home', 'hero', 'cta_secondary', 'Zobrazit ceník'),
('home', 'hero', 'float_1', '+127% tržby'),
('home', 'hero', 'float_2', '+2,400 zákazníků'),
('home', 'hero', 'float_3', 'ROAS 4.2x');

-- Stats sekce - používá globální statistiky (global.stats)

-- Services sekce
INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('home', 'services', 'badge', 'Naše služby'),
('home', 'services', 'title', 'Vše, co potřebujete pro online růst'),
('home', 'services', 'description', 'Kompletní online marketing pod jednou střechou. Od strategie přes realizaci až po reporting.');

-- Process sekce
INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('home', 'process', 'badge', 'Jak to funguje'),
('home', 'process', 'title', 'Cesta k vašemu úspěchu'),
('home', 'process', 'description', 'Od prvního kontaktu po měřitelné výsledky. Jednoduchý a transparentní proces.');

-- Why Us sekce
INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('home', 'whyus', 'badge', 'Proč SocialHero'),
('home', 'whyus', 'title', 'Marketing bez zbytečností'),
('home', 'whyus', 'description', 'Žádné dlouhé smlouvy, skryté poplatky nebo nejasné reporty. Jen měřitelné výsledky.'),
('home', 'whyus', 'item1_title', 'Vše na jednom místě'),
('home', 'whyus', 'item1_text', 'Jeden tým, jeden kontakt. Konec chaosu s více agenturami a freelancery.'),
('home', 'whyus', 'item2_title', 'Transparentní billing'),
('home', 'whyus', 'item2_text', 'Přesně víte, za co platíte. Žádné skryté poplatky ani překvapení ve fakturách.'),
('home', 'whyus', 'item3_title', 'Rychlá odezva'),
('home', 'whyus', 'item3_text', 'Na vaše dotazy odpovídáme do 4 hodin. Urgentní věci řešíme okamžitě.'),
('home', 'whyus', 'item4_title', 'Flexibilita'),
('home', 'whyus', 'item4_text', 'Měsíční předplatné bez dlouhodobých závazků. Můžete kdykoliv změnit nebo zrušit.');

-- Video sekce
INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('home', 'video', 'badge', 'Poznejte nás'),
('home', 'video', 'title', 'Jak pracujeme a kdo jsme'),
('home', 'video', 'placeholder', 'Klikněte pro přehrání videa');

-- Certifications sekce
INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('home', 'certifications', 'badge', 'Certifikace'),
('home', 'certifications', 'title', 'Oficiální partneři a certifikace');

-- Pricing sekce
INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('home', 'pricing', 'badge', 'Ceník'),
('home', 'pricing', 'title', 'Jednoduchý a transparentní'),
('home', 'pricing', 'description', 'Vyberte si balíček podle vašich potřeb. Bez skrytých poplatků, bez dlouhodobých závazků.'),
('home', 'pricing', 'cta', 'Začít s tímto plánem');

-- Testimonials sekce
INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('home', 'testimonials', 'badge', 'Reference'),
('home', 'testimonials', 'title', 'Co říkají naši klienti'),
('home', 'testimonials', 'link', 'Zobrazit všechny reference');

-- FAQ sekce
INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('home', 'faq', 'badge', 'FAQ'),
('home', 'faq', 'title', 'Časté dotazy');

-- CTA sekce
INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('home', 'cta', 'title', 'Připraveni na růst?'),
('home', 'cta', 'description', 'Domluvme si nezávaznou konzultaci. Probereme vaše cíle a navrhneme strategii šitou na míru.'),
('home', 'cta', 'button', 'Domluvit konzultaci zdarma');

-- =============================================
-- O NÁS
-- =============================================

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('about', 'hero', 'badge', 'O nás'),
('about', 'hero', 'title', 'Jsme tým marketingových nadšenců'),
('about', 'hero', 'description', 'Milujeme svou práci a věříme ve výsledky. Ne v dlouhé smlouvy a prázdné sliby.');

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('about', 'story', 'badge', 'Náš příběh'),
('about', 'story', 'title', 'Proč jsme založili SocialHero'),
('about', 'story', 'text', 'Začínali jsme jako malý tým freelancerů, kteří byli frustrovaní z toho, jak fungují tradiční marketingové agentury. Dlouhé smlouvy, nejasné reporty, pomalá komunikace. Věděli jsme, že to jde lépe.\n\nV roce 2019 jsme založili SocialHero s jednoduchou vizí: poskytovat kvalitní marketing bez zbytečností. Žádné složité procesy, žádné skryté poplatky. Jen výsledky.\n\nDnes pomáháme desítkám firem růst online. Od malých e-shopů až po velké B2B společnosti. Každý klient je pro nás výzvou a každý úspěch motivací pokračovat.');

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('about', 'values', 'badge', 'Naše hodnoty'),
('about', 'values', 'title', 'Na čem nám záleží');

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('about', 'team', 'badge', 'Náš tým'),
('about', 'team', 'title', 'Lidé za SocialHero'),
('about', 'team', 'description', 'Malý tým expertů, kteří milují svou práci.');

-- Stats pro O nás používají globální statistiky z home.stats

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('about', 'cta', 'title', 'Pojďme se poznat'),
('about', 'cta', 'description', 'Zavolejte nám nebo napište. Rádi vám povíme více o tom, jak můžeme pomoct vašemu byznysu růst.'),
('about', 'cta', 'button', 'Kontaktovat nás');

-- =============================================
-- KONTAKT
-- =============================================

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('contact', 'hero', 'badge', 'Kontakt'),
('contact', 'hero', 'title', 'Ozvěte se nám'),
('contact', 'hero', 'description', 'Máte dotaz nebo chcete nezávaznou konzultaci? Napište nám nebo zavolejte.');

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('contact', 'form', 'title', 'Napište nám'),
('contact', 'form', 'description', 'Vyplňte formulář a ozveme se vám do 24 hodin.'),
('contact', 'form', 'button', 'Odeslat zprávu');

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('contact', 'info', 'working_hours', 'Po-Pá: 9:00 - 18:00');

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('contact', 'social', 'title', 'Sledujte nás');

-- =============================================
-- SLUŽBY
-- =============================================

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('services', 'hero', 'badge', 'Naše služby'),
('services', 'hero', 'title', 'Kompletní online marketing pod jednou střechou'),
('services', 'hero', 'description', 'Od strategie přes realizaci až po reporting. Vše, co potřebujete pro úspěšný online marketing.');

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('services', 'cta', 'title', 'Nevíte, co potřebujete?'),
('services', 'cta', 'description', 'Nevadí! Zavolejte nám nebo napište a společně najdeme ideální řešení pro váš byznys.'),
('services', 'cta', 'button', 'Domluvit konzultaci zdarma');

-- =============================================
-- REFERENCE
-- =============================================

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('references', 'hero', 'badge', 'Reference'),
('references', 'hero', 'title', 'Výsledky, které mluví za nás'),
('references', 'hero', 'description', 'Podívejte se na výsledky, kterých jsme dosáhli pro naše klienty. Čísla nelžou.');

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('references', 'clients', 'title', 'Důvěřují nám');

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('references', 'cta', 'title', 'Chcete být naší další úspěšnou referencí?'),
('references', 'cta', 'description', 'Pojďme společně vytvořit příběh úspěchu i pro váš byznys.'),
('references', 'cta', 'button', 'Začít spolupráci');

-- =============================================
-- CENÍK
-- =============================================

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('pricing', 'hero', 'badge', 'Ceník'),
('pricing', 'hero', 'title', 'Jednoduchý a transparentní ceník'),
('pricing', 'hero', 'description', 'Žádné skryté poplatky, žádné překvapení. Vyberte si balíček, který vám vyhovuje.');

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('pricing', 'enterprise', 'title', 'Potřebujete více?'),
('pricing', 'enterprise', 'description', 'Pro velké projekty nabízíme individuální řešení na míru.'),
('pricing', 'enterprise', 'button', 'Kontaktovat sales tým');

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('pricing', 'calculator', 'badge', 'Kalkulačka'),
('pricing', 'calculator', 'title', 'Spočítejte si svoji cenu'),
('pricing', 'calculator', 'description', 'Vyberte služby, které potřebujete, a získejte orientační cenu.'),
('pricing', 'calculator', 'result_label', 'Orientační měsíční cena'),
('pricing', 'calculator', 'button', 'Získat přesnou nabídku');

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('pricing', 'addons', 'badge', 'Doplňkové služby'),
('pricing', 'addons', 'title', 'Potřebujete něco navíc?');

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('pricing', 'faq', 'badge', 'Časté dotazy'),
('pricing', 'faq', 'title', 'Máte otázky?');

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('pricing', 'cta', 'title', 'Připraveni začít?'),
('pricing', 'cta', 'description', 'Domluvme si nezávaznou konzultaci. Probereme vaše cíle a doporučíme ideální balíček.'),
('pricing', 'cta', 'button', 'Domluvit konzultaci zdarma');

-- =============================================
-- BLOG
-- =============================================

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('blog', 'hero', 'badge', 'Blog'),
('blog', 'hero', 'title', 'Tipy a novinky ze světa online marketingu'),
('blog', 'hero', 'description', 'Návody, případové studie a nejnovější trendy. Vše, co potřebujete vědět pro úspěšný online marketing.');

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('blog', 'empty', 'title', 'Připravujeme nové články'),
('blog', 'empty', 'description', 'Blog se připravuje. Brzy zde najdete užitečné tipy a návody ze světa online marketingu.');

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('blog', 'newsletter', 'badge', 'Newsletter'),
('blog', 'newsletter', 'title', 'Nechte si posílat novinky'),
('blog', 'newsletter', 'description', 'Jednou měsíčně vám pošleme souhrn nejlepších článků a tipy, jak zlepšit váš online marketing.'),
('blog', 'newsletter', 'button', 'Odebírat'),
('blog', 'newsletter', 'privacy', 'Žádný spam. Odhlásit se můžete kdykoliv.');

-- =============================================
-- GLOBAL (Header, Footer, Cookie)
-- =============================================

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('global', 'header', 'cta', 'Nezávazná konzultace');

-- Globální statistiky (používané na homepage i O nás)
INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('global', 'stats', 'stat1_value', '150+'),
('global', 'stats', 'stat1_label', 'Spokojených klientů'),
('global', 'stats', 'stat2_value', '24h'),
('global', 'stats', 'stat2_label', 'Průměrná odezva'),
('global', 'stats', 'stat3_value', '40%'),
('global', 'stats', 'stat3_label', 'Průměrný nárůst konverzí'),
('global', 'stats', 'stat4_value', '5+'),
('global', 'stats', 'stat4_label', 'Let zkušeností');

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('global', 'footer', 'description', 'Kompletní online marketing v jednom měsíčním předplatném. Sociální sítě, PPC reklama, e-mailing a více.'),
('global', 'footer', 'newsletter_title', 'Odebírejte novinky'),
('global', 'footer', 'newsletter_description', 'Tipy a triky ze světa online marketingu přímo do vašeho inboxu.'),
('global', 'footer', 'copyright', '© [YEAR] SocialHero. Všechna práva vyhrazena.');

INSERT IGNORE INTO `page_content` (`page`, `section`, `field`, `content`) VALUES
('global', 'cookie', 'message', 'Tento web používá cookies pro zlepšení uživatelského zážitku a analýzu návštěvnosti.'),
('global', 'cookie', 'link', 'Více informací'),
('global', 'cookie', 'accept', 'Přijmout'),
('global', 'cookie', 'reject', 'Odmítnout');

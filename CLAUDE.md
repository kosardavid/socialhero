# SocialHero - Projektova dokumentace

## O projektu
Moderni webova prezentace pro marketingovou agenturu SocialHero - online marketing na klic.
Inspirace designem: NinjaPromo.io (tmavy moderni design).

## Pristupove udaje
Vsechny pristupove udaje jsou ulozeny v souboru `.env` (nikdy nepushovat na Git!)

## Struktura projektu
```
socialhero/
├── .claude/              # Konfigurace Claude Code
├── .env                  # Pristupove udaje (FTP, DB) - NEKOPIROVAT
├── .gitignore            # Git ignore pravidla
├── CLAUDE.md             # Tato dokumentace
├── README.md             # Zakladni dokumentace projektu
│
├── public/               # Verejna slozka (document root)
│   ├── index.php         # Hlavni entry point
│   ├── .htaccess         # Apache rewrite pravidla
│   └── assets/
│       ├── css/style.css # Hlavni styly
│       ├── js/main.js    # JavaScript
│       └── images/       # Obrazky
│
├── app/                  # Aplikacni logika (MVC)
│   ├── Core/             # Framework jadro
│   │   ├── App.php       # Hlavni aplikace
│   │   ├── Router.php    # Routing
│   │   ├── View.php      # Sablony
│   │   └── Database.php  # DB wrapper (PDO)
│   ├── Controllers/      # Kontrolery
│   │   ├── HomeController.php   # Homepage
│   │   ├── PageController.php   # Staticke stranky
│   │   └── ContactController.php # Kontaktni formular
│   ├── Models/           # Modely (zatim prazdne)
│   └── Views/            # Sablony
│       ├── layouts/      # Layout soubory
│       ├── pages/        # Stranky (home, services, pricing...)
│       ├── partials/     # Castecne sablony (header, footer)
│       └── errors/       # Chybove stranky
│
├── admin/                # Admin panel
│   ├── index.php         # Admin entry point + routing
│   ├── .htaccess
│   ├── Controllers/
│   │   ├── AuthController.php      # Prihlaseni/odhlaseni
│   │   ├── DashboardController.php # Dashboard se statistikami
│   │   └── ContentController.php   # CRUD pro vsechen obsah
│   ├── Views/            # Admin sablony
│   │   ├── layout.php        # Hlavni layout s menu
│   │   ├── dashboard.php     # Dashboard se statistikami
│   │   ├── login.php         # Prihlaseni
│   │   ├── services.php      # Seznam sluzeb
│   │   ├── service-form.php  # Formular sluzby
│   │   ├── pricing.php       # Seznam ceniku
│   │   ├── pricing-form.php  # Formular ceniku
│   │   ├── faqs.php          # Seznam FAQ
│   │   ├── faq-form.php      # Formular FAQ
│   │   ├── testimonials.php  # Seznam recenzi
│   │   ├── testimonial-form.php
│   │   ├── case-studies.php  # Seznam referenci
│   │   ├── case-study-form.php
│   │   ├── team.php          # Seznam clenu tymu
│   │   ├── team-form.php
│   │   ├── blog.php          # Seznam clanku
│   │   ├── blog-form.php     # Formular s Quill WYSIWYG editorem
│   │   ├── clients.php       # Seznam klientu
│   │   ├── client-form.php
│   │   ├── contacts.php      # Poptavky
│   │   ├── contact-detail.php
│   │   └── settings.php      # Nastaveni webu
│   └── assets/
│       └── css/admin.css # Admin styly
│
├── config/               # Konfigurace
│   ├── app.php           # Nastaveni aplikace
│   └── database.php      # DB konfigurace
│
├── database/             # SQL soubory
│   ├── schema.sql        # Databazove schema
│   ├── update_v2.sql     # Kroky spoluprace, certifikace
│   └── update_v3.sql     # SEO, tracking, kalkulacka
│
└── storage/              # Logy, cache
```

## Technicky stack
- **Backend:** PHP 8.4 (vlastni MVC framework)
- **Frontend:** HTML5, CSS3 (vanilla), JavaScript (vanilla)
- **Databaze:** MariaDB 10.4
- **Hosting:** Wedos
- **Design:** Dark theme, gradientove akcenty, moderni UI
- **WYSIWYG:** Quill editor (pro blog clanky)
- **Ikony:** Feather Icons

## Databazove tabulky
```sql
- admin_users           # Admin uzivatele
- contacts              # Poptavky z kontaktniho formulare
- newsletter_subscribers # Odberatele newsletteru
- services              # Sluzby
- pricing_plans         # Cenove plany
- faqs                  # Casto kladene otazky
- testimonials          # Reference/recenze
- case_studies          # Pripadove studie
- team_members          # Clenove tymu
- blog_posts            # Blog clanky
- clients               # Klienti (loga)
- settings              # Nastaveni webu
- process_steps         # Kroky spoluprace
- certifications        # Certifikace a partnerstvi
- page_seo              # SEO nastaveni pro stranky
- page_content          # Editovatelny obsah stranek (texty, badge, titulky)
```

## Admin panel - funkce

### Dashboard
- Statistiky: poptavky, odberatele, reference
- Prehled obsahu webu (pocty polozek v kazde kategorii)
- Posledni poptavky a odberatele
- Rychle odkazy na jednotlive sekce

### CRUD operace
Kompletni sprava pro:
- **Sluzby** - nazev, slug, ikona, popis, features
- **Cenik** - nazev, cena, obdobi, features, is_featured
- **FAQ** - otazka, odpoved, kategorie
- **Testimonials** - jmeno, firma, pozice, text, hodnoceni
- **Reference** - nazev, klient, vysledky, popis
- **Tym** - jmeno, pozice, bio, kontakt
- **Blog** - nazev, obsah (Quill WYSIWYG), kategorie, SEO
- **Klienti** - nazev, logo, web
- **Kroky spoluprace** - proces jak to funguje
- **Certifikace** - loga partneru a certifikaci

### Specialni funkce
- Quill WYSIWYG editor pro blog clanky
- Flash zpravy (uspech/chyba)
- Aktivace/deaktivace obsahu
- Razeni (sort_order)
- SEO nastaveni pro kazdou stranku
- Tracking & Analytics (GTM, GA4, FB Pixel, Sklik, Ecomail)
- Cenova kalkulacka
- Zmena hesla
- Rate limiting na prihlaseni (5 pokusu, 15 min blokace)
- **Obsah stranek** - editace vsech textu na webu (badge, titulky, popisy)
- **Globalni statistiky** - spolecne pro homepage a O nas (150+, 24h, 40%, 5+)
- **Plovouci tlacitko Ulozit** - na strance Nastaveni je tlacitko fixne dole

## Deployment

### Hosting info
- **Hosting:** Wedos
- **PHP verze:** 8.4
- **FTP cesta:** /domains/socialhero.cz/
- **Databaze:** MariaDB 10.4 na md395.wedos.net

### FTP deploy (curl)
```bash
# Jednotlivy soubor
curl -T soubor.php -u USER:PASS ftp://HOST/domains/socialhero.cz/cesta/soubor.php

# Priklad
curl -T "admin/Views/dashboard.php" -u w387379_kosar:HESLO "ftp://387379.w79.wedos.net/domains/socialhero.cz/admin/Views/dashboard.php"
```

### Inicializace databaze
1. Importovat `database/schema.sql` do phpMyAdmin
2. Spustit updaty: `update_v2.sql`, `update_v3.sql`, `update_v4_page_content.sql`
3. Vytvorit admin uzivatele primo v DB nebo pres registraci

## URL struktura

### Frontend
- `/` - Homepage
- `/sluzby` - Prehled sluzeb
- `/sluzby/{slug}` - Detail sluzby
- `/reference` - Case studies
- `/cenik` - Cenik
- `/o-nas` - O spolecnosti
- `/kontakt` - Kontaktni formular
- `/blog` - Blog

### Admin panel
- `/admin` - Dashboard
- `/admin/contacts` - Poptavky
- `/admin/services` - Sluzby
- `/admin/pricing` - Cenik
- `/admin/faqs` - FAQ
- `/admin/testimonials` - Recenze
- `/admin/case-studies` - Reference
- `/admin/team` - Tym
- `/admin/blog` - Blog
- `/admin/clients` - Klienti
- `/admin/process-steps` - Kroky spoluprace
- `/admin/certifications` - Certifikace
- `/admin/page-content` - Obsah stranek (texty)
- `/admin/page-seo` - SEO stranky
- `/admin/settings` - Nastaveni

## GitHub
- **Repozitar:** https://github.com/kosardavid/socialhero

## SEO & Optimalizace (pridano 10.12.2025)

### Implementovano
- **robots.txt** - povoleni crawleru, blokovani /admin/ a /api/
- **sitemap.xml** - 7 hlavnich stranek
- **JSON-LD** - strukturovana data pro MarketingAgency
- **Canonical URL** - v hlavicce kazde stranky
- **Font preload** - optimalizace nacitani Google Fonts
- **Lazy loading** - pro obrazky
- **HTTPS redirect** - vynuceny v .htaccess
- **Cookie consent banner** - GDPR kompatibilni, ulozeni do localStorage
- **Responzivni design** - opraveno pro mobily (cookie banner, toast, newsletter form)

## Frontend animace

### Stats Counter
- Animovane pocitadlo statistik (150+, 24h, 40%, 5+)
- Spusti se pri scrollu na sekci (IntersectionObserver, threshold 0.3)
- Podporuje formaty: cisla, procenta, hodiny (24h), plus suffix

### Process Timeline
- Kroky "Cesta k uspechu" se zobrazuji postupne zleva doprava
- Animace se spusti az pri scrollu na 70% sekce (threshold 0.7)
- Kazdy krok ma 400ms zpozdeni vuci predchozimu

### Phone Mockup Slider (Reels Showcase)
- Sekce "Ukazka prace" s 3 telefony zobrazujicimi videa/YouTube shorts
- **Desktop:** 3 telefony vedle sebe s 3D transformaci (levy/pravy naklonene, prostredni vetsi)
- **Mobil (do 768px):** Slider s jednim telefonem, navigacni sipky a tecky
- Lazy loading videi - spusti se az pri 50% viditelnosti sekce (IntersectionObserver)
- Touch swipe podpora pro mobilni zarizeni
- Konfigurace v admin panelu: Nastaveni > Reels Showcase (video/youtube/image/text)
- YouTube shorts se automaticky zvetsují na 180% sirky pro oriznutí cernych pruhu

### Soubory na serveru
```
/domains/socialhero.cz/
├── .htaccess          # Bezpecnostni pravidla (root)
├── robots.txt         # SEO
├── sitemap.xml        # SEO
├── index.php          # Hlavni entry point
├── assets/            # Staticke soubory (CSS, JS, images)
├── app/               # MVC aplikace
├── admin/             # Admin panel
├── config/            # Konfigurace
└── database/          # SQL soubory
```

## Zname problemy

### OPcache na Wedosu
- Wedos ma agresivni OPcache (5+ minut)
- Zmeny v PHP souborech se neprojevi okamzite
- Reseni: pockat nebo restartovat PHP pres admin panel

## Dulezite poznamky

### Bezpecnost
- `.env` soubor NIKDY nepushovat na Git!
- Admin heslo zmenit po prvnim prihlaseni!
- Rate limiting: 5 neuspesnych pokusu = 15 min blokace
- Citlive slozky chraneny .htaccess (app/, config/, database/, admin/Controllers/, admin/Views/)

### Vyvoj
- Pro lokalni vyvoj: `php -S localhost:8000 -t public`
- Pred deployem vzdy otestovat lokalne
- Pristupove udaje nacirat z `.env` souboru

### Frontend nacitani dat
- Vsechny stranky nacitaji data z databaze
- Pokud je tabulka prazdna, pouziji se fallback data (krome blogu)
- Blog zobrazuje "Pripravujeme clanky" pokud neni zadny clanek v DB
- Fallback data jsou v `PageController.php` (getDefaultServices, getDefaultPricing, atd.)

## Wedos server struktura
```
/ (root - DocumentRoot pro www)
├── .htaccess          # Presmerovani na domain folder
├── index.php          # Include domains/socialhero.cz/index.php
├── robots.txt
├── sitemap.xml
└── domains/
    └── socialhero.cz/
        ├── .htaccess  # Bezpecnost a routing
        ├── index.php  # Hlavni aplikace
        ├── .env       # Pristupove udaje
        ├── assets/    # CSS, JS, images
        ├── app/       # MVC framework
        ├── admin/     # Admin panel
        ├── config/    # Konfigurace
        └── database/  # SQL soubory
```

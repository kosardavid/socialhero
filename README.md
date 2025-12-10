# SocialHero

Moderni webova prezentace pro marketingovou agenturu - online marketing na klic.

## Demo

- **Web:** https://socialhero.cz/
- **Admin:** https://socialhero.cz/admin/

## Funkce

### Frontend
- Responzivni dark design
- Stranky: Homepage, Sluzby, Cenik, Reference, O nas, Kontakt, Blog
- Kontaktni formular s ukladanim do DB
- Newsletter prihlaseni
- SEO optimalizovano
- Cenova kalkulacka
- Video sekce (YouTube)
- Live chat (Tawk.to integrace)

### Admin Panel
- Dashboard se statistikami
- Kompletni CRUD pro vsechen obsah:
  - Sluzby
  - Cenik
  - FAQ
  - Testimonials
  - Reference (case studies)
  - Tym
  - Blog (s WYSIWYG editorem Quill)
  - Klienti
  - Kroky spoluprace (proces)
  - Certifikace
- Sprava poptavek
- **SEO nastaveni pro kazdou stranku**
- **Tracking & Analytics:**
  - Google Tag Manager
  - Google Analytics 4
  - Google Ads
  - Facebook Pixel
  - Seznam Sklik
  - Ecomail
  - Vlastni HEAD/BODY skripty
- Nastaveni webu (kontakty, socialni site, kalkulacka)

## Tech Stack

- **Backend:** PHP 8.2 (vlastni MVC)
- **Frontend:** HTML5, CSS3, Vanilla JS
- **Databaze:** MariaDB 10.4
- **WYSIWYG:** Quill Editor
- **Ikony:** Feather Icons
- **Live Chat:** Tawk.to

## Instalace

1. Naklonovat repozitar
2. Zkopirovat `.env.example` na `.env` a vyplnit udaje
3. Importovat `database/schema.sql`
4. Spustit updaty: `database/update_v2.sql`, `database/update_v3.sql`
5. Spustit seed: `/admin/seed.php?key=socialhero2025seed`

## Databazove updaty

- **update_v2.sql** - Kroky spoluprace, certifikace
- **update_v3.sql** - SEO stranky, tracking nastaveni, kalkulacka

## Struktura

```
socialhero/
├── admin/              # Admin panel
│   ├── Controllers/    # Admin controllery
│   ├── Views/          # Admin sablony
│   └── assets/         # Admin CSS/JS
├── app/                # MVC aplikace
│   ├── Core/           # Framework (App, Router, Database, View)
│   ├── Controllers/    # Frontend controllery
│   └── Views/          # Frontend sablony
├── config/             # Konfigurace
├── database/           # SQL schema a updaty
└── public/             # Verejne soubory (CSS, JS, images)
```

## Roadmap (planovane funkce)

- [ ] Newsletter subscribers - sprava prihlasenychemailu, export CSV
- [ ] Media knihovna - upload a sprava obrazku
- [ ] Statistiky a reporting - graf navstevnosti, konverze
- [ ] Sitemap.xml a robots.txt - automaticke generovani
- [ ] Zalohy - export/import databaze
- [ ] Vice uzivatelu - role (admin/editor), log aktivit
- [ ] Blog rozsireni - kategorie, tagy, komentare, planovane publikovani
- [ ] Kontaktni formular - vice typu, auto-reply email
- [ ] Pop-up / Banner - akcni nabidky, cookie consent
- [ ] Vicejazycnost - CZ/EN verze

## Licence

Proprietary - David Kosar

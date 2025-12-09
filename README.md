# SocialHero

Moderni webova prezentace pro marketingovou agenturu - online marketing na klic.

## Demo

- **Web:** https://socialhero.cz/new/
- **Admin:** https://socialhero.cz/new/admin/

## Funkce

### Frontend
- Responzivni dark design
- Stranky: Homepage, Sluzby, Cenik, Reference, O nas, Kontakt, Blog
- Kontaktni formular s ukladanim do DB
- Newsletter prihlaseni
- SEO optimalizovano

### Admin Panel
- Dashboard se statistikami
- Kompletni CRUD pro vsechen obsah:
  - Sluzby
  - Cenik
  - FAQ
  - Testimonials
  - Reference (case studies)
  - Tym
  - Blog (s WYSIWYG editorem)
  - Klienti
- Sprava poptavek
- Nastaveni webu

## Tech Stack

- **Backend:** PHP 8.2 (vlastni MVC)
- **Frontend:** HTML5, CSS3, Vanilla JS
- **Databaze:** MariaDB 10.4
- **WYSIWYG:** Quill Editor
- **Ikony:** Feather Icons

## Instalace

1. Naklonovat repozitar
2. Zkopirovat `.env.example` na `.env` a vyplnit udaje
3. Importovat `database/schema.sql`
4. Spustit seed: `/admin/seed.php?key=socialhero2025seed`

## Struktura

```
socialhero/
├── admin/          # Admin panel
├── app/            # MVC aplikace
│   ├── Core/       # Framework
│   ├── Controllers/
│   └── Views/
├── config/         # Konfigurace
├── database/       # SQL schema
└── public/         # Verejne soubory
```

## Licence

Proprietary - David Kosar

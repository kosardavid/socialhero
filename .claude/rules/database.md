---
paths: database/**/*.sql, app/Core/Database.php, admin/Controllers/**/*.php
---

# Databaze pravidla

## Pripojeni
- Server: md395.wedos.net
- Typ: MariaDB 10.4
- Konfigurace v `.env` (nikdy nepushovat!)

## Hlavni tabulky
- admin_users - admin uzivatele
- contacts - poptavky z formulare
- settings - nastaveni webu (key-value)
- services, pricing_plans, faqs - obsah
- testimonials, case_studies, team_members - reference
- blog_posts - clanky s WYSIWYG
- process_steps - kroky spoluprace
- page_content - editovatelne texty stranek

## CRUD operace
- Insert: `Database::insert('table', $data)`
- Update: `Database::update('table', $data, 'id = ?', [$id])`
- Delete: `Database::delete('table', 'id = ?', [$id])`
- Select: `Database::fetchAll($sql, $params)`

## Bezpecnost
- Vzdy pouzivat prepared statements
- Nikdy nekonkatenovat SQL s user inputem

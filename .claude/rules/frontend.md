---
paths: public/**/*.css, public/**/*.js, app/Views/**/*.php
---

# Frontend pravidla

## JavaScript kompatibilita
- Psat v ES5 syntaxi pro mobilni kompatibilitu (var misto const/let, function misto arrow)
- IntersectionObserver vzdy s fallbackem na scroll listener
- Vzdy pridat timeout fallback (2s) pro pripad selhani

## Animace
- Stats counter: animate cisla od 0 k cili
- Process timeline: kroky se zobrazuji postupne zleva doprava
- Animace nastavovat pres inline styly v JS (ne CSS tridy) - spolehlivejsi

## Mobile-first
- Breakpoint: 768px
- Phone slider na mobilu, 3 telefony na desktopu
- Touch swipe podpora

## Settings z DB
- Pouzivat `\App\Core\View::setting('key', 'default')`
- Obsah stranek: `\App\Core\View::content('page', 'section', 'field', 'default')`

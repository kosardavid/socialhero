# Deployment pravidla

## FTP Upload
- Host: ftp://387379.w79.wedos.net
- User: w387379_kosar
- Cesta: /domains/socialhero.cz/

## Upload prikaz
```bash
curl -s -T "soubor" -u "w387379_kosar:HESLO" "ftp://387379.w79.wedos.net/domains/socialhero.cz/cesta/soubor"
```

## Cache busting
- CSS/JS maji verzi v URL: `?v=20251211c`
- Pri zmene CSS/JS aktualizovat verzi v `app/Views/layouts/main.php`

## OPcache
- Wedos ma agresivni cache (5+ minut)
- Zmeny v PHP se neprojevi okamzite
- Reseni: pockat nebo restartovat PHP v admin panelu

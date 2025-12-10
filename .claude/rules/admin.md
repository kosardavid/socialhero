---
paths: admin/**/*.php
---

# Admin panel pravidla

## Struktura
- Entry point: admin/index.php (routing)
- Layout: admin/Views/layout.php
- Styly: admin/assets/css/admin.css

## Controllers
- AuthController - prihlaseni/odhlaseni, rate limiting
- DashboardController - statistiky
- ContentController - CRUD pro vsechen obsah

## Views konvence
- Seznam: {entity}.php (services.php, pricing.php)
- Formular: {entity}-form.php (service-form.php)
- Detail: {entity}-detail.php

## Flash zpravy
```php
$_SESSION['flash_success'] = 'Ulozeno';
$_SESSION['flash_error'] = 'Chyba';
```

## Nastaveni stranky
- Plovouci tlacitko Ulozit: `form-actions--floating`
- Extra padding pro floating: `main-body--has-floating-actions`

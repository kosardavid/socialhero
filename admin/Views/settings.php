<?php
$pageTitle = 'Nastavení';
$currentPage = 'settings';

ob_start();
?>

<form method="POST" action="/new/admin/settings">
    <div class="card">
        <div class="card__header">
            <h3>Obecné nastavení</h3>
        </div>
        <div class="card__body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Název webu</label>
                    <input type="text" name="site_name" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['site_name'] ?? 'SocialHero') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Popis webu</label>
                    <input type="text" name="site_description" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['site_description'] ?? '') ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__header">
            <h3>Kontaktní údaje</h3>
        </div>
        <div class="card__body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">E-mail</label>
                    <input type="email" name="contact_email" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['contact_email'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Telefon</label>
                    <input type="text" name="contact_phone" class="form-input"
                           value="<?= htmlspecialchars($settingsArray['contact_phone'] ?? '') ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Adresa</label>
                <input type="text" name="contact_address" class="form-input"
                       value="<?= htmlspecialchars($settingsArray['contact_address'] ?? '') ?>">
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__header">
            <h3>Sociální sítě</h3>
        </div>
        <div class="card__body">
            <div class="form-group">
                <label class="form-label">Facebook URL</label>
                <input type="url" name="social_facebook" class="form-input"
                       value="<?= htmlspecialchars($settingsArray['social_facebook'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Instagram URL</label>
                <input type="url" name="social_instagram" class="form-input"
                       value="<?= htmlspecialchars($settingsArray['social_instagram'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label class="form-label">LinkedIn URL</label>
                <input type="url" name="social_linkedin" class="form-input"
                       value="<?= htmlspecialchars($settingsArray['social_linkedin'] ?? '') ?>">
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn--primary">
            <i data-feather="save"></i>
            Uložit nastavení
        </button>
    </div>
</form>

<?php
$content = ob_get_clean();
require ADMIN_PATH . '/Views/layout.php';
?>

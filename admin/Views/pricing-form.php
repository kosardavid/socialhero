<?php
$pageTitle = $plan ? 'Upravit cenový plán' : 'Nový cenový plán';
$currentPage = 'pricing';
ob_start();
$features = $plan ? implode("\n", json_decode($plan['features'] ?? '[]', true) ?: []) : '';
?>

<div class="content-header">
    <div class="content-header__left">
        <a href="/admin/pricing" class="btn btn--secondary btn--small">
            <i data-feather="arrow-left"></i> Zpět
        </a>
    </div>
</div>

<form method="POST" class="form">
    <div class="card">
        <div class="card__header">
            <h3>Základní informace</h3>
        </div>
        <div class="card__body">
            <div class="form-row">
                <div class="form-group form-group--half">
                    <label for="name">Název plánu *</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($plan['name'] ?? $_POST['name'] ?? '') ?>" required placeholder="např. Start, Growth, Scale">
                </div>
                <div class="form-group form-group--half">
                    <label for="slug">URL slug</label>
                    <input type="text" id="slug" name="slug" value="<?= htmlspecialchars($plan['slug'] ?? $_POST['slug'] ?? '') ?>" placeholder="automaticky z názvu">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group form-group--third">
                    <label for="price">Cena (Kč) *</label>
                    <input type="number" id="price" name="price" value="<?= $plan['price'] ?? $_POST['price'] ?? '' ?>" required min="0" step="1">
                </div>
                <div class="form-group form-group--third">
                    <label for="period">Období</label>
                    <input type="text" id="period" name="period" value="<?= htmlspecialchars($plan['period'] ?? $_POST['period'] ?? 'měsíčně') ?>">
                </div>
                <div class="form-group form-group--third">
                    <label for="hours">Hodiny</label>
                    <input type="text" id="hours" name="hours" value="<?= htmlspecialchars($plan['hours'] ?? $_POST['hours'] ?? '') ?>" placeholder="např. 20 hodin">
                </div>
            </div>

            <div class="form-group">
                <label for="description">Popis</label>
                <input type="text" id="description" name="description" value="<?= htmlspecialchars($plan['description'] ?? $_POST['description'] ?? '') ?>" placeholder="např. Pro začínající firmy">
            </div>

            <div class="form-group">
                <label for="features">Vlastnosti (každá na nový řádek)</label>
                <textarea id="features" name="features" rows="8" placeholder="Správa 2 sociálních sítí&#10;8 příspěvků měsíčně&#10;Základní reporting"><?= htmlspecialchars($features) ?></textarea>
            </div>

            <div class="form-group">
                <label for="sort_order">Pořadí</label>
                <input type="number" id="sort_order" name="sort_order" value="<?= $plan['sort_order'] ?? $_POST['sort_order'] ?? 0 ?>">
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__body">
            <div class="form-group">
                <label class="checkbox">
                    <input type="checkbox" name="is_featured" value="1" <?= ($plan['is_featured'] ?? false) ? 'checked' : '' ?>>
                    <span>Doporučený plán (zvýrazněný)</span>
                </label>
            </div>
            <div class="form-group">
                <label class="checkbox">
                    <input type="checkbox" name="is_active" value="1" <?= ($plan['is_active'] ?? true) ? 'checked' : '' ?>>
                    <span>Aktivní (zobrazit na webu)</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn--primary">
                    <i data-feather="save"></i> Uložit
                </button>
                <a href="/admin/pricing" class="btn btn--secondary">Zrušit</a>
            </div>
        </div>
    </div>
</form>

<?php
$content = ob_get_clean();
require ADMIN_PATH . '/Views/layout.php';
?>

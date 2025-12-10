<?php
$pageTitle = $service ? 'Upravit službu' : 'Nová služba';
$currentPage = 'services';
ob_start();
$features = $service ? implode("\n", json_decode($service['features'] ?? '[]', true) ?: []) : '';
?>

<div class="content-header">
    <div class="content-header__left">
        <a href="/admin/services" class="btn btn--secondary btn--small">
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
                    <label for="title">Název služby *</label>
                    <input type="text" id="title" name="title" value="<?= htmlspecialchars($service['title'] ?? $_POST['title'] ?? '') ?>" required>
                </div>
                <div class="form-group form-group--half">
                    <label for="slug">URL slug</label>
                    <input type="text" id="slug" name="slug" value="<?= htmlspecialchars($service['slug'] ?? $_POST['slug'] ?? '') ?>" placeholder="automaticky z názvu">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group form-group--half">
                    <label for="icon">Ikona (Feather Icons)</label>
                    <input type="text" id="icon" name="icon" value="<?= htmlspecialchars($service['icon'] ?? $_POST['icon'] ?? 'box') ?>" placeholder="např. share-2, target, search">
                    <small class="form-hint">Seznam ikon: <a href="https://feathericons.com/" target="_blank">feathericons.com</a></small>
                </div>
                <div class="form-group form-group--half">
                    <label for="sort_order">Pořadí</label>
                    <input type="number" id="sort_order" name="sort_order" value="<?= $service['sort_order'] ?? $_POST['sort_order'] ?? 0 ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="short_description">Krátký popis</label>
                <input type="text" id="short_description" name="short_description" value="<?= htmlspecialchars($service['short_description'] ?? $_POST['short_description'] ?? '') ?>" maxlength="255">
            </div>

            <div class="form-group">
                <label for="description">Detailní popis</label>
                <textarea id="description" name="description" rows="5"><?= htmlspecialchars($service['description'] ?? $_POST['description'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="features">Vlastnosti (každá na nový řádek)</label>
                <textarea id="features" name="features" rows="6" placeholder="Tvorba obsahové strategie&#10;Pravidelné příspěvky&#10;Community management"><?= htmlspecialchars($features) ?></textarea>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__header">
            <h3>SEO</h3>
        </div>
        <div class="card__body">
            <div class="form-group">
                <label for="meta_title">Meta titulek</label>
                <input type="text" id="meta_title" name="meta_title" value="<?= htmlspecialchars($service['meta_title'] ?? $_POST['meta_title'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="meta_description">Meta popis</label>
                <textarea id="meta_description" name="meta_description" rows="2"><?= htmlspecialchars($service['meta_description'] ?? $_POST['meta_description'] ?? '') ?></textarea>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__body">
            <div class="form-group">
                <label class="checkbox">
                    <input type="checkbox" name="is_active" value="1" <?= ($service['is_active'] ?? true) ? 'checked' : '' ?>>
                    <span>Aktivní (zobrazit na webu)</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn--primary">
                    <i data-feather="save"></i> Uložit
                </button>
                <a href="/admin/services" class="btn btn--secondary">Zrušit</a>
            </div>
        </div>
    </div>
</form>

<?php
$content = ob_get_clean();
require ADMIN_PATH . '/Views/layout.php';
?>

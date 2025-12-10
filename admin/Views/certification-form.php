<?php
$pageTitle = $item ? 'Upravit certifikaci' : 'Nová certifikace';
$currentPage = 'certifications';
ob_start();
?>

<div class="content-header">
    <div class="content-header__left">
        <a href="/admin/certifications" class="btn btn--secondary btn--small">
            <i data-feather="arrow-left"></i> Zpět
        </a>
    </div>
</div>

<form method="POST" class="form">
    <div class="card">
        <div class="card__header">
            <h3>Certifikace / Partnerství</h3>
        </div>
        <div class="card__body">
            <div class="form-group">
                <label for="name">Název *</label>
                <input type="text" id="name" name="name"
                       value="<?= htmlspecialchars($item['name'] ?? $_POST['name'] ?? '') ?>"
                       required placeholder="např. Google Partner">
            </div>

            <div class="form-group">
                <label for="description">Popis / Status</label>
                <input type="text" id="description" name="description"
                       value="<?= htmlspecialchars($item['description'] ?? $_POST['description'] ?? '') ?>"
                       placeholder="např. Certifikovaná agentura">
            </div>

            <div class="form-row">
                <div class="form-group form-group--half">
                    <label for="icon">Ikona (Feather Icons)</label>
                    <input type="text" id="icon" name="icon"
                           value="<?= htmlspecialchars($item['icon'] ?? $_POST['icon'] ?? 'award') ?>"
                           placeholder="např. award, shield, star">
                    <small class="text-muted">
                        <a href="https://feathericons.com/" target="_blank">Seznam ikon</a>
                    </small>
                </div>
                <div class="form-group form-group--half">
                    <label for="color">Barva (HEX)</label>
                    <div style="display: flex; gap: 0.5rem; align-items: center;">
                        <input type="color" id="color_picker" style="width: 50px; height: 38px; border: none; cursor: pointer;"
                               value="<?= htmlspecialchars($item['color'] ?? '#7c3aed') ?>"
                               onchange="document.getElementById('color').value = this.value">
                        <input type="text" id="color" name="color"
                               value="<?= htmlspecialchars($item['color'] ?? $_POST['color'] ?? '#7c3aed') ?>"
                               placeholder="#7c3aed" style="flex: 1;">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group form-group--half">
                    <label for="url">URL (volitelné)</label>
                    <input type="url" id="url" name="url"
                           value="<?= htmlspecialchars($item['url'] ?? $_POST['url'] ?? '') ?>"
                           placeholder="https://...">
                </div>
                <div class="form-group form-group--half">
                    <label for="sort_order">Pořadí</label>
                    <input type="number" id="sort_order" name="sort_order"
                           value="<?= $item['sort_order'] ?? $_POST['sort_order'] ?? 0 ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__body">
            <div class="form-group">
                <label class="checkbox">
                    <input type="checkbox" name="is_active" value="1"
                           <?= ($item['is_active'] ?? true) ? 'checked' : '' ?>>
                    <span>Aktivní (zobrazit na webu)</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn--primary">
                    <i data-feather="save"></i> Uložit
                </button>
                <a href="/admin/certifications" class="btn btn--secondary">Zrušit</a>
            </div>
        </div>
    </div>
</form>

<?php
$content = ob_get_clean();
require ADMIN_PATH . '/Views/layout.php';
?>

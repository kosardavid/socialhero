<?php
$pageTitle = $item ? 'Upravit krok' : 'Nový krok';
$currentPage = 'process-steps';
ob_start();
?>

<div class="content-header">
    <div class="content-header__left">
        <a href="/new/admin/process-steps" class="btn btn--secondary btn--small">
            <i data-feather="arrow-left"></i> Zpět
        </a>
    </div>
</div>

<form method="POST" class="form">
    <div class="card">
        <div class="card__header">
            <h3>Krok spolupráce</h3>
        </div>
        <div class="card__body">
            <div class="form-group">
                <label for="title">Název kroku *</label>
                <input type="text" id="title" name="title"
                       value="<?= htmlspecialchars($item['title'] ?? $_POST['title'] ?? '') ?>"
                       required placeholder="např. Nezávazná konzultace">
            </div>

            <div class="form-group">
                <label for="description">Popis</label>
                <textarea id="description" name="description" rows="3"
                          placeholder="Krátký popis tohoto kroku..."><?= htmlspecialchars($item['description'] ?? $_POST['description'] ?? '') ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group form-group--half">
                    <label for="icon">Ikona (Feather Icons)</label>
                    <input type="text" id="icon" name="icon"
                           value="<?= htmlspecialchars($item['icon'] ?? $_POST['icon'] ?? 'check') ?>"
                           placeholder="např. message-circle, file-text, play-circle">
                    <small class="text-muted">
                        <a href="https://feathericons.com/" target="_blank">Seznam ikon</a>
                    </small>
                </div>
                <div class="form-group form-group--half">
                    <label for="sort_order">Pořadí (číslo kroku)</label>
                    <input type="number" id="sort_order" name="sort_order"
                           value="<?= $item['sort_order'] ?? $_POST['sort_order'] ?? 1 ?>" min="1">
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
                <a href="/new/admin/process-steps" class="btn btn--secondary">Zrušit</a>
            </div>
        </div>
    </div>
</form>

<?php
$content = ob_get_clean();
require ADMIN_PATH . '/Views/layout.php';
?>

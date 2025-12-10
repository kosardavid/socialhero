<?php
$pageTitle = $client ? 'Upravit klienta' : 'Nový klient';
$currentPage = 'clients';
ob_start();
?>

<div class="content-header">
    <div class="content-header__left">
        <a href="/admin/clients" class="btn btn--secondary btn--small">
            <i data-feather="arrow-left"></i> Zpět
        </a>
    </div>
</div>

<form method="POST" class="form">
    <div class="card">
        <div class="card__header">
            <h3>Klient</h3>
        </div>
        <div class="card__body">
            <div class="form-group">
                <label for="name">Název firmy *</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($client['name'] ?? $_POST['name'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="logo">URL loga</label>
                <input type="url" id="logo" name="logo" value="<?= htmlspecialchars($client['logo'] ?? $_POST['logo'] ?? '') ?>" placeholder="https://...">
            </div>

            <div class="form-group">
                <label for="website">Webové stránky</label>
                <input type="url" id="website" name="website" value="<?= htmlspecialchars($client['website'] ?? $_POST['website'] ?? '') ?>" placeholder="https://...">
            </div>

            <div class="form-group">
                <label for="sort_order">Pořadí</label>
                <input type="number" id="sort_order" name="sort_order" value="<?= $client['sort_order'] ?? $_POST['sort_order'] ?? 0 ?>">
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__body">
            <div class="form-group">
                <label class="checkbox">
                    <input type="checkbox" name="is_active" value="1" <?= ($client['is_active'] ?? true) ? 'checked' : '' ?>>
                    <span>Aktivní (zobrazit na webu)</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn--primary">
                    <i data-feather="save"></i> Uložit
                </button>
                <a href="/admin/clients" class="btn btn--secondary">Zrušit</a>
            </div>
        </div>
    </div>
</form>

<?php
$content = ob_get_clean();
require ADMIN_PATH . '/Views/layout.php';
?>

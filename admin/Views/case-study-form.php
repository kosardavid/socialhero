<?php
$pageTitle = $caseStudy ? 'Upravit referenci' : 'Nová reference';
$currentPage = 'case-studies';
ob_start();
?>

<div class="content-header">
    <div class="content-header__left">
        <a href="/admin/case-studies" class="btn btn--secondary btn--small">
            <i data-feather="arrow-left"></i> Zpět
        </a>
    </div>
</div>

<form method="POST" class="form">
    <div class="card">
        <div class="card__header">
            <h3>Reference / Case Study</h3>
        </div>
        <div class="card__body">
            <div class="form-group">
                <label for="title">Název projektu *</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($caseStudy['title'] ?? $_POST['title'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="slug">URL slug</label>
                <input type="text" id="slug" name="slug" value="<?= htmlspecialchars($caseStudy['slug'] ?? $_POST['slug'] ?? '') ?>" placeholder="automaticky z názvu">
            </div>

            <div class="form-row">
                <div class="form-group form-group--half">
                    <label for="client_name">Jméno klienta *</label>
                    <input type="text" id="client_name" name="client_name" value="<?= htmlspecialchars($caseStudy['client_name'] ?? $_POST['client_name'] ?? '') ?>" required>
                </div>
                <div class="form-group form-group--half">
                    <label for="category">Kategorie</label>
                    <input type="text" id="category" name="category" value="<?= htmlspecialchars($caseStudy['category'] ?? $_POST['category'] ?? '') ?>" placeholder="např. E-commerce, B2B">
                </div>
            </div>

            <div class="form-group">
                <label for="description">Krátký popis</label>
                <textarea id="description" name="description" rows="3"><?= htmlspecialchars($caseStudy['description'] ?? $_POST['description'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="challenge">Výzva / Problém</label>
                <textarea id="challenge" name="challenge" rows="4"><?= htmlspecialchars($caseStudy['challenge'] ?? $_POST['challenge'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="solution">Řešení</label>
                <textarea id="solution" name="solution" rows="4"><?= htmlspecialchars($caseStudy['solution'] ?? $_POST['solution'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="results">Výsledky (JSON formát)</label>
                <textarea id="results" name="results" rows="4" placeholder='[{"label": "Nárůst konverzí", "value": "+150%"}]'><?= htmlspecialchars($caseStudy['results'] ?? $_POST['results'] ?? '') ?></textarea>
                <small class="text-muted">Formát: [{"label": "Popis", "value": "Hodnota"}, ...]</small>
            </div>

            <div class="form-row">
                <div class="form-group form-group--half">
                    <label for="featured_image">URL hlavního obrázku</label>
                    <input type="url" id="featured_image" name="featured_image" value="<?= htmlspecialchars($caseStudy['featured_image'] ?? $_POST['featured_image'] ?? '') ?>">
                </div>
                <div class="form-group form-group--half">
                    <label for="client_logo">URL loga klienta</label>
                    <input type="url" id="client_logo" name="client_logo" value="<?= htmlspecialchars($caseStudy['client_logo'] ?? $_POST['client_logo'] ?? '') ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="sort_order">Pořadí</label>
                <input type="number" id="sort_order" name="sort_order" value="<?= $caseStudy['sort_order'] ?? $_POST['sort_order'] ?? 0 ?>">
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__body">
            <div class="form-group">
                <label class="checkbox">
                    <input type="checkbox" name="is_featured" value="1" <?= ($caseStudy['is_featured'] ?? false) ? 'checked' : '' ?>>
                    <span>Zvýrazněná reference (zobrazit na homepage)</span>
                </label>
            </div>

            <div class="form-group">
                <label class="checkbox">
                    <input type="checkbox" name="is_published" value="1" <?= ($caseStudy['is_published'] ?? true) ? 'checked' : '' ?>>
                    <span>Publikováno</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn--primary">
                    <i data-feather="save"></i> Uložit
                </button>
                <a href="/admin/case-studies" class="btn btn--secondary">Zrušit</a>
            </div>
        </div>
    </div>
</form>

<?php
$content = ob_get_clean();
require ADMIN_PATH . '/Views/layout.php';
?>

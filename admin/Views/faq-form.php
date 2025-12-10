<?php
$pageTitle = $faq ? 'Upravit FAQ' : 'Nové FAQ';
$currentPage = 'faqs';
ob_start();
?>

<div class="content-header">
    <div class="content-header__left">
        <a href="/admin/faqs" class="btn btn--secondary btn--small">
            <i data-feather="arrow-left"></i> Zpět
        </a>
    </div>
</div>

<form method="POST" class="form">
    <div class="card">
        <div class="card__header">
            <h3>FAQ</h3>
        </div>
        <div class="card__body">
            <div class="form-group">
                <label for="question">Otázka *</label>
                <input type="text" id="question" name="question" value="<?= htmlspecialchars($faq['question'] ?? $_POST['question'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="answer">Odpověď *</label>
                <textarea id="answer" name="answer" rows="5" required><?= htmlspecialchars($faq['answer'] ?? $_POST['answer'] ?? '') ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group form-group--half">
                    <label for="category">Kategorie</label>
                    <input type="text" id="category" name="category" value="<?= htmlspecialchars($faq['category'] ?? $_POST['category'] ?? '') ?>" placeholder="např. Platby, Služby">
                </div>
                <div class="form-group form-group--half">
                    <label for="sort_order">Pořadí</label>
                    <input type="number" id="sort_order" name="sort_order" value="<?= $faq['sort_order'] ?? $_POST['sort_order'] ?? 0 ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__body">
            <div class="form-group">
                <label class="checkbox">
                    <input type="checkbox" name="is_active" value="1" <?= ($faq['is_active'] ?? true) ? 'checked' : '' ?>>
                    <span>Aktivní (zobrazit na webu)</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn--primary">
                    <i data-feather="save"></i> Uložit
                </button>
                <a href="/admin/faqs" class="btn btn--secondary">Zrušit</a>
            </div>
        </div>
    </div>
</form>

<?php
$content = ob_get_clean();
require ADMIN_PATH . '/Views/layout.php';
?>

<?php
$pageTitle = $testimonial ? 'Upravit testimonial' : 'Nový testimonial';
$currentPage = 'testimonials';
ob_start();
?>

<div class="content-header">
    <div class="content-header__left">
        <a href="/admin/testimonials" class="btn btn--secondary btn--small">
            <i data-feather="arrow-left"></i> Zpět
        </a>
    </div>
</div>

<form method="POST" class="form">
    <div class="card">
        <div class="card__header">
            <h3>Testimonial</h3>
        </div>
        <div class="card__body">
            <div class="form-row">
                <div class="form-group form-group--half">
                    <label for="name">Jméno autora *</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($testimonial['name'] ?? $_POST['name'] ?? '') ?>" required>
                </div>
                <div class="form-group form-group--half">
                    <label for="position">Pozice</label>
                    <input type="text" id="position" name="position" value="<?= htmlspecialchars($testimonial['position'] ?? $_POST['position'] ?? '') ?>" placeholder="např. CEO, Marketing Manager">
                </div>
            </div>

            <div class="form-group">
                <label for="company">Firma</label>
                <input type="text" id="company" name="company" value="<?= htmlspecialchars($testimonial['company'] ?? $_POST['company'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="text">Text testimonialu *</label>
                <textarea id="text" name="text" rows="5" required><?= htmlspecialchars($testimonial['text'] ?? $_POST['text'] ?? '') ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group form-group--half">
                    <label for="rating">Hodnocení</label>
                    <select id="rating" name="rating">
                        <option value="5" <?= ($testimonial['rating'] ?? 5) == 5 ? 'selected' : '' ?>>★★★★★ (5)</option>
                        <option value="4" <?= ($testimonial['rating'] ?? 5) == 4 ? 'selected' : '' ?>>★★★★☆ (4)</option>
                        <option value="3" <?= ($testimonial['rating'] ?? 5) == 3 ? 'selected' : '' ?>>★★★☆☆ (3)</option>
                        <option value="2" <?= ($testimonial['rating'] ?? 5) == 2 ? 'selected' : '' ?>>★★☆☆☆ (2)</option>
                        <option value="1" <?= ($testimonial['rating'] ?? 5) == 1 ? 'selected' : '' ?>>★☆☆☆☆ (1)</option>
                    </select>
                </div>
                <div class="form-group form-group--half">
                    <label for="image">URL obrázku autora</label>
                    <input type="url" id="image" name="image" value="<?= htmlspecialchars($testimonial['image'] ?? $_POST['image'] ?? '') ?>" placeholder="https://...">
                </div>
            </div>

            <div class="form-group">
                <label for="sort_order">Pořadí</label>
                <input type="number" id="sort_order" name="sort_order" value="<?= $testimonial['sort_order'] ?? $_POST['sort_order'] ?? 0 ?>">
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__body">
            <div class="form-group">
                <label class="checkbox">
                    <input type="checkbox" name="is_active" value="1" <?= ($testimonial['is_active'] ?? true) ? 'checked' : '' ?>>
                    <span>Aktivní (zobrazit na webu)</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn--primary">
                    <i data-feather="save"></i> Uložit
                </button>
                <a href="/admin/testimonials" class="btn btn--secondary">Zrušit</a>
            </div>
        </div>
    </div>
</form>

<?php
$content = ob_get_clean();
require ADMIN_PATH . '/Views/layout.php';
?>

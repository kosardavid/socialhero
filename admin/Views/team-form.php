<?php
$pageTitle = $member ? 'Upravit člena týmu' : 'Nový člen týmu';
$currentPage = 'team';
ob_start();
?>

<div class="content-header">
    <div class="content-header__left">
        <a href="/admin/team" class="btn btn--secondary btn--small">
            <i data-feather="arrow-left"></i> Zpět
        </a>
    </div>
</div>

<form method="POST" class="form">
    <div class="card">
        <div class="card__header">
            <h3>Člen týmu</h3>
        </div>
        <div class="card__body">
            <div class="form-row">
                <div class="form-group form-group--half">
                    <label for="name">Jméno *</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($member['name'] ?? $_POST['name'] ?? '') ?>" required>
                </div>
                <div class="form-group form-group--half">
                    <label for="position">Pozice *</label>
                    <input type="text" id="position" name="position" value="<?= htmlspecialchars($member['position'] ?? $_POST['position'] ?? '') ?>" required placeholder="např. CEO, Marketing Manager">
                </div>
            </div>

            <div class="form-group">
                <label for="bio">Bio / Popis</label>
                <textarea id="bio" name="bio" rows="4"><?= htmlspecialchars($member['bio'] ?? $_POST['bio'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($member['email'] ?? $_POST['email'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="image">URL fotky</label>
                <input type="url" id="image" name="image" value="<?= htmlspecialchars($member['image'] ?? $_POST['image'] ?? '') ?>" placeholder="https://...">
            </div>

            <div class="form-group">
                <label for="linkedin">LinkedIn URL</label>
                <input type="url" id="linkedin" name="linkedin" value="<?= htmlspecialchars($member['linkedin'] ?? $_POST['linkedin'] ?? '') ?>" placeholder="https://linkedin.com/in/...">
            </div>

            <div class="form-group">
                <label for="sort_order">Pořadí</label>
                <input type="number" id="sort_order" name="sort_order" value="<?= $member['sort_order'] ?? $_POST['sort_order'] ?? 0 ?>">
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__body">
            <div class="form-group">
                <label class="checkbox">
                    <input type="checkbox" name="is_active" value="1" <?= ($member['is_active'] ?? true) ? 'checked' : '' ?>>
                    <span>Aktivní (zobrazit na webu)</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn--primary">
                    <i data-feather="save"></i> Uložit
                </button>
                <a href="/admin/team" class="btn btn--secondary">Zrušit</a>
            </div>
        </div>
    </div>
</form>


<?php
$content = ob_get_clean();
require ADMIN_PATH . '/Views/layout.php';
?>

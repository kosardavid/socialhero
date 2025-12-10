<?php
$pageTitle = 'SEO Stránek';
$currentPage = 'page-seo';

ob_start();
?>

<div class="card">
    <div class="card__header">
        <h3>SEO nastavení jednotlivých stránek</h3>
    </div>
    <div class="card__body">
        <p style="color: var(--color-text-muted); margin-bottom: 1.5rem;">
            Nastavte meta title a description pro každou stránku webu. Tyto hodnoty se zobrazí ve výsledcích vyhledávání.
        </p>

        <form method="POST" action="/admin/page-seo">
            <?php foreach ($pages as $page): ?>
            <div style="border: 1px solid var(--color-border); border-radius: var(--radius-lg); padding: 1.5rem; margin-bottom: 1.5rem; background: var(--color-bg-tertiary);">
                <h4 style="margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i data-feather="file-text" style="width: 18px; height: 18px;"></i>
                    <?= htmlspecialchars($page['page_name']) ?>
                    <span style="font-size: 0.75rem; color: var(--color-text-muted); font-weight: normal;">
                        /<?= $page['page_slug'] === 'home' ? '' : htmlspecialchars($page['page_slug']) ?>
                    </span>
                </h4>

                <input type="hidden" name="pages[<?= $page['id'] ?>][id]" value="<?= $page['id'] ?>">

                <div class="form-group">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="pages[<?= $page['id'] ?>][meta_title]" class="form-input"
                           value="<?= htmlspecialchars($page['meta_title'] ?? '') ?>"
                           placeholder="<?= htmlspecialchars($page['page_name']) ?> | SocialHero">
                    <small style="color: var(--color-text-muted);">
                        <?php
                        $titleLen = strlen($page['meta_title'] ?? '');
                        $titleColor = $titleLen > 60 ? 'var(--color-error)' : ($titleLen > 50 ? 'var(--color-warning)' : 'var(--color-success)');
                        ?>
                        <span style="color: <?= $titleColor ?>;"><?= $titleLen ?></span>/60 znaků
                    </small>
                </div>

                <div class="form-group">
                    <label class="form-label">Meta Description</label>
                    <textarea name="pages[<?= $page['id'] ?>][meta_description]" class="form-input" rows="2"
                              placeholder="Popis stránky pro vyhledávače..."><?= htmlspecialchars($page['meta_description'] ?? '') ?></textarea>
                    <small style="color: var(--color-text-muted);">
                        <?php
                        $descLen = strlen($page['meta_description'] ?? '');
                        $descColor = $descLen > 160 ? 'var(--color-error)' : ($descLen > 150 ? 'var(--color-warning)' : 'var(--color-success)');
                        ?>
                        <span style="color: <?= $descColor ?>;"><?= $descLen ?></span>/160 znaků
                    </small>
                </div>

                <div class="form-group">
                    <label class="form-label">Meta Keywords <span style="color: var(--color-text-muted); font-weight: normal;">(volitelné)</span></label>
                    <input type="text" name="pages[<?= $page['id'] ?>][meta_keywords]" class="form-input"
                           value="<?= htmlspecialchars($page['meta_keywords'] ?? '') ?>"
                           placeholder="klíčové, slova, oddělené, čárkou">
                </div>
            </div>
            <?php endforeach; ?>

            <div class="form-actions">
                <button type="submit" class="btn btn--primary">
                    <i data-feather="save"></i>
                    Uložit SEO nastavení
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Live character count
document.querySelectorAll('input[name*="meta_title"], textarea[name*="meta_description"]').forEach(function(el) {
    el.addEventListener('input', function() {
        var small = this.parentElement.querySelector('small span');
        if (small) {
            var len = this.value.length;
            var max = this.name.includes('title') ? 60 : 160;
            var warn = this.name.includes('title') ? 50 : 150;
            small.textContent = len;
            if (len > max) {
                small.style.color = 'var(--color-error)';
            } else if (len > warn) {
                small.style.color = 'var(--color-warning)';
            } else {
                small.style.color = 'var(--color-success)';
            }
        }
    });
});
</script>

<?php
$content = ob_get_clean();
require ADMIN_PATH . '/Views/layout.php';
?>

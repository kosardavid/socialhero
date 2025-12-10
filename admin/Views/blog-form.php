<?php
$pageTitle = $post ? 'Upravit článek' : 'Nový článek';
$currentPage = 'blog';
ob_start();
?>

<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

<div class="content-header">
    <div class="content-header__left">
        <a href="/admin/blog" class="btn btn--secondary btn--small">
            <i data-feather="arrow-left"></i> Zpět
        </a>
    </div>
</div>

<form method="POST" class="form" id="blogForm">
    <div class="card">
        <div class="card__header">
            <h3>Článek</h3>
        </div>
        <div class="card__body">
            <div class="form-group">
                <label for="title">Název článku *</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title'] ?? $_POST['title'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="slug">URL slug</label>
                <input type="text" id="slug" name="slug" value="<?= htmlspecialchars($post['slug'] ?? $_POST['slug'] ?? '') ?>" placeholder="automaticky z názvu">
            </div>

            <div class="form-group">
                <label for="excerpt">Perex (krátký popis)</label>
                <textarea id="excerpt" name="excerpt" rows="3"><?= htmlspecialchars($post['excerpt'] ?? $_POST['excerpt'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label>Obsah článku *</label>
                <div id="editor" style="height: 400px; background: #fff;"><?= $post['content'] ?? $_POST['content'] ?? '' ?></div>
                <input type="hidden" name="content" id="content">
            </div>

            <div class="form-row">
                <div class="form-group form-group--half">
                    <label for="category">Kategorie</label>
                    <input type="text" id="category" name="category" value="<?= htmlspecialchars($post['category'] ?? $_POST['category'] ?? '') ?>" placeholder="např. Marketing, Sociální sítě">
                </div>
                <div class="form-group form-group--half">
                    <label for="author">Autor</label>
                    <input type="text" id="author" name="author" value="<?= htmlspecialchars($post['author'] ?? $_POST['author'] ?? '') ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group form-group--half">
                    <label for="featured_image">URL hlavního obrázku</label>
                    <input type="url" id="featured_image" name="featured_image" value="<?= htmlspecialchars($post['featured_image'] ?? $_POST['featured_image'] ?? '') ?>">
                </div>
                <div class="form-group form-group--half">
                    <label for="read_time">Doba čtení (min)</label>
                    <input type="number" id="read_time" name="read_time" value="<?= $post['read_time'] ?? $_POST['read_time'] ?? 5 ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="tags">Tagy</label>
                <input type="text" id="tags" name="tags" value="<?= htmlspecialchars($post['tags'] ?? $_POST['tags'] ?? '') ?>" placeholder="oddělené čárkou">
            </div>

            <div class="form-group">
                <label for="meta_description">Meta description (SEO)</label>
                <textarea id="meta_description" name="meta_description" rows="2"><?= htmlspecialchars($post['meta_description'] ?? $_POST['meta_description'] ?? '') ?></textarea>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card__body">
            <div class="form-group">
                <label class="checkbox">
                    <input type="checkbox" name="is_featured" value="1" <?= ($post['is_featured'] ?? false) ? 'checked' : '' ?>>
                    <span>Zvýrazněný článek (zobrazit na homepage)</span>
                </label>
            </div>

            <div class="form-group">
                <label class="checkbox">
                    <input type="checkbox" name="is_published" value="1" <?= ($post['is_published'] ?? true) ? 'checked' : '' ?>>
                    <span>Publikováno</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn--primary">
                    <i data-feather="save"></i> Uložit
                </button>
                <a href="/admin/blog" class="btn btn--secondary">Zrušit</a>
            </div>
        </div>
    </div>
</form>

<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Quill editor
    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Začněte psát článek...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['blockquote', 'code-block'],
                ['link', 'image'],
                [{ 'align': [] }],
                ['clean']
            ]
        }
    });

    // Sync editor content to hidden input on form submit
    document.getElementById('blogForm').addEventListener('submit', function() {
        document.getElementById('content').value = quill.root.innerHTML;
    });
});
</script>

<style>
.ql-editor {
    font-size: 1rem;
    line-height: 1.6;
}
.ql-container {
    border-bottom-left-radius: var(--radius-md);
    border-bottom-right-radius: var(--radius-md);
}
.ql-toolbar {
    border-top-left-radius: var(--radius-md);
    border-top-right-radius: var(--radius-md);
    background: #f8f9fa;
}
</style>

<?php
$content = ob_get_clean();
require ADMIN_PATH . '/Views/layout.php';
?>

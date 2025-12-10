<?php
$pageTitle = 'Testimonials';
$currentPage = 'testimonials';
ob_start();
?>

<div class="content-header">
    <div class="content-header__left">
        <h2>Správa testimonials</h2>
        <p class="text-muted">Reference a hodnocení od klientů.</p>
    </div>
    <div class="content-header__right">
        <a href="/admin/testimonials/create" class="btn btn--primary">
            <i data-feather="plus"></i> Přidat testimonial
        </a>
    </div>
</div>

<div class="card">
    <div class="card__header">
        <h3>Seznam testimonials</h3>
    </div>
    <div class="card__body">
        <?php if (empty($testimonials)): ?>
        <div class="empty-state">
            <i data-feather="message-square"></i>
            <p>Zatím nemáte žádné testimonials.</p>
            <a href="/admin/testimonials/create" class="btn btn--primary">Přidat první testimonial</a>
        </div>
        <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Autor</th>
                    <th>Pozice</th>
                    <th>Hodnocení</th>
                    <th>Status</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($testimonials as $item): ?>
                <tr>
                    <td>
                        <strong><?= htmlspecialchars($item['name']) ?></strong>
                    </td>
                    <td><?= htmlspecialchars($item['position'] ?? '-') ?></td>
                    <td>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <span style="color: <?= $i <= ($item['rating'] ?? 5) ? '#f59e0b' : '#d1d5db' ?>">★</span>
                        <?php endfor; ?>
                    </td>
                    <td>
                        <span class="badge badge--<?= $item['is_active'] ? 'success' : 'secondary' ?>">
                            <?= $item['is_active'] ? 'Aktivní' : 'Neaktivní' ?>
                        </span>
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="/admin/testimonials/<?= $item['id'] ?>/edit" class="btn btn--small btn--secondary">
                                <i data-feather="edit-2"></i>
                            </a>
                            <a href="/admin/testimonials/<?= $item['id'] ?>/delete" class="btn btn--small btn--danger" onclick="return confirm('Opravdu smazat?')">
                                <i data-feather="trash-2"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>

<style>
.empty-state {
    text-align: center;
    padding: 3rem;
}
.empty-state i {
    width: 48px;
    height: 48px;
    color: var(--color-text-muted);
    margin-bottom: 1rem;
}
.content-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5rem;
}
.table-actions {
    display: flex;
    gap: 0.5rem;
}
</style>

<?php
$content = ob_get_clean();
require ADMIN_PATH . '/Views/layout.php';
?>

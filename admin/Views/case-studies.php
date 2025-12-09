<?php
$pageTitle = 'Reference';
$currentPage = 'case-studies';
ob_start();
?>

<div class="content-header">
    <div class="content-header__left">
        <h2>Správa referencí</h2>
        <p class="text-muted">Reference a case studies vašich klientů.</p>
    </div>
    <div class="content-header__right">
        <a href="/new/admin/case-studies/create" class="btn btn--primary">
            <i data-feather="plus"></i> Přidat referenci
        </a>
    </div>
</div>

<div class="card">
    <div class="card__header">
        <h3>Seznam referencí</h3>
    </div>
    <div class="card__body">
        <?php if (empty($caseStudies)): ?>
        <div class="empty-state">
            <i data-feather="briefcase"></i>
            <p>Zatím nemáte žádné reference.</p>
            <a href="/new/admin/case-studies/create" class="btn btn--primary">Přidat první referenci</a>
        </div>
        <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Název</th>
                    <th>Klient</th>
                    <th>Kategorie</th>
                    <th>Status</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($caseStudies as $item): ?>
                <tr>
                    <td><strong><?= htmlspecialchars($item['title']) ?></strong></td>
                    <td><?= htmlspecialchars($item['client_name'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($item['category'] ?? '-') ?></td>
                    <td>
                        <span class="badge badge--<?= $item['is_published'] ? 'success' : 'secondary' ?>">
                            <?= $item['is_published'] ? 'Publikováno' : 'Koncept' ?>
                        </span>
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="/new/admin/case-studies/<?= $item['id'] ?>/edit" class="btn btn--small btn--secondary">
                                <i data-feather="edit-2"></i>
                            </a>
                            <a href="/new/admin/case-studies/<?= $item['id'] ?>/delete" class="btn btn--small btn--danger" onclick="return confirm('Opravdu smazat?')">
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

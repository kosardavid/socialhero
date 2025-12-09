<?php
$pageTitle = 'Tým';
$currentPage = 'team';
ob_start();
?>

<div class="content-header">
    <div class="content-header__left">
        <h2>Správa týmu</h2>
        <p class="text-muted">Členové vašeho týmu.</p>
    </div>
    <div class="content-header__right">
        <a href="/new/admin/team/create" class="btn btn--primary">
            <i data-feather="plus"></i> Přidat člena
        </a>
    </div>
</div>

<div class="card">
    <div class="card__header">
        <h3>Seznam členů týmu</h3>
    </div>
    <div class="card__body">
        <?php if (empty($members)): ?>
        <div class="empty-state">
            <i data-feather="users"></i>
            <p>Zatím nemáte žádné členy týmu.</p>
            <a href="/new/admin/team/create" class="btn btn--primary">Přidat prvního člena</a>
        </div>
        <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Jméno</th>
                    <th>Pozice</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $item): ?>
                <tr>
                    <td><strong><?= htmlspecialchars($item['name']) ?></strong></td>
                    <td><?= htmlspecialchars($item['position'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($item['email'] ?? '-') ?></td>
                    <td>
                        <span class="badge badge--<?= $item['is_active'] ? 'success' : 'secondary' ?>">
                            <?= $item['is_active'] ? 'Aktivní' : 'Neaktivní' ?>
                        </span>
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="/new/admin/team/<?= $item['id'] ?>/edit" class="btn btn--small btn--secondary">
                                <i data-feather="edit-2"></i>
                            </a>
                            <a href="/new/admin/team/<?= $item['id'] ?>/delete" class="btn btn--small btn--danger" onclick="return confirm('Opravdu smazat?')">
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

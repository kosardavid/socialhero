<?php
$pageTitle = 'Klienti';
$currentPage = 'clients';
ob_start();
?>

<div class="content-header">
    <div class="content-header__left">
        <h2>Správa klientů</h2>
        <p class="text-muted">Loga a informace o klientech.</p>
    </div>
    <div class="content-header__right">
        <a href="/admin/clients/create" class="btn btn--primary">
            <i data-feather="plus"></i> Přidat klienta
        </a>
    </div>
</div>

<div class="card">
    <div class="card__header">
        <h3>Seznam klientů</h3>
    </div>
    <div class="card__body">
        <?php if (empty($clients)): ?>
        <div class="empty-state">
            <i data-feather="award"></i>
            <p>Zatím nemáte žádné klienty.</p>
            <a href="/admin/clients/create" class="btn btn--primary">Přidat prvního klienta</a>
        </div>
        <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Název</th>
                    <th>Web</th>
                    <th>Status</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $item): ?>
                <tr>
                    <td>
                        <?php if (!empty($item['logo'])): ?>
                        <img src="<?= htmlspecialchars($item['logo']) ?>" alt="" style="max-height: 30px; max-width: 100px;">
                        <?php else: ?>
                        <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                    <td><strong><?= htmlspecialchars($item['name']) ?></strong></td>
                    <td>
                        <?php if (!empty($item['website'])): ?>
                        <a href="<?= htmlspecialchars($item['website']) ?>" target="_blank"><?= htmlspecialchars($item['website']) ?></a>
                        <?php else: ?>
                        -
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="badge badge--<?= $item['is_active'] ? 'success' : 'secondary' ?>">
                            <?= $item['is_active'] ? 'Aktivní' : 'Neaktivní' ?>
                        </span>
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="/admin/clients/<?= $item['id'] ?>/edit" class="btn btn--small btn--secondary">
                                <i data-feather="edit-2"></i>
                            </a>
                            <a href="/admin/clients/<?= $item['id'] ?>/delete" class="btn btn--small btn--danger" onclick="return confirm('Opravdu smazat?')">
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

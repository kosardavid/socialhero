<?php
$pageTitle = 'Kroky spolupráce';
$currentPage = 'process-steps';
ob_start();
?>

<div class="content-header">
    <div class="content-header__left">
        <h1>Kroky spolupráce (Timeline)</h1>
        <p>Proces spolupráce zobrazený na homepage</p>
    </div>
    <div class="content-header__right">
        <a href="/admin/process-steps/create" class="btn btn--primary">
            <i data-feather="plus"></i> Přidat krok
        </a>
    </div>
</div>

<?php if (isset($_SESSION['flash_message'])): ?>
<div class="alert alert--<?= $_SESSION['flash_type'] ?? 'success' ?>">
    <?= $_SESSION['flash_message'] ?>
</div>
<?php unset($_SESSION['flash_message'], $_SESSION['flash_type']); endif; ?>

<div class="card">
    <div class="card__body">
        <?php if (empty($items)): ?>
        <div class="empty-state">
            <i data-feather="list"></i>
            <h3>Žádné kroky</h3>
            <p>Zatím nemáte žádné kroky spolupráce.</p>
            <a href="/admin/process-steps/create" class="btn btn--primary">Přidat první krok</a>
        </div>
        <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 60px;">Pořadí</th>
                    <th style="width: 60px;">Ikona</th>
                    <th>Název</th>
                    <th>Popis</th>
                    <th style="width: 80px;">Status</th>
                    <th style="width: 120px;">Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><strong><?= $item['sort_order'] ?></strong></td>
                    <td><i data-feather="<?= htmlspecialchars($item['icon']) ?>"></i></td>
                    <td><strong><?= htmlspecialchars($item['title']) ?></strong></td>
                    <td style="color: var(--color-text-secondary); font-size: 0.875rem;">
                        <?= htmlspecialchars(mb_substr($item['description'] ?? '', 0, 60)) ?>...
                    </td>
                    <td>
                        <?php if ($item['is_active']): ?>
                        <span class="badge badge--success">Aktivní</span>
                        <?php else: ?>
                        <span class="badge badge--secondary">Skrytý</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="/admin/process-steps/<?= $item['id'] ?>/edit" class="btn btn--secondary btn--small">
                                <i data-feather="edit-2"></i>
                            </a>
                            <a href="/admin/process-steps/<?= $item['id'] ?>/delete"
                               class="btn btn--danger btn--small"
                               onclick="return confirm('Opravdu smazat tento krok?')">
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

<?php
$content = ob_get_clean();
require ADMIN_PATH . '/Views/layout.php';
?>

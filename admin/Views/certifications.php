<?php
$pageTitle = 'Certifikace a partnerství';
$currentPage = 'certifications';
ob_start();
?>

<div class="content-header">
    <div class="content-header__left">
        <h1>Certifikace a partnerství</h1>
        <p>Badges zobrazené na homepage</p>
    </div>
    <div class="content-header__right">
        <a href="/new/admin/certifications/create" class="btn btn--primary">
            <i data-feather="plus"></i> Přidat certifikaci
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
            <i data-feather="award"></i>
            <h3>Žádné certifikace</h3>
            <p>Zatím nemáte žádné certifikace nebo partnerství.</p>
            <a href="/new/admin/certifications/create" class="btn btn--primary">Přidat první</a>
        </div>
        <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 60px;">Ikona</th>
                    <th>Název</th>
                    <th>Popis</th>
                    <th style="width: 80px;">Barva</th>
                    <th style="width: 80px;">Status</th>
                    <th style="width: 120px;">Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td>
                        <div style="width: 40px; height: 40px; border-radius: 8px; background: <?= htmlspecialchars($item['color']) ?>20; display: flex; align-items: center; justify-content: center; color: <?= htmlspecialchars($item['color']) ?>;">
                            <i data-feather="<?= htmlspecialchars($item['icon']) ?>"></i>
                        </div>
                    </td>
                    <td><strong><?= htmlspecialchars($item['name']) ?></strong></td>
                    <td style="color: var(--color-text-secondary); font-size: 0.875rem;">
                        <?= htmlspecialchars($item['description'] ?? '') ?>
                    </td>
                    <td>
                        <div style="width: 24px; height: 24px; border-radius: 4px; background: <?= htmlspecialchars($item['color']) ?>;"></div>
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
                            <a href="/new/admin/certifications/<?= $item['id'] ?>/edit" class="btn btn--secondary btn--small">
                                <i data-feather="edit-2"></i>
                            </a>
                            <a href="/new/admin/certifications/<?= $item['id'] ?>/delete"
                               class="btn btn--danger btn--small"
                               onclick="return confirm('Opravdu smazat tuto certifikaci?')">
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

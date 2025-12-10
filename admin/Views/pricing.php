<?php
$pageTitle = 'Ceník';
$currentPage = 'pricing';
ob_start();
?>

<div class="content-header">
    <div class="content-header__left">
        <h2>Správa ceníku</h2>
        <p class="text-muted">Cenové plány zobrazené na webu</p>
    </div>
    <div class="content-header__right">
        <a href="/admin/pricing/create" class="btn btn--primary">
            <i data-feather="plus"></i> Přidat plán
        </a>
    </div>
</div>

<div class="card">
    <div class="card__body">
        <?php if (empty($plans)): ?>
        <div class="empty-state">
            <i data-feather="credit-card"></i>
            <p>Zatím nemáte žádné cenové plány.</p>
            <a href="/admin/pricing/create" class="btn btn--primary">Přidat první plán</a>
        </div>
        <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th width="50">Pořadí</th>
                    <th>Název</th>
                    <th>Cena</th>
                    <th>Hodiny</th>
                    <th width="100">Doporučený</th>
                    <th width="80">Status</th>
                    <th width="120">Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($plans as $p): ?>
                <tr>
                    <td><?= $p['sort_order'] ?></td>
                    <td><strong><?= htmlspecialchars($p['name']) ?></strong></td>
                    <td><?= number_format($p['price'], 0, ',', ' ') ?> Kč/<?= $p['period'] ?? 'měsíc' ?></td>
                    <td><?= htmlspecialchars($p['hours'] ?? '-') ?></td>
                    <td>
                        <?php if ($p['is_featured']): ?>
                        <span class="badge badge--primary">Ano</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="badge badge--<?= $p['is_active'] ? 'success' : 'secondary' ?>">
                            <?= $p['is_active'] ? 'Aktivní' : 'Skryto' ?>
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="/admin/pricing/<?= $p['id'] ?>/edit" class="btn btn--small btn--secondary">
                                <i data-feather="edit-2"></i>
                            </a>
                            <a href="/admin/pricing/<?= $p['id'] ?>/delete" class="btn btn--small btn--danger" onclick="return confirm('Opravdu smazat?')">
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

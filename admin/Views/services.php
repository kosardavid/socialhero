<?php
$pageTitle = 'Služby';
$currentPage = 'services';
ob_start();
?>

<div class="content-header">
    <div class="content-header__left">
        <h2>Správa služeb</h2>
        <p class="text-muted">Služby zobrazené na webu</p>
    </div>
    <div class="content-header__right">
        <a href="/admin/services/create" class="btn btn--primary">
            <i data-feather="plus"></i> Přidat službu
        </a>
    </div>
</div>

<div class="card">
    <div class="card__body">
        <?php if (empty($services)): ?>
        <div class="empty-state">
            <i data-feather="layers"></i>
            <p>Zatím nemáte žádné služby.</p>
            <a href="/admin/services/create" class="btn btn--primary">Přidat první službu</a>
        </div>
        <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th width="50">Pořadí</th>
                    <th width="50">Ikona</th>
                    <th>Název</th>
                    <th>Krátký popis</th>
                    <th width="80">Status</th>
                    <th width="120">Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $s): ?>
                <tr>
                    <td><?= $s['sort_order'] ?></td>
                    <td><i data-feather="<?= htmlspecialchars($s['icon'] ?? 'box') ?>"></i></td>
                    <td><strong><?= htmlspecialchars($s['title']) ?></strong></td>
                    <td class="text-muted"><?= htmlspecialchars(mb_substr($s['short_description'] ?? '', 0, 60)) ?>...</td>
                    <td>
                        <span class="badge badge--<?= $s['is_active'] ? 'success' : 'secondary' ?>">
                            <?= $s['is_active'] ? 'Aktivní' : 'Skryto' ?>
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="/admin/services/<?= $s['id'] ?>/edit" class="btn btn--small btn--secondary">
                                <i data-feather="edit-2"></i>
                            </a>
                            <a href="/admin/services/<?= $s['id'] ?>/delete" class="btn btn--small btn--danger" onclick="return confirm('Opravdu smazat?')">
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

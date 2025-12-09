<?php
$pageTitle = 'FAQ';
$currentPage = 'faqs';
ob_start();
?>

<div class="content-header">
    <div class="content-header__left">
        <h2>Správa FAQ</h2>
        <p class="text-muted">Často kladené dotazy</p>
    </div>
    <div class="content-header__right">
        <a href="/new/admin/faqs/create" class="btn btn--primary">
            <i data-feather="plus"></i> Přidat FAQ
        </a>
    </div>
</div>

<div class="card">
    <div class="card__body">
        <?php if (empty($faqs)): ?>
        <div class="empty-state">
            <i data-feather="help-circle"></i>
            <p>Zatím nemáte žádné FAQ.</p>
            <a href="/new/admin/faqs/create" class="btn btn--primary">Přidat první FAQ</a>
        </div>
        <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th width="50">Pořadí</th>
                    <th>Otázka</th>
                    <th width="80">Status</th>
                    <th width="120">Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($faqs as $f): ?>
                <tr>
                    <td><?= $f['sort_order'] ?></td>
                    <td><strong><?= htmlspecialchars($f['question']) ?></strong></td>
                    <td>
                        <span class="badge badge--<?= $f['is_active'] ? 'success' : 'secondary' ?>">
                            <?= $f['is_active'] ? 'Aktivní' : 'Skryto' ?>
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="/new/admin/faqs/<?= $f['id'] ?>/edit" class="btn btn--small btn--secondary">
                                <i data-feather="edit-2"></i>
                            </a>
                            <a href="/new/admin/faqs/<?= $f['id'] ?>/delete" class="btn btn--small btn--danger" onclick="return confirm('Opravdu smazat?')">
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

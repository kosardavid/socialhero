<?php
$pageTitle = 'Poptávky';
$currentPage = 'contacts';

ob_start();
?>

<div class="card">
    <div class="card__header">
        <h3>Všechny poptávky</h3>
        <span class="text-muted"><?= count($contacts) ?> celkem</span>
    </div>
    <div class="card__body">
        <?php if (empty($contacts)): ?>
        <p class="empty-state">Zatím žádné poptávky z kontaktního formuláře.</p>
        <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Jméno</th>
                    <th>E-mail</th>
                    <th>Služba</th>
                    <th>Datum</th>
                    <th>Stav</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                <tr class="<?= !$contact['is_read'] ? 'row--unread' : '' ?>">
                    <td>
                        <strong><?= htmlspecialchars($contact['name']) ?></strong>
                        <?php if ($contact['company']): ?>
                        <br><small class="text-muted"><?= htmlspecialchars($contact['company']) ?></small>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="mailto:<?= htmlspecialchars($contact['email']) ?>">
                            <?= htmlspecialchars($contact['email']) ?>
                        </a>
                        <?php if ($contact['phone']): ?>
                        <br><small class="text-muted"><?= htmlspecialchars($contact['phone']) ?></small>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($contact['service'] ?: '-') ?></td>
                    <td><?= date('d.m.Y H:i', strtotime($contact['created_at'])) ?></td>
                    <td>
                        <?php if ($contact['is_read']): ?>
                        <span class="badge badge--success">Přečteno</span>
                        <?php else: ?>
                        <span class="badge badge--warning">Nové</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="/new/admin/contacts/<?= $contact['id'] ?>" class="btn btn--sm btn--secondary">
                            Detail
                        </a>
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

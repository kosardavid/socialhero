<?php
$pageTitle = 'Dashboard';
$currentPage = 'dashboard';
$unreadContacts = $stats['unread_contacts'] ?? 0;

ob_start();
?>

<?php if (isset($dbError)): ?>
<div class="alert alert--warning">
    <i data-feather="alert-triangle"></i>
    <?= htmlspecialchars($dbError) ?>
</div>
<?php endif; ?>

<!-- Stats Grid - Primary -->
<div class="stats-grid">
    <div class="stat-card <?= ($stats['unread_contacts'] ?? 0) > 0 ? 'stat-card--highlight' : '' ?>">
        <div class="stat-card__icon" style="background: rgba(249, 115, 22, 0.1); color: #f97316;">
            <i data-feather="inbox"></i>
        </div>
        <div class="stat-card__content">
            <div class="stat-card__value"><?= $stats['unread_contacts'] ?? 0 ?></div>
            <div class="stat-card__label">Nepřečtených poptávek</div>
        </div>
        <?php if (($stats['unread_contacts'] ?? 0) > 0): ?>
        <a href="/admin/contacts" class="stat-card__link">Zobrazit</a>
        <?php endif; ?>
    </div>

    <div class="stat-card">
        <div class="stat-card__icon" style="background: rgba(124, 58, 237, 0.1); color: #a855f7;">
            <i data-feather="mail"></i>
        </div>
        <div class="stat-card__content">
            <div class="stat-card__value"><?= $stats['contacts'] ?? 0 ?></div>
            <div class="stat-card__label">Celkem poptávek</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card__icon" style="background: rgba(34, 197, 94, 0.1); color: #22c55e;">
            <i data-feather="users"></i>
        </div>
        <div class="stat-card__content">
            <div class="stat-card__value"><?= $stats['subscribers'] ?? 0 ?></div>
            <div class="stat-card__label">Odběratelů</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card__icon" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6;">
            <i data-feather="briefcase"></i>
        </div>
        <div class="stat-card__content">
            <div class="stat-card__value"><?= $stats['case_studies'] ?? 0 ?></div>
            <div class="stat-card__label">Referencí</div>
        </div>
    </div>
</div>

<!-- Content Stats -->
<h3 style="margin: 2rem 0 1rem; font-size: 1.1rem; color: var(--color-text-secondary);">Obsah webu</h3>
<div class="stats-grid stats-grid--small">
    <a href="/admin/services" class="stat-card stat-card--mini">
        <i data-feather="layers"></i>
        <span class="stat-card__value"><?= $stats['services'] ?? 0 ?></span>
        <span class="stat-card__label">Služeb</span>
    </a>
    <a href="/admin/pricing" class="stat-card stat-card--mini">
        <i data-feather="credit-card"></i>
        <span class="stat-card__value"><?= $stats['pricing_plans'] ?? 0 ?></span>
        <span class="stat-card__label">Ceníků</span>
    </a>
    <a href="/admin/faqs" class="stat-card stat-card--mini">
        <i data-feather="help-circle"></i>
        <span class="stat-card__value"><?= $stats['faqs'] ?? 0 ?></span>
        <span class="stat-card__label">FAQ</span>
    </a>
    <a href="/admin/testimonials" class="stat-card stat-card--mini">
        <i data-feather="message-square"></i>
        <span class="stat-card__value"><?= $stats['testimonials'] ?? 0 ?></span>
        <span class="stat-card__label">Recenzí</span>
    </a>
    <a href="/admin/team" class="stat-card stat-card--mini">
        <i data-feather="users"></i>
        <span class="stat-card__value"><?= $stats['team_members'] ?? 0 ?></span>
        <span class="stat-card__label">V týmu</span>
    </a>
    <a href="/admin/blog" class="stat-card stat-card--mini">
        <i data-feather="edit-3"></i>
        <span class="stat-card__value"><?= $stats['blog_posts'] ?? 0 ?></span>
        <span class="stat-card__label">Článků</span>
    </a>
    <a href="/admin/clients" class="stat-card stat-card--mini">
        <i data-feather="award"></i>
        <span class="stat-card__value"><?= $stats['clients'] ?? 0 ?></span>
        <span class="stat-card__label">Klientů</span>
    </a>
</div>

<style>
.stats-grid--small {
    grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
    gap: 0.75rem;
}
.stat-card--mini {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 1rem;
    text-decoration: none;
    transition: transform 0.2s, box-shadow 0.2s;
}
.stat-card--mini:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.stat-card--mini i {
    width: 24px;
    height: 24px;
    color: var(--color-text-muted);
    margin-bottom: 0.5rem;
}
.stat-card--mini .stat-card__value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--color-text);
}
.stat-card--mini .stat-card__label {
    font-size: 0.75rem;
    color: var(--color-text-muted);
}
.stat-card--highlight {
    border-color: #f97316;
    background: rgba(249, 115, 22, 0.05);
}
.stat-card__link {
    position: absolute;
    top: 0.75rem;
    right: 0.75rem;
    font-size: 0.75rem;
    color: var(--color-accent);
    text-decoration: none;
}
.stat-card {
    position: relative;
}
</style>

<!-- Recent Activity -->
<div class="dashboard-grid">
    <!-- Recent Contacts -->
    <div class="card">
        <div class="card__header">
            <h3>Poslední poptávky</h3>
            <a href="/admin/contacts" class="btn btn--sm btn--secondary">Zobrazit vše</a>
        </div>
        <div class="card__body">
            <?php if (empty($recentContacts)): ?>
            <p class="empty-state">Zatím žádné poptávky.</p>
            <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Jméno</th>
                        <th>E-mail</th>
                        <th>Datum</th>
                        <th>Stav</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentContacts as $contact): ?>
                    <tr>
                        <td>
                            <a href="/admin/contacts/<?= $contact['id'] ?>">
                                <?= htmlspecialchars($contact['name']) ?>
                            </a>
                        </td>
                        <td><?= htmlspecialchars($contact['email']) ?></td>
                        <td><?= date('d.m.Y H:i', strtotime($contact['created_at'])) ?></td>
                        <td>
                            <?php if ($contact['is_read']): ?>
                            <span class="badge badge--success">Přečteno</span>
                            <?php else: ?>
                            <span class="badge badge--warning">Nové</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Subscribers -->
    <div class="card">
        <div class="card__header">
            <h3>Noví odběratelé</h3>
        </div>
        <div class="card__body">
            <?php if (empty($recentSubscribers)): ?>
            <p class="empty-state">Zatím žádní odběratelé.</p>
            <?php else: ?>
            <ul class="subscriber-list">
                <?php foreach ($recentSubscribers as $sub): ?>
                <li>
                    <span class="subscriber-email"><?= htmlspecialchars($sub['email']) ?></span>
                    <span class="subscriber-date"><?= date('d.m.Y', strtotime($sub['created_at'])) ?></span>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require ADMIN_PATH . '/Views/layout.php';
?>

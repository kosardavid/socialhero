<?php
$pageTitle = 'Detail poptávky';
$currentPage = 'contacts';

ob_start();
?>

<div class="page-actions">
    <a href="/new/admin/contacts" class="btn btn--secondary">
        <i data-feather="arrow-left"></i>
        Zpět na seznam
    </a>
    <a href="mailto:<?= htmlspecialchars($contact['email']) ?>" class="btn btn--primary">
        <i data-feather="mail"></i>
        Odpovědět
    </a>
</div>

<div class="card">
    <div class="card__header">
        <h3>Poptávka od <?= htmlspecialchars($contact['name']) ?></h3>
        <span class="text-muted"><?= date('d.m.Y H:i', strtotime($contact['created_at'])) ?></span>
    </div>
    <div class="card__body">
        <div class="detail-grid">
            <div class="detail-item">
                <label>Jméno</label>
                <p><?= htmlspecialchars($contact['name']) ?></p>
            </div>
            <div class="detail-item">
                <label>E-mail</label>
                <p><a href="mailto:<?= htmlspecialchars($contact['email']) ?>"><?= htmlspecialchars($contact['email']) ?></a></p>
            </div>
            <div class="detail-item">
                <label>Telefon</label>
                <p><?= htmlspecialchars($contact['phone'] ?: '-') ?></p>
            </div>
            <div class="detail-item">
                <label>Firma</label>
                <p><?= htmlspecialchars($contact['company'] ?: '-') ?></p>
            </div>
            <div class="detail-item">
                <label>Služba</label>
                <p><?= htmlspecialchars($contact['service'] ?: '-') ?></p>
            </div>
            <div class="detail-item">
                <label>Rozpočet</label>
                <p><?= htmlspecialchars($contact['budget'] ?: '-') ?></p>
            </div>
        </div>

        <div class="detail-message">
            <label>Zpráva</label>
            <div class="message-box">
                <?= nl2br(htmlspecialchars($contact['message'])) ?>
            </div>
        </div>

        <div class="detail-meta">
            <small class="text-muted">
                IP: <?= htmlspecialchars($contact['ip_address'] ?? '-') ?><br>
                User Agent: <?= htmlspecialchars(substr($contact['user_agent'] ?? '-', 0, 100)) ?>...
            </small>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require ADMIN_PATH . '/Views/layout.php';
?>

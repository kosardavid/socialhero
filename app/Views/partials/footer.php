<?php $settings = \App\Core\View::getSettings(); ?>
<footer class="footer">
    <div class="footer__container container">
        <div class="footer__grid">
            <div class="footer__brand">
                <a href="<?= \App\Core\View::url('/') ?>" class="footer__logo">
                    <span class="logo-text">Social<span class="logo-highlight">Hero</span></span>
                </a>
                <p class="footer__description">
                    Kompletní online marketing v jednom měsíčním předplatném.
                    Sociální sítě, PPC reklama, e-mailing a více.
                </p>
                <div class="footer__social">
                    <?php if (!empty($settings['social_facebook'])): ?>
                    <a href="<?= htmlspecialchars($settings['social_facebook']) ?>" class="footer__social-link" aria-label="Facebook" target="_blank">
                        <i data-feather="facebook"></i>
                    </a>
                    <?php endif; ?>
                    <?php if (!empty($settings['social_instagram'])): ?>
                    <a href="<?= htmlspecialchars($settings['social_instagram']) ?>" class="footer__social-link" aria-label="Instagram" target="_blank">
                        <i data-feather="instagram"></i>
                    </a>
                    <?php endif; ?>
                    <?php if (!empty($settings['social_linkedin'])): ?>
                    <a href="<?= htmlspecialchars($settings['social_linkedin']) ?>" class="footer__social-link" aria-label="LinkedIn" target="_blank">
                        <i data-feather="linkedin"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="footer__links">
                <h4 class="footer__title">Služby</h4>
                <ul class="footer__list">
                    <li><a href="<?= \App\Core\View::url('/sluzby/socialni-site') ?>">Správa sociálních sítí</a></li>
                    <li><a href="<?= \App\Core\View::url('/sluzby/meta-ads') ?>">Meta Ads</a></li>
                    <li><a href="<?= \App\Core\View::url('/sluzby/google-ads') ?>">Google Ads</a></li>
                    <li><a href="<?= \App\Core\View::url('/sluzby/email-marketing') ?>">E-mail marketing</a></li>
                    <li><a href="<?= \App\Core\View::url('/sluzby/seo') ?>">SEO</a></li>
                </ul>
            </div>

            <div class="footer__links">
                <h4 class="footer__title">Společnost</h4>
                <ul class="footer__list">
                    <li><a href="<?= \App\Core\View::url('/o-nas') ?>">O nás</a></li>
                    <li><a href="<?= \App\Core\View::url('/reference') ?>">Reference</a></li>
                    <li><a href="<?= \App\Core\View::url('/cenik') ?>">Ceník</a></li>
                    <li><a href="<?= \App\Core\View::url('/blog') ?>">Blog</a></li>
                    <li><a href="<?= \App\Core\View::url('/kontakt') ?>">Kontakt</a></li>
                </ul>
            </div>

            <div class="footer__contact">
                <h4 class="footer__title">Kontakt</h4>
                <ul class="footer__list">
                    <?php if (!empty($settings['contact_email'])): ?>
                    <li>
                        <i data-feather="mail"></i>
                        <a href="mailto:<?= htmlspecialchars($settings['contact_email']) ?>"><?= htmlspecialchars($settings['contact_email']) ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($settings['contact_phone'])): ?>
                    <li>
                        <i data-feather="phone"></i>
                        <a href="tel:<?= htmlspecialchars(preg_replace('/\s+/', '', $settings['contact_phone'])) ?>"><?= htmlspecialchars($settings['contact_phone']) ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($settings['contact_address'])): ?>
                    <li>
                        <i data-feather="map-pin"></i>
                        <span><?= htmlspecialchars($settings['contact_address']) ?></span>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="footer__newsletter">
            <div class="footer__newsletter-content">
                <h4>Odebírejte novinky</h4>
                <p>Tipy a triky ze světa online marketingu přímo do vašeho inboxu.</p>
            </div>
            <form class="footer__newsletter-form" id="newsletter-form">
                <input type="email" name="email" placeholder="váš@email.cz" required>
                <button type="submit" class="btn btn--primary">Odebírat</button>
            </form>
        </div>

        <div class="footer__bottom">
            <p>&copy; <?= date('Y') ?> SocialHero. Všechna práva vyhrazena.</p>
            <div class="footer__legal">
                <a href="<?= \App\Core\View::url('/ochrana-osobnich-udaju') ?>">Ochrana osobních údajů</a>
                <a href="<?= \App\Core\View::url('/obchodni-podminky') ?>">Obchodní podmínky</a>
            </div>
        </div>
    </div>
</footer>

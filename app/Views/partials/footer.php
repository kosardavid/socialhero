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
                    <a href="#" class="footer__social-link" aria-label="Facebook">
                        <i data-feather="facebook"></i>
                    </a>
                    <a href="#" class="footer__social-link" aria-label="Instagram">
                        <i data-feather="instagram"></i>
                    </a>
                    <a href="#" class="footer__social-link" aria-label="LinkedIn">
                        <i data-feather="linkedin"></i>
                    </a>
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
                    <li>
                        <i data-feather="mail"></i>
                        <a href="mailto:info@socialhero.cz">info@socialhero.cz</a>
                    </li>
                    <li>
                        <i data-feather="phone"></i>
                        <a href="tel:+420123456789">+420 123 456 789</a>
                    </li>
                    <li>
                        <i data-feather="map-pin"></i>
                        <span>Praha, Česká republika</span>
                    </li>
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

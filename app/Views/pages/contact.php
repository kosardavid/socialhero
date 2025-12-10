<?php $settings = \App\Core\View::getSettings(); ?>
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <span class="section__badge">Kontakt</span>
        <h1 class="page-header__title">
            Ozvěte se
            <span class="text-gradient">nám</span>
        </h1>
        <p class="page-header__description">
            Máte dotaz nebo chcete nezávaznou konzultaci?
            Napište nám nebo zavolejte.
        </p>
    </div>
</section>

<!-- Contact Section -->
<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr; gap: 3rem; max-width: 1000px; margin: 0 auto;">

            <!-- Contact Form -->
            <div style="padding: 2.5rem; background: var(--color-bg-card); border: 1px solid var(--color-border); border-radius: var(--radius-xl);">
                <h2 style="margin-bottom: 0.5rem;">Napište nám</h2>
                <p style="color: var(--color-text-secondary); margin-bottom: 2rem;">
                    Vyplňte formulář a ozveme se vám do 24 hodin.
                </p>

                <?php
                // Generate CSRF token
                if (!isset($_SESSION['csrf_token'])) {
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                }
                ?>

                <form id="contact-form" action="<?= \App\Core\View::url('/api/contact') ?>" method="POST" class="contact-form">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="name">Jméno a příjmení *</label>
                            <input type="text" id="name" name="name" class="form-input" required placeholder="Jan Novák">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">E-mail *</label>
                            <input type="email" id="email" name="email" class="form-input" required placeholder="jan@firma.cz">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="phone">Telefon</label>
                            <input type="tel" id="phone" name="phone" class="form-input" placeholder="+420 123 456 789">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="company">Firma</label>
                            <input type="text" id="company" name="company" class="form-input" placeholder="Název firmy">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="service">O jakou službu máte zájem?</label>
                            <select id="service" name="service" class="form-select">
                                <option value="">Vyberte službu...</option>
                                <option value="socialni-site">Správa sociálních sítí</option>
                                <option value="meta-ads">Meta Ads (Facebook/Instagram)</option>
                                <option value="google-ads">Google Ads</option>
                                <option value="email-marketing">E-mail marketing</option>
                                <option value="seo">SEO</option>
                                <option value="kompletni">Kompletní marketing</option>
                                <option value="jine">Jiné</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="budget">Měsíční rozpočet</label>
                            <select id="budget" name="budget" class="form-select">
                                <option value="">Vyberte rozpočet...</option>
                                <option value="do-15000">Do 15 000 Kč</option>
                                <option value="15000-30000">15 000 - 30 000 Kč</option>
                                <option value="30000-50000">30 000 - 50 000 Kč</option>
                                <option value="50000+">50 000+ Kč</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="message">Zpráva *</label>
                        <textarea id="message" name="message" class="form-textarea" required placeholder="Popište nám váš projekt nebo dotaz..."></textarea>
                    </div>

                    <button type="submit" class="btn btn--primary btn--large" style="width: 100%;">
                        Odeslat zprávu
                        <i data-feather="send"></i>
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                <?php if (!empty($settings['contact_email'])): ?>
                <div style="padding: 1.5rem; background: var(--color-bg-card); border: 1px solid var(--color-border); border-radius: var(--radius-xl); text-align: center;">
                    <div style="width: 48px; height: 48px; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; background: rgba(124, 58, 237, 0.1); border-radius: var(--radius-lg);">
                        <i data-feather="mail" style="color: var(--color-accent-secondary);"></i>
                    </div>
                    <h4 style="margin-bottom: 0.5rem;">E-mail</h4>
                    <a href="mailto:<?= htmlspecialchars($settings['contact_email']) ?>" style="color: var(--color-text-secondary);">
                        <?= htmlspecialchars($settings['contact_email']) ?>
                    </a>
                </div>
                <?php endif; ?>

                <?php if (!empty($settings['contact_phone'])): ?>
                <div style="padding: 1.5rem; background: var(--color-bg-card); border: 1px solid var(--color-border); border-radius: var(--radius-xl); text-align: center;">
                    <div style="width: 48px; height: 48px; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; background: rgba(124, 58, 237, 0.1); border-radius: var(--radius-lg);">
                        <i data-feather="phone" style="color: var(--color-accent-secondary);"></i>
                    </div>
                    <h4 style="margin-bottom: 0.5rem;">Telefon</h4>
                    <a href="tel:<?= htmlspecialchars(preg_replace('/\s+/', '', $settings['contact_phone'])) ?>" style="color: var(--color-text-secondary);">
                        <?= htmlspecialchars($settings['contact_phone']) ?>
                    </a>
                </div>
                <?php endif; ?>

                <?php if (!empty($settings['contact_address'])): ?>
                <div style="padding: 1.5rem; background: var(--color-bg-card); border: 1px solid var(--color-border); border-radius: var(--radius-xl); text-align: center;">
                    <div style="width: 48px; height: 48px; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; background: rgba(124, 58, 237, 0.1); border-radius: var(--radius-lg);">
                        <i data-feather="map-pin" style="color: var(--color-accent-secondary);"></i>
                    </div>
                    <h4 style="margin-bottom: 0.5rem;">Adresa</h4>
                    <span style="color: var(--color-text-secondary);">
                        <?= htmlspecialchars($settings['contact_address']) ?>
                    </span>
                </div>
                <?php endif; ?>

                <div style="padding: 1.5rem; background: var(--color-bg-card); border: 1px solid var(--color-border); border-radius: var(--radius-xl); text-align: center;">
                    <div style="width: 48px; height: 48px; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; background: rgba(124, 58, 237, 0.1); border-radius: var(--radius-lg);">
                        <i data-feather="clock" style="color: var(--color-accent-secondary);"></i>
                    </div>
                    <h4 style="margin-bottom: 0.5rem;">Pracovní doba</h4>
                    <span style="color: var(--color-text-secondary);">
                        Po-Pá: 9:00 - 18:00
                    </span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Social Links -->
<section class="section section--alt">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title" style="font-size: var(--text-2xl);">
                Sledujte nás
            </h2>
        </div>

        <div style="display: flex; justify-content: center; gap: 1rem;">
            <?php if (!empty($settings['social_facebook'])): ?>
            <a href="<?= htmlspecialchars($settings['social_facebook']) ?>" target="_blank" rel="noopener" style="display: flex; align-items: center; justify-content: center; width: 56px; height: 56px; background: var(--color-bg-card); border: 1px solid var(--color-border); border-radius: var(--radius-lg); color: var(--color-text-secondary); transition: all 0.2s;">
                <i data-feather="facebook" style="width: 24px; height: 24px;"></i>
            </a>
            <?php endif; ?>
            <?php if (!empty($settings['social_instagram'])): ?>
            <a href="<?= htmlspecialchars($settings['social_instagram']) ?>" target="_blank" rel="noopener" style="display: flex; align-items: center; justify-content: center; width: 56px; height: 56px; background: var(--color-bg-card); border: 1px solid var(--color-border); border-radius: var(--radius-lg); color: var(--color-text-secondary); transition: all 0.2s;">
                <i data-feather="instagram" style="width: 24px; height: 24px;"></i>
            </a>
            <?php endif; ?>
            <?php if (!empty($settings['social_linkedin'])): ?>
            <a href="<?= htmlspecialchars($settings['social_linkedin']) ?>" target="_blank" rel="noopener" style="display: flex; align-items: center; justify-content: center; width: 56px; height: 56px; background: var(--color-bg-card); border: 1px solid var(--color-border); border-radius: var(--radius-lg); color: var(--color-text-secondary); transition: all 0.2s;">
                <i data-feather="linkedin" style="width: 24px; height: 24px;"></i>
            </a>
            <?php endif; ?>
        </div>
    </div>
</section>

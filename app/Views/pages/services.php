<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <span class="section__badge">Naše služby</span>
        <h1 class="page-header__title">
            Kompletní online marketing
            <span class="text-gradient">pod jednou střechou</span>
        </h1>
        <p class="page-header__description">
            Od strategie přes realizaci až po reporting.
            Vše, co potřebujete pro úspěšný online marketing.
        </p>
    </div>
</section>

<!-- Services Grid -->
<section class="section">
    <div class="container">
        <div class="services__grid" style="grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));">
            <?php foreach ($services as $service): ?>
            <div class="service-card" style="padding: 2rem;">
                <div class="service-card__icon" style="width: 56px; height: 56px;">
                    <i data-feather="<?= $service['icon'] ?>"></i>
                </div>
                <h3 class="service-card__title" style="font-size: 1.5rem; margin-bottom: 0.75rem;">
                    <?= $service['title'] ?>
                </h3>
                <p class="service-card__description" style="margin-bottom: 1.5rem;">
                    <?= $service['description'] ?>
                </p>

                <?php if (!empty($service['features'])): ?>
                <ul style="margin-bottom: 1.5rem;">
                    <?php foreach ($service['features'] as $feature): ?>
                    <li style="display: flex; align-items: center; gap: 0.5rem; padding: 0.5rem 0; color: var(--color-text-secondary); font-size: 0.875rem;">
                        <i data-feather="check" style="width: 16px; height: 16px; color: var(--color-success);"></i>
                        <?= $feature ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <a href="<?= \App\Core\View::url('/sluzby/' . $service['slug']) ?>" class="service-card__link">
                    Zjistit více
                    <i data-feather="arrow-right"></i>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-section__box">
            <h2 class="cta-section__title">
                Nevíte, co
                <span class="text-gradient">potřebujete?</span>
            </h2>
            <p class="cta-section__description">
                Nevadí! Zavolejte nám nebo napište a společně najdeme
                ideální řešení pro váš byznys.
            </p>
            <a href="<?= \App\Core\View::url('/kontakt') ?>" class="btn btn--primary btn--large">
                Domluvit konzultaci zdarma
                <i data-feather="calendar"></i>
            </a>
        </div>
    </div>
</section>

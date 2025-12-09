<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <span class="section__badge">Ceník</span>
        <h1 class="page-header__title">
            Jednoduchý a
            <span class="text-gradient">transparentní ceník</span>
        </h1>
        <p class="page-header__description">
            Žádné skryté poplatky, žádné překvapení.
            Vyberte si balíček, který vám vyhovuje.
        </p>
    </div>
</section>

<!-- Pricing Plans -->
<section class="section">
    <div class="container">
        <div class="pricing__grid">
            <?php foreach ($plans as $plan): ?>
            <div class="pricing-card <?= $plan['featured'] ? 'pricing-card--featured' : '' ?>">
                <div class="pricing-card__header">
                    <h3 class="pricing-card__name"><?= $plan['name'] ?></h3>
                    <div class="pricing-card__hours"><?= $plan['hours'] ?></div>
                    <p style="font-size: 0.875rem; color: var(--color-text-muted); margin-bottom: 1rem;">
                        <?= $plan['description'] ?>
                    </p>
                    <div class="pricing-card__price">
                        <?= number_format((int)$plan['price'], 0, ',', ' ') ?> Kč
                        <span>/<?= $plan['period'] ?></span>
                    </div>
                </div>

                <div class="pricing-card__features">
                    <?php foreach ($plan['features'] as $feature): ?>
                    <?php
                        // Handle both formats: array with text/included OR simple string
                        $isArray = is_array($feature);
                        $text = $isArray ? ($feature['text'] ?? $feature) : $feature;
                        $included = $isArray ? ($feature['included'] ?? true) : true;
                    ?>
                    <div class="pricing-card__feature <?= !$included ? 'pricing-card__feature--disabled' : '' ?>">
                        <i data-feather="<?= $included ? 'check' : 'x' ?>"></i>
                        <?= htmlspecialchars($text) ?>
                    </div>
                    <?php endforeach; ?>
                </div>

                <a href="<?= \App\Core\View::url('/kontakt') ?>?plan=<?= $plan['name'] ?>" class="btn <?= $plan['featured'] ? 'btn--primary' : 'btn--secondary' ?> pricing-card__cta">
                    <?= $plan['cta'] ?? ($plan['featured'] ? 'Nejoblíbenější volba' : 'Začít s tímto plánem') ?>
                </a>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Enterprise note -->
        <div style="text-align: center; margin-top: 3rem; padding: 2rem; background: var(--color-bg-card); border: 1px solid var(--color-border); border-radius: var(--radius-xl);">
            <h3 style="margin-bottom: 0.5rem;">Potřebujete více?</h3>
            <p style="color: var(--color-text-secondary); margin-bottom: 1rem;">
                Pro velké projekty nabízíme individuální řešení na míru.
            </p>
            <a href="<?= \App\Core\View::url('/kontakt') ?>?plan=enterprise" class="btn btn--secondary">
                Kontaktovat sales tým
            </a>
        </div>
    </div>
</section>

<!-- Add-ons -->
<section class="section section--alt">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">Doplňkové služby</span>
            <h2 class="section__title">
                Potřebujete něco
                <span class="text-gradient">navíc?</span>
            </h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; max-width: 800px; margin: 0 auto;">
            <?php foreach ($addons as $addon): ?>
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1.25rem; background: var(--color-bg-card); border: 1px solid var(--color-border); border-radius: var(--radius-lg);">
                <span style="font-weight: 500;"><?= $addon['name'] ?></span>
                <span style="color: var(--color-accent-secondary); font-weight: 600;"><?= $addon['price'] ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="section">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">Časté dotazy</span>
            <h2 class="section__title">
                Máte
                <span class="text-gradient">otázky?</span>
            </h2>
        </div>

        <div class="faq__list">
            <div class="faq-item active">
                <button class="faq-item__question">
                    Mohu kdykoliv změnit nebo zrušit předplatné?
                    <i data-feather="chevron-down" class="faq-item__icon"></i>
                </button>
                <div class="faq-item__answer">
                    <p>Ano! Nejsme agentura, která vás zamyká do dlouhodobých smluv. Můžete upgradovat, downgradovat nebo zrušit kdykoliv. Věříme ve výsledky, ne v papíry.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-item__question">
                    Co se stane s nevyužitými hodinami?
                    <i data-feather="chevron-down" class="faq-item__icon"></i>
                </button>
                <div class="faq-item__answer">
                    <p>Nevyužité hodiny se přenášejí do dalšího měsíce (max. 1 měsíc). Snažíme se ale vždy využít všechny vaše hodiny efektivně.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-item__question">
                    Jsou v ceně zahrnuty náklady na reklamu?
                    <i data-feather="chevron-down" class="faq-item__icon"></i>
                </button>
                <div class="faq-item__answer">
                    <p>Ne, reklamní rozpočet (ad spend) pro Meta Ads a Google Ads není zahrnut v ceně balíčku. Tyto náklady platíte přímo platformám a stanovujete si je sami podle svých možností.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-item__question">
                    Jak probíhá reporting?
                    <i data-feather="chevron-down" class="faq-item__icon"></i>
                </button>
                <div class="faq-item__answer">
                    <p>Dostáváte pravidelné reporty podle vašeho balíčku (měsíčně/týdně). Navíc máte přístup k live dashboardu, kde vidíte aktuální data kdykoliv.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-section__box">
            <h2 class="cta-section__title">
                Připraveni
                <span class="text-gradient">začít?</span>
            </h2>
            <p class="cta-section__description">
                Domluvme si nezávaznou konzultaci.
                Probereme vaše cíle a doporučíme ideální balíček.
            </p>
            <a href="<?= \App\Core\View::url('/kontakt') ?>" class="btn btn--primary btn--large">
                Domluvit konzultaci zdarma
                <i data-feather="calendar"></i>
            </a>
        </div>
    </div>
</section>

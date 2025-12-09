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

<!-- Pricing Calculator -->
<section class="calculator section--alt" id="kalkulacka">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">Kalkulačka</span>
            <h2 class="section__title">
                Spočítejte si svoji
                <span class="text-gradient">cenu</span>
            </h2>
            <p class="section__description">
                Vyberte služby, které potřebujete, a získejte orientační cenu.
            </p>
        </div>

        <?php
        // Default prices if not set from admin
        $prices = $calculatorPrices ?? [
            'social' => 8000,
            'meta' => 6000,
            'google' => 6000,
            'email' => 4000,
            'seo' => 8000,
            'content' => 5000,
        ];
        ?>
        <div class="calculator__wrapper">
            <div class="calculator__form" id="calculatorForm">
                <div class="calculator__group">
                    <label class="calculator__label">Jaké služby potřebujete?</label>
                    <div class="calculator__options calculator__options--grid">
                        <label class="calculator__option">
                            <input type="checkbox" name="service" value="social" data-price="<?= $prices['social'] ?>" onchange="calculatePrice()">
                            <div class="calculator__checkbox"><i data-feather="check"></i></div>
                            <div>
                                <strong>Správa soc. sítí</strong>
                                <div style="font-size: 0.75rem; color: var(--color-text-muted);">od <?= number_format($prices['social'], 0, ',', ' ') ?> Kč/měs.</div>
                            </div>
                        </label>
                        <label class="calculator__option">
                            <input type="checkbox" name="service" value="meta" data-price="<?= $prices['meta'] ?>" onchange="calculatePrice()">
                            <div class="calculator__checkbox"><i data-feather="check"></i></div>
                            <div>
                                <strong>Meta Ads</strong>
                                <div style="font-size: 0.75rem; color: var(--color-text-muted);">od <?= number_format($prices['meta'], 0, ',', ' ') ?> Kč/měs.</div>
                            </div>
                        </label>
                        <label class="calculator__option">
                            <input type="checkbox" name="service" value="google" data-price="<?= $prices['google'] ?>" onchange="calculatePrice()">
                            <div class="calculator__checkbox"><i data-feather="check"></i></div>
                            <div>
                                <strong>Google Ads</strong>
                                <div style="font-size: 0.75rem; color: var(--color-text-muted);">od <?= number_format($prices['google'], 0, ',', ' ') ?> Kč/měs.</div>
                            </div>
                        </label>
                        <label class="calculator__option">
                            <input type="checkbox" name="service" value="email" data-price="<?= $prices['email'] ?>" onchange="calculatePrice()">
                            <div class="calculator__checkbox"><i data-feather="check"></i></div>
                            <div>
                                <strong>E-mail marketing</strong>
                                <div style="font-size: 0.75rem; color: var(--color-text-muted);">od <?= number_format($prices['email'], 0, ',', ' ') ?> Kč/měs.</div>
                            </div>
                        </label>
                        <label class="calculator__option">
                            <input type="checkbox" name="service" value="seo" data-price="<?= $prices['seo'] ?>" onchange="calculatePrice()">
                            <div class="calculator__checkbox"><i data-feather="check"></i></div>
                            <div>
                                <strong>SEO optimalizace</strong>
                                <div style="font-size: 0.75rem; color: var(--color-text-muted);">od <?= number_format($prices['seo'], 0, ',', ' ') ?> Kč/měs.</div>
                            </div>
                        </label>
                        <label class="calculator__option">
                            <input type="checkbox" name="service" value="content" data-price="<?= $prices['content'] ?>" onchange="calculatePrice()">
                            <div class="calculator__checkbox"><i data-feather="check"></i></div>
                            <div>
                                <strong>Tvorba obsahu</strong>
                                <div style="font-size: 0.75rem; color: var(--color-text-muted);">od <?= number_format($prices['content'], 0, ',', ' ') ?> Kč/měs.</div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="calculator__group">
                    <label class="calculator__label">Kolik sociálních sítí chcete spravovat?</label>
                    <div class="calculator__options">
                        <label class="calculator__option">
                            <input type="radio" name="networks" value="1-2" data-multiplier="1" onchange="calculatePrice()" checked>
                            <div class="calculator__checkbox"><i data-feather="check"></i></div>
                            <span>1-2 sítě</span>
                        </label>
                        <label class="calculator__option">
                            <input type="radio" name="networks" value="3-4" data-multiplier="1.3" onchange="calculatePrice()">
                            <div class="calculator__checkbox"><i data-feather="check"></i></div>
                            <span>3-4 sítě (+30%)</span>
                        </label>
                        <label class="calculator__option">
                            <input type="radio" name="networks" value="5+" data-multiplier="1.5" onchange="calculatePrice()">
                            <div class="calculator__checkbox"><i data-feather="check"></i></div>
                            <span>5 a více (+50%)</span>
                        </label>
                    </div>
                </div>

                <div class="calculator__result">
                    <div class="calculator__price" id="calculatorPrice">0 Kč</div>
                    <div class="calculator__note">Orientační měsíční cena</div>
                    <a href="<?= \App\Core\View::url('/kontakt') ?>?source=calculator" class="btn btn--primary" style="margin-top: 1rem;">
                        Získat přesnou nabídku
                        <i data-feather="arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function calculatePrice() {
    var total = 0;
    var checkboxes = document.querySelectorAll('input[name="service"]:checked');
    checkboxes.forEach(function(cb) {
        total += parseInt(cb.dataset.price);
    });

    var multiplier = document.querySelector('input[name="networks"]:checked');
    if (multiplier) {
        total = Math.round(total * parseFloat(multiplier.dataset.multiplier));
    }

    document.getElementById('calculatorPrice').textContent = total.toLocaleString('cs-CZ') + ' Kč';

    // Update selected states for better browser compatibility
    updateSelectedStates();
}

function updateSelectedStates() {
    // Handle checkboxes
    document.querySelectorAll('.calculator__option input[type="checkbox"]').forEach(function(input) {
        var label = input.closest('.calculator__option');
        if (input.checked) {
            label.classList.add('selected');
        } else {
            label.classList.remove('selected');
        }
    });

    // Handle radio buttons
    document.querySelectorAll('.calculator__option input[type="radio"]').forEach(function(input) {
        var label = input.closest('.calculator__option');
        if (input.checked) {
            label.classList.add('selected');
        } else {
            label.classList.remove('selected');
        }
    });
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateSelectedStates();
});
</script>

<!-- Add-ons -->
<section class="section">
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

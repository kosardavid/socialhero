<!-- Hero Section -->
<section class="hero">
    <div class="hero__container container">
        <div class="hero__content">
            <div class="hero__badge">
                <span class="hero__badge-dot"></span>
                Přijímáme nové klienty
            </div>

            <h1 class="hero__title">
                Veškerý online marketing v
                <span class="text-gradient">jednom předplatném</span>
            </h1>

            <p class="hero__subtitle">
                Sociální sítě, Meta Ads, Google Ads, e-mailing a více.
                Jeden tým, jeden kontakt, měřitelné výsledky.
            </p>

            <div class="hero__actions">
                <a href="<?= \App\Core\View::url('/kontakt') ?>" class="btn btn--primary btn--large">
                    Nezávazná konzultace
                    <i data-feather="arrow-right"></i>
                </a>
                <a href="<?= \App\Core\View::url('/cenik') ?>" class="btn btn--secondary btn--large">
                    Zobrazit ceník
                </a>
            </div>
        </div>

        <div class="hero__visual">
            <div class="hero__image">
                <!-- Placeholder for hero image/illustration -->
                <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
                    <rect width="400" height="400" fill="url(#heroGrad)"/>
                    <circle cx="200" cy="200" r="100" stroke="rgba(255,255,255,0.2)" stroke-width="2" fill="none"/>
                    <circle cx="200" cy="200" r="150" stroke="rgba(255,255,255,0.1)" stroke-width="1" fill="none"/>
                    <path d="M200 100 L200 300 M100 200 L300 200" stroke="rgba(255,255,255,0.1)" stroke-width="1"/>
                    <circle cx="200" cy="200" r="20" fill="rgba(124, 58, 237, 0.5)"/>
                    <circle cx="150" cy="150" r="10" fill="rgba(168, 85, 247, 0.5)"/>
                    <circle cx="250" cy="150" r="10" fill="rgba(236, 72, 153, 0.5)"/>
                    <circle cx="150" cy="250" r="10" fill="rgba(249, 115, 22, 0.5)"/>
                    <circle cx="250" cy="250" r="10" fill="rgba(34, 197, 94, 0.5)"/>
                    <defs>
                        <linearGradient id="heroGrad" x1="0" y1="0" x2="400" y2="400">
                            <stop offset="0%" stop-color="#1a1a2e"/>
                            <stop offset="100%" stop-color="#0a0a0f"/>
                        </linearGradient>
                    </defs>
                </svg>
            </div>

            <div class="hero__float hero__float--1">
                <i data-feather="trending-up" style="color: #22c55e;"></i>
                <span style="font-size: 0.875rem; margin-left: 0.5rem;">+127% tržby</span>
            </div>

            <div class="hero__float hero__float--2">
                <i data-feather="users" style="color: #a855f7;"></i>
                <span style="font-size: 0.875rem; margin-left: 0.5rem;">+2,400 zákazníků</span>
            </div>

            <div class="hero__float hero__float--3">
                <i data-feather="target" style="color: #f97316;"></i>
                <span style="font-size: 0.875rem; margin-left: 0.5rem;">ROAS 4.2x</span>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats">
    <div class="container">
        <div class="stats__grid">
            <?php foreach ($stats as $stat): ?>
            <div class="stats__item">
                <div class="stats__number"><?= $stat['number'] ?></div>
                <div class="stats__label"><?= $stat['label'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="section" id="sluzby">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">Naše služby</span>
            <h2 class="section__title">
                Vše, co potřebujete pro
                <span class="text-gradient">online růst</span>
            </h2>
            <p class="section__description">
                Kompletní online marketing pod jednou střechou.
                Od strategie přes realizaci až po reporting.
            </p>
        </div>

        <div class="services__grid">
            <?php foreach ($services as $service): ?>
            <div class="service-card">
                <div class="service-card__icon">
                    <i data-feather="<?= $service['icon'] ?>"></i>
                </div>
                <h3 class="service-card__title"><?= $service['title'] ?></h3>
                <p class="service-card__description"><?= $service['description'] ?></p>
                <a href="<?= \App\Core\View::url('/sluzby/' . ($service['slug'] ?? '')) ?>" class="service-card__link">
                    Zjistit více
                    <i data-feather="arrow-right"></i>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="section section--alt">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">Proč SocialHero</span>
            <h2 class="section__title">
                Marketing bez
                <span class="text-gradient">zbytečností</span>
            </h2>
            <p class="section__description">
                Žádné dlouhé smlouvy, skryté poplatky nebo nejasné reporty.
                Jen měřitelné výsledky.
            </p>
        </div>

        <div class="services__grid">
            <div class="service-card">
                <div class="service-card__icon">
                    <i data-feather="layers"></i>
                </div>
                <h3 class="service-card__title">Vše na jednom místě</h3>
                <p class="service-card__description">
                    Jeden tým pro všechny vaše marketingové potřeby.
                    Žádné jonglování mezi agenturami.
                </p>
            </div>

            <div class="service-card">
                <div class="service-card__icon">
                    <i data-feather="eye"></i>
                </div>
                <h3 class="service-card__title">Transparentní billing</h3>
                <p class="service-card__description">
                    Víte přesně, za co platíte. Hodinové reporty,
                    jasné výstupy, žádná překvapení.
                </p>
            </div>

            <div class="service-card">
                <div class="service-card__icon">
                    <i data-feather="zap"></i>
                </div>
                <h3 class="service-card__title">Rychlá odezva</h3>
                <p class="service-card__description">
                    Na každý dotaz odpovídáme do 24 hodin.
                    Urgent záležitosti řešíme ihned.
                </p>
            </div>

            <div class="service-card">
                <div class="service-card__icon">
                    <i data-feather="refresh-cw"></i>
                </div>
                <h3 class="service-card__title">Flexibilita</h3>
                <p class="service-card__description">
                    Měníte potřeby? Žádný problém.
                    Můžete kdykoliv upgradovat nebo zrušit.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="section" id="cenik">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">Ceník</span>
            <h2 class="section__title">
                Jednoduchý a
                <span class="text-gradient">transparentní</span>
            </h2>
            <p class="section__description">
                Vyberte si balíček podle vašich potřeb.
                Bez skrytých poplatků, bez dlouhodobých závazků.
            </p>
        </div>

        <div class="pricing__grid">
            <?php foreach ($pricing as $plan): ?>
            <div class="pricing-card <?= $plan['featured'] ? 'pricing-card--featured' : '' ?>">
                <div class="pricing-card__header">
                    <h3 class="pricing-card__name"><?= $plan['name'] ?></h3>
                    <div class="pricing-card__hours"><?= $plan['hours'] ?></div>
                    <div class="pricing-card__price">
                        <?= number_format($plan['price'], 0, ',', ' ') ?> Kč
                        <span>/<?= $plan['period'] ?></span>
                    </div>
                </div>
                <div class="pricing-card__features">
                    <?php foreach ($plan['features'] as $feature): ?>
                    <div class="pricing-card__feature">
                        <i data-feather="check"></i>
                        <?= $feature ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <a href="<?= \App\Core\View::url('/kontakt') ?>" class="btn <?= $plan['featured'] ? 'btn--primary' : 'btn--secondary' ?> pricing-card__cta">
                    Začít s tímto plánem
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="section section--alt">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">Reference</span>
            <h2 class="section__title">
                Co říkají naši
                <span class="text-gradient">klienti</span>
            </h2>
        </div>

        <div class="testimonials__grid">
            <?php foreach ($testimonials as $testimonial): ?>
            <div class="testimonial-card">
                <p class="testimonial-card__text">"<?= $testimonial['text'] ?>"</p>
                <div class="testimonial-card__author">
                    <div class="testimonial-card__avatar">
                        <!-- Avatar placeholder -->
                    </div>
                    <div>
                        <div class="testimonial-card__name"><?= $testimonial['name'] ?></div>
                        <div class="testimonial-card__company"><?= $testimonial['company'] ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-xl">
            <a href="<?= \App\Core\View::url('/reference') ?>" class="btn btn--secondary">
                Zobrazit všechny reference
                <i data-feather="arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section" id="faq">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">FAQ</span>
            <h2 class="section__title">
                Časté
                <span class="text-gradient">dotazy</span>
            </h2>
        </div>

        <div class="faq__list">
            <?php foreach ($faqs as $index => $faq): ?>
            <div class="faq-item <?= $index === 0 ? 'active' : '' ?>">
                <button class="faq-item__question">
                    <?= $faq['question'] ?>
                    <i data-feather="chevron-down" class="faq-item__icon"></i>
                </button>
                <div class="faq-item__answer">
                    <p><?= $faq['answer'] ?></p>
                </div>
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
                Připraveni na
                <span class="text-gradient">růst?</span>
            </h2>
            <p class="cta-section__description">
                Domluvme si nezávaznou konzultaci.
                Probereme vaše cíle a navrhneme strategii šitou na míru.
            </p>
            <a href="<?= \App\Core\View::url('/kontakt') ?>" class="btn btn--primary btn--large">
                Domluvit konzultaci zdarma
                <i data-feather="calendar"></i>
            </a>
        </div>
    </div>
</section>

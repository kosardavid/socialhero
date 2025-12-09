<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <span class="section__badge">Reference</span>
        <h1 class="page-header__title">
            Výsledky, které
            <span class="text-gradient">mluví za nás</span>
        </h1>
        <p class="page-header__description">
            Podívejte se na výsledky, kterých jsme dosáhli pro naše klienty.
            Čísla nelžou.
        </p>
    </div>
</section>

<!-- Case Studies -->
<section class="section">
    <div class="container">
        <div class="case-studies__grid" style="display: grid; gap: 2rem;">
            <?php foreach ($caseStudies as $case): ?>
            <div class="case-study-card" style="display: grid; grid-template-columns: 1fr; gap: 2rem; padding: 2rem; background: var(--color-bg-card); border: 1px solid var(--color-border); border-radius: var(--radius-xl);">
                <div class="case-study-card__image" style="aspect-ratio: 16/10; background: var(--color-bg-tertiary); border-radius: var(--radius-lg); overflow: hidden;">
                    <!-- Image placeholder -->
                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: var(--color-text-muted);">
                        <i data-feather="image" style="width: 48px; height: 48px;"></i>
                    </div>
                </div>

                <div class="case-study-card__content">
                    <span style="display: inline-block; padding: 0.25rem 0.75rem; background: rgba(124, 58, 237, 0.1); border-radius: var(--radius-full); font-size: 0.75rem; color: var(--color-accent-secondary); margin-bottom: 1rem;">
                        <?= $case['category'] ?>
                    </span>

                    <h3 style="font-size: 1.5rem; margin-bottom: 0.75rem;"><?= $case['title'] ?></h3>

                    <p style="color: var(--color-text-secondary); margin-bottom: 1.5rem;">
                        <?= $case['description'] ?>
                    </p>

                    <!-- Results -->
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
                        <?php foreach ($case['results'] as $result): ?>
                        <div style="text-align: center; padding: 1rem; background: var(--color-bg-tertiary); border-radius: var(--radius-lg);">
                            <div style="font-size: 1.5rem; font-weight: 700; color: var(--color-accent-secondary);">
                                <?= $result['value'] ?>
                            </div>
                            <div style="font-size: 0.75rem; color: var(--color-text-muted);">
                                <?= $result['label'] ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <a href="#" class="service-card__link">
                        Celá případová studie
                        <i data-feather="arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Clients Logos -->
<section class="section section--alt">
    <div class="container">
        <div class="section__header">
            <h2 class="section__title" style="font-size: var(--text-2xl);">
                Důvěřují nám
            </h2>
        </div>

        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 3rem; opacity: 0.6;">
            <?php foreach ($clients as $client): ?>
            <div style="width: 120px; height: 60px; display: flex; align-items: center; justify-content: center; filter: grayscale(1); transition: filter 0.3s;">
                <!-- Logo placeholder -->
                <div style="padding: 1rem; background: var(--color-bg-tertiary); border-radius: var(--radius-md); font-size: 0.75rem; color: var(--color-text-muted);">
                    Logo
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
                Chcete být naší další
                <span class="text-gradient">úspěšnou referencí?</span>
            </h2>
            <p class="cta-section__description">
                Pojďme společně vytvořit příběh úspěchu i pro váš byznys.
            </p>
            <a href="<?= \App\Core\View::url('/kontakt') ?>" class="btn btn--primary btn--large">
                Začít spolupráci
                <i data-feather="arrow-right"></i>
            </a>
        </div>
    </div>
</section>

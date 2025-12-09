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
            <div class="case-study-card--enhanced">
                <!-- Left: Metrics -->
                <div class="case-study__left">
                    <span style="display: inline-block; padding: 0.25rem 0.75rem; background: rgba(124, 58, 237, 0.1); border-radius: var(--radius-full); font-size: 0.75rem; color: var(--color-accent-secondary); margin-bottom: 1rem;">
                        <?= htmlspecialchars($case['category'] ?? 'Marketing') ?>
                    </span>

                    <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;"><?= htmlspecialchars($case['title']) ?></h3>
                    <p style="font-size: 0.875rem; color: var(--color-text-muted); margin-bottom: 1.5rem;">
                        <?= htmlspecialchars($case['client_name'] ?? '') ?>
                    </p>

                    <!-- Key Metrics -->
                    <div class="case-study__metrics">
                        <?php
                        $results = $case['results'] ?? [];
                        if (is_string($results)) {
                            $results = json_decode($results, true) ?? [];
                        }
                        foreach ($results as $result):
                        ?>
                        <div class="case-study__metric">
                            <div class="case-study__metric-value"><?= htmlspecialchars($result['value'] ?? '') ?></div>
                            <div class="case-study__metric-label"><?= htmlspecialchars($result['label'] ?? '') ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Right: Details -->
                <div class="case-study__right">
                    <p style="color: var(--color-text-secondary); margin-bottom: 1.5rem; font-size: 1rem; line-height: 1.7;">
                        <?= htmlspecialchars($case['description'] ?? $case['short_description'] ?? '') ?>
                    </p>

                    <?php if (!empty($case['challenge'])): ?>
                    <div class="case-study__challenge">
                        <div class="case-study__challenge-title">
                            <i data-feather="alert-circle" style="width: 16px; height: 16px;"></i>
                            Výzva
                        </div>
                        <p class="case-study__challenge-text"><?= htmlspecialchars($case['challenge']) ?></p>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($case['solution'])): ?>
                    <div class="case-study__solution">
                        <div class="case-study__solution-title">
                            <i data-feather="check-circle" style="width: 16px; height: 16px;"></i>
                            Řešení
                        </div>
                        <p class="case-study__solution-text"><?= htmlspecialchars($case['solution']) ?></p>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($case['testimonial'])): ?>
                    <div style="padding: 1rem; background: rgba(124, 58, 237, 0.05); border-left: 3px solid var(--color-accent-primary); border-radius: 0 var(--radius-md) var(--radius-md) 0; margin-top: 1rem;">
                        <p style="font-style: italic; color: var(--color-text-secondary); margin-bottom: 0.5rem;">
                            "<?= htmlspecialchars($case['testimonial']) ?>"
                        </p>
                        <?php if (!empty($case['testimonial_author'])): ?>
                        <p style="font-size: 0.75rem; color: var(--color-text-muted);">
                            — <?= htmlspecialchars($case['testimonial_author']) ?>
                        </p>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
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

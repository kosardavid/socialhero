<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <span class="section__badge">O nás</span>
        <h1 class="page-header__title">
            Jsme tým
            <span class="text-gradient">marketingových nadšenců</span>
        </h1>
        <p class="page-header__description">
            Milujeme svou práci a věříme ve výsledky.
            Ne v dlouhé smlouvy a prázdné sliby.
        </p>
    </div>
</section>

<!-- Story Section -->
<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr; gap: 3rem; align-items: center;">
            <div>
                <span class="section__badge">Náš příběh</span>
                <h2 style="margin-bottom: 1.5rem;">
                    Proč jsme založili
                    <span class="text-gradient">SocialHero</span>
                </h2>
                <p style="color: var(--color-text-secondary); margin-bottom: 1rem; font-size: 1.125rem; line-height: 1.8;">
                    Po letech práce v tradičních agenturách jsme viděli, jak firmy platí za služby,
                    které nepotřebují, zamykají se do dlouhodobých smluv a nemají přehled o tom,
                    kam jejich peníze skutečně tečou.
                </p>
                <p style="color: var(--color-text-secondary); margin-bottom: 1rem; font-size: 1.125rem; line-height: 1.8;">
                    Proto jsme vytvořili SocialHero - agenturu, která funguje jinak.
                    S transparentním ceníkem, flexibilním předplatným a důrazem na měřitelné výsledky.
                </p>
                <p style="color: var(--color-text-secondary); font-size: 1.125rem; line-height: 1.8;">
                    Věříme, že kvalitní marketing by měl být dostupný pro každého -
                    od malých živnostníků po velké korporace.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="section section--alt">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">Naše hodnoty</span>
            <h2 class="section__title">
                Na čem nám
                <span class="text-gradient">záleží</span>
            </h2>
        </div>

        <div class="services__grid">
            <?php foreach ($values as $value): ?>
            <div class="service-card">
                <div class="service-card__icon">
                    <i data-feather="<?= $value['icon'] ?>"></i>
                </div>
                <h3 class="service-card__title"><?= $value['title'] ?></h3>
                <p class="service-card__description"><?= $value['description'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="section">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">Náš tým</span>
            <h2 class="section__title">
                Lidé za
                <span class="text-gradient">SocialHero</span>
            </h2>
            <p class="section__description">
                Malý tým expertů, kteří milují svou práci.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; max-width: 800px; margin: 0 auto;">
            <?php foreach ($team as $member): ?>
            <div style="text-align: center; padding: 2rem; background: var(--color-bg-card); border: 1px solid var(--color-border); border-radius: var(--radius-xl);">
                <div style="width: 120px; height: 120px; margin: 0 auto 1.5rem; border-radius: 50%; background: var(--color-bg-tertiary); display: flex; align-items: center; justify-content: center;">
                    <i data-feather="user" style="width: 48px; height: 48px; color: var(--color-text-muted);"></i>
                </div>
                <h3 style="margin-bottom: 0.25rem;"><?= $member['name'] ?></h3>
                <p style="color: var(--color-accent-secondary); font-size: 0.875rem; margin-bottom: 1rem;"><?= $member['role'] ?></p>
                <?php if (!empty($member['linkedin'])): ?>
                <a href="<?= $member['linkedin'] ?>" target="_blank" rel="noopener" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: var(--color-bg-tertiary); border-radius: var(--radius-md); color: var(--color-text-secondary);">
                    <i data-feather="linkedin" style="width: 18px; height: 18px;"></i>
                </a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="stats">
    <div class="container">
        <div class="stats__grid">
            <div class="stats__item">
                <div class="stats__number">5+</div>
                <div class="stats__label">Let zkušeností</div>
            </div>
            <div class="stats__item">
                <div class="stats__number">150+</div>
                <div class="stats__label">Spokojených klientů</div>
            </div>
            <div class="stats__item">
                <div class="stats__number">500+</div>
                <div class="stats__label">Úspěšných kampaní</div>
            </div>
            <div class="stats__item">
                <div class="stats__number">40%</div>
                <div class="stats__label">Průměrný růst konverzí</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-section__box">
            <h2 class="cta-section__title">
                Pojďme se
                <span class="text-gradient">poznat</span>
            </h2>
            <p class="cta-section__description">
                Zavolejte nám nebo napište. Rádi vám povíme více o tom,
                jak můžeme pomoct vašemu byznysu růst.
            </p>
            <a href="<?= \App\Core\View::url('/kontakt') ?>" class="btn btn--primary btn--large">
                Kontaktovat nás
                <i data-feather="message-circle"></i>
            </a>
        </div>
    </div>
</section>

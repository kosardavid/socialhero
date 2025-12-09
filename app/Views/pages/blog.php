<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <span class="section__badge">Blog</span>
        <h1 class="page-header__title">
            Tipy a novinky ze světa
            <span class="text-gradient">online marketingu</span>
        </h1>
        <p class="page-header__description">
            Návody, případové studie a nejnovější trendy.
            Vše, co potřebujete vědět pro úspěšný online marketing.
        </p>
    </div>
</section>

<!-- Blog Posts -->
<section class="section">
    <div class="container">
        <?php if (empty($posts)): ?>
        <div style="text-align: center; padding: 4rem 2rem;">
            <div style="width: 80px; height: 80px; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; background: var(--color-bg-tertiary); border-radius: 50%;">
                <i data-feather="edit-3" style="width: 32px; height: 32px; color: var(--color-text-muted);"></i>
            </div>
            <h3 style="margin-bottom: 0.5rem;">Připravujeme nové články</h3>
            <p style="color: var(--color-text-secondary); max-width: 400px; margin: 0 auto;">
                Blog se připravuje. Brzy zde najdete užitečné tipy a návody
                ze světa online marketingu.
            </p>
        </div>
        <?php else: ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem;">
            <?php foreach ($posts as $post): ?>
            <article style="background: var(--color-bg-card); border: 1px solid var(--color-border); border-radius: var(--radius-xl); overflow: hidden; transition: all 0.3s;">
                <a href="<?= \App\Core\View::url('/blog/' . $post['slug']) ?>" style="display: block;">
                    <div style="aspect-ratio: 16/9; background: var(--color-bg-tertiary); display: flex; align-items: center; justify-content: center;">
                        <i data-feather="image" style="width: 48px; height: 48px; color: var(--color-text-muted);"></i>
                    </div>
                </a>
                <div style="padding: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <span style="padding: 0.25rem 0.75rem; background: rgba(124, 58, 237, 0.1); border-radius: var(--radius-full); font-size: 0.75rem; color: var(--color-accent-secondary);">
                            <?= $post['category'] ?>
                        </span>
                        <span style="font-size: 0.75rem; color: var(--color-text-muted);">
                            <?= date('d.m.Y', strtotime($post['date'])) ?>
                        </span>
                    </div>
                    <h3 style="margin-bottom: 0.75rem;">
                        <a href="<?= \App\Core\View::url('/blog/' . $post['slug']) ?>" style="color: var(--color-text-primary);">
                            <?= $post['title'] ?>
                        </a>
                    </h3>
                    <p style="color: var(--color-text-secondary); font-size: 0.875rem; margin-bottom: 1rem;">
                        <?= $post['excerpt'] ?>
                    </p>
                    <a href="<?= \App\Core\View::url('/blog/' . $post['slug']) ?>" class="service-card__link">
                        Číst více
                        <i data-feather="arrow-right"></i>
                    </a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Newsletter -->
<section class="section section--alt">
    <div class="container">
        <div style="max-width: 600px; margin: 0 auto; text-align: center;">
            <span class="section__badge">Newsletter</span>
            <h2 class="section__title">
                Nechte si posílat
                <span class="text-gradient">novinky</span>
            </h2>
            <p style="color: var(--color-text-secondary); margin-bottom: 2rem;">
                Jednou měsíčně vám pošleme souhrn nejlepších článků
                a tipy, jak zlepšit váš online marketing.
            </p>

            <form id="newsletter-form" style="display: flex; gap: 0.75rem; max-width: 400px; margin: 0 auto;">
                <input type="email" name="email" placeholder="váš@email.cz" required class="form-input" style="flex: 1;">
                <button type="submit" class="btn btn--primary">
                    Odebírat
                </button>
            </form>

            <p style="font-size: 0.75rem; color: var(--color-text-muted); margin-top: 1rem;">
                Žádný spam. Odhlásit se můžete kdykoliv.
            </p>
        </div>
    </div>
</section>

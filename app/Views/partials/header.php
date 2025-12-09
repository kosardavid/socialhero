<header class="header" id="header">
    <nav class="nav container">
        <a href="<?= \App\Core\View::url('/') ?>" class="nav__logo">
            <span class="logo-text">Social<span class="logo-highlight">Hero</span></span>
        </a>

        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="<?= \App\Core\View::url('/sluzby') ?>" class="nav__link">Služby</a>
                </li>
                <li class="nav__item">
                    <a href="<?= \App\Core\View::url('/reference') ?>" class="nav__link">Reference</a>
                </li>
                <li class="nav__item">
                    <a href="<?= \App\Core\View::url('/cenik') ?>" class="nav__link">Ceník</a>
                </li>
                <li class="nav__item">
                    <a href="<?= \App\Core\View::url('/o-nas') ?>" class="nav__link">O nás</a>
                </li>
                <li class="nav__item">
                    <a href="<?= \App\Core\View::url('/blog') ?>" class="nav__link">Blog</a>
                </li>
            </ul>

            <div class="nav__close" id="nav-close">
                <i data-feather="x"></i>
            </div>
        </div>

        <div class="nav__actions">
            <a href="<?= \App\Core\View::url('/kontakt') ?>" class="btn btn--primary">
                Nezávazná konzultace
            </a>

            <div class="nav__toggle" id="nav-toggle">
                <i data-feather="menu"></i>
            </div>
        </div>
    </nav>
</header>

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

<!-- Process Timeline Section -->
<?php if (!empty($processSteps)): ?>
<section class="process section--alt">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">Jak to funguje</span>
            <h2 class="section__title">
                Cesta k vašemu
                <span class="text-gradient">úspěchu</span>
            </h2>
            <p class="section__description">
                Od prvního kontaktu po měřitelné výsledky ve <?= count($processSteps) ?> jednoduchých krocích.
            </p>
        </div>

        <div class="process__timeline">
            <?php foreach ($processSteps as $index => $step): ?>
            <div class="process__step">
                <div class="process__icon">
                    <span class="process__number"><?= $index + 1 ?></span>
                    <i data-feather="<?= htmlspecialchars($step['icon'] ?? 'check') ?>"></i>
                </div>
                <h3 class="process__title"><?= htmlspecialchars($step['title']) ?></h3>
                <p class="process__description">
                    <?= htmlspecialchars($step['description'] ?? '') ?>
                </p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Reels Showcase Section -->
<?php
// Helper function to extract YouTube video ID from URL or ID
function extractYoutubeId($input) {
    if (empty($input)) return '';
    $input = trim($input);

    // If it's already just an ID (11 characters, alphanumeric with - and _)
    if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $input)) {
        return $input;
    }

    // Try to extract from various YouTube URL formats
    // youtube.com/shorts/ID
    if (preg_match('/youtube\.com\/shorts\/([a-zA-Z0-9_-]{11})/', $input, $matches)) {
        return $matches[1];
    }
    // youtube.com/watch?v=ID
    if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]{11})/', $input, $matches)) {
        return $matches[1];
    }
    // youtu.be/ID
    if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]{11})/', $input, $matches)) {
        return $matches[1];
    }
    // youtube.com/embed/ID
    if (preg_match('/youtube\.com\/embed\/([a-zA-Z0-9_-]{11})/', $input, $matches)) {
        return $matches[1];
    }

    return $input; // Return as-is if no pattern matched
}

$reelTypes = [
    1 => \App\Core\View::setting('reel_1_type', 'video'),
    2 => \App\Core\View::setting('reel_2_type', 'video'),
    3 => \App\Core\View::setting('reel_3_type', 'video'),
];
$reelVideos = [
    1 => \App\Core\View::setting('reel_1_video', ''),
    2 => \App\Core\View::setting('reel_2_video', ''),
    3 => \App\Core\View::setting('reel_3_video', ''),
];
$reelYoutubes = [
    1 => extractYoutubeId(\App\Core\View::setting('reel_1_youtube', '')),
    2 => extractYoutubeId(\App\Core\View::setting('reel_2_youtube', '')),
    3 => extractYoutubeId(\App\Core\View::setting('reel_3_youtube', '')),
];
$reelImages = [
    1 => \App\Core\View::setting('reel_1_image', ''),
    2 => \App\Core\View::setting('reel_2_image', ''),
    3 => \App\Core\View::setting('reel_3_image', ''),
];
$reelTexts = [
    1 => \App\Core\View::setting('reel_1_text', ''),
    2 => \App\Core\View::setting('reel_2_text', ''),
    3 => \App\Core\View::setting('reel_3_text', ''),
];
$reelLabels = [
    1 => \App\Core\View::setting('reel_1_label', ''),
    2 => \App\Core\View::setting('reel_2_label', ''),
    3 => \App\Core\View::setting('reel_3_label', ''),
];
?>
<style>
/* Phone slider navigation - hidden on desktop */
.phone-slider-nav {
    display: none;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    margin-top: 1.5rem;
}
.phone-slider-nav__btn {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: rgba(124, 58, 237, 0.2);
    border: 1px solid rgba(124, 58, 237, 0.4);
    color: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}
.phone-slider-nav__btn:hover {
    background: rgba(124, 58, 237, 0.4);
}
.phone-slider-nav__btn svg {
    width: 20px;
    height: 20px;
}
.phone-slider-nav__dots {
    display: flex;
    gap: 0.5rem;
}
.phone-slider-nav__dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    cursor: pointer;
    transition: all 0.2s;
}
.phone-slider-nav__dot.active {
    background: #7c3aed;
    transform: scale(1.2);
}

/* Mobile phone slider */
@media (max-width: 768px) {
    .reels-showcase__phones {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 400px;
    }
    .reels-showcase__phone {
        position: absolute;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }
    .reels-showcase__phone.active {
        position: relative;
        opacity: 1;
        pointer-events: auto;
    }
    .reels-showcase__phone--left,
    .reels-showcase__phone--right,
    .reels-showcase__phone--center {
        transform: none !important;
    }
    .phone-frame,
    .phone-frame--large {
        width: 220px !important;
        height: 440px !important;
        background: linear-gradient(145deg, #1a1a2e, #0a0a0f) !important;
        border: 3px solid #333 !important;
        border-radius: 30px !important;
        position: relative !important;
        overflow: hidden !important;
        padding: 0 !important;
    }
    .phone-frame__screen {
        width: 100% !important;
        height: 100% !important;
        border-radius: 27px !important;
        overflow: hidden !important;
        position: relative !important;
    }
    .phone-frame__video,
    .phone-frame__image {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
    }
    .phone-frame__youtube {
        width: 180% !important;
        height: 100% !important;
        position: absolute !important;
        top: 0 !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
    }
    .phone-frame__notch {
        display: none !important;
    }
    .phone-slider-nav {
        display: flex !important;
    }
}
</style>
<section class="reels-showcase section">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">Ukázka práce</span>
            <h2 class="section__title">
                A jak to
                <span class="text-gradient">vypadá?</span>
            </h2>
            <p class="section__description">
                Podívejte se na ukázky našich Reels a videí pro klienty.
            </p>
        </div>

        <div class="reels-showcase__slider">
            <div class="reels-showcase__phones">
                <?php
                $positions = [1 => 'left', 2 => 'center', 3 => 'right'];
                foreach ([1, 2, 3] as $i):
                    $position = $positions[$i];
                    $isLarge = $i === 2 ? ' phone-frame--large' : '';
                ?>
                <!-- Phone <?= $i ?> -->
                <div class="reels-showcase__phone reels-showcase__phone--<?= $position ?>" data-index="<?= $i ?>">
                    <div class="phone-frame<?= $isLarge ?>" data-has-sound="<?= ($reelTypes[$i] === 'video' || $reelTypes[$i] === 'youtube') ? '1' : '0' ?>">
                        <div class="phone-frame__notch"></div>
                        <div class="phone-frame__screen">
                            <?php if ($reelTypes[$i] === 'video' && !empty($reelVideos[$i])): ?>
                                <video class="phone-frame__video" muted loop playsinline preload="metadata">
                                    <source src="<?= htmlspecialchars($reelVideos[$i]) ?>" type="video/mp4">
                                </video>
                            <?php elseif ($reelTypes[$i] === 'youtube' && !empty($reelYoutubes[$i])): ?>
                                <iframe class="phone-frame__youtube" id="yt-player-<?= $i ?>"
                                    data-src="https://www.youtube.com/embed/<?= htmlspecialchars($reelYoutubes[$i]) ?>?autoplay=1&mute=1&loop=1&playlist=<?= htmlspecialchars($reelYoutubes[$i]) ?>&controls=0&showinfo=0&rel=0&modestbranding=1&playsinline=1&enablejsapi=1&origin=https://socialhero.cz"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            <?php elseif ($reelTypes[$i] === 'image' && !empty($reelImages[$i])): ?>
                                <img src="<?= htmlspecialchars($reelImages[$i]) ?>" alt="<?= htmlspecialchars($reelLabels[$i] ?: 'Reel ' . $i) ?>" class="phone-frame__image">
                            <?php elseif ($reelTypes[$i] === 'text' && !empty($reelTexts[$i])): ?>
                                <div class="phone-frame__text-content">
                                    <?= nl2br(htmlspecialchars($reelTexts[$i])) ?>
                                </div>
                            <?php else: ?>
                                <div class="phone-frame__placeholder">
                                    <i data-feather="play-circle"></i>
                                    <span><?= htmlspecialchars($reelLabels[$i] ?: 'Video ' . $i) ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($reelLabels[$i]) && ($reelTypes[$i] !== 'text' || empty($reelTexts[$i]))): ?>
                                <div class="phone-frame__label"><?= htmlspecialchars($reelLabels[$i]) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Mobile slider navigation -->
            <div class="phone-slider-nav">
                <button class="phone-slider-nav__btn phone-slider-nav__btn--prev" aria-label="Předchozí">
                    <i data-feather="chevron-left"></i>
                </button>
                <div class="phone-slider-nav__dots">
                    <span class="phone-slider-nav__dot active" data-index="1"></span>
                    <span class="phone-slider-nav__dot" data-index="2"></span>
                    <span class="phone-slider-nav__dot" data-index="3"></span>
                </div>
                <button class="phone-slider-nav__btn phone-slider-nav__btn--next" aria-label="Další">
                    <i data-feather="chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<script>
// Phone slider for mobile + lazy load videos
(function() {
    var reelsSection = document.querySelector('.reels-showcase');
    if (!reelsSection) return;

    var phones = reelsSection.querySelectorAll('.reels-showcase__phone');
    var dots = reelsSection.querySelectorAll('.phone-slider-nav__dot');
    var prevBtn = reelsSection.querySelector('.phone-slider-nav__btn--prev');
    var nextBtn = reelsSection.querySelector('.phone-slider-nav__btn--next');
    var currentIndex = 1;
    var loaded = false;

    function isMobile() {
        return window.innerWidth <= 768;
    }

    function showPhone(index) {
        if (!isMobile()) return;

        phones.forEach(function(phone) {
            var phoneIndex = parseInt(phone.getAttribute('data-index'));
            phone.classList.remove('active');
            if (phoneIndex === index) {
                phone.classList.add('active');
            }
        });

        dots.forEach(function(dot) {
            var dotIndex = parseInt(dot.getAttribute('data-index'));
            dot.classList.toggle('active', dotIndex === index);
        });

        currentIndex = index;

        // Play video of current phone, pause others
        phones.forEach(function(phone) {
            var phoneIndex = parseInt(phone.getAttribute('data-index'));
            var video = phone.querySelector('.phone-frame__video');
            if (video) {
                if (phoneIndex === index) {
                    video.play().catch(function() {});
                } else {
                    video.pause();
                }
            }
        });
    }

    function nextPhone() {
        var next = currentIndex + 1;
        if (next > 3) next = 1;
        showPhone(next);
    }

    function prevPhone() {
        var prev = currentIndex - 1;
        if (prev < 1) prev = 3;
        showPhone(prev);
    }

    // Event listeners
    if (prevBtn) prevBtn.addEventListener('click', prevPhone);
    if (nextBtn) nextBtn.addEventListener('click', nextPhone);

    dots.forEach(function(dot) {
        dot.addEventListener('click', function() {
            showPhone(parseInt(this.getAttribute('data-index')));
        });
    });

    // Initialize on mobile
    function init() {
        if (isMobile()) {
            // Remove desktop classes, add active to first
            phones.forEach(function(phone) {
                phone.classList.remove('active');
            });
            showPhone(1);
        } else {
            // Desktop: remove active class, restore positions
            phones.forEach(function(phone) {
                phone.classList.remove('active');
            });
            // Play all videos on desktop
            reelsSection.querySelectorAll('.phone-frame__video').forEach(function(video) {
                video.play().catch(function() {});
            });
        }
    }

    window.addEventListener('resize', init);

    // Lazy load videos when section is visible
    function loadVideos() {
        if (loaded) return;
        loaded = true;

        // Load YouTube iframes
        reelsSection.querySelectorAll('.phone-frame__youtube[data-src]').forEach(function(iframe) {
            iframe.src = iframe.getAttribute('data-src');
            iframe.removeAttribute('data-src');
        });

        // Play videos (or just current on mobile)
        if (isMobile()) {
            showPhone(1);
        } else {
            reelsSection.querySelectorAll('.phone-frame__video').forEach(function(video) {
                video.play().catch(function() {});
            });
        }
    }

    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting && !loaded) {
                    loadVideos();
                    observer.disconnect();
                }
            });
        }, { threshold: 0.5 });

        observer.observe(reelsSection);
    } else {
        loadVideos();
    }

    // Touch swipe support
    var touchStartX = 0;
    var touchEndX = 0;
    var phonesContainer = reelsSection.querySelector('.reels-showcase__phones');

    if (phonesContainer) {
        phonesContainer.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        phonesContainer.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            var diff = touchStartX - touchEndX;
            if (Math.abs(diff) > 50) { // minimum swipe distance
                if (diff > 0) {
                    nextPhone(); // swipe left = next
                } else {
                    prevPhone(); // swipe right = prev
                }
            }
        }, { passive: true });
    }

    // Initialize immediately for mobile
    init();
})();
</script>

<!-- Why Choose Us Section -->
<section class="section">
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

<!-- Video Section -->
<?php if (!empty($settings['youtube_video_id'])): ?>
<section class="video-section">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">Poznejte nás</span>
            <h2 class="section__title">
                Jak pracujeme a
                <span class="text-gradient">kdo jsme</span>
            </h2>
        </div>

        <div class="video-section__wrapper">
            <div class="video-section__embed" id="videoEmbed">
                <div class="video-section__placeholder" onclick="loadVideo()">
                    <div class="video-section__play">
                        <i data-feather="play"></i>
                    </div>
                    <p style="color: var(--color-text-secondary);">Klikněte pro přehrání videa</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function loadVideo() {
    var embed = document.getElementById('videoEmbed');
    embed.innerHTML = '<iframe src="https://www.youtube.com/embed/<?= htmlspecialchars($settings['youtube_video_id']) ?>?autoplay=1&rel=0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}
</script>
<?php endif; ?>

<!-- Certifications Section -->
<?php if (!empty($certifications)): ?>
<section class="partners">
    <div class="container">
        <div class="section__header">
            <span class="section__badge">Certifikace</span>
            <h2 class="section__title" style="font-size: var(--text-2xl);">
                Oficiální partneři a certifikace
            </h2>
        </div>

        <div class="partners__grid">
            <?php foreach ($certifications as $cert): ?>
            <div class="partner-badge">
                <div class="partner-badge__icon" style="background: <?= htmlspecialchars($cert['color']) ?>20; color: <?= htmlspecialchars($cert['color']) ?>;">
                    <i data-feather="<?= htmlspecialchars($cert['icon'] ?? 'award') ?>"></i>
                </div>
                <div>
                    <div class="partner-badge__name"><?= htmlspecialchars($cert['name']) ?></div>
                    <div class="partner-badge__status"><?= htmlspecialchars($cert['description'] ?? '') ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

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

/**
 * SocialHero - Main JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
    // Initialize all components
    initNavigation();
    initScrollEffects();
    initFAQ();
    initForms();
    initAnimations();
    initLazyLoading();
    initStatsCounter();
    initProcessTimeline();
});

/**
 * Lazy Loading for images
 */
function initLazyLoading() {
    // Add loading="lazy" to all images that don't have it
    document.querySelectorAll('img:not([loading])').forEach(img => {
        img.setAttribute('loading', 'lazy');
    });
}

/**
 * Navigation
 */
function initNavigation() {
    const header = document.getElementById('header');
    const navMenu = document.getElementById('nav-menu');
    const navToggle = document.getElementById('nav-toggle');
    const navClose = document.getElementById('nav-close');
    const navLinks = document.querySelectorAll('.nav__link');

    // Toggle mobile menu
    if (navToggle) {
        navToggle.addEventListener('click', () => {
            navMenu.classList.add('show');
            document.body.style.overflow = 'hidden';
        });
    }

    if (navClose) {
        navClose.addEventListener('click', () => {
            navMenu.classList.remove('show');
            document.body.style.overflow = '';
        });
    }

    // Close menu on link click
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            navMenu.classList.remove('show');
            document.body.style.overflow = '';
        });
    });

    // Header scroll effect
    let lastScroll = 0;

    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;

        if (currentScroll > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        lastScroll = currentScroll;
    });

    // Active link based on current page
    const currentPath = window.location.pathname;
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });
}

/**
 * Scroll Effects
 */
function initScrollEffects() {
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const headerHeight = document.getElementById('header').offsetHeight;
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

/**
 * FAQ Accordion
 */
function initFAQ() {
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-item__question');

        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');

            // Close all other items
            faqItems.forEach(otherItem => {
                otherItem.classList.remove('active');
            });

            // Toggle current item
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });
}

/**
 * Forms
 */
function initForms() {
    // Contact form
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', handleContactForm);
    }

    // Newsletter form
    const newsletterForm = document.getElementById('newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', handleNewsletterForm);
    }
}

async function handleContactForm(e) {
    e.preventDefault();

    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;

    // Show loading state
    submitBtn.classList.add('loading');
    submitBtn.textContent = 'Odesílám...';
    submitBtn.disabled = true;

    try {
        const formData = new FormData(form);
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            showToast(result.message, 'success');
            form.reset();
        } else {
            showToast(result.message, 'error');
        }
    } catch (error) {
        showToast('Došlo k chybě. Zkuste to prosím později.', 'error');
    } finally {
        submitBtn.classList.remove('loading');
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
    }
}

async function handleNewsletterForm(e) {
    e.preventDefault();

    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;

    submitBtn.classList.add('loading');
    submitBtn.disabled = true;

    try {
        const formData = new FormData(form);
        const response = await fetch('/api/newsletter', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            showToast(result.message, 'success');
            form.reset();
        } else {
            showToast(result.message, 'error');
        }
    } catch (error) {
        showToast('Došlo k chybě. Zkuste to prosím později.', 'error');
    } finally {
        submitBtn.classList.remove('loading');
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
    }
}

/**
 * Toast Notifications
 */
function showToast(message, type = 'success') {
    // Remove existing toasts
    const existingToast = document.querySelector('.toast');
    if (existingToast) {
        existingToast.remove();
    }

    // Create new toast
    const toast = document.createElement('div');
    toast.className = `toast toast--${type}`;
    toast.textContent = message;

    document.body.appendChild(toast);

    // Trigger animation
    setTimeout(() => toast.classList.add('show'), 10);

    // Auto hide
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 5000);
}

/**
 * Scroll Animations
 */
function initAnimations() {
    // Check if IntersectionObserver is supported
    if (!('IntersectionObserver' in window)) {
        return; // Skip animations if not supported
    }

    const observerOptions = {
        root: null,
        rootMargin: '50px',
        threshold: 0.05
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Animate cards only (not sections - those should be visible immediately)
    const animateElements = document.querySelectorAll('.service-card, .pricing-card, .testimonial-card, .case-study-card');

    animateElements.forEach((el, index) => {
        el.classList.add('animate-card');
        el.style.transitionDelay = `${Math.min(index * 0.1, 0.5)}s`;
        observer.observe(el);

        // Fallback: show after 1.5s if observer didn't trigger
        setTimeout(() => {
            if (!el.classList.contains('animate-visible')) {
                el.classList.add('animate-visible');
            }
        }, 1500);
    });
}

/**
 * Utility Functions
 */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function throttle(func, limit) {
    let inThrottle;
    return function executedFunction(...args) {
        if (!inThrottle) {
            func(...args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

/**
 * Stats Counter Animation
 * Compatible with iOS Safari, Android Chrome and all mobile browsers
 */
function initStatsCounter() {
    var statsSection = document.querySelector('.stats');
    if (!statsSection) return;

    var statsNumbers = statsSection.querySelectorAll('.stats__number');
    if (!statsNumbers || statsNumbers.length === 0) return;

    var animated = false;
    var originalTexts = [];

    // Store original texts immediately
    for (var j = 0; j < statsNumbers.length; j++) {
        originalTexts.push(statsNumbers[j].textContent.trim());
    }

    function animateNumber(element, originalText) {
        var text = originalText || element.textContent.trim();
        if (!text) return;

        // Extract number and suffix (e.g., "150+" -> 150 and "+", "24h" -> 24 and "h", "40%" -> 40 and "%")
        var match = text.match(/^([\d,.\s]+)(.*)$/);
        if (!match) return;

        // Parse number - handle both comma and dot as decimal separator
        var numStr = match[1].replace(/\s/g, '').replace(',', '.');
        var targetNumber = parseFloat(numStr);
        if (isNaN(targetNumber)) return;

        var suffix = match[2] || '';
        var duration = 2000; // 2 seconds
        var startTime = null;
        var startNumber = 0;

        // Check if original text has decimal
        var isDecimal = text.indexOf(',') !== -1 || (text.indexOf('.') !== -1 && text.indexOf('.') < text.length - 2);
        var decimalPlaces = 0;
        if (isDecimal) {
            var parts = text.split(/[,.]/);
            if (parts.length > 1) {
                var lastPart = parts[parts.length - 1].match(/\d+/);
                decimalPlaces = lastPart ? lastPart[0].length : 0;
            }
        }

        // Set to 0 first
        element.textContent = '0' + suffix;

        function updateNumber(currentTime) {
            if (!startTime) startTime = currentTime;
            var elapsed = currentTime - startTime;
            var progress = Math.min(elapsed / duration, 1);

            // Easing function (ease-out)
            var easeOut = 1 - Math.pow(1 - progress, 3);
            var currentNumber = startNumber + (targetNumber - startNumber) * easeOut;

            if (isDecimal && decimalPlaces > 0) {
                element.textContent = currentNumber.toFixed(decimalPlaces).replace('.', ',') + suffix;
            } else {
                element.textContent = Math.floor(currentNumber) + suffix;
            }

            if (progress < 1) {
                requestAnimationFrame(updateNumber);
            } else {
                // Ensure final value is exact
                element.textContent = text;
            }
        }

        requestAnimationFrame(updateNumber);
    }

    function runAnimation() {
        if (animated) return;
        animated = true;

        for (var i = 0; i < statsNumbers.length; i++) {
            animateNumber(statsNumbers[i], originalTexts[i]);
        }
    }

    // Check if element is in viewport
    function isInViewport(el) {
        var rect = el.getBoundingClientRect();
        var windowHeight = window.innerHeight || document.documentElement.clientHeight;
        return rect.top < windowHeight && rect.bottom > 0;
    }

    // Try IntersectionObserver first
    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function(entries) {
            for (var i = 0; i < entries.length; i++) {
                if (entries[i].isIntersecting && !animated) {
                    runAnimation();
                    observer.disconnect();
                    break;
                }
            }
        }, {
            threshold: 0,  // Trigger as soon as any part is visible
            rootMargin: '50px'  // Start 50px before element enters viewport
        });

        observer.observe(statsSection);

        // Also check immediately if already visible
        if (isInViewport(statsSection)) {
            runAnimation();
            observer.disconnect();
        }
    } else {
        // Fallback for browsers without IntersectionObserver
        function checkScroll() {
            if (!animated && isInViewport(statsSection)) {
                runAnimation();
                window.removeEventListener('scroll', checkScroll);
            }
        }

        window.addEventListener('scroll', checkScroll, { passive: true });
        checkScroll();
    }

    // Fallback: if still not animated after 2 seconds, run it
    setTimeout(function() {
        if (!animated) {
            runAnimation();
        }
    }, 2000);
}

/**
 * Process Timeline Animation
 * Steps appear one by one from left to right
 * Compatible with all browsers including mobile
 */
function initProcessTimeline() {
    var processSection = document.querySelector('.process');
    if (!processSection) return;

    var steps = processSection.querySelectorAll('.process__step');
    if (!steps || steps.length === 0) return;

    var animated = false;
    var stepsReady = false;

    // Prepare steps for animation (hide them)
    function prepareSteps() {
        if (stepsReady) return;
        stepsReady = true;
        for (var i = 0; i < steps.length; i++) {
            steps[i].style.opacity = '0';
            steps[i].style.transform = 'translateY(30px)';
            steps[i].style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        }
    }

    // Animate steps one by one
    function animateSteps() {
        if (animated) return;
        animated = true;

        // If steps weren't prepared (JS ran late), just show them
        if (!stepsReady) {
            for (var j = 0; j < steps.length; j++) {
                steps[j].style.opacity = '1';
                steps[j].style.transform = 'translateY(0)';
            }
            return;
        }

        for (var i = 0; i < steps.length; i++) {
            (function(index) {
                setTimeout(function() {
                    if (steps[index]) {
                        steps[index].style.opacity = '1';
                        steps[index].style.transform = 'translateY(0)';
                    }
                }, index * 300);
            })(i);
        }
    }

    function isInViewport(el) {
        try {
            var rect = el.getBoundingClientRect();
            var windowHeight = window.innerHeight || document.documentElement.clientHeight || 800;
            return rect.top < windowHeight && rect.bottom > 0;
        } catch (e) {
            return true;
        }
    }

    // Check if section is NOT in viewport yet - only then prepare for animation
    if (!isInViewport(processSection)) {
        prepareSteps();
    }

    if ('IntersectionObserver' in window) {
        try {
            var observer = new IntersectionObserver(function(entries) {
                for (var i = 0; i < entries.length; i++) {
                    if (entries[i].isIntersecting) {
                        if (!stepsReady && !animated) {
                            // Section visible but steps not hidden - just mark as animated
                            animated = true;
                        } else if (!animated) {
                            animateSteps();
                        }
                        observer.disconnect();
                        break;
                    }
                }
            }, {
                threshold: 0,
                rootMargin: '50px'
            });

            observer.observe(processSection);
        } catch (e) {
            if (!animated) animateSteps();
        }
    } else {
        // Fallback: scroll listener
        function checkScroll() {
            if (isInViewport(processSection) && !animated) {
                animateSteps();
                window.removeEventListener('scroll', checkScroll);
            }
        }
        window.addEventListener('scroll', checkScroll, { passive: true });
        // Check immediately
        if (isInViewport(processSection) && !animated) {
            animateSteps();
        }
    }

    // Fallback: if steps are hidden but not animated after 1.5s, show them
    setTimeout(function() {
        if (stepsReady && !animated) {
            animateSteps();
        }
    }, 1500);
}

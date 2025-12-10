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
 */
function initStatsCounter() {
    const statsSection = document.querySelector('.stats');
    if (!statsSection) return;

    const statsNumbers = statsSection.querySelectorAll('.stats__number');
    let animated = false;

    function animateNumber(element) {
        const text = element.textContent.trim();
        // Extract number and suffix (e.g., "150+" -> 150 and "+", "24h" -> 24 and "h", "40%" -> 40 and "%")
        const match = text.match(/^([\d,.\s]+)(.*)$/);
        if (!match) return;

        const targetNumber = parseFloat(match[1].replace(/[,\s]/g, '').replace('.', ','));
        const suffix = match[2] || '';
        const duration = 2000; // 2 seconds
        const startTime = performance.now();
        const startNumber = 0;

        // Check if it's a decimal number
        const isDecimal = text.includes(',') || text.includes('.');
        const decimalPlaces = isDecimal ? (text.split(/[,.]/).pop().match(/\d+/)?.[0]?.length || 0) : 0;

        function updateNumber(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);

            // Easing function (ease-out)
            const easeOut = 1 - Math.pow(1 - progress, 3);
            const currentNumber = startNumber + (targetNumber - startNumber) * easeOut;

            if (isDecimal) {
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

    function handleIntersection(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting && !animated) {
                animated = true;
                statsNumbers.forEach(num => animateNumber(num));
            }
        });
    }

    // Use IntersectionObserver if available
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(handleIntersection, {
            threshold: 0.3
        });
        observer.observe(statsSection);
    } else {
        // Fallback: animate immediately
        statsNumbers.forEach(num => animateNumber(num));
    }
}

/**
 * Process Timeline Animation
 * Steps appear one by one from left to right with connecting line
 */
function initProcessTimeline() {
    const processSection = document.querySelector('.process');
    if (!processSection) return;

    const timeline = processSection.querySelector('.process__timeline');
    const steps = processSection.querySelectorAll('.process__step');
    if (!timeline || steps.length === 0) return;

    let animated = false;

    function animateSteps() {
        if (animated) return;
        animated = true;

        // Animate each step with delay (left to right)
        steps.forEach((step, index) => {
            setTimeout(() => {
                step.classList.add('animate-visible');
            }, index * 400); // 400ms delay between each step
        });
    }

    function handleIntersection(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting && !animated) {
                animateSteps();
            }
        });
    }

    // Use IntersectionObserver if available
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(handleIntersection, {
            threshold: 0.7
        });
        observer.observe(processSection);
    } else {
        // Fallback: animate immediately
        animateSteps();
    }
}

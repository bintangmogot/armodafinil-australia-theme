/**
 * Armodafinil Australia — Main JavaScript
 *
 * =====================================================
 * 🔰 JS GUIDE:
 * =====================================================
 * This is plain JavaScript — no jQuery needed!
 * WordPress loads this file in the footer (see inc/enqueue.php).
 *
 * Add any interactive features here:
 * - Mobile menu toggle (already done below)
 * - Scroll animations
 * - GSAP animations
 * - Modal popups
 * etc.
 * =====================================================
 */

document.addEventListener('DOMContentLoaded', () => {

    // ── Mobile Menu Toggle ──────────────────────────────
    const menuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const iconHamburger = document.getElementById('icon-hamburger');
    const iconClose = document.getElementById('icon-close');

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', () => {
            const isOpen = !mobileMenu.classList.contains('hidden');

            // Toggle menu visibility
            mobileMenu.classList.toggle('hidden');

            // Swap icons
            if (iconHamburger && iconClose) {
                iconHamburger.classList.toggle('hidden');
                iconClose.classList.toggle('hidden');
            }

            // Update accessibility attribute
            menuToggle.setAttribute('aria-expanded', !isOpen);
        });
    }


    // ── Header Shadow on Scroll ─────────────────────────
    const header = document.getElementById('site-header');

    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) {
                header.classList.add('shadow-md');
            } else {
                header.classList.remove('shadow-md');
            }
        }, { passive: true });
    }


    // ── Close mobile menu when clicking a link ──────────
    if (mobileMenu) {
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                if (iconHamburger && iconClose) {
                    iconHamburger.classList.remove('hidden');
                    iconClose.classList.add('hidden');
                }
                if (menuToggle) {
                    menuToggle.setAttribute('aria-expanded', 'false');
                }
            });
        });
    }

    // ── Excerpt Read More Toggle ─────────────────────────
    document.addEventListener('click', (e) => {
        const toggleBtn = e.target.closest('.read-more-toggle');
        if (!toggleBtn) return;

        e.preventDefault();
        e.stopPropagation();

        const parent = toggleBtn.closest('.product-excerpt');
        if (!parent) return;

        const shortSpan = parent.querySelector('.excerpt-short');
        const fullSpan = parent.querySelector('.excerpt-full');

        if (shortSpan && fullSpan) {
            const isHidden = fullSpan.classList.contains('hidden');
            if (isHidden) {
                fullSpan.classList.remove('hidden');
                shortSpan.classList.add('hidden');
                toggleBtn.textContent = 'Read less <<';
            } else {
                fullSpan.classList.add('hidden');
                shortSpan.classList.remove('hidden');
                toggleBtn.textContent = 'Read more >>';
            }
        }
    }, true);

});

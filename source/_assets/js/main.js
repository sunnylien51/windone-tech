document.addEventListener('DOMContentLoaded', function () {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            once: true,
        });
    }

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    if (typeof Fancybox !== 'undefined') {
        Fancybox.bind('[data-fancybox]', {});
    }
});

if (typeof Lenis !== 'undefined') {
    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        direction: 'vertical',
        gestureDirection: 'vertical',
        smooth: true,
        mouseMultiplier: 1,
        smoothTouch: false,
        touchMultiplier: 2,
        infinite: false,
    });

    window.lenis = lenis;

    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }

    requestAnimationFrame(raf);
}

const backToTopBtn = document.getElementById('back-to-top');
if (backToTopBtn) {
    backToTopBtn.addEventListener('click', function () {
        if (window.lenis) {
            window.lenis.scrollTo(0);
        } else {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
}

/* ---------- Mobile menu ---------- */
const mobileMenuBtn = document.getElementById('mobile-menu-btn');
const mobileMenuIcon = document.getElementById('mobile-menu-icon');
const navMenu = document.getElementById('nav-menu');
const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

function setMobileMenuIcon(name) {
    if (!mobileMenuIcon) {
        return;
    }

    mobileMenuIcon.setAttribute('data-lucide', name);
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
}

function closeMobileMenu() {
    if (!navMenu) {
        return;
    }

    navMenu.classList.add('translate-x-full');
    if (mobileMenuOverlay) {
        mobileMenuOverlay.classList.add('hidden');
    }
    if (mobileMenuBtn) {
        mobileMenuBtn.setAttribute('aria-expanded', 'false');
    }
    setMobileMenuIcon('menu');
    document.body.classList.remove('overflow-hidden');
}

function openMobileMenu() {
    if (!navMenu) {
        return;
    }

    navMenu.classList.remove('translate-x-full');
    if (mobileMenuOverlay) {
        mobileMenuOverlay.classList.remove('hidden');
    }
    if (mobileMenuBtn) {
        mobileMenuBtn.setAttribute('aria-expanded', 'true');
    }
    setMobileMenuIcon('x');
    document.body.classList.add('overflow-hidden');
}

function toggleMobileMenu() {
    const isOpen = navMenu && !navMenu.classList.contains('translate-x-full');
    if (isOpen) {
        closeMobileMenu();
    } else {
        openMobileMenu();
    }
}

if (mobileMenuBtn && navMenu) {
    mobileMenuBtn.addEventListener('click', toggleMobileMenu);
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', closeMobileMenu);
    }
}

window.addEventListener('resize', () => {
    if (window.innerWidth >= 1200) {
        closeMobileMenu();
        closeLangMenu();
    }
    syncNavTrackerToActive();
});

/* ---------- Nav sliding tracker (TLC-style) ---------- */
const navTrackList = document.getElementById('nav-track-list');
const navTracker = navTrackList ? navTrackList.querySelector('.nav-tracker') : null;
const navTrackItems = navTrackList
    ? [...navTrackList.querySelectorAll('.nav-item')]
    : [];

function moveNavTrackerTo(el) {
    if (!navTrackList || !navTracker || !el) {
        return;
    }

    const listRect = navTrackList.getBoundingClientRect();
    const itemRect = el.getBoundingClientRect();

    navTracker.style.left = `${itemRect.left - listRect.left}px`;
    navTracker.style.width = `${itemRect.width}px`;
    navTrackList.classList.add('is-tracking');
}

function hideNavTracker() {
    if (!navTrackList || !navTracker) {
        return;
    }

    navTrackList.classList.remove('is-tracking');
    navTrackItems.forEach((item) => item.classList.remove('is-over'));
}

function syncNavTrackerToActive() {
    // 對齊 TLC：非 hover 時收起 tracker；目前頁面僅用文字色標示 active
    hideNavTracker();
}

if (navTrackList && navTracker) {
    navTrackItems.forEach((item) => {
        item.addEventListener('mouseenter', () => {
            navTrackItems.forEach((el) => el.classList.toggle('is-over', el === item));
            moveNavTrackerTo(item);
        });
    });

    navTrackList.addEventListener('mouseleave', hideNavTracker);
}

/* ---------- Language switch ---------- */
const langBtn = document.getElementById('lang-btn');
const langMenu = document.getElementById('lang-menu');
const langLabel = document.getElementById('lang-label');

function closeLangMenu() {
    if (!langMenu || !langBtn) {
        return;
    }
    langMenu.classList.remove('is-open');
    langBtn.setAttribute('aria-expanded', 'false');
}

function openLangMenu() {
    if (!langMenu || !langBtn) {
        return;
    }
    langMenu.classList.add('is-open');
    langBtn.setAttribute('aria-expanded', 'true');
}

if (langBtn && langMenu) {
    langBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        const isOpen = langBtn.getAttribute('aria-expanded') === 'true';
        if (isOpen) {
            closeLangMenu();
        } else {
            openLangMenu();
        }
    });

    document.addEventListener('click', function (e) {
        if (!langMenu.contains(e.target) && !langBtn.contains(e.target)) {
            closeLangMenu();
        }
    });
}

document.querySelectorAll('.lang-option').forEach((option) => {
    option.addEventListener('click', function () {
        const lang = this.getAttribute('data-lang');
        const label = this.getAttribute('data-label') || this.textContent.trim();
        document.querySelectorAll('.lang-option').forEach((el) => {
            const match = el.getAttribute('data-lang') === lang;
            el.classList.toggle('is-active', match);
            el.setAttribute('aria-selected', match ? 'true' : 'false');
        });
        if (langLabel && label) {
            langLabel.textContent = label;
        }
        closeLangMenu();
    });
});

/* ---------- Home hero swiper ---------- */
const heroSwiperEl = document.getElementById('hero-swiper');
if (heroSwiperEl && typeof Swiper !== 'undefined') {
    const heroCopy = document.getElementById('hero-copy');
    const heroTitle = document.getElementById('hero-title');
    const heroBody = document.getElementById('hero-body');
    const heroLink = document.getElementById('hero-link');
    const heroCurrent = document.getElementById('hero-current');
    const heroPrev = document.querySelector('[data-hero-prev]');
    const heroNext = document.querySelector('[data-hero-next]');
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function pad2(n) {
        return String(n).padStart(2, '0');
    }

    function applyHeroCopy(slide) {
        if (!slide) {
            return;
        }

        if (heroTitle) {
            heroTitle.textContent = slide.getAttribute('data-hero-title') || '';
        }
        if (heroBody) {
            heroBody.textContent = slide.getAttribute('data-hero-body') || '';
        }
        if (heroLink) {
            heroLink.setAttribute('href', slide.getAttribute('data-hero-link') || '/products/');
        }
    }

    function syncHeroCopy(swiper, animate) {
        const slide = swiper.slides[swiper.activeIndex];
        if (!slide) {
            return;
        }

        if (heroCurrent) {
            heroCurrent.textContent = pad2(swiper.realIndex + 1);
        }

        if (!animate || reduceMotion || !heroCopy) {
            applyHeroCopy(slide);
            return;
        }

        heroCopy.classList.add('is-leaving');
        window.setTimeout(() => {
            applyHeroCopy(slide);
            heroCopy.classList.remove('is-leaving');
        }, 220);
    }

    const heroSection = document.getElementById('home-hero');
    const heroRing = document.getElementById('hero-ring');
    const RING_LEN = 2 * Math.PI * 38; // r=38

    function setRing(fraction) {
        if (!heroRing) {
            return;
        }
        const f = Math.min(1, Math.max(0, fraction));
        heroRing.style.strokeDashoffset = String(RING_LEN * (1 - f));
    }

    const heroSwiper = new Swiper(heroSwiperEl, {
        loop: true,
        speed: reduceMotion ? 0 : 1000, // 與 CSS .hero-motion 的 1s 一致
        // 用 fade 讓同時只有一張可見；進出場的右進左出＋縮放淡入淡出交給 CSS 的 .hero-motion
        effect: 'fade',
        fadeEffect: { crossFade: true },
        autoplay: reduceMotion
            ? false
            : {
                  delay: 5200,
                  disableOnInteraction: false,
                  pauseOnMouseEnter: false,
              },
        on: {
            init(swiper) {
                syncHeroCopy(swiper, false);
                if (reduceMotion) {
                    setRing((swiper.realIndex + 1) / swiper.slides.filter((s) => !s.classList.contains('swiper-slide-duplicate')).length);
                } else {
                    setRing(0);
                }
                if (heroSection) {
                    requestAnimationFrame(() => {
                        heroSection.classList.add('is-ready');
                    });
                }
            },
            slideChange(swiper) {
                syncHeroCopy(swiper, true);
                if (reduceMotion) {
                    const total = swiper.slides.filter((s) => !s.classList.contains('swiper-slide-duplicate')).length;
                    setRing((swiper.realIndex + 1) / total);
                }
            },
            // 倒數進度 1 → 0：進度圈 0 → 滿，與換頁同步
            autoplayTimeLeft(swiper, timeLeft, percentage) {
                setRing(1 - percentage);
            },
        },
    });

    if (heroPrev) {
        heroPrev.addEventListener('click', () => heroSwiper.slidePrev());
    }
    if (heroNext) {
        heroNext.addEventListener('click', () => heroSwiper.slideNext());
    }

    /* 3D 傾斜：滑鼠在 hero 內移動時，產品朝滑鼠方向轉。
       效能：節點只查一次並快取；每幀直接寫 element.style.transform，
       不透過 CSS 變數，避免整棵子樹樣式重算。 */
    const canHover = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    if (heroSection && canHover && !reduceMotion) {
        const MAX_TILT = 9; // 最大傾斜角（度）
        const EASE = 0.08; // 跟隨緩動，越小越滑順
        const SHADOW_BASE = 33; // 與 CSS .hero-shadow-tilt 基礎偏移一致（px）
        const tiltEls = [...heroSwiperEl.querySelectorAll('.hero-tilt')];
        const shadowEls = [...heroSwiperEl.querySelectorAll('.hero-shadow-tilt')];
        let targetX = 0;
        let targetY = 0;
        let curX = 0;
        let curY = 0;
        let rafId = null;

        function applyTilt(x, y) {
            const tiltValue = `perspective(1100px) rotateX(${x.toFixed(2)}deg) rotateY(${y.toFixed(2)}deg)`;
            const shadowValue = `translate3d(${(SHADOW_BASE - y * 1.5).toFixed(1)}px, ${(SHADOW_BASE + x * 1.5).toFixed(1)}px, 0)`;

            for (let i = 0; i < tiltEls.length; i++) {
                tiltEls[i].style.transform = tiltValue;
            }
            for (let i = 0; i < shadowEls.length; i++) {
                shadowEls[i].style.transform = shadowValue;
            }
        }

        function tick() {
            curX += (targetX - curX) * EASE;
            curY += (targetY - curY) * EASE;

            if (Math.abs(targetX - curX) > 0.01 || Math.abs(targetY - curY) > 0.01) {
                applyTilt(curX, curY);
                rafId = requestAnimationFrame(tick);
            } else {
                // 收斂：直接貼齊目標並停止迴圈（滑鼠不動時不再佔 CPU）
                curX = targetX;
                curY = targetY;
                applyTilt(curX, curY);
                rafId = null;
            }
        }

        function kick() {
            if (rafId === null) {
                rafId = requestAnimationFrame(tick);
            }
        }

        heroSection.addEventListener('mousemove', (e) => {
            const rect = heroSection.getBoundingClientRect();
            const nx = (e.clientX - rect.left) / rect.width - 0.5; // -0.5 ~ 0.5
            const ny = (e.clientY - rect.top) / rect.height - 0.5;
            targetY = nx * 2 * MAX_TILT; // 滑鼠在右 → 產品朝右
            targetX = -ny * 2 * MAX_TILT; // 滑鼠在上 → 產品朝上
            kick();
        });

        heroSection.addEventListener('mouseleave', () => {
            targetX = 0;
            targetY = 0;
            kick();
        });
    }
}

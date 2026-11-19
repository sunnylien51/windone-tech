// 與 tailwind.config.js 的 screens.lg 一致
const LG_BREAKPOINT = 1200;

/* Mac 觸控板左右滑：Swiper mousewheel + 只吃橫向（縱向仍交給頁面／Lenis） */
const swiperTrackpadWheel = {
    enabled: true,
    forceToAxis: true,
    sensitivity: 1,
    thresholdDelta: 8,
    releaseOnEdges: true,
};

// Lenis 1.x：用 autoRaf；開選單時 stop()，關選單時 start()
if (typeof Lenis !== 'undefined') {
    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        touchMultiplier: 2,
        autoRaf: true,
    });

    window.lenis = lenis;
}

function initPageEnhancements() {
    if (typeof AOS !== 'undefined') {
        // offset:0 → 首屏標題／副標進頁就觸發，不用先滾一下
        // Vite module 可能晚於 DOMContentLoaded，故用 readyState 雙路徑
        AOS.init({
            duration: 800,
            once: true,
            offset: 0,
        });

        // 下一幀＋完整 load：確保首屏已在視窗內的元素立刻加上 aos-animate
        const refreshAos = () => AOS.refresh();
        requestAnimationFrame(refreshAos);
        window.addEventListener('load', refreshAos, { once: true });
    }

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    if (typeof Fancybox !== 'undefined') {
        Fancybox.bind('[data-fancybox]', {});
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPageEnhancements);
} else {
    initPageEnhancements();
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

    if (mobileMenuBtn) {
        mobileMenuBtn.setAttribute('aria-expanded', name === 'x' ? 'true' : 'false');
        mobileMenuBtn.setAttribute('aria-label', name === 'x' ? '關閉選單' : '開啟選單');
    }
}

function lockPageScroll() {
    document.documentElement.classList.add('overflow-hidden');
    document.body.classList.add('overflow-hidden');
    if (window.lenis) {
        window.lenis.stop();
    }
}

function unlockPageScroll() {
    document.documentElement.classList.remove('overflow-hidden');
    document.body.classList.remove('overflow-hidden');
    if (window.lenis) {
        window.lenis.start();
    }
}

function closeMobileMenu() {
    if (!navMenu) {
        return;
    }

    navMenu.classList.add('translate-x-full', 'opacity-0');
    if (mobileMenuOverlay) {
        mobileMenuOverlay.classList.add('hidden');
    }
    setMobileMenuIcon('menu');
    unlockPageScroll();
}

function openMobileMenu() {
    if (!navMenu) {
        return;
    }

    navMenu.classList.remove('translate-x-full', 'opacity-0');
    if (mobileMenuOverlay) {
        mobileMenuOverlay.classList.remove('hidden');
    }
    setMobileMenuIcon('x');
    lockPageScroll();
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
    if (window.innerWidth >= LG_BREAKPOINT) {
        closeMobileMenu();
        closeLangMenu();
    }
    hideNavTracker();
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

// 對齊 TLC：非 hover 時收起 tracker
function hideNavTracker() {
    if (!navTrackList || !navTracker) {
        return;
    }

    navTrackList.classList.remove('is-tracking');
    navTrackItems.forEach((item) => item.classList.remove('is-over'));
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

function applyNavLang(lang) {
    document.querySelectorAll('[data-i18n-nav]').forEach((el) => {
        let labels = {};
        try {
            labels = JSON.parse(el.getAttribute('data-labels') || '{}');
        } catch (e) {
            return;
        }
        const text = labels[lang];
        if (text) {
            el.textContent = text;
        }
    });
}

/** 切語系時更新 html lang，讓 :lang(...) 字型變數生效（示意） */
function applyDocumentLang(lang) {
    if (!lang) {
        return;
    }
    document.documentElement.setAttribute('lang', lang);
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
        if (lang) {
            applyDocumentLang(lang);
            applyNavLang(lang);
        }
        closeLangMenu();
    });
});

/* ---------- Home hero swiper ---------- */
const heroSwiperEl = document.getElementById('hero-swiper');
if (heroSwiperEl && typeof Swiper !== 'undefined') {
    const heroSection = document.getElementById('home-hero');
    const heroTitle = document.getElementById('hero-title');
    const heroBody = document.getElementById('hero-body');
    const heroLink = document.getElementById('hero-link');
    const heroCurrent = document.getElementById('hero-current');
    const heroDots = [...document.querySelectorAll('[data-hero-dot]')];
    const heroCursor = document.querySelector('.hero-cursor');
    const heroCursorProgress = document.getElementById('hero-cursor-progress');
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const canHover = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    // 待確認：滑鼠停在 hero 上是否暫停自動播放；預設不暫停
    const pauseOnHover = heroSection?.dataset.heroPauseOnHover === 'true';
    const CURSOR_RING_LEN = 2 * Math.PI * 43.875; // r=43.875，對齊 90px 游標
    const CURSOR_HALF = 45;

    function pad2(n) {
        return String(n).padStart(2, '0');
    }

    function isHeroChrome(target) {
        return Boolean(
            target?.closest?.(
                // 左側文案／Read more／頁數：等同離開 hero，整顆關掉自訂游標、不觸發換頁
                '.hero-footer, .hero-pager, a, button, input, textarea, select, label'
            )
        );
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
            heroLink.setAttribute('href', slide.getAttribute('data-hero-link') || '#');
        }
    }

    function syncHeroPager(swiper) {
        const index = swiper.realIndex;
        if (heroCurrent) {
            heroCurrent.textContent = pad2(index + 1);
        }

        heroDots.forEach((dot, i) => {
            const active = i === index;
            dot.classList.toggle('is-active', active);
            dot.setAttribute('aria-selected', active ? 'true' : 'false');
        });
    }

    function syncHeroCopy(swiper) {
        const slide = swiper.slides[swiper.activeIndex];
        if (!slide) {
            return;
        }

        syncHeroPager(swiper);
        applyHeroCopy(slide);
    }

    function setCursorProgress(fraction) {
        if (!heroCursorProgress) {
            return;
        }
        const f = Math.min(1, Math.max(0, fraction));
        heroCursorProgress.style.strokeDashoffset = String(CURSOR_RING_LEN * (1 - f));
    }

    // 進度環 = 目前第幾張／總張數（例如 2/3 → 約 66%），不是自動播放秒數
    function syncCursorSlideProgress(swiper) {
        const total = swiper.slides.filter((s) => !s.classList.contains('swiper-slide-duplicate')).length;
        if (!total) {
            setCursorProgress(0);
            return;
        }
        setCursorProgress((swiper.realIndex + 1) / total);
    }

    const heroSwiper = new Swiper(heroSwiperEl, {
        loop: true,
        speed: reduceMotion ? 0 : 1000, // 與 CSS .hero-motion 的 1s 一致
        // 用 fade 讓同時只有一張可見；進出場的右進左出＋縮放淡入淡出交給 CSS 的 .hero-motion
        effect: 'fade',
        fadeEffect: { crossFade: true },
        mousewheel: swiperTrackpadWheel,
        autoplay: reduceMotion
            ? false
            : {
                  delay: 5200,
                  disableOnInteraction: false,
                  pauseOnMouseEnter: pauseOnHover,
              },
        on: {
            init(swiper) {
                syncHeroCopy(swiper);
                syncCursorSlideProgress(swiper);
            },
            slideChange(swiper) {
                syncHeroCopy(swiper);
                syncCursorSlideProgress(swiper);
            },
        },
    });

    heroDots.forEach((dot) => {
        dot.addEventListener('click', (e) => {
            e.stopPropagation();
            const index = Number(dot.getAttribute('data-hero-dot'));
            if (!Number.isNaN(index)) {
                heroSwiper.slideToLoop(index);
            }
        });
    });

    /* 鍵盤：hero 取得焦點（或焦點在其內）時，左右方向鍵換頁 */
    if (heroSection) {
        heroSection.addEventListener('keydown', (e) => {
            if (e.key !== 'ArrowLeft' && e.key !== 'ArrowRight') {
                return;
            }
            if (!heroSection.contains(document.activeElement) && document.activeElement !== heroSection) {
                return;
            }
            e.preventDefault();
            if (e.key === 'ArrowLeft') {
                heroSwiper.slidePrev();
            } else {
                heroSwiper.slideNext();
            }
        });
    }

    /* 桌機：點左半上一張、右半下一張（Read more／頁點除外） */
    if (heroSection && canHover) {
        heroSection.addEventListener('click', (e) => {
            if (e.pointerType && e.pointerType !== 'mouse') {
                return;
            }
            if (isHeroChrome(e.target)) {
                return;
            }

            const rect = heroSection.getBoundingClientRect();
            if (e.clientX >= rect.left + rect.width / 2) {
                heroSwiper.slideNext();
            } else {
                heroSwiper.slidePrev();
            }
        });
    }

    /* 桌機自訂游標：跟隨滑鼠、左右半邊換箭頭。
       離開 hero（含疊在上方的主選單）→ pointerleave 整顆關掉。
       左側文案／Read more／頁點同理：整顆關掉，恢復系統游標。
       prefers-reduced-motion 時不啟用。游標掛 body 以利 backdrop-filter。 */
    if (heroSection && heroCursor && canHover && !reduceMotion) {
        let cursorDir = 'next';
        let cursorVisible = false;

        if (heroCursor.parentElement !== document.body) {
            document.body.appendChild(heroCursor);
        }

        function placeCursor(clientX, clientY) {
            heroCursor.style.transform = `translate3d(${clientX - CURSOR_HALF}px, ${clientY - CURSOR_HALF}px, 0)`;
        }

        function setCursorDir(dir) {
            if (cursorDir === dir) {
                return;
            }
            cursorDir = dir;
            heroCursor.dataset.dir = dir;
        }

        function showCursor() {
            if (cursorVisible) {
                return;
            }
            cursorVisible = true;
            heroSection.classList.add('is-cursor-on');
            heroCursor.classList.add('is-visible');
        }

        function hideCursor() {
            if (!cursorVisible) {
                return;
            }
            cursorVisible = false;
            heroSection.classList.remove('is-cursor-on');
            heroCursor.classList.remove('is-visible');
        }

        heroSection.addEventListener('pointerenter', (e) => {
            if (e.pointerType !== 'mouse') {
                return;
            }
            if (isHeroChrome(e.target)) {
                hideCursor();
                return;
            }
            showCursor();
            placeCursor(e.clientX, e.clientY);
        });

        // 主選單在 hero DOM 外：滑上去會 pointerleave → 整顆關掉
        heroSection.addEventListener('pointerleave', () => {
            hideCursor();
        });

        heroSection.addEventListener('pointermove', (e) => {
            if (e.pointerType !== 'mouse') {
                return;
            }

            // 左側文案等同離開：整顆關掉自訂游標
            if (isHeroChrome(e.target)) {
                hideCursor();
                return;
            }

            showCursor();
            placeCursor(e.clientX, e.clientY);

            const rect = heroSection.getBoundingClientRect();
            const onRight = e.clientX >= rect.left + rect.width / 2;
            setCursorDir(onRight ? 'next' : 'prev');
        });
    }

    /* 3D 傾斜：滑鼠在 hero 內移動時，產品朝滑鼠方向轉。
       效能：節點只查一次並快取；每幀直接寫 element.style.transform，
       不透過 CSS 變數，避免整棵子樹樣式重算。 */
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

/* ---------- Home product slider ---------- */
const productSwiperEl = document.getElementById('product-swiper');
if (productSwiperEl && typeof Swiper !== 'undefined') {
    const productCurrent = document.getElementById('product-current');
    const productTotal = document.getElementById('product-total');
    const productDotsEl = document.getElementById('product-pager-dots');
    const reduceMotionProducts = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    let productDots = [];

    function pad2(n) {
        return String(n).padStart(2, '0');
    }

    function rebuildProductDots(swiper) {
        if (!productDotsEl) {
            return;
        }

        const total = Math.max(swiper.snapGrid.length, 1);
        productDotsEl.replaceChildren();
        productDots = [];

        for (let i = 0; i < total; i++) {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'pager-dot' + (i === swiper.snapIndex ? ' is-active' : '');
            btn.setAttribute('role', 'tab');
            btn.setAttribute('data-product-dot', String(i));
            btn.setAttribute('aria-label', `第 ${i + 1} 頁，共 ${total} 頁`);
            btn.setAttribute('aria-selected', i === swiper.snapIndex ? 'true' : 'false');

            const pill = document.createElement('span');
            pill.className = 'pager-dot-pill';
            pill.setAttribute('aria-hidden', 'true');
            btn.appendChild(pill);

            btn.addEventListener('click', () => {
                swiper.slideTo(i);
            });

            productDotsEl.appendChild(btn);
            productDots.push(btn);
        }
    }

    function syncProductPager(swiper) {
        const total = Math.max(swiper.snapGrid.length, 1);
        const index = Math.min(Math.max(swiper.snapIndex, 0), total - 1);

        if (productCurrent) {
            productCurrent.textContent = pad2(index + 1);
        }
        if (productTotal) {
            productTotal.textContent = pad2(total);
        }

        if (productDots.length !== total) {
            rebuildProductDots(swiper);
            return;
        }

        productDots.forEach((dot, i) => {
            const active = i === index;
            dot.classList.toggle('is-active', active);
            dot.setAttribute('aria-selected', active ? 'true' : 'false');
        });
    }

    new Swiper(productSwiperEl, {
        slidesPerView: 1.25,
        spaceBetween: 16,
        speed: reduceMotionProducts ? 0 : 600,
        watchOverflow: true,
        mousewheel: swiperTrackpadWheel,
        breakpoints: {
            800: {
                slidesPerView: 3.25,
                spaceBetween: 20,
            },
            1200: {
                // 對齊稿：桌機 4 卡；6 張 → snap 約 3 頁（01 / 03）
                slidesPerView: 4,
                spaceBetween: 24,
            },
        },
        on: {
            init(swiper) {
                rebuildProductDots(swiper);
                syncProductPager(swiper);
            },
            slideChange(swiper) {
                syncProductPager(swiper);
            },
            resize(swiper) {
                syncProductPager(swiper);
            },
        },
    });
}

/* ---------- Home partners slider（全斷點單列） ---------- */
const partnerSwiperEl = document.getElementById('partner-swiper');
if (partnerSwiperEl && typeof Swiper !== 'undefined') {
    const reduceMotionPartners = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    new Swiper(partnerSwiperEl, {
        slidesPerView: 2.25,
        spaceBetween: 0,
        speed: reduceMotionPartners ? 0 : 500,
        grabCursor: true,
        simulateTouch: true,
        allowTouchMove: true,
        watchOverflow: true,
        mousewheel: swiperTrackpadWheel,
        breakpoints: {
            768: {
                slidesPerView: 3.5,
            },
            1024: {
                slidesPerView: 4,
            },
            1280: {
                slidesPerView: 6,
            },
        },
    });
}

/* ---------- Data panel：底圖視差（滾得比內容慢） ---------- */
const dataPanel = document.querySelector('.data-panel');
const dataPanelBg = dataPanel && dataPanel.querySelector('.data-panel-bg');
if (dataPanel && dataPanelBg && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    // 0～1：越小底圖動得越慢
    const DATA_PARALLAX = 0.28;
    // 須對齊 CSS：.data-panel-bg top -50% / height 200% → 理論可動 50%；留一點安全邊
    const DATA_PARALLAX_MAX_RATIO = 0.45;

    const updateDataParallax = () => {
        const rect = dataPanel.getBoundingClientRect();
        const viewH = window.innerHeight || 1;
        if (rect.bottom < -80 || rect.top > viewH + 80) {
            return;
        }
        const panelH = rect.height || 1;
        const maxShift = panelH * DATA_PARALLAX_MAX_RATIO;
        // 面板中心相對視窗中心的位移 × 係數；clamp 避免超出底圖層而露 gray5
        const centerDelta = rect.top + panelH / 2 - viewH / 2;
        const y = Math.max(-maxShift, Math.min(maxShift, centerDelta * DATA_PARALLAX));
        dataPanelBg.style.transform = `translate3d(0, ${y}px, 0)`;
    };

    if (window.lenis) {
        window.lenis.on('scroll', updateDataParallax);
    } else {
        window.addEventListener('scroll', updateDataParallax, { passive: true });
    }
    window.addEventListener('resize', updateDataParallax, { passive: true });
    updateDataParallax();
}

/* ---------- 產品內頁舞台：輕量 3D 傾斜（沿用首頁語彙，無 Swiper） ---------- */
const productStage = document.getElementById('product-stage');
if (productStage) {
    const canHoverStage = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    const reduceMotionStage = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (canHoverStage && !reduceMotionStage) {
        const MAX_TILT = 7;
        const EASE = 0.08;
        const SHADOW_BASE = 28;
        const tiltEl = productStage.querySelector('.product-stage-tilt');
        const shadowEl = productStage.querySelector('.product-stage-shadow-tilt');
        let targetX = 0;
        let targetY = 0;
        let curX = 0;
        let curY = 0;
        let rafId = null;

        const applyTilt = (x, y) => {
            if (tiltEl) {
                tiltEl.style.transform = `perspective(1100px) rotateX(${x.toFixed(2)}deg) rotateY(${y.toFixed(2)}deg)`;
            }
            if (shadowEl) {
                shadowEl.style.transform = `translate3d(${(SHADOW_BASE - y * 1.5).toFixed(1)}px, ${(SHADOW_BASE + x * 1.5).toFixed(1)}px, 0)`;
            }
        };

        const tick = () => {
            curX += (targetX - curX) * EASE;
            curY += (targetY - curY) * EASE;

            if (Math.abs(targetX - curX) > 0.01 || Math.abs(targetY - curY) > 0.01) {
                applyTilt(curX, curY);
                rafId = requestAnimationFrame(tick);
            } else {
                curX = targetX;
                curY = targetY;
                applyTilt(curX, curY);
                rafId = null;
            }
        };

        const kick = () => {
            if (rafId === null) {
                rafId = requestAnimationFrame(tick);
            }
        };

        productStage.addEventListener('mousemove', (e) => {
            const rect = productStage.getBoundingClientRect();
            const nx = (e.clientX - rect.left) / rect.width - 0.5;
            const ny = (e.clientY - rect.top) / rect.height - 0.5;
            targetY = nx * 2 * MAX_TILT;
            targetX = -ny * 2 * MAX_TILT;
            kick();
        });

        productStage.addEventListener('mouseleave', () => {
            targetX = 0;
            targetY = 0;
            kick();
        });
    }
}

/* ---------- 產品介紹：分類選單＋列表篩選＋橫滑提示 ---------- */
const productCatNav = document.getElementById('product-categories');
if (productCatNav) {
    const catTabs = Array.from(productCatNav.querySelectorAll('[data-product-cat]'));
    const productGroups = Array.from(document.querySelectorAll('[data-product-group]'));
    const productCatWrap = productCatNav.closest('.product-cat-nav-wrap');

    const updateProductCatScrollHint = () => {
        if (!productCatWrap) {
            return;
        }
        const maxScroll = productCatNav.scrollWidth - productCatNav.clientWidth;
        const left = productCatNav.scrollLeft;
        const canScroll = maxScroll > 2;
        productCatWrap.classList.toggle('can-scroll-left', canScroll && left > 2);
        productCatWrap.classList.toggle('can-scroll-right', canScroll && left < maxScroll - 2);
    };

    const filterProductGroups = (slug) => {
        const showAll = !slug || slug === 'all';
        let firstVisible = null;
        productGroups.forEach((group) => {
            const match = showAll || group.getAttribute('data-product-group') === slug;
            group.classList.toggle('is-hidden', !match);
            if (match && !firstVisible) {
                firstVisible = group;
            }
        });
        return firstVisible;
    };

    const setActiveCat = (activeBtn) => {
        catTabs.forEach((btn) => {
            const on = btn === activeBtn;
            btn.classList.toggle('is-active', on);
            btn.setAttribute('aria-selected', on ? 'true' : 'false');
        });
    };

    catTabs.forEach((btn) => {
        btn.addEventListener('click', () => {
            const slug = btn.getAttribute('data-product-cat') || '';
            setActiveCat(btn);
            const firstVisible = filterProductGroups(slug);
            if (firstVisible && slug !== 'all') {
                firstVisible.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    productCatNav.addEventListener('scroll', updateProductCatScrollHint, { passive: true });
    window.addEventListener('resize', updateProductCatScrollHint, { passive: true });
    updateProductCatScrollHint();
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
}

/* ---------- Page banner 形象圖：圓角框內視差（類似 TLC Healthcare） ---------- */
const bannerMediaFrame = document.querySelector('.page-banner-media-frame');
const bannerMediaParallax = bannerMediaFrame && bannerMediaFrame.querySelector('.page-banner-media-parallax');
if (bannerMediaFrame && bannerMediaParallax && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    // CSS：top -15% / height 130% → 可動約 15%；係數柔一點
    const BANNER_PARALLAX = 0.22;
    const BANNER_PARALLAX_MAX_RATIO = 0.14;

    const updateBannerParallax = () => {
        const rect = bannerMediaFrame.getBoundingClientRect();
        const viewH = window.innerHeight || 1;
        if (rect.bottom < -80 || rect.top > viewH + 80) {
            return;
        }
        const frameH = rect.height || 1;
        const maxShift = frameH * BANNER_PARALLAX_MAX_RATIO;
        const centerDelta = rect.top + frameH / 2 - viewH / 2;
        const y = Math.max(-maxShift, Math.min(maxShift, centerDelta * BANNER_PARALLAX));
        bannerMediaParallax.style.transform = `translate3d(0, ${y}px, 0)`;
    };

    if (window.lenis) {
        window.lenis.on('scroll', updateBannerParallax);
    } else {
        window.addEventListener('scroll', updateBannerParallax, { passive: true });
    }
    window.addEventListener('resize', updateBannerParallax, { passive: true });
    updateBannerParallax();
}

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@php
    $pageTitle = $page->title ? $page->title . ' | ' . $page->siteName : $page->siteName;
    $pageDescription = $page->description ?? $page->siteDescription;
    // canonical／og 需要完整網址；config.php 的 siteUrl 留空時就不輸出這幾個標籤
    $siteUrl = rtrim($page->siteUrl ?? '', '/');
    $pagePath = '/' . trim($page->getPath(), '/');
    $canonicalUrl = $siteUrl . ($pagePath === '/' ? '/' : $pagePath . '/');
    $features = $page->asArray($page->features ?? []);
    $useLenis = ($features['lenis'] ?? true) !== false;
    $useSwiper = ($features['swiper'] ?? true) !== false;
    $useFancybox = ($features['fancybox'] ?? true) !== false;
@endphp
<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $pageDescription }}">
@if ($siteUrl)
<link rel="canonical" href="{{ $canonicalUrl }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:image" content="{{ $siteUrl }}{{ $page->ogImage ?? '/images/og.jpg' }}">
@endif
<meta property="og:type" content="website">
<meta property="og:locale" content="zh_TW">
<meta property="og:site_name" content="{{ $page->siteName }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $pageDescription }}">
<meta name="twitter:card" content="summary_large_image">

{{-- favicon.ico 實際為 PNG；優先宣告 image/png，避免 Chrome 當 x-icon 解失敗 --}}
<link rel="icon" type="image/png" href="/favicon.png?v=3" sizes="32x32">
<link rel="icon" type="image/png" href="/images/favicon.png?v=3" sizes="32x32">
<link rel="shortcut icon" type="image/png" href="/favicon.png?v=3">
<link rel="apple-touch-icon" href="/images/favicon.png?v=3">

@php
    // 字型：Latin（Outfit／Tenor）每語系都載；CJK 只載當前語系，避免 TC＋JP 雙份
    $pageLang = $page->language ?? 'zh-Hant';
    $cjkFamily = 'Noto+Sans+TC:wght@500;700';
    if ($pageLang === 'ja' || str_starts_with($pageLang, 'ja')) {
        $cjkFamily = 'Noto+Sans+JP:wght@500;700';
    } elseif ($pageLang === 'zh-Hans' || $pageLang === 'zh-CN') {
        $cjkFamily = 'Noto+Sans+SC:wght@500;700';
    } elseif ($pageLang === 'en' || str_starts_with($pageLang, 'en')) {
        $cjkFamily = null; // 英文頁內容走 Outfit，不另載 CJK
    }
    $googleFontsHref = $cjkFamily
        ? 'https://fonts.googleapis.com/css2?family=' . $cjkFamily . '&family=Outfit:wght@400&family=Tenor+Sans&display=swap'
        : 'https://fonts.googleapis.com/css2?family=Outfit:wght@400&family=Tenor+Sans&display=swap';
@endphp
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="{{ $googleFontsHref }}" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet" />
@if ($useSwiper)
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11.2.10/swiper-bundle.min.css" />
@endif
@if ($useFancybox)
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0.36/dist/fancybox/fancybox.css" />
@endif
@if ($useLenis)
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lenis@1.3.27/dist/lenis.css" />
@endif

{{-- CDN 必須排在 vite main.js 之前：同樣是 defer，會依文件順序執行；
     若 main 先跑，Swiper／Lenis／lucide 還是 undefined，Hero 產品會卡在 opacity:0 --}}
<script defer src="https://cdn.jsdelivr.net/npm/lucide@0.474.0/dist/umd/lucide.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
@if ($useSwiper)
<script defer src="https://cdn.jsdelivr.net/npm/swiper@11.2.10/swiper-bundle.min.js"></script>
@endif
@if ($useFancybox)
<script defer src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0.36/dist/fancybox/fancybox.umd.js"></script>
@endif
@if ($useLenis)
<script defer src="https://cdn.jsdelivr.net/npm/lenis@1.3.27/dist/lenis.min.js"></script>
@endif

@viteRefresh()
<link rel="stylesheet" href="{{ vite('source/_assets/css/main.css', '/static') }}">
<script defer type="module" src="{{ vite('source/_assets/js/main.js', '/static') }}"></script>

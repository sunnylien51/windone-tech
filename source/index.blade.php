@extends('_layouts.main')

@section('bodyClass', 'bg-dot')

@section('body')
@php
    $heroSlides = $page->heroSlides ?? [];
    $heroCount = max(count($heroSlides), 1);
    $heroFirst = $heroSlides[0] ?? ['title' => '', 'body' => '', 'link' => '#'];
    $productCards = $page->asArray($page->productCards ?? []);
    $valueCards = $page->asArray($page->valueCards ?? []);
    $dataPanel = $page->asArray($page->dataPanel ?? []);
    $dataStats = $page->asArray($dataPanel['stats'] ?? []);
    $dataStatsD = $page->asArray($dataStats[0] ?? []);
    $dataStatsT = $page->asArray($dataStats[1] ?? []);
    $aboutPanel = $page->asArray($page->aboutPanel ?? []);
    $partnerLogos = $page->asArray($page->partnerLogos ?? []);
@endphp

{{-- ----------------------------------------------------------------------
     ★ SECTION · Home top - 主視覺＋產品共用底
     ---------------------------------------------------------------------- --}}
<div class="home-top">
{{-- ----------------------------------------------------------------------
     ★ SECTION · Hero - 首頁主視覺
     ---------------------------------------------------------------------- --}}
<section
    id="home-hero"
    class="hero relative w-full h-[100svh] overflow-x-clip overflow-y-hidden"
    aria-label="首頁主視覺"
    tabindex="0"
    data-hero-pause-on-hover="false"
>
    <div class="layout-grid h-full flex-col pt-32 lg:pt-[160px] pb-20 md:pb-14 lg:pb-16 overflow-visible">
        {{-- 上：品牌字 + 產品圖（吃掉剩餘高度） --}}
        <div class="hero-stage relative w-full flex-1 min-h-0 overflow-visible">
            {{-- 背景英文：寬度 = 版面內容寬（layout-grid），白色漸層；textLength 讓字距自動撐滿 --}}
            <div class="hero-brand pointer-events-none select-none" aria-hidden="true">
                <svg viewBox="0 0 1000 180" class="block w-full h-auto" preserveAspectRatio="xMidYMid meet" role="presentation">
                    <defs>
                        <linearGradient id="hero-brand-gradient" x1="0" y1="0" x2="1" y2="0">
                            <stop offset="0%" class="hero-brand-stop-start" />
                            <stop offset="100%" class="hero-brand-stop-end" />
                        </linearGradient>
                    </defs>
                    <text
                        x="0"
                        y="165"
                        textLength="1000"
                        lengthAdjust="spacing"
                        fill="url(#hero-brand-gradient)"
                        class="hero-brand-text"
                    >WINDONE</text>
                </svg>
            </div>

            <div class="hero-visual relative z-10 h-full mx-auto w-full max-w-[920px] flex items-center translate-y-6 md:translate-y-10 lg:translate-y-16">
                <div id="hero-swiper" class="swiper hero-swiper w-full">
                    <div class="swiper-wrapper">
                        @foreach ($heroSlides as $slide)
                            <div
                                class="swiper-slide"
                                data-hero-title="{{ $slide['title'] }}"
                                data-hero-body="{{ $slide['body'] }}"
                                data-hero-link="{{ $slide['link'] }}"
                            >
                                {{-- 分層（各管各的 transform，避免互相覆蓋）：
                                     motion  = 右進左出 + 縮放淡入淡出
                                     shadow  = 動態陰影（獨立一層，隨漂浮拉遠／變淡，隨傾斜位移）
                                     float   = 上下漂浮
                                     tilt    = 3D 傾斜（跟隨滑鼠） --}}
                                <div class="hero-motion relative w-full">
                                    <div class="hero-shadow-tilt" aria-hidden="true">
                                        <div class="hero-shadow">
                                            <img src="{{ $slide['image'] }}" alt="" class="hero-shadow-img" decoding="async">
                                        </div>
                                    </div>
                                    <div class="hero-float relative w-full">
                                        <div class="hero-tilt w-full">
                                            <img
                                                src="{{ $slide['image'] }}"
                                                alt="{{ $slide['title'] }}"
                                                class="hero-visual-img w-full h-auto max-h-[min(60svh,620px)] object-contain"
                                                width="800"
                                                height="550"
                                                decoding="async"
                                                @if ($loop->first) fetchpriority="high" @endif
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- 下：文案 + Read more；頁數改絕對定位，底邊對齊 64px --}}
        <div class="hero-footer relative z-10 w-full shrink-0 h-[17.5rem] md:h-[15rem] pt-4 md:pt-6 flex flex-col justify-end">
            <div class="w-full max-w-[400px] flex flex-col items-start gap-6 md:gap-8">
                {{-- AOS 以 hero 頂端為觸發點：貼近底部的按鈕才會跟標題一起出現 --}}
                <div id="hero-copy" class="w-full flex flex-col items-start gap-2 md:gap-3">
                    <h1 id="hero-title" class="text-ch4 md:text-ch3 text-gray5 line-clamp-1" data-aos="fade-up" data-aos-anchor="#home-hero">{{ $heroFirst['title'] }}</h1>
                    <p id="hero-body" class="text-cb3 text-gray3 line-clamp-2" data-aos="fade-up" data-aos-delay="100" data-aos-anchor="#home-hero">{{ $heroFirst['body'] }}</p>
                </div>
                <a
                    id="hero-link"
                    href="{{ $heroFirst['link'] }}"
                    class="btn-dark"
                    data-aos="fade-up"
                    data-aos-delay="200"
                    data-aos-anchor="#home-hero"
                >
                    <span class="btn-dark-icon" aria-hidden="true">
                        <i data-lucide="arrow-right"></i>
                    </span>
                    <span class="text-eb2 text-white">Read more</span>
                </a>
            </div>
        </div>
    </div>

    {{-- 頁數：手機靠右下避開 Read more；md+ 右 80px／底 64px --}}
    <div class="pager hero-pager" role="group" aria-label="主視覺頁數">
        <p class="pager-label tabular-nums" aria-live="polite">
            <span id="hero-current">01</span> / <span>{{ str_pad((string) $heroCount, 2, '0', STR_PAD_LEFT) }}</span>
        </p>
        <div class="pager-dots" role="tablist" aria-label="選擇主視覺頁面">
            @foreach ($heroSlides as $slide)
                <button
                    type="button"
                    class="pager-dot{{ $loop->first ? ' is-active' : '' }}"
                    role="tab"
                    data-hero-dot="{{ $loop->index }}"
                    aria-label="第 {{ $loop->iteration }} 張，共 {{ $heroCount }} 張"
                    aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                >
                    <span class="pager-dot-pill" aria-hidden="true"></span>
                </button>
            @endforeach
        </div>
    </div>

    {{-- 桌機自訂游標（僅 pointer: fine）；進度環 = 目前第幾張／總張數 --}}
    <div class="hero-cursor" data-dir="next" aria-hidden="true">
        <svg class="hero-cursor-svg" viewBox="0 0 90 90" fill="none">
            <circle class="hero-cursor-track" cx="45" cy="45" r="43.875" />
            <circle
                id="hero-cursor-progress"
                class="hero-cursor-progress"
                cx="45"
                cy="45"
                r="43.875"
                stroke-dasharray="275.76"
                stroke-dashoffset="275.76"
            />
        </svg>
        <span class="hero-cursor-icon hero-cursor-icon-next">
            <i data-lucide="arrow-right"></i>
        </span>
        <span class="hero-cursor-icon hero-cursor-icon-prev">
            <i data-lucide="arrow-left"></i>
        </span>
    </div>
</section>

@if (count($productCards) > 0)
{{-- ----------------------------------------------------------------------
     ★ SECTION · Products - 產品介紹
     ---------------------------------------------------------------------- --}}
<section
    id="home-products"
    class="relative w-full pt-10 md:pt-12 lg:pt-14 pb-16 md:pb-20 lg:pb-24"
    aria-label="產品介紹"
>
    <div class="layout-grid flex-col gap-8 md:gap-10 lg:gap-12">
        <div id="product-swiper" class="swiper product-swiper w-full">
            <div class="swiper-wrapper">
                @foreach ($productCards as $card)
                    <div class="swiper-slide h-auto">
                        <a
                            href="{{ $card['link'] ?? '/products/' }}"
                            class="product-card h-full"
                            aria-label="查看{{ $card['title'] }}"
                        >
                            <div class="relative w-full pl-6 md:pl-8 pr-5 md:pr-6 pt-16 md:pt-20 lg:pt-24">
                                <div class="w-full pb-6 md:pb-8 border-b border-gray1 flex flex-col items-start gap-1 pr-6">
                                    <p class="text-cb3 text-main2 pl-2">{{ $card['category'] }}</p>
                                    <h2 class="text-cb1 text-gray5">{{ $card['title'] }}</h2>
                                    <p class="text-cb3 text-gray3 line-clamp-2">{{ $card['body'] }}</p>
                                </div>
                                <span
                                    class="btn-icon-solid absolute right-5 md:right-6 bottom-0 translate-y-1/2"
                                    aria-hidden="true"
                                >
                                    <i data-lucide="plus"></i>
                                </span>
                            </div>
                            <div class="product-card-media h-56 md:h-64 lg:h-72">
                                <img
                                    src="{{ $card['image'] }}"
                                    alt=""
                                    class="w-56 h-56 md:w-64 md:h-64 lg:w-72 lg:h-72 object-contain"
                                    width="288"
                                    height="288"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="pager product-pager" role="group" aria-label="產品頁數">
            <p class="pager-label tabular-nums" aria-live="polite">
                <span id="product-current">01</span> / <span id="product-total">01</span>
            </p>
            <div id="product-pager-dots" class="pager-dots" role="tablist" aria-label="選擇產品頁面"></div>
        </div>
    </div>
</section>
@endif
</div>

@if (count($valueCards) > 0)
{{-- ----------------------------------------------------------------------
     ★ SECTION · Values - 企業理念
     ---------------------------------------------------------------------- --}}
<section
    id="home-values"
    class="relative w-full py-16 md:py-20 lg:py-24"
    aria-label="企業理念"
>
    <div class="layout-grid flex-col gap-8">
        <div class="values-stack">
            {{-- 上排小字：跟疊卡一起釘住、一起離場（必須在 stack 內） --}}
            <div class="values-label">
                <p class="text-eb3 text-gray3">Since 1995</p>
                <p class="text-eb3 text-gray3">Taoyuan, Taiwan</p>
            </div>

            @foreach ($valueCards as $card)
                <article class="values-card" aria-labelledby="value-title-{{ $loop->iteration }}">
                    <div class="values-card-inner">
                        <img
                            class="values-card-media"
                            src="{{ $card['image'] }}"
                            alt=""
                            width="1600"
                            height="760"
                            loading="lazy"
                            decoding="async"
                        >
                        <div class="values-card-scrim" aria-hidden="true"></div>
                        <div class="values-card-body">
                            <div class="w-full h-16 md:h-20 flex justify-between items-center shrink-0">
                                <div class="flex items-center gap-5 min-w-0">
                                    <span class="text-eb2 text-white/90 tabular-nums shrink-0">{{ $card['num'] }}</span>
                                    <h2 id="value-title-{{ $loop->iteration }}" class="text-ch5 text-white/90 truncate">{{ $card['title'] }}</h2>
                                </div>
                                <p class="text-eb3 text-white/70 shrink-0 hidden md:block pb-0.5">( OUR VALUES )</p>
                            </div>
                            <div class="w-full h-px bg-white/25 shrink-0" aria-hidden="true"></div>
                            <p class="w-full max-w-[600px] pt-5 md:pt-6 text-cb3 md:text-cb2 text-white/90 shrink-0">{{ $card['body'] }}</p>
                            <div class="w-full flex-1 min-h-4" aria-hidden="true"></div>
                            <span class="values-card-num self-end" aria-hidden="true">{{ $card['num'] }}</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="w-full flex justify-between items-center">
            <p class="text-eb3 text-gray3">Quality &amp; Precision</p>
            <p class="text-eb3 text-gray3">Professional &amp; Reliable</p>
        </div>
    </div>
</section>
@endif

@if (count($dataPanel) > 0)
{{-- ----------------------------------------------------------------------
     ★ SECTION · Data - 企業數據
     id: #home-data
     ---------------------------------------------------------------------- --}}
<section
    id="home-data"
    class="relative w-full "
    aria-label="企業數據"
>
    <div class="data-panel">
        <div class="data-panel-bg" aria-hidden="true"></div>
        <div class="data-panel-inner">
            {{-- 左：標題＋說明＋大字母 --}}
            <div class="data-col flex-1 px-6 md:px-12 lg:px-20 py-12 md:py-16 lg:py-24 gap-7">
                <div class="relative z-10 flex flex-col items-start gap-4">
                    <span class="accent-bar" aria-hidden="true"></span>
                    <h2 class="text-eh1 uppercase text-gray1">{{ $dataPanel['enTitle'] }}</h2>
                </div>
                <p class="relative z-10 text-cb3 text-white/80 whitespace-pre-line">{{ $dataPanel['body'] ?? '' }}</p>

                {{-- 裁切框靠欄位右緣（左／中欄靠右分隔線；右欄靠面板右邊）＋底邊 --}}
                <div class="data-col-media z-10">
                    <span class="data-col-letter" aria-hidden="true">W</span>
                </div>
            </div>

            {{-- 中區塊：後台 label／value；手機／平板兩筆左右並列，lg 直排；字母 D 寫死 --}}
            <div class="data-col w-full lg:w-96 shrink-0 border-t lg:border-t-0 lg:border-l border-white/20 pl-6 md:pl-12 lg:pl-9 pr-6 py-8 md:py-12 lg:py-24 gap-10 lg:gap-24">
                <div class="data-col-stats">
                    @foreach ($dataStatsD as $stat)
                        <dl class="relative z-10 flex flex-col gap-2">
                            <dt class="text-cb3 text-white/90">{{ $stat['label'] }}</dt>
                            <dd class="text-eh1 text-white whitespace-nowrap">{{ $stat['value'] }}</dd>
                        </dl>
                    @endforeach
                </div>
                <div class="data-col-media z-10">
                    <span class="data-col-letter" aria-hidden="true">D</span>
                </div>
            </div>

            {{-- 下區塊：同上；字母 T 寫死 --}}
            <div class="data-col w-full lg:w-96 shrink-0 border-t lg:border-t-0 lg:border-l border-white/20 pl-6 md:pl-12 lg:pl-9 pr-6 py-8 md:py-12 lg:py-24 gap-10 lg:gap-24">
                <div class="data-col-stats">
                    @foreach ($dataStatsT as $stat)
                        <dl class="relative z-10 flex flex-col gap-2">
                            <dt class="text-cb3 text-white/90">{{ $stat['label'] }}</dt>
                            <dd class="text-eh1 text-white whitespace-nowrap">{{ $stat['value'] }}</dd>
                        </dl>
                    @endforeach
                </div>
                <div class="data-col-media z-10">
                    <span class="data-col-letter" aria-hidden="true">T</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@if (count($aboutPanel) > 0)
{{-- ----------------------------------------------------------------------
     ★ SECTION · About partners - 關於我們與合作夥伴
     ---------------------------------------------------------------------- --}}
<section
    id="home-about-partners"
    class="relative w-full rounded-t-[40px] overflow-hidden"
    aria-label="關於我們與合作夥伴"
>
    {{-- ----------------------------------------------------------------------
         ★ SECTION · About - 關於我們
         ---------------------------------------------------------------------- --}}
    <div
        id="home-about"
        class="w-full flex flex-col lg:flex-row items-stretch pt-24 md:pt-32 lg:pt-40"
    >
        <div class="w-full lg:w-[718px] shrink-0 px-6 md:px-12 lg:px-24 pt-6 md:pt-8 lg:pt-10 flex flex-col items-start gap-8 md:gap-9">
            <div class="w-full flex flex-col items-start gap-4">
                <span class="accent-bar" aria-hidden="true"></span>
                <h2 class="text-eh1 uppercase text-gray3">{{ $aboutPanel['enTitle'] ?? 'About' }}</h2>
            </div>
            <p class="w-full text-ch4 text-gray5 whitespace-pre-line">{{ $aboutPanel['headline'] ?? '' }}</p>
            <p class="w-full text-cb2 text-gray3">{{ $aboutPanel['body'] ?? '' }}</p>
            <a href="{{ $aboutPanel['link'] ?? '/about/' }}" class="btn-dark">
                <span class="btn-dark-icon" aria-hidden="true">
                    <i data-lucide="arrow-right"></i>
                </span>
                <span class="text-eb2 text-white">Read more</span>
            </a>
        </div>

        <div class="about-media w-full flex-1 mt-10 lg:mt-0 lg:h-[660px] pl-6 md:pl-12 lg:pl-0">
            <div class="relative w-full h-full">
                <img
                    src="{{ $aboutPanel['image'] ?? '/images/about_index.jpg' }}"
                    alt=""
                    class="w-full h-64 md:h-96 lg:h-full object-cover rounded-tl-[40px] rounded-bl-[40px]"
                    width="722"
                    height="660"
                    loading="lazy"
                    decoding="async"
                >
                <div class="about-badge">
                    <p class="text-eb2 text-gray5">{{ $aboutPanel['badgeEn'] ?? '' }}</p>
                    <p class="text-cb3 text-gray3">{{ $aboutPanel['badgeZh'] ?? '' }}</p>
                </div>
            </div>
        </div>
    </div>

    @if (count($partnerLogos) > 0)
    {{-- ----------------------------------------------------------------------
         ★ SECTION · Partners - 合作夥伴
         ---------------------------------------------------------------------- --}}
    <div
        id="home-partners"
        class="w-full px-6 md:px-12 lg:px-20 pt-16 md:pt-20 pb-24 md:pb-32 lg:pb-40 flex flex-col items-start gap-8 md:gap-10"
    >
        <div class="w-full flex flex-col items-start gap-4">
            <span class="accent-bar" aria-hidden="true"></span>
            <h2 class="text-eh1 uppercase text-gray3">Partners</h2>
        </div>
        <div id="partner-swiper" class="swiper partner-swiper w-full" data-lenis-prevent aria-label="合作夥伴">
            <div class="swiper-wrapper">
                @foreach ($partnerLogos as $logo)
                    <div class="swiper-slide">
                        <div class="partner-logo">
                            <img
                                src="{{ $logo['image'] }}"
                                alt="{{ $logo['alt'] ?? '' }}"
                                draggable="false"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</section>
@endif
@endsection

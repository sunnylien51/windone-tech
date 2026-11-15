@extends('_layouts.main')

@section('body')
@php
    $heroSlides = $page->heroSlides ?? [];
    $heroCount = max(count($heroSlides), 1);
    $heroFirst = $heroSlides[0] ?? ['title' => '', 'body' => '', 'link' => '#'];
    $productCards = $page->asArray($page->productCards ?? []);
@endphp

{{-- hero + 產品 slider：共用 bg_main，下方圓角 40px --}}
<div class="home-top">
<section
    id="home-hero"
    class="hero relative w-full h-[100svh] overflow-x-clip overflow-y-hidden"
    aria-label="首頁主視覺"
    tabindex="0"
    data-hero-pause-on-hover="false"
>
    <div class="layout-grid h-full flex-col pt-24 md:pt-28 lg:pt-[160px] pb-10 md:pb-14 lg:pb-16 overflow-visible">
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
            <div class="hero-enter w-full max-w-[400px] flex flex-col items-start gap-5 md:gap-6">
                <div id="hero-copy" class="hero-copy-fade w-full h-[7.75rem] flex flex-col items-start gap-2 md:gap-3 overflow-hidden">
                    <h1 id="hero-title" class="text-ch4 md:text-ch3 text-gray5 line-clamp-1">{{ $heroFirst['title'] }}</h1>
                    <p id="hero-body" class="text-cb3 text-gray3 line-clamp-3">{{ $heroFirst['body'] }}</p>
                </div>
                <a
                    id="hero-link"
                    href="{{ $heroFirst['link'] }}"
                    class="btn-dark"
                >
                    <span class="btn-dark-icon" aria-hidden="true">
                        <i data-lucide="arrow-right"></i>
                    </span>
                    <span class="text-eb2 text-white">Read more</span>
                </a>
            </div>
        </div>
    </div>

    {{-- 右下角頁數：右 80px、底 64px，與 Read more 底邊對齊 --}}
    <div class="pager hero-pager hero-enter hero-enter-delay" role="group" aria-label="主視覺頁數">
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
                                <div class="w-full pb-6 md:pb-8 border-b border-gray1 flex flex-col items-start gap-1 pr-12">
                                    <p class="text-cb3 text-gray3">{{ $card['category'] }}</p>
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
@endsection

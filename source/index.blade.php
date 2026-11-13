@extends('_layouts.main')

@section('body')
@php
    $heroSlides = $page->heroSlides ?? [];
    $heroCount = max(count($heroSlides), 1);
    $heroFirst = $heroSlides[0] ?? [
        'image' => '/images/main_product1.webp',
        'title' => '高精密切割刀具',
        'body' => '',
        'link' => '/products/',
    ];
@endphp

<section
    id="home-hero"
    class="hero relative w-full min-h-[100svh] h-[100svh] overflow-x-clip overflow-y-hidden"
    aria-label="首頁主視覺"
    style="background-image: url('/images/bg_main.webp'); background-size: cover; background-position: center top;"
>
    <div class="layout-grid h-full flex-col pt-24 md:pt-28 lg:pt-[160px] pb-6 md:pb-12 lg:pb-[72px] overflow-visible">
        {{-- 上：品牌字 + 產品圖（吃掉剩餘高度） --}}
        <div class="hero-stage relative w-full flex-1 min-h-0 overflow-visible">
            {{-- 背景英文：寬度 = 版面內容寬（layout-grid），白色漸層；textLength 讓字距自動撐滿 --}}
            <div class="hero-brand pointer-events-none select-none" aria-hidden="true">
                <svg viewBox="0 0 1000 180" class="block w-full h-auto" preserveAspectRatio="xMidYMid meet" role="presentation">
                    <defs>
                        <linearGradient id="hero-brand-gradient" x1="0" y1="0" x2="1" y2="0">
                            <stop offset="0%" stop-color="#FFFFFF" stop-opacity="1" />
                            <stop offset="100%" stop-color="#FFFFFF" stop-opacity="0.15" />
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
                                                @if ($loop->first) fetchpriority="high" @else loading="eager" @endif
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

        {{-- 下：文案 + 頁碼（與產品同屏、同時進場） --}}
        {{-- 下排高度固定（不隨文案行數變動），輪播區吃剩下的高度 --}}
        <div class="hero-footer relative z-10 w-full shrink-0 h-[17.5rem] md:h-[15rem] pt-4 md:pt-6 flex flex-col justify-end gap-6 md:flex-row md:justify-between md:items-end">
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
                    <span class="text-eb2 text-white">Read more</span>
                </a>
            </div>

            <div class="hero-enter hero-enter-delay flex items-center gap-3 md:gap-5 self-end md:self-auto">
                <button
                    type="button"
                    class="hero-pager-btn"
                    data-hero-prev
                    aria-label="上一則"
                >
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                </button>

                <div class="hero-pager-dial relative size-24 md:size-32 rounded-full bg-white/60 flex items-center justify-center">
                    {{-- 進度圈：底圈 gray1、進度 main1，隨自動輪播倒數填滿 --}}
                    <svg class="absolute inset-0 size-full -rotate-90 pointer-events-none" viewBox="0 0 80 80" fill="none" aria-hidden="true">
                        <circle cx="40" cy="40" r="38" stroke="currentColor" stroke-width="2.5" class="text-gray1" />
                        <circle
                            id="hero-ring"
                            cx="40" cy="40" r="38"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            class="hero-ring text-main1"
                            stroke-dasharray="238.76"
                            stroke-dashoffset="238.76"
                        />
                    </svg>
                    {{-- 大字當前頁（Tenor Sans）+ 小字總頁數 --}}
                    <span class="relative flex flex-col items-center tabular-nums">
                        <span id="hero-current" class="text-ch2 md:text-eh1 text-gray5 leading-none">01</span>
                        <span class="text-eb3 text-gray3 mt-1">
                            <span aria-hidden="true">/ </span><span id="hero-total">{{ str_pad((string) $heroCount, 2, '0', STR_PAD_LEFT) }}</span>
                        </span>
                    </span>
                </div>

                <button
                    type="button"
                    class="hero-pager-btn text-gray3 hover:text-gray5 transition-colors cursor-pointer"
                    data-hero-next
                    aria-label="下一則"
                >
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    </div>
</section>
@endsection

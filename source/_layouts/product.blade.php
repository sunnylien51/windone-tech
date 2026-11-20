@extends('_layouts.main')

{{-- is-inner：與其他內頁一致；本頁不用 page-banner，改以產品舞台開場 --}}
@section('bodyClass', 'bg-bg is-inner')

@section('body')
@php
    $slug = $page->getFilename();
    $product = $page->productBySlug($slug);
    $categoryTitle = is_array($product) ? ($product['categoryTitle'] ?? '') : '';
    $title = is_array($product) ? ($product['title'] ?? ($page->title ?? '')) : ($page->title ?? '');
    $lead = is_array($product) ? ($product['lead'] ?? ($product['body'] ?? '')) : '';
    $image = is_array($product) ? ($product['image'] ?? '/images/product1.webp') : '/images/product1.webp';
    $applications = is_array($product) ? $page->asArray($product['applications'] ?? []) : [];
    $specs = is_array($product) ? $page->asArray($product['specs'] ?? []) : [];
    $contactHref = '/contact/?product=' . rawurlencode($title);

    // 適用場景併入規格重點表格（一列）
    $specRows = $specs;
    $appTitles = [];
    foreach ($applications as $app) {
        $app = is_array($app) ? $app : (array) $app;
        $appTitle = trim((string) ($app['title'] ?? ''));
        if ($appTitle !== '') {
            $appTitles[] = $appTitle;
        }
    }
    if (count($appTitles) > 0) {
        array_unshift($specRows, [
            'label' => '適用場景',
            'value' => implode('、', $appTitles),
        ]);
    }
@endphp

@if (!$product)
    <div class="layout-grid flex-col pt-32 pb-20">
        <p class="text-cb2 text-gray3">找不到此產品。</p>
        <a href="/products/" class="btn-dark mt-8">
            <span class="btn-dark-icon" aria-hidden="true">
                <i data-lucide="arrow-right"></i>
            </span>
            <span class="text-cb2 text-white">回產品介紹</span>
        </a>
    </div>
@else
    {{-- ----------------------------------------------------------------------
         ★ SECTION · Product stage - 產品舞台
         ---------------------------------------------------------------------- --}}
    <section
        id="product-stage"
        class="product-stage relative w-full overflow-x-clip"
        aria-label="{{ $title }}"
    >
        <img
            class="product-stage-bg"
            src="/images/bg_banner.webp"
            alt=""
            width="1920"
            height="1920"
            aria-hidden="true"
            decoding="async"
        >

        <div class="layout-grid relative z-10 flex-col pt-32 md:pt-40 lg:pt-44 pb-14 md:pb-16 lg:pb-20">
            {{-- 首屏不加 AOS：避免 CDN／JS 未就緒時整區卡在 opacity:0 看起來空白 --}}
            <nav
                aria-label="麵包屑"
                class="breadcrumb-pill"
            >
                <a
                    href="/"
                    class="breadcrumb-pill-item border-r border-gray1 text-eb3 text-gray3 transition-colors hover:text-main1"
                >WINDONE</a>
                <a
                    href="/products/"
                    class="breadcrumb-pill-item border-r border-gray1 font-content text-[13px] text-gray3 tracking-wider transition-colors hover:text-main1"
                >產品介紹</a>
                <span class="breadcrumb-pill-item font-content text-[13px] tracking-wider text-gray5">{{ $title }}</span>
            </nav>

            <div class="product-stage-grid w-full mt-10 md:mt-12 lg:mt-14">
                <div class="product-stage-copy flex flex-col items-start gap-6 md:gap-8">
                    <div class="w-full flex flex-col items-start gap-3">
                        
                        @if ($categoryTitle !== '')
                            <p class="text-cb3 text-main2">{{ $categoryTitle }}</p>
                        @endif
                        <span class="accent-bar" aria-hidden="true"></span>
                        <h1 class="w-full text-ch3 text-gray5">{{ $title }}</h1>
                        @if ($lead !== '')
                            <p class="w-full max-w-[520px] text-cb2 text-gray3">{{ $lead }}</p>
                        @endif
                    </div>

                    @if (count($specRows) > 0)
                        {{-- 規格重點：緊接簡介下方 --}}
                        <div class="w-full flex flex-col items-start gap-4" aria-label="規格重點">
                            <h2 class="text-ch5 text-gray5">規格重點</h2>
                            <dl class="w-full flex flex-col border-t border-gray2">
                                @foreach ($specRows as $spec)
                                    @php
                                        $specLabel = $spec['label'] ?? '';
                                        $specValue = $spec['value'] ?? '';
                                    @endphp
                                    @if ($specLabel === '')
                                        @continue
                                    @endif
                                    <div class="product-spec-row w-full py-4 border-b border-gray2 flex flex-col md:flex-row md:items-baseline gap-1 md:gap-6">
                                        <dt class="product-spec-label text-cb3 text-gray3 md:w-28 lg:w-32 shrink-0">{{ $specLabel }}</dt>
                                        <dd class="product-spec-value text-cb2 text-gray5 flex-1 m-0">{{ $specValue }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        </div>
                    @endif

                    <a href="/products/" class="btn-dark">
                        <span class="btn-dark-icon" aria-hidden="true">
                            <i data-lucide="arrow-right"></i>
                        </span>
                        <span class="text-cb2 text-white">返回產品列表</span>
                    </a>
                </div>

                <div class="product-stage-visual relative w-full">
                    <div class="product-stage-shadow-tilt" aria-hidden="true">
                        <div class="product-stage-shadow">
                            <img src="{{ $image }}" alt="" class="product-stage-shadow-img" decoding="async">
                        </div>
                    </div>
                    <div class="product-stage-float relative w-full">
                        <div class="product-stage-tilt w-full flex items-center justify-center">
                            <img
                                src="{{ $image }}"
                                alt="{{ $title }}"
                                class="product-stage-img w-full w-full h-auto object-contain"
                                width="420"
                                height="420"
                                fetchpriority="high"
                                decoding="async"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="layout-grid flex-col pt-14 md:pt-16 lg:pt-20 pb-20 md:pb-24 lg:pb-28 gap-16 md:gap-20 lg:gap-24">
        {{-- ----------------------------------------------------------------------
             ★ SECTION · Product CTA - 詢價引導
             ---------------------------------------------------------------------- --}}
        <section
            class="w-full px-6 md:px-10 lg:px-16 py-12 md:py-14 lg:py-16 bg-white rounded-[40px] flex flex-col md:flex-row md:items-center md:justify-between gap-8"
            aria-label="詢價引導"
            data-aos="fade-up"
        >
            <div class="w-full md:max-w-xl flex flex-col items-start gap-3">
                <span class="accent-bar" aria-hidden="true"></span>
                <h2 class="w-full text-ch3 text-gray5">需要規格確認或客製評估？</h2>
                <p class="w-full text-cb2 text-gray3">告訴我們機台條件與用量需求，崴東團隊協助對應合適規格與交期。</p>
            </div>
            <a href="{{ $contactHref }}" class="btn-dark shrink-0">
                <span class="btn-dark-icon" aria-hidden="true">
                    <i data-lucide="arrow-right"></i>
                </span>
                <span class="text-cb2 text-white">聯絡我們</span>
            </a>
        </section>
    </div>
@endif
@endsection

@extends('_layouts.main')

{{-- is-inner：與其他內頁一致；本頁不用 page-banner，改以產品舞台開場 --}}
@section('bodyClass', 'bg-bg is-inner')

@section('body')
@php
    $slug = $page->getFilename();
    $product = $page->productBySlug($slug);
    $categoryTitle = $product['categoryTitle'] ?? '';
    $title = $product['title'] ?? ($page->title ?? '');
    $lead = $product['lead'] ?? ($product['body'] ?? '');
    $image = $product['image'] ?? '/images/product1.webp';
    $kind = $product['kind'] ?? 'product';
    $applications = $page->asArray($product['applications'] ?? []);
    $specs = $page->asArray($product['specs'] ?? []);
    $steps = $page->asArray($product['steps'] ?? []);
    $related = $page->relatedProducts($slug, 3);
    $contactHref = '/contact/?product=' . rawurlencode($title);
    $isService = $kind === 'service';
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
            <nav
                aria-label="麵包屑"
                class="inline-flex items-center overflow-hidden rounded-[20px] bg-white px-1.5 outline-inset outline-gray1 self-start"
                data-aos="fade-up"
            >
                <a
                    href="/"
                    class="px-4 py-2 border-r border-gray1 text-eb3 text-gray3 transition-colors hover:text-main1"
                >WINDONE</a>
                <a
                    href="/products/"
                    class="px-4 py-2 border-r border-gray1 font-content text-[13px] text-gray3 tracking-wider transition-colors hover:text-main1"
                >產品介紹</a>
                <span class="px-4 py-2 font-content text-[13px] tracking-wider text-gray5">{{ $title }}</span>
            </nav>

            <div class="product-stage-grid w-full mt-10 md:mt-12 lg:mt-14">
                <div class="product-stage-copy flex flex-col items-start gap-6 md:gap-8" data-aos="fade-up">
                    <div class="w-full flex flex-col items-start gap-3">
                        <span class="accent-bar" aria-hidden="true"></span>
                        @if ($categoryTitle !== '')
                            <p class="text-cb3 text-main2">{{ $categoryTitle }}</p>
                        @endif
                        <h1 class="w-full text-ch3 text-gray5">{{ $title }}</h1>
                        @if ($lead !== '')
                            <p class="w-full max-w-[520px] text-cb2 text-gray3">{{ $lead }}</p>
                        @endif
                    </div>
                    <a href="{{ $contactHref }}" class="btn-dark">
                        <span class="btn-dark-icon" aria-hidden="true">
                            <i data-lucide="arrow-right"></i>
                        </span>
                        <span class="text-cb2 text-white">立即詢價</span>
                    </a>
                </div>

                <div class="product-stage-visual relative w-full" data-aos="fade-up" data-aos-delay="100">
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
                                class="product-stage-img w-full max-w-[420px] h-auto object-contain"
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
        @if (count($applications) > 0)
            {{-- ----------------------------------------------------------------------
                 ★ SECTION · Product applications - 適用場景
                 ---------------------------------------------------------------------- --}}
            <section
                class="w-full flex flex-col items-start gap-8 md:gap-10"
                aria-label="適用場景"
            >
                <div class="w-full flex flex-col items-start gap-3" data-aos="fade-up">
                    <span class="accent-bar" aria-hidden="true"></span>
                    <h2 class="w-full text-ch3 text-gray5">適用場景</h2>
                </div>
                <div
                    class="w-full border-t border-b border-gray2 grid grid-cols-1 md:grid-cols-3"
                    data-aos="fade-up"
                >
                    @foreach ($applications as $app)
                        @php
                            $appTitle = $app['title'] ?? '';
                            $appBody = $app['body'] ?? '';
                        @endphp
                        @if ($appTitle === '')
                            @continue
                        @endif
                        <article class="px-6 md:px-8 lg:px-10 pt-10 md:pt-12 pb-12 md:pb-14 flex flex-col items-start gap-3{{ $loop->first ? '' : ' border-t md:border-t-0 md:border-l border-gray2' }}">
                            <p class="text-eb3 text-main2 tabular-nums">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</p>
                            <h3 class="text-ch5 text-gray5">{{ $appTitle }}</h3>
                            @if ($appBody !== '')
                                <p class="text-cb2 text-gray3">{{ $appBody }}</p>
                            @endif
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($isService && count($steps) > 0)
            {{-- ----------------------------------------------------------------------
                 ★ SECTION · Product steps - 服務流程
                 ---------------------------------------------------------------------- --}}
            <section
                class="w-full flex flex-col items-start gap-8 md:gap-10"
                aria-label="服務流程"
            >
                <div class="w-full flex flex-col items-start gap-3" data-aos="fade-up">
                    <span class="accent-bar" aria-hidden="true"></span>
                    <h2 class="w-full text-ch3 text-gray5">服務流程</h2>
                </div>
                <ol class="w-full flex flex-col border-t border-gray2" data-aos="fade-up">
                    @foreach ($steps as $step)
                        @php
                            $stepTitle = $step['title'] ?? '';
                            $stepBody = $step['body'] ?? '';
                        @endphp
                        @if ($stepTitle === '')
                            @continue
                        @endif
                        <li class="w-full py-6 md:py-8 border-b border-gray2 flex flex-col md:flex-row md:items-baseline gap-2 md:gap-8">
                            <span class="text-eb2 text-main2 tabular-nums shrink-0 w-12">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <h3 class="text-ch5 text-gray5 md:w-48 lg:w-56 shrink-0">{{ $stepTitle }}</h3>
                            @if ($stepBody !== '')
                                <p class="text-cb2 text-gray3 flex-1">{{ $stepBody }}</p>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </section>
        @elseif (!$isService && count($specs) > 0)
            {{-- ----------------------------------------------------------------------
                 ★ SECTION · Product specs - 規格重點
                 ---------------------------------------------------------------------- --}}
            <section
                class="w-full flex flex-col items-start gap-8 md:gap-10"
                aria-label="規格重點"
            >
                <div class="w-full flex flex-col items-start gap-3" data-aos="fade-up">
                    <span class="accent-bar" aria-hidden="true"></span>
                    <h2 class="w-full text-ch3 text-gray5">規格重點</h2>
                </div>
                <dl class="w-full flex flex-col border-t border-gray2" data-aos="fade-up">
                    @foreach ($specs as $spec)
                        @php
                            $specLabel = $spec['label'] ?? '';
                            $specValue = $spec['value'] ?? '';
                        @endphp
                        @if ($specLabel === '')
                            @continue
                        @endif
                        <div class="w-full py-5 md:py-6 border-b border-gray2 flex flex-col md:flex-row md:items-baseline gap-2 md:gap-10">
                            <dt class="text-cb3 text-gray3 md:w-40 lg:w-48 shrink-0">{{ $specLabel }}</dt>
                            <dd class="text-cb1 text-gray5 flex-1">{{ $specValue }}</dd>
                        </div>
                    @endforeach
                </dl>
            </section>
        @endif

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

        @if (count($related) > 0)
            {{-- ----------------------------------------------------------------------
                 ★ SECTION · Related products - 同分類產品
                 ---------------------------------------------------------------------- --}}
            <section
                class="w-full flex flex-col items-start gap-8 md:gap-10"
                aria-label="同分類產品"
            >
                <div class="w-full flex flex-col items-start gap-3" data-aos="fade-up">
                    <span class="accent-bar" aria-hidden="true"></span>
                    <h2 class="w-full text-ch3 text-gray5">同分類產品</h2>
                </div>
                <div class="product-catalog-grid w-full">
                    @foreach ($related as $item)
                        @php
                            $itemTitle = $item['title'] ?? '';
                            $itemBody = $item['body'] ?? '';
                            $itemImage = $item['image'] ?? '/images/product1.webp';
                            $itemLink = $item['link'] ?? '/products/';
                            $itemCat = $item['categoryTitle'] ?? $categoryTitle;
                        @endphp
                        @if ($itemTitle === '')
                            @continue
                        @endif
                        <a
                            href="{{ $itemLink }}"
                            class="product-card w-full"
                            aria-label="了解{{ $itemTitle }}"
                            data-aos="fade-up"
                        >
                            <div class="relative w-full pl-6 md:pl-8 pr-5 md:pr-6 pt-16 md:pt-20 lg:pt-24">
                                <div class="w-full pb-6 md:pb-8 border-b border-gray1 flex flex-col items-start gap-1 pr-6">
                                    <p class="text-cb3 text-main2 pl-2">{{ $itemCat }}</p>
                                    <h3 class="text-cb1 text-gray5 line-clamp-1">{{ $itemTitle }}</h3>
                                    @if ($itemBody !== '')
                                        <p class="text-cb3 text-gray3 line-clamp-2">{{ $itemBody }}</p>
                                    @endif
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
                                    src="{{ $itemImage }}"
                                    alt=""
                                    class="w-56 h-56 md:w-64 md:h-64 lg:w-72 lg:h-72 object-contain"
                                    width="288"
                                    height="288"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endif
@endsection

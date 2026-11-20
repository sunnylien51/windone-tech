---
title: 產品介紹
description: 產品介紹
---
@extends('_layouts.main')

{{-- is-inner：讓 site-main clip 住 page-banner 底圖，不撐出 footer 外 --}}
@section('bodyClass', 'bg-bg is-inner')

@section('body')
    @php
        $productsPage = $page->asArray($page->productsPage ?? []);
        $banner = $page->asArray($productsPage['banner'] ?? []);
        $categories = $page->asArray($productsPage['categories'] ?? []);
        $groups = $page->asArray($productsPage['groups'] ?? []);
    @endphp

    @include('_components.page-banner', [
        'title' => $banner['title'] ?? 'PRODUCTS',
        'crumbs' => $page->asArray($banner['crumbs'] ?? [['name' => '產品介紹']]),
        'subtitle' => $banner['subtitle'] ?? null,
    ])

    <div class="layout-grid flex-col pt-14 md:pt-16 lg:pt-20 pb-20 md:pb-24 lg:pb-28">
        {{-- ----------------------------------------------------------------------
             ★ SECTION · Product categories - 產品分類選單
             ---------------------------------------------------------------------- --}}
        <div class="product-cat-nav-wrap w-full">
            <span class="product-cat-hint" aria-hidden="true">
                <i data-lucide="chevron-right"></i>
            </span>
            <nav
                id="product-categories"
                class="product-cat-nav w-full"
                aria-label="產品分類"
            >
                <ul class="product-cat-list" role="tablist">
                    @foreach ($categories as $index => $cat)
                        @php
                            $slug = $cat['slug'] ?? '';
                            $label = $cat['label'] ?? '';
                            $isFirst = $index === 0;
                        @endphp
                        @if ($label === '')
                            @continue
                        @endif
                        <li class="shrink-0">
                            <button
                                type="button"
                                class="product-cat-item{{ $isFirst ? ' is-active' : '' }}"
                                role="tab"
                                id="product-cat-{{ $slug !== '' ? $slug : $index }}"
                                aria-selected="{{ $isFirst ? 'true' : 'false' }}"
                                data-product-cat="{{ $slug }}"
                            >{{ $label }}</button>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>

        {{-- ----------------------------------------------------------------------
             ★ SECTION · Product catalog - 產品列表
             ---------------------------------------------------------------------- --}}
        <div id="product-catalog" class="w-full flex flex-col items-stretch">
            @foreach ($groups as $groupIndex => $group)
                @php
                    $groupSlug = $group['slug'] ?? '';
                    $groupTitle = $group['title'] ?? '';
                    $items = $page->asArray($group['items'] ?? []);
                    $isLast = $loop->last;
                @endphp
                @if ($groupTitle === '' || count($items) === 0)
                    @continue
                @endif
                <section
                    id="product-group-{{ $groupSlug !== '' ? $groupSlug : $groupIndex }}"
                    class="product-group w-full py-10 md:py-12 lg:py-14 flex flex-col items-start gap-8 md:gap-10{{ $isLast ? '' : ' border-b border-gray2' }}"
                    aria-labelledby="product-group-title-{{ $groupSlug !== '' ? $groupSlug : $groupIndex }}"
                    data-product-group="{{ $groupSlug }}"
                >
                    <div class="w-full flex flex-col items-start gap-3" data-aos="fade-up">
                        <span class="accent-bar" aria-hidden="true"></span>
                        <h2
                            id="product-group-title-{{ $groupSlug !== '' ? $groupSlug : $groupIndex }}"
                            class="w-full text-ch3 text-gray5"
                        >{{ $groupTitle }}</h2>
                    </div>

                    <div class="product-catalog-grid w-full">
                        @foreach ($items as $item)
                            @php
                                $itemTitle = $item['title'] ?? '';
                                $itemBody = $item['body'] ?? '';
                                $itemImage = $item['image'] ?? '/images/product1.webp';
                                $itemSlug = $item['slug'] ?? '';
                                $itemLink = $itemSlug !== ''
                                    ? '/products/' . $itemSlug . '/'
                                    : ($item['link'] ?? '/contact/');
                            @endphp
                            @if ($itemTitle === '')
                                @continue
                            @endif
                            <a
                                href="{{ $itemLink }}"
                                class="product-card product-card--catalog w-full"
                                aria-label="了解{{ $itemTitle }}"
                                data-aos="fade-up"
                            >
                                <div class="product-card-body relative w-full pl-6 md:pl-8 pr-5 md:pr-6 pt-16 md:pt-20 lg:pt-24">
                                    <div class="product-card-copy w-full pb-6 md:pb-8 border-b border-gray1 flex flex-col items-start gap-1 pr-6">
                                        <p class="text-cb3 text-main2 pl-2">{{ $groupTitle }}</p>
                                        <h3 class="text-cb1 text-gray5 line-clamp-2 md:line-clamp-1">{{ $itemTitle }}</h3>
                                        @if ($itemBody !== '')
                                            <p class="product-card-desc text-cb3 text-gray3 line-clamp-2">{{ $itemBody }}</p>
                                        @endif
                                    </div>
                                    <span
                                        class="btn-icon-solid absolute right-5 md:right-6 bottom-0 translate-y-1/2"
                                        aria-hidden="true"
                                    >
                                        <i data-lucide="plus"></i>
                                    </span>
                                </div>
                                <div class="product-card-media h-auto md:h-64 lg:h-72">
                                    <img
                                        src="{{ $itemImage }}"
                                        alt=""
                                        class="size-[140px] md:size-64 lg:size-72 object-contain"
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
            @endforeach
        </div>
    </div>
@endsection

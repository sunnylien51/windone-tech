{{-- 產品分類選單＋列表；呼叫端傳入 $activeCategory（all 或分類 slug） --}}
@php
    $productsPage = $page->asArray($page->productsPage ?? []);
    $banner = $page->asArray($productsPage['banner'] ?? []);
    $categories = $page->asArray($productsPage['categories'] ?? []);
    $groups = $page->asArray($productsPage['groups'] ?? []);
    $activeCategory = $activeCategory ?? 'all';
    if ($activeCategory === '') {
        $activeCategory = 'all';
    }

    $activeLabel = '全部';
    foreach ($categories as $cat) {
        $cat = is_array($cat) ? $cat : (array) $cat;
        if (($cat['slug'] ?? '') === $activeCategory) {
            $activeLabel = $cat['label'] ?? $activeCategory;
            break;
        }
    }

    if ($activeCategory !== 'all') {
        $crumbs = [
            ['name' => '產品介紹', 'link' => '/products/'],
            ['name' => $activeLabel],
        ];
    } else {
        $crumbs = $page->asArray($banner['crumbs'] ?? [['name' => '產品介紹']]);
    }

    $visibleGroups = [];
    foreach ($groups as $group) {
        $group = is_array($group) ? $group : (array) $group;
        $groupSlug = $group['slug'] ?? '';
        if ($activeCategory !== 'all' && $groupSlug !== $activeCategory) {
            continue;
        }
        $items = $page->asArray($group['items'] ?? []);
        if (($group['title'] ?? '') === '' || count($items) === 0) {
            continue;
        }
        $visibleGroups[] = $group;
    }
@endphp

@include('_components.page-banner', [
    'title' => $banner['title'] ?? 'PRODUCTS',
    'crumbs' => $crumbs,
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
            <ul class="product-cat-list" role="list">
                @foreach ($categories as $cat)
                    @php
                        $slug = $cat['slug'] ?? '';
                        $label = $cat['label'] ?? '';
                        $isActive = $slug === $activeCategory;
                        $href = ($slug === '' || $slug === 'all')
                            ? '/products/'
                            : '/products/' . $slug . '/';
                    @endphp
                    @if ($label === '')
                        @continue
                    @endif
                    <li class="shrink-0">
                        <a
                            href="{{ $href }}"
                            class="product-cat-item{{ $isActive ? ' is-active' : '' }}"
                            @if ($isActive) aria-current="page" @endif
                            data-product-cat="{{ $slug }}"
                        >{{ $label }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>

    {{-- ----------------------------------------------------------------------
         ★ SECTION · Product catalog - 產品列表
         ---------------------------------------------------------------------- --}}
    <div id="product-catalog" class="w-full flex flex-col items-stretch">
        @forelse ($visibleGroups as $groupIndex => $group)
            @php
                $groupSlug = $group['slug'] ?? '';
                $groupTitle = $group['title'] ?? '';
                $items = $page->asArray($group['items'] ?? []);
                $isLast = $loop->last;
            @endphp
            <section
                id="product-group-{{ $groupSlug !== '' ? $groupSlug : $groupIndex }}"
                class="product-group w-full py-10 md:py-12 lg:py-14 flex flex-col items-start gap-8 md:gap-10{{ $isLast ? '' : ' product-group--divided' }}"
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
        @empty
            <p class="text-cb2 text-gray3 py-10" data-aos="fade-up">此分類目前沒有產品。</p>
        @endforelse
    </div>
</div>

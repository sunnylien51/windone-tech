{{-- ----------------------------------------------------------------------
     ★ SECTION · Page banner - 內頁橫幅
     ---------------------------------------------------------------------- --}}
{{--
  參數：
  - enTitle   英文大標（text-eh1，如 PRODUCTS）
  - zhTitle   麵包屑當前頁（如 產品介紹）
  - subtitle  副標（可選）
  - image     形象大圖路徑（可選；有值＝有圖版）
  - imageAlt  形象圖 alt（可選，預設 zhTitle）
--}}
@php
    $bannerImage = $image ?? null;
    $bannerAlt = $imageAlt ?? ($zhTitle ?? '');
    $bannerSubtitle = $subtitle ?? null;
    $hasImage = !empty($bannerImage);
@endphp
<section class="page-banner" aria-label="{{ $zhTitle ?? '頁面橫幅' }}">
    <img
        class="page-banner-bg"
        src="/images/bg_banner.webp"
        alt=""
        width="1920"
        height="1920"
        aria-hidden="true"
        decoding="async"
    >

    <div class="layout-grid flex-col pt-32 md:pt-40 lg:pt-44{{ $hasImage ? '' : ' pb-10 md:pb-12 lg:pb-14' }}">
        <div class="w-full flex flex-col items-start gap-7">
            {{-- 麵包屑 pill：WINDONE | 當前頁 --}}
            <nav
                aria-label="麵包屑"
                class="inline-flex items-center overflow-hidden rounded-[20px] bg-white px-1.5 outline-inset outline-gray1"
            >
                <a
                    href="/"
                    class="px-4 py-2 border-r border-gray1 text-eb3 text-gray3 transition-colors hover:text-main1"
                >WINDONE</a>
                <span class="px-4 py-2 text-cb3 text-gray5">{{ $zhTitle }}</span>
            </nav>

            <div class="w-full flex flex-col items-start gap-3">
                <h1 class="w-full text-eh1 uppercase text-gray5">{{ $enTitle }}</h1>
                @if (!empty($bannerSubtitle))
                    <p class="w-full max-w-[600px] text-cb2 text-gray3">{{ $bannerSubtitle }}</p>
                @endif
            </div>
        </div>
    </div>

    {{-- 形象圖：不進 layout-grid；手機左右 24px，平板／桌機 48px --}}
    @if ($hasImage)
        <div class="w-full px-6 md:px-12 mt-10 md:mt-12 lg:mt-14 pb-10 md:pb-12 lg:pb-14">
            <img
                src="{{ $bannerImage }}"
                alt="{{ $bannerAlt }}"
                class="w-full aspect-[1360/510] object-cover rounded-[40px]"
                width="1360"
                height="510"
                loading="eager"
                decoding="async"
            >
        </div>
    @endif
</section>

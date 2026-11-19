{{-- ----------------------------------------------------------------------
     ★ SECTION · Page banner - 內頁橫幅
     ---------------------------------------------------------------------- --}}
{{--
  參數：
  - title     頁面大標（text-eh1；隨語系切換，勿再拆 zhTitle／enTitle）
  - crumbs    麵包屑階層（陣列；WINDONE 首層固定連首頁）
              例：[['name' => '產品介紹', 'link' => '/products/'], ['name' => '產品名稱']]
              每層：name 必填；link 有值＝可點，無 link＝當前頁
  - subtitle  副標（可選）
  - image     形象大圖路徑（可選；有值＝有圖版）
  - imageAlt  形象圖 alt（可選，預設 title）
--}}
@php
    $bannerTitle = $title ?? '';
    $bannerCrumbs = $crumbs ?? [];
    $bannerImage = $image ?? null;
    $bannerAlt = $imageAlt ?? $bannerTitle;
    $bannerSubtitle = $subtitle ?? null;
    $hasImage = !empty($bannerImage);
    $hasSubtitle = !empty($bannerSubtitle);
    // 依序上升：麵包屑 → 標題 → 副標 → 形象圖
    $aosImageDelay = $hasSubtitle ? 300 : 200;
@endphp
<section id="page-banner" class="page-banner" aria-label="{{ $bannerTitle !== '' ? $bannerTitle : '頁面橫幅' }}">
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
            {{-- 麵包屑／標題／副標：以 banner 頂端為觸發點，進頁即顯示（勿等滾動） --}}
            <nav
                aria-label="麵包屑"
                class="inline-flex items-center overflow-hidden rounded-[20px] bg-white px-1.5 outline-inset outline-gray1"
                data-aos="fade-up"
                data-aos-anchor="#page-banner"
                data-aos-offset="0"
            >
                <a
                    href="/"
                    class="px-4 py-2 border-r border-gray1 text-eb3 text-gray3 transition-colors hover:text-main1"
                >WINDONE</a>
                @foreach ($bannerCrumbs as $crumb)
                    @php
                        $crumbName = $crumb['name'] ?? '';
                        $crumbLink = $crumb['link'] ?? null;
                        $isLast = $loop->last;
                    @endphp
                    @if ($crumbName === '')
                        @continue
                    @endif
                    @if (!$isLast && !empty($crumbLink))
                        <a
                            href="{{ $crumbLink }}"
                            class="px-4 py-2 border-r border-gray1 font-content text-[13px] text-gray3 tracking-wider transition-colors hover:text-main1"
                        >{{ $crumbName }}</a>
                    @else
                        <span class="px-4 py-2 font-content text-[13px] tracking-wider text-gray5{{ $isLast ? '' : ' border-r border-gray1' }}">{{ $crumbName }}</span>
                    @endif
                @endforeach
            </nav>

            <div class="w-full flex flex-col items-start gap-3">
                <h1
                    class="w-full text-eh1 uppercase text-gray5"
                    data-aos="fade-up"
                    data-aos-delay="100"
                    data-aos-anchor="#page-banner"
                    data-aos-offset="0"
                >{{ $bannerTitle }}</h1>
                @if ($hasSubtitle)
                    <p
                        class="w-full max-w-[600px] text-cb2 text-gray3"
                        data-aos="fade-up"
                        data-aos-delay="200"
                        data-aos-anchor="#page-banner"
                        data-aos-offset="0"
                    >{{ $bannerSubtitle }}</p>
                @endif
            </div>
        </div>
    </div>

    {{-- 形象圖：圓角裁切框＋視差（參考 TLC：圖比框高，捲動時在框內平移）
         不進 layout-grid；手機左右 24px，平板／桌機 48px --}}
    @if ($hasImage)
        <div
            class="page-banner-media w-full px-6 md:px-12 mt-10 md:mt-12 lg:mt-14 pb-10 md:pb-12 lg:pb-14"
            data-aos="fade-up"
            data-aos-delay="{{ $aosImageDelay }}"
            data-aos-anchor="#page-banner"
            data-aos-offset="0"
        >
            <div class="page-banner-media-frame">
                <div class="page-banner-media-parallax">
                    <img
                        src="{{ $bannerImage }}"
                        alt="{{ $bannerAlt }}"
                        class="page-banner-media-img"
                        width="1360"
                        height="510"
                        loading="eager"
                        decoding="async"
                    >
                </div>
            </div>
        </div>
    @endif
</section>

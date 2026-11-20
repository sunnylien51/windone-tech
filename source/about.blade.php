---
title: 關於我們
description: 關於我們
---
@extends('_layouts.main')

{{-- is-inner：讓 site-main clip 住 page-banner 底圖，不撐出 footer 外 --}}
{{-- 圖片走 config aboutPage；文案之後以 HTML 範本編輯器維護 --}}
@section('bodyClass', 'bg-bg is-inner')

@section('body')
    @php
        $aboutPage = $page->asArray($page->aboutPage ?? []);
        $aboutBanner = $page->asArray($aboutPage['banner'] ?? []);
    @endphp

    @include('_components.page-banner', [
        'title' => 'ABOUT',
        'crumbs' => [
            ['name' => '關於我們'],
        ],
        'subtitle' => $aboutBanner['subtitle'] ?? null,
        'image' => $aboutBanner['image'] ?? '/images/banner_about.jpg',
        'imageAlt' => '崴東科技',
    ])

    <div class="layout-grid flex-col pt-14 md:pt-16 lg:pt-20 pb-20 md:pb-24 lg:pb-28">
        {{-- ----------------------------------------------------------------------
             ★ SECTION · About intro - 關於我們引言
             ---------------------------------------------------------------------- --}}
        <section
            class="w-full flex flex-col items-start gap-10 md:gap-12 lg:gap-16"
            aria-label="關於我們引言"
            data-aos="fade-up"
        >
            <div class="w-full flex flex-col items-start gap-3">
                <span class="accent-bar" aria-hidden="true"></span>
                <h2 class="w-full text-ch3 text-gray5 whitespace-pre-line">深耕電子與 IC 載板產業<br>提供高精密製程解決方案</h2>
            </div>
            <div class="w-full flex justify-end">
                <p class="w-full max-w-[560px] text-cb2 text-gray3">崴東科技有限公司深耕電子產業相關領域，專注於IC載板產業之製程耗材、精密刀具與相關應用產品，致力於提供客戶專業、可靠且具競爭力的產品與技術服務。</br>

我們的核心業務涵蓋 IC 載板切割設備相關刀具、精密治具開發、承載框架、功能性膜材，以及表面奈米鍍膜處理等應用，並持續整合產業資源與專業技術，滿足客戶在製程生產、品質提升及效率優化上的多元需求。</p>
            </div>
        </section>

        {{-- ----------------------------------------------------------------------
             ★ SECTION · About values - 企業理念
             ---------------------------------------------------------------------- --}}
        <section
            class="w-full pt-14 md:pt-16 lg:pt-20 pb-20 md:pb-24 lg:pb-28 flex flex-col items-start gap-10 md:gap-12 lg:gap-14"
            aria-label="企業理念"
        >
            <div class="w-full flex flex-col items-start gap-3" data-aos="fade-up">
                <span class="accent-bar" aria-hidden="true"></span>
                <h2 class="w-full text-ch3 text-gray5">企業理念</h2>
            </div>

            <div
                class="w-full border-t border-b border-gray2/50 flex flex-col lg:flex-row items-stretch"
                data-aos="fade-up"
            >
                <article class="flex-1 px-6 md:px-8 lg:px-10 pt-10 md:pt-12 pb-12 md:pb-14 flex flex-col items-start gap-4">
                    <h3 class="text-ch5 text-gray5">創新突破</h3>
                    <p class="w-full text-cb2 text-gray3">秉持創新突破的精神，持續提升產品技術與製程應用。我們深入了解客戶需求，協助解決生產難題，創造更高的作業效率與競爭優勢。</p>
                </article>
                <article class="flex-1 px-6 md:px-8 lg:px-10 pt-10 md:pt-12 pb-12 md:pb-14 flex flex-col items-start gap-4 border-t lg:border-t-0 lg:border-l border-gray2/50">
                    <h3 class="text-ch5 text-gray5">專業服務</h3>
                    <p class="w-full text-cb2 text-gray3">真正的價值不僅在於提供產品，更在於專業服務與即時支援。以務實態度回應製程需求，讓客戶在面對產線挑戰時擁有穩健依靠。</p>
                </article>
                <article class="flex-1 px-6 md:px-8 lg:px-10 pt-10 md:pt-12 pb-12 md:pb-14 flex flex-col items-start gap-4 border-t lg:border-t-0 lg:border-l border-gray2/50">
                    <h3 class="text-ch5 text-gray5">永續經營</h3>
                    <p class="w-full text-cb2 text-gray3">以永續經營為核心，以專業技術為基礎、客戶需求為核心。透過持續精進品質與服務，攜手合作夥伴共同成長，共創產業新價值。</p>
                </article>
            </div>
        </section>

        {{-- ----------------------------------------------------------------------
             ★ SECTION · About profile - 公司簡介
             ---------------------------------------------------------------------- --}}
        <section
            class="w-full p-6 pb-10 md:p-10 lg:p-16 bg-white rounded-[40px] flex flex-col lg:flex-row items-stretch lg:items-center gap-10 md:gap-14 lg:gap-20"
            aria-label="公司簡介"
            data-aos="fade-up"
        >
            <img
                src="/images/brand.jpg"
                alt="崴東科技"
                class="w-full lg:w-[480px] lg:shrink-0 aspect-[480/670] object-cover rounded-[20px]"
                width="480"
                height="670"
                loading="lazy"
                decoding="async"
            >

            <div class="w-full flex-1 flex flex-col items-start gap-8 md:gap-10 min-w-0">
                <div class="w-full max-w-xs flex flex-col items-start gap-3">
                    <span class="accent-bar" aria-hidden="true"></span>
                    <h2 class="w-full text-ch3 text-gray5">公司簡介</h2>
                </div>

                <dl class="w-full border-t border-gray1 flex flex-col items-start">
                    <div class="w-full py-4 md:py-5 border-b border-gray1 flex flex-row items-start gap-4">
                        <dt class="w-20 sm:w-40 shrink-0 text-cb2 text-gray3">公司名稱</dt>
                        <dd class="flex-1 min-w-0 text-cb2 text-gray3">崴東科技有限公司</dd>
                    </div>
                    <div class="w-full py-4 md:py-5 border-b border-gray1 flex flex-row items-start gap-4">
                        <dt class="w-20 sm:w-40 shrink-0 text-cb2 text-gray3">成立年份</dt>
                        <dd class="flex-1 min-w-0 text-cb2 text-gray5">1995 年</dd>
                    </div>
                    <div class="w-full py-4 md:py-5 border-b border-gray1 flex flex-row items-start gap-4">
                        <dt class="w-20 sm:w-40 shrink-0 text-cb2 text-gray3">地址</dt>
                        <dd class="flex-1 min-w-0 text-cb2 text-gray5">桃園市蘆竹區大新路257號3樓</dd>
                    </div>
                    <div class="w-full py-4 md:py-5 border-b border-gray1 flex flex-row items-start gap-4">
                        <dt class="w-20 sm:w-40 shrink-0 text-cb2 text-gray3">電話</dt>
                        <dd class="flex-1 min-w-0 text-cb2 text-gray5">
                            <a href="tel:+88633235998" class="transition-colors hover:text-main1">03-3235998</a>
                        </dd>
                    </div>
                    <div class="w-full py-4 md:py-5 border-b border-gray1 flex flex-row items-start gap-4">
                        <dt class="w-20 sm:w-40 shrink-0 text-cb2 text-gray3">Email</dt>
                        <dd class="flex-1 min-w-0 text-cb2 text-gray3">sylvia@windone-tech.com</dd>
                    </div>
                    <div class="w-full py-4 md:py-5 border-b border-gray1 flex flex-row items-start gap-4">
                        <dt class="w-20 sm:w-40 shrink-0 text-cb2 text-gray3">營業項目</dt>
                        <dd class="flex-1 min-w-0 text-cb2 text-gray3">精密刀具、加工治具、膜（膠）捲類耗材、特殊鍍膜與清洗表面處理，以及委外代工切割。</dd>
                    </div>
                </dl>
            </div>
        </section>
    </div>
@endsection

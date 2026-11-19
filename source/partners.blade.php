---
title: 合作夥伴
description: 合作夥伴
---
@extends('_layouts.main')

{{-- is-inner：讓 site-main clip 住 page-banner 底圖，不撐出 footer 外 --}}
@section('bodyClass', 'bg-bg is-inner')

@section('body')
    @php
        $partnersPage = $page->asArray($page->partnersPage ?? []);
        $banner = $page->asArray($partnersPage['banner'] ?? []);
        $partnerLogos = $page->asArray($page->partnerLogos ?? []);
    @endphp

    @include('_components.page-banner', [
        'title' => $banner['title'] ?? 'PARTNERS',
        'crumbs' => $page->asArray($banner['crumbs'] ?? [['name' => '合作夥伴']]),
        'subtitle' => $banner['subtitle'] ?? null,
    ])

    <div class="layout-grid flex-col pt-14 md:pt-16 lg:pt-20 pb-20 md:pb-24 lg:pb-28 gap-14 md:gap-16 lg:gap-20">
        {{-- ----------------------------------------------------------------------
             ★ SECTION · Partners intro - 合作夥伴引言
             ---------------------------------------------------------------------- --}}
        @if (count($partnerLogos) > 0)
            {{-- ----------------------------------------------------------------------
                 ★ SECTION · Partners logos - 合作夥伴 logo
                 ---------------------------------------------------------------------- --}}
            <section
                id="partners-logos"
                class="w-full"
                aria-label="合作夥伴"
            >
                <ul class="partner-grid w-full" aria-label="合作夥伴名單" data-aos="fade-up">
                    @foreach ($partnerLogos as $logo)
                        @php
                            $logoImage = $logo['image'] ?? '';
                            $logoAlt = $logo['alt'] ?? ($logo['name'] ?? 'Partner');
                            $logoLink = $logo['link'] ?? '';
                        @endphp
                        <li>
                            @if ($logoLink !== '')
                                <a
                                    href="{{ $logoLink }}"
                                    class="partner-grid-item"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="前往{{ $logoAlt }}官方網站"
                                >
                                    <span class="partner-grid-logo">
                                        <img
                                            src="{{ $logoImage }}"
                                            alt=""
                                            width="200"
                                            height="80"
                                            loading="lazy"
                                            decoding="async"
                                        >
                                    </span>
                                </a>
                            @else
                                <div class="partner-grid-item">
                                    <div class="partner-grid-logo">
                                        <img
                                            src="{{ $logoImage }}"
                                            alt="{{ $logoAlt }}"
                                            width="200"
                                            height="80"
                                            loading="lazy"
                                            decoding="async"
                                        >
                                    </div>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif

        {{-- ----------------------------------------------------------------------
             ★ SECTION · Partners CTA - 洽詢合作（無後台，文案寫在 HTML）
             ---------------------------------------------------------------------- --}}
        <section
            class="w-full flex flex-col md:flex-row md:items-center md:justify-between gap-8 md:gap-12"
            aria-label="洽詢合作"
            data-aos="fade-up"
        >
            <div class="w-full md:max-w-xl flex flex-col items-start gap-3">
                <span class="accent-bar" aria-hidden="true"></span>
                <h2 class="w-full text-ch3 text-gray5">歡迎洽詢合作</h2>
                <p class="w-full text-cb2 text-gray3">無論是供應諮詢、客製開發或長期合作規劃，崴東團隊樂於與您深入討論。</p>
            </div>
            <a href="/contact/" class="btn-dark shrink-0">
                <span class="btn-dark-icon" aria-hidden="true">
                    <i data-lucide="arrow-right"></i>
                </span>
                <span class="text-cb2 text-white">聯絡我們</span>
            </a>
        </section>
    </div>
@endsection

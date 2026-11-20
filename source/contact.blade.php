---
title: 聯絡我們
description: 聯絡我們
---
@extends('_layouts.main')

{{-- is-inner：讓 site-main clip 住 page-banner 底圖，不撐出 footer 外 --}}
@section('bodyClass', 'bg-bg is-inner')

@section('body')
    @php
        $contactPage = $page->asArray($page->contactPage ?? []);
        $banner = $page->asArray($contactPage['banner'] ?? []);
        $contactInfo = $page->asArray($page->contactInfo ?? []);
        $address = $contactInfo['address'] ?? '';

        $contactRows = array_filter([
            !empty($contactInfo['tel']) ? [
                'icon' => 'phone',
                'label' => '電話',
                'text' => $contactInfo['tel'],
                'href' => 'tel:' . ($contactInfo['telHref'] ?? preg_replace('/\D+/', '', $contactInfo['tel'])),
                'latin' => true,
            ] : null,
            !empty($contactInfo['fax']) ? [
                'icon' => 'printer',
                'label' => '傳真',
                'text' => $contactInfo['fax'],
                'href' => null,
                'latin' => true,
            ] : null,
            !empty($contactInfo['email']) ? [
                'icon' => 'mail',
                'label' => 'Email',
                'text' => $contactInfo['email'],
                'href' => 'mailto:' . $contactInfo['email'],
                'latin' => true,
            ] : null,
            $address !== '' ? [
                'icon' => 'map-pin',
                'label' => '地址',
                'text' => $address,
                'href' => 'https://www.google.com/maps/search/?api=1&query=' . urlencode($address),
                'latin' => false,
            ] : null,
        ]);
    @endphp

    @include('_components.page-banner', [
        'title' => $banner['title'] ?? 'CONTACT',
        'crumbs' => $page->asArray($banner['crumbs'] ?? [['name' => '聯絡我們']]),
        'subtitle' => $banner['subtitle'] ?? null,
        'image' => $banner['image'] ?? null,
        'imageAlt' => '崴東科技公司門面',
    ])

    <div class="layout-grid flex-col gap-14 md:gap-16 lg:gap-20 pt-14 md:pt-16 lg:pt-20 pb-20 md:pb-24 lg:pb-28">
        {{-- ----------------------------------------------------------------------
             ★ SECTION · Contact - 聯絡資訊＋線上諮詢
             ---------------------------------------------------------------------- --}}
        <section
            id="contact"
            class="w-full flex flex-col lg:flex-row items-start gap-10 md:gap-12 lg:gap-20"
            aria-label="聯絡資訊與線上諮詢"
        >
            {{-- 左：公司聯絡資訊 --}}
            <div class="w-full lg:w-96 lg:shrink-0 flex flex-col items-start gap-8" data-aos="fade-up">
                <div class="w-full flex flex-col items-start gap-3">
                    <span class="accent-bar" aria-hidden="true"></span>
                    <h2 class="w-full text-ch3 text-gray5">{{ $contactPage['companyName'] ?? $page->siteName }}</h2>
                </div>

                <ul class="w-full flex flex-col">
                    @foreach ($contactRows as $row)
                        <li class="w-full flex items-center gap-4">
                            <i data-lucide="{{ $row['icon'] }}" class="w-[18px] h-[18px] shrink-0 text-gray5" aria-hidden="true"></i>
                            <span class="sr-only">{{ $row['label'] }}</span>
                            @if ($row['href'])
                                <a
                                    href="{{ $row['href'] }}"
                                    class="flex-1 min-w-0 py-4 border-b border-gray2/60 break-all transition-colors hover:text-main1 {{ $row['latin'] ? 'text-eb2' : 'text-cb2' }} text-gray3"
                                    @if (str_starts_with($row['href'], 'http')) target="_blank" rel="noopener" @endif
                                >{{ $row['text'] }}</a>
                            @else
                                <span class="flex-1 min-w-0 py-4 border-b border-gray2/60 {{ $row['latin'] ? 'text-eb2' : 'text-cb2' }} text-gray3">{{ $row['text'] }}</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- 右：線上諮詢表單（Netlify Forms；bot-field 為防機器人蜜罐） --}}
            <div
                class="w-full flex-1 min-w-0 px-6 py-10 md:p-10 lg:p-16 bg-white rounded-2xl md:rounded-[40px] flex flex-col items-start gap-8"
                data-aos="fade-up"
                data-aos-delay="100"
            >
                <div class="w-full flex flex-col items-start gap-3">
                    <span class="accent-bar" aria-hidden="true"></span>
                    <h2 class="w-full text-ch3 text-gray5">{{ $contactPage['formTitle'] ?? '線上諮詢' }}</h2>
                </div>

                <form
                    name="contact"
                    method="POST"
                    action="/contact/"
                    data-netlify="true"
                    netlify-honeypot="bot-field"
                    class="w-full flex flex-col items-start gap-8"
                >
                    <input type="hidden" name="form-name" value="contact">
                    <p class="hidden">
                        <label>請勿填寫：<input name="bot-field" tabindex="-1" autocomplete="off"></label>
                    </p>

                    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-4 md:gap-y-8">
                        <div class="form-field">
                            <label for="contact-name" class="form-label">姓名</label>
                            <input id="contact-name" name="name" type="text" class="form-control" placeholder="請輸入姓名" autocomplete="name" required>
                        </div>
                        <div class="form-field">
                            <label for="contact-company" class="form-label">公司名稱</label>
                            <input id="contact-company" name="company" type="text" class="form-control" placeholder="請輸入公司名稱" autocomplete="organization">
                        </div>
                        <div class="form-field">
                            <label for="contact-email" class="form-label">Email</label>
                            <input id="contact-email" name="email" type="email" class="form-control" placeholder="請輸入 Email" autocomplete="email" required>
                        </div>
                        <div class="form-field">
                            <label for="contact-phone" class="form-label">聯絡電話</label>
                            <input id="contact-phone" name="phone" type="tel" class="form-control" placeholder="請輸入聯絡電話" autocomplete="tel">
                        </div>
                    </div>

                    <div class="form-field">
                        <label for="contact-message" class="form-label">需求說明</label>
                        <textarea id="contact-message" name="message" class="form-control" placeholder="請描述您的需求" required></textarea>
                    </div>

                    <div class="w-full flex flex-col items-start gap-8">
                        <button type="submit" class="btn-dark w-full">
                            <span class="btn-dark-icon" aria-hidden="true">
                                <i data-lucide="arrow-right"></i>
                            </span>
                            <span class="text-eb2 text-white">SEND</span>
                        </button>
                        <p class="text-cb3 text-gray3">
                            採用 reCAPTCHA 保護機制
                            <a href="https://policies.google.com/privacy" target="_blank" rel="noopener" class="underline transition-colors hover:text-main1">隱私權</a>
                            /
                            <a href="https://policies.google.com/terms" target="_blank" rel="noopener" class="underline transition-colors hover:text-main1">條款</a>
                        </p>
                    </div>
                </form>
            </div>
        </section>

        {{-- ----------------------------------------------------------------------
             ★ SECTION · Map - Google 地圖
             ---------------------------------------------------------------------- --}}
        @if ($address !== '')
            <section
                id="contact-map"
                class="w-full h-72 md:h-96 overflow-hidden rounded-3xl md:rounded-[40px] bg-gray1"
                aria-label="公司位置地圖"
                data-aos="fade-up"
            >
                <iframe
                    src="https://www.google.com/maps?q={{ urlencode($address) }}&output=embed"
                    title="{{ $contactPage['companyName'] ?? $page->siteName }}位置：{{ $address }}"
                    class="w-full h-full border-0"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    allowfullscreen
                ></iframe>
            </section>
        @endif
    </div>
@endsection

@push('scripts')
{{-- 產品內頁「立即詢價」帶 ?product= 時預填需求說明 --}}
<script>
    (function () {
        try {
            var params = new URLSearchParams(window.location.search);
            var product = (params.get('product') || '').trim();
            if (!product) return;
            var field = document.getElementById('contact-message');
            if (!field || field.value) return;
            field.value = '想詢問產品：' + product;
        } catch (e) {}
    })();
</script>
@endpush

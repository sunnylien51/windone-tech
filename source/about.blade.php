---
title: 關於我們
description: 關於我們
---
@extends('_layouts.main')

{{-- is-inner：讓 site-main clip 住 page-banner 底圖，不撐出 footer 外 --}}
@section('bodyClass', 'bg-bg is-inner')

@section('body')
    @include('_components.page-banner', [
        'enTitle' => 'ABOUT',
        'zhTitle' => '關於我們',
        'subtitle' => '副標文案待客戶提供（暫定）',
        'image' => '/images/banner_about.jpg',
    ])

    {{-- ----------------------------------------------------------------------
         ★ SECTION · About content - 關於我們內文
         ---------------------------------------------------------------------- --}}
    <section class="layout-grid inner-page-padding">
        <div class="max-w-3xl flex flex-col gap-6" data-aos="fade-up">
            <p class="text-cb2 text-gray3">在此放入關於我們的內容。複製此頁作為其他內頁的起點，並依需求調整 page-banner 的標題與副標；需要形象大圖時傳入 image。</p>
        </div>
    </section>
@endsection

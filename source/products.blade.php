---
title: 產品介紹
description: 產品介紹
---
@extends('_layouts.main')

{{-- is-inner：讓 site-main clip 住 page-banner 底圖，不撐出 footer 外 --}}
@section('bodyClass', 'bg-bg is-inner')

@section('body')
    @include('_components.product-catalog', [
        'activeCategory' => 'all',
    ])
@endsection

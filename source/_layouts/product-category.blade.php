@extends('_layouts.main')

{{-- 分類分頁：檔名即分類 slug，輸出 /products/{slug}/ --}}
@section('bodyClass', 'bg-bg is-inner')

@section('body')
    @include('_components.product-catalog', [
        'activeCategory' => $page->getFilename(),
    ])
@endsection

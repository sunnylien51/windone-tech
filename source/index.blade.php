@extends('_layouts.main')

@section('body')
    <main class="layout-grid inner-page-padding gap-8 items-center text-center">
        <div data-aos="fade-up" data-aos-duration="1000" class="bg-dot text-main1 p-8 rounded">
            <h1 class="text-ch1 text-main1 mb-4">崴東科技</h1>
            <p class="text-eh1 text-main2 mb-4">WINDONE</p>
            <p class="text-cb2 text-gray3 mb-8">公司描述</p>

            <div class="flex gap-4 justify-center">
                <a href="/about/" class="btn-primary">
                    <span>Explore</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </main>
@endsection

<section class="relative overflow-x-clip bg-gray1">
    <div class="layout-grid h-60 md:h-80 pb-6 relative flex flex-col justify-end items-center gap-10">
        <div class="w-full flex flex-col justify-start items-start gap-1 relative z-10" data-aos="fade-up">
            @if (!empty($enTitle))
                <div class="text-main2 text-eb3 uppercase">{{ $enTitle }}</div>
            @endif
            <h1 class="text-main1 text-ch3 md:text-ch2">{{ $zhTitle }}</h1>
        </div>

        <div class="w-full flex justify-end items-center gap-2 relative z-10" data-aos="fade-up" data-aos-delay="100">
            <a href="/" class="text-main2 text-eb3 font-medium hover:underline">HOME</a>
            @if (!empty($crumbs))
                @foreach ($crumbs as $crumb)
                    <i data-lucide="chevron-right" class="w-4 h-4 text-main2"></i>
                    @if (!empty($crumb['link']))
                        <a href="{{ $crumb['link'] }}" class="text-main2 text-eb3 font-medium hover:underline">{{ $crumb['name'] }}</a>
                    @else
                        <span class="text-main1 text-eb3 font-medium">{{ $crumb['name'] }}</span>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</section>

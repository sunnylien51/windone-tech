@php
    $contactInfo = $page->asArray($page->contactInfo ?? []);
    $navItems = $page->asArray($page->navItems ?? []);
    $navColumns = array_chunk($navItems, 2);
@endphp

{{-- ----------------------------------------------------------------------
     ★ SECTION · Footer - 頁尾
     ---------------------------------------------------------------------- --}}
<footer class="site-footer w-full mt-auto">
    <div class="relative px-6 md:px-12 lg:px-20 pt-10 md:pt-20 pb-8 flex flex-col items-center gap-8">
        {{-- 主卡片：聯絡 CTA + ACCESS／MENU --}}
        <div class="w-full p-3 md:p-5 bg-white/80 rounded-[24px] md:rounded-[36px] shadow-[0px_0px_26px_0px_rgba(0,0,0,0.05)] flex flex-col lg:flex-row justify-start items-stretch gap-8 lg:gap-24 overflow-hidden">
            {{-- Get in Touch --}}
            <a
                href="/contact/"
                class="footer-touch relative w-full lg:w-[500px] h-56 md:h-72 shrink-0 bg-gray5 rounded-[20px] md:rounded-[24px] flex flex-col justify-between items-end overflow-hidden"
                aria-label="聯絡我們"
            >
                <img
                    src="/images/getintouch.jpg"
                    alt=""
                    class="absolute inset-0 w-full h-full object-cover pointer-events-none"
                    aria-hidden="true"
                >
                <span class="absolute inset-0 bg-gray5/50 pointer-events-none" aria-hidden="true"></span>

                <div class="relative z-10 self-stretch px-8 py-7 flex flex-col items-start">
                    <span class="text-eb3 text-white/90">CONTACT</span>
                    <span class="font-outfit text-[30px] font-medium leading-10 tracking-wide text-white">Get in Touch</span>
                </div>

                {{-- 右下角裝飾圖＋圓形按鈕 --}}
                <div class="relative z-10 w-20 h-20 shrink-0">
                    <img
                        src="/images/getintouch-rb.svg"
                        alt=""
                        width="80"
                        height="80"
                        class="absolute inset-0 w-full h-full pointer-events-none"
                        aria-hidden="true"
                    >
                    <span class="btn-icon-solid absolute bottom-0 right-0" aria-hidden="true">
                        <i data-lucide="arrow-up-right"></i>
                    </span>
                </div>
            </a>

            {{-- ACCESS + MENU --}}
            <div class="flex-1 self-stretch py-4 px-4 flex flex-col justify-between overflow-hidden">
                <div class="w-full flex flex-col md:flex-row justify-between items-start gap-10 md:gap-8 overflow-hidden">
                    <div class="w-full md:w-72 flex flex-col items-start gap-3">
                        <span class="text-eb3 text-gray2">ACCESS</span>
                        <div class="w-full flex flex-col items-start gap-1">
                            @if (!empty($contactInfo['address']))
                                <p class="text-cb2 text-gray3">{{ $contactInfo['address'] }}</p>
                            @endif
                            @if (!empty($contactInfo['tel']))
                                <a
                                    href="tel:{{ $contactInfo['telHref'] ?? preg_replace('/\D+/', '', $contactInfo['tel']) }}"
                                    class="footer-link"
                                >電話｜{{ $contactInfo['tel'] }}</a>
                            @endif
                            @if (!empty($contactInfo['email']))
                                <a href="mailto:{{ $contactInfo['email'] }}" class="footer-link">Email｜{{ $contactInfo['email'] }}</a>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-start gap-10 md:gap-8">
                        @foreach ($navColumns as $column)
                            <div class="w-28 flex flex-col items-start gap-3">
                                @if ($loop->first)
                                    <span class="text-eb3 text-gray2">MENU</span>
                                @else
                                    <span class="text-eb3 text-transparent select-none" aria-hidden="true">MENU</span>
                                @endif
                                <div class="w-full flex flex-col items-start gap-1">
                                    @foreach ($column as $item)
                                        <a href="{{ $item['path'] }}/" class="footer-link">{{ $item['label'] }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- 版權列 --}}
        <div class="w-full flex flex-wrap justify-center items-center gap-4">
            <span class="text-eb3 text-gray3">© {{ date('Y') }} WIN DONE TECH</span>
            <div class="flex items-start gap-1">
                <a href="/privacy/" class="text-eb3 text-gray3 hover:text-main2 transition-colors">隱私權聲明</a>
                <span class="text-eb3 text-gray3" aria-hidden="true">｜</span>
                <a href="/terms/" class="text-eb3 text-gray3 hover:text-main2 transition-colors">服務條款</a>
            </div>
        </div>

        {{-- 回到頂部：右側邊距正中 --}}
        <button
            type="button"
            id="back-to-top"
            class="footer-back-top"
            aria-label="回到頂部"
        >
            <i data-lucide="chevron-up" class="w-4 h-4"></i>
            <span class="w-px h-8 bg-current" aria-hidden="true"></span>
            <span class="text-cb3 leading-4 text-center">回<br>到<br>頂<br>部</span>
        </button>
    </div>
</footer>

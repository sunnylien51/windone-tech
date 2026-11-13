<footer class="w-full relative mt-auto">
    <div class="w-full bg-white rounded-t-[40px] lg:rounded-t-[72px] shadow-[0px_-16px_48px_0px_rgba(14,26,43,0.06)]">
        <div class="layout-grid pt-16 lg:pt-20 pb-10 flex flex-col gap-12 lg:gap-16">
            <div class="w-full flex flex-col lg:flex-row justify-between items-start gap-8">
                <div class="flex flex-col gap-3">
                    <a href="/" class="inline-flex">
                        <img src="/images/logo.svg" alt="{{ $page->siteName }}" class="h-8 w-auto">
                    </a>
                    <p class="text-cb2 text-gray3 max-w-md">{{ $page->siteDescription }}</p>
                </div>

                <div class="flex items-center gap-4">
                    <a href="#" class="w-10 h-10 rounded-full border border-gray1 flex items-center justify-center text-main1 hover:bg-main1 hover:text-white transition-colors" aria-label="Facebook">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full border border-gray1 flex items-center justify-center text-main1 hover:bg-main1 hover:text-white transition-colors" aria-label="Instagram">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full border border-gray1 flex items-center justify-center text-main1 hover:bg-main1 hover:text-white transition-colors" aria-label="YouTube">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/></svg>
                    </a>
                </div>
            </div>

            <div class="w-full flex flex-col lg:flex-row justify-between items-start gap-12 lg:gap-16">
                <div class="w-full lg:w-auto grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5 lg:min-w-[420px]">
                    <div class="flex flex-col items-start gap-1">
                        <span class="text-gray3 text-eb3 uppercase">電話</span>
                        <a href="tel:0212345678" class="text-main1 text-cb2 hover:text-main2 transition-colors">02-1234-5678</a>
                    </div>
                    <div class="flex flex-col items-start gap-1">
                        <span class="text-gray3 text-eb3 uppercase">信箱</span>
                        <a href="mailto:info@example.com" class="text-main1 text-cb2 hover:text-main2 transition-colors">info@example.com</a>
                    </div>
                    <div class="flex flex-col items-start gap-1 md:col-span-2">
                        <span class="text-gray3 text-eb3 uppercase">地址</span>
                        <span class="text-main1 text-cb2">台北市示例區示例路 1 號</span>
                    </div>
                </div>

                <div class="hidden lg:block w-px self-stretch bg-gray1"></div>

                <div class="flex-1 w-full max-w-[640px] grid grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 items-start">
                    <div class="flex flex-col items-start gap-3">
                        <a href="/about/" class="text-main1 text-cb2 hover:text-main2 transition-colors">公司簡介</a>
                        <a href="/products/" class="text-main1 text-cb2 hover:text-main2 transition-colors">產品介紹</a>
                    </div>
                    <div class="flex flex-col items-start gap-3">
                        <a href="/partners/" class="text-main1 text-cb2 hover:text-main2 transition-colors">合作夥伴</a>
                        <a href="/contact/" class="text-main1 text-cb2 hover:text-main2 transition-colors">聯絡我們</a>
                    </div>
                    <div class="flex flex-col items-start gap-1">
                        <span class="text-main1 text-cb2 mb-1">條款</span>
                        <a href="/privacy/" class="text-gray3 text-cb2 hover:text-main2 transition-colors">隱私權聲明</a>
                        <a href="/terms/" class="text-gray3 text-cb2 hover:text-main2 transition-colors">使用者條款</a>
                    </div>
                </div>
            </div>

            <div class="w-full pt-4 text-gray3 text-cb3">
                <div>© {{ date('Y') }} {{ $page->siteName }}. Designed by <a href="https://ppnet.tw/" target="_blank" rel="noopener noreferrer" class="hover:text-main1 transition-colors underline">PPNET</a></div>
            </div>
        </div>
    </div>
</footer>

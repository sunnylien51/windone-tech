@php
    $navItems = [
        ['label' => '公司簡介', 'path' => '/about'],
        ['label' => '產品介紹', 'path' => '/products'],
        ['label' => '合作夥伴', 'path' => '/partners'],
        ['label' => '聯絡我們', 'path' => '/contact'],
    ];
    $langs = [
        ['code' => 'zh-Hant', 'label' => '繁體中文'],
        ['code' => 'en', 'label' => 'English'],
        ['code' => 'ja', 'label' => '日本語'],
        ['code' => 'zh-Hans', 'label' => '简体中文'],
    ];
    $currentLang = $langs[0];
@endphp

<header id="main-header" class="w-full absolute top-0 left-0 z-[100] bg-transparent">
    <nav id="main-nav" class="layout-grid py-6 md:py-8 justify-between items-center relative" aria-label="主選單">
        <a href="/" class="relative z-50 shrink-0 flex items-center">
            <img src="/images/logo.svg" alt="{{ $page->siteName }}" class="h-8 md:h-9 w-auto">
        </a>

        {{-- Desktop pill cluster --}}
        <div class="nav-pill hidden lg:flex items-center gap-3 p-2 bg-white/70 rounded-[50px] outline outline-1 outline-offset-[-1px] outline-gray1/80 backdrop-blur-lg">
            <a
                href="/"
                class="nav-home-btn size-10 shrink-0 bg-white/70 rounded-[20px] outline outline-1 outline-offset-[-1px] outline-gray2 flex justify-center items-center text-gray5 transition-colors hover:bg-white"
                aria-label="回首頁"
            >
                <i data-lucide="home" class="w-4 h-4"></i>
            </a>

            {{-- TLC 式滑動深色 pill hover：tracker 跟滑鼠移動 --}}
            <ul id="nav-track-list" class="nav-track-list relative flex items-center gap-0.5">
                <span class="nav-tracker" aria-hidden="true"></span>
                @foreach ($navItems as $item)
                    <li class="relative z-10">
                        <a
                            href="{{ $item['path'] }}/"
                            class="nav-item text-cb2 text-gray5 h-10 px-4 rounded-full inline-flex items-center justify-center {{ $page->isActive($item['path']) }}"
                        >{{ $item['label'] }}</a>
                    </li>
                @endforeach
            </ul>

            <div class="relative shrink-0" id="lang-switch">
                <button
                    type="button"
                    id="lang-btn"
                    class="nav-lang h-10 w-[130px] pl-2 pr-3 py-2 bg-white/70 rounded-[20px] outline outline-1 outline-offset-[-0.5px] outline-gray2 inline-flex items-center justify-start gap-2 text-gray5 cursor-pointer transition-colors hover:bg-white"
                    aria-expanded="false"
                    aria-haspopup="listbox"
                    aria-controls="lang-menu"
                >
                    <i data-lucide="globe" class="w-5 h-5 shrink-0"></i>
                    <span id="lang-label" class="text-eb3 whitespace-nowrap truncate min-w-0">{{ $currentLang['label'] }}</span>
                    <i data-lucide="chevron-down" class="lang-chevron w-3.5 h-3.5 shrink-0 ml-auto"></i>
                </button>
                <ul
                    id="lang-menu"
                    class="lang-menu absolute left-1/2 top-[calc(100%+0.75rem)] z-50 w-full flex-col gap-1 overflow-hidden rounded-[20px] outline outline-1 outline-offset-[-1px] outline-gray1/80 bg-white/80 backdrop-blur-lg p-1.5 shadow-[0_8px_24px_rgba(14,26,43,0.08)]"
                    role="listbox"
                    aria-label="語言"
                >
                    @foreach ($langs as $lang)
                        <li>
                            <button
                                type="button"
                                class="lang-option text-eb3 relative z-0 flex w-full cursor-pointer items-center justify-center rounded-[12px] px-3 py-2 text-gray5 whitespace-nowrap {{ $lang['code'] === $currentLang['code'] ? 'is-active' : '' }}"
                                role="option"
                                aria-selected="{{ $lang['code'] === $currentLang['code'] ? 'true' : 'false' }}"
                                data-lang="{{ $lang['code'] }}"
                                data-label="{{ $lang['label'] }}"
                            >{{ $lang['label'] }}</button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Mobile toggle --}}
        <button
            type="button"
            id="mobile-menu-btn"
            class="lg:hidden relative z-50 size-10 flex items-center justify-center rounded-[20px] bg-white/70 outline outline-1 outline-offset-[-1px] outline-gray1/80 backdrop-blur-lg text-gray5 cursor-pointer"
            aria-label="開啟選單"
            aria-expanded="false"
            aria-controls="nav-menu"
        >
            <i data-lucide="menu" id="mobile-menu-icon" class="w-5 h-5"></i>
        </button>

        {{-- Mobile panel --}}
        <div
            id="nav-menu"
            class="fixed lg:hidden top-0 right-0 max-w-full w-full sm:w-[320px] h-screen max-h-[100dvh] bg-white shadow-2xl p-6 pt-24 pb-12 flex flex-col gap-6 translate-x-full transition-transform duration-300 ease-in-out z-40 overflow-y-auto"
        >
            <ul class="flex flex-col gap-1 w-full">
                @foreach ($navItems as $item)
                    <li>
                        <a
                            href="{{ $item['path'] }}/"
                            class="nav-item-mobile text-cb2 text-gray5 flex w-full items-center rounded-[16px] px-4 py-3 transition-colors hover:bg-bg {{ $page->isActive($item['path']) }}"
                        >{{ $item['label'] }}</a>
                    </li>
                @endforeach
            </ul>

            <div class="flex items-center gap-2 pt-2 border-t border-gray1">
                <a
                    href="/"
                    class="nav-home-btn size-10 shrink-0 rounded-[20px] border border-gray2 flex justify-center items-center text-gray5"
                    aria-label="回首頁"
                >
                    <i data-lucide="home" class="w-4 h-4"></i>
                </a>
                <div class="flex flex-col gap-1 ml-auto w-full max-w-[11rem]">
                    @foreach ($langs as $lang)
                        <button
                            type="button"
                            class="lang-option text-eb3 rounded-[12px] px-3 py-2 text-gray5 cursor-pointer text-left whitespace-nowrap {{ $lang['code'] === $currentLang['code'] ? 'is-active' : '' }}"
                            data-lang="{{ $lang['code'] }}"
                            data-label="{{ $lang['label'] }}"
                        >{{ $lang['label'] }}</button>
                    @endforeach
                </div>
            </div>
        </div>

        <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/40 hidden z-30 lg:hidden"></div>
    </nav>
</header>

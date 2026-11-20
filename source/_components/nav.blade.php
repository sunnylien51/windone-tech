@php
    $navItems = $page->navItems;
    $langs = [
        ['code' => 'zh-Hant', 'label' => '繁體中文'],
        ['code' => 'en', 'label' => 'English'],
        ['code' => 'ja', 'label' => '日本語'],
        ['code' => 'zh-Hans', 'label' => '简体中文'],
    ];
    $currentLang = $langs[0];
@endphp

{{-- ----------------------------------------------------------------------
     ★ SECTION · Nav - 主選單
     ---------------------------------------------------------------------- --}}
<header id="main-header" class="w-full fixed top-0 left-0 z-[100] bg-transparent">
    {{-- 不用 layout-grid；手機左右 24px，平板／桌機 48px --}}
    <nav id="main-nav" class="flex w-full px-6 md:px-12 py-6 justify-between items-center relative" aria-label="主選單">
        <a href="/" class="relative z-50 shrink-0 flex items-center">
            <img src="/images/logo.svg" alt="{{ $page->siteName }}" class="h-8 md:h-9 w-auto">
        </a>

        {{-- Desktop pill cluster --}}
        <div class="nav-pill hidden lg:flex items-center gap-3 p-2 bg-white/65 rounded-full backdrop-blur-lg">
            <a
                href="/"
                class="nav-home-btn size-10 shrink-0 bg-white/70 rounded-full outline-inset outline-gray1 flex justify-center items-center text-gray5 transition-colors hover:bg-white"
                aria-label="回首頁"
            >
                <i data-lucide="home" class="w-4 h-4"></i>
            </a>

            {{-- TLC 式滑動 pill hover：tracker 跟滑鼠移動 --}}
            <ul id="nav-track-list" class="nav-track-list relative flex items-center gap-0.5">
                <span class="nav-tracker" aria-hidden="true"></span>
                @foreach ($navItems as $item)
                    @php
                        $itemLabels = $item['labels'] ?? ['zh-Hant' => $item['label']];
                    @endphp
                    <li class="relative z-10">
                        <a
                            href="{{ $item['path'] }}/"
                            class="nav-item text-cb2 text-gray5 h-10 px-4 rounded-full inline-flex items-center justify-center {{ $page->isActive($item['path']) }}"
                            data-i18n-nav
                            data-labels="{{ json_encode($itemLabels, JSON_UNESCAPED_UNICODE) }}"
                        >{{ $itemLabels[$currentLang['code']] ?? $item['label'] }}</a>
                    </li>
                @endforeach
            </ul>

            <div class="relative shrink-0" id="lang-switch">
                <button
                    type="button"
                    id="lang-btn"
                    class="nav-lang h-10 w-[130px] pl-2 pr-3 py-2 bg-white/70 rounded-full outline-inset outline-gray1 inline-flex items-center justify-start gap-2 text-gray5 cursor-pointer transition-colors hover:bg-white"
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
                    class="lang-menu absolute left-1/2 top-[calc(100%+0.75rem)] z-50 w-full flex-col gap-1 overflow-hidden rounded-[20px] bg-white/50 backdrop-blur-lg p-1.5 shadow-[0_8px_24px_theme(colors.gray5/5%)]"
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
            class="lg:hidden relative z-50 size-10 flex items-center justify-center rounded-full bg-white/70 outline-inset outline-gray1/80 backdrop-blur-lg text-gray5 cursor-pointer"
            aria-label="開啟選單"
            aria-expanded="false"
            aria-controls="nav-menu"
        >
            <i data-lucide="menu" id="mobile-menu-icon" class="w-5 h-5"></i>
        </button>

        {{-- Mobile panel --}}
        <div
            id="nav-menu"
            class="fixed lg:hidden top-0 right-0 max-w-full w-full md:w-[320px] h-screen max-h-[100dvh] bg-white/75 backdrop-blur-[20px] shadow-2xl p-6 pt-24 pb-12 flex flex-col gap-6 translate-x-full opacity-0 transition-[transform,opacity] duration-500 ease-in-out z-40 overflow-y-auto"
        >
            <ul class="flex flex-col gap-1 w-full">
                @foreach ($navItems as $item)
                    @php
                        $itemLabels = $item['labels'] ?? ['zh-Hant' => $item['label']];
                    @endphp
                    <li>
                        <a
                            href="{{ $item['path'] }}/"
                            class="nav-item-mobile text-cb2 text-gray5 flex w-full items-center rounded-[16px] px-4 py-3 transition-colors duration-300 hover:bg-bg/80 {{ $page->isActive($item['path']) }}"
                            data-i18n-nav
                            data-labels="{{ json_encode($itemLabels, JSON_UNESCAPED_UNICODE) }}"
                        >{{ $itemLabels[$currentLang['code']] ?? $item['label'] }}</a>
                    </li>
                @endforeach
            </ul>

            <div class="flex flex-wrap items-center gap-1 pt-4 border-t border-white/40 w-full" role="listbox" aria-label="語言">
                @foreach ($langs as $lang)
                    <button
                        type="button"
                        class="lang-option text-eb3 relative z-0 rounded-[12px] px-3 py-2 text-gray5 cursor-pointer whitespace-nowrap {{ $lang['code'] === $currentLang['code'] ? 'is-active' : '' }}"
                        role="option"
                        aria-selected="{{ $lang['code'] === $currentLang['code'] ? 'true' : 'false' }}"
                        data-lang="{{ $lang['code'] }}"
                        data-label="{{ $lang['label'] }}"
                    >{{ $lang['label'] }}</button>
                @endforeach
            </div>
        </div>

        <div id="mobile-menu-overlay" class="fixed inset-0 bg-gray5/40 hidden z-30 lg:hidden"></div>
    </nav>
</header>

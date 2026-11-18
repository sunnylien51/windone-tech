<!DOCTYPE html>
<html lang="{{ $page->language ?? 'zh-Hant' }}">
<head>
    @include('_components.head')
    @stack('head')
</head>
<body class="@yield('bodyClass', 'bg-bg') text-gray5 font-sans antialiased selection:bg-main2 selection:text-white flex flex-col min-h-screen overflow-x-hidden">
    @include('_components.nav')

    {{-- 內頁（body.is-inner）會 clip，避免 page-banner 底圖撐出 footer 下方空白 --}}
    <div class="site-main flex-grow">
        @yield('body')
    </div>

    @include('_components.footer')

    @stack('scripts')
</body>
</html>

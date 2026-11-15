<?php

return [
    'production' => false,
    // 站掛在網域根目錄，連結一律寫根路徑（/about/），不要用 baseUrl；此欄位留空即可
    'baseUrl' => '',
    // 正式網址（無結尾斜線），用於 canonical／og:url／og:image；上線前在 config.production.php 覆寫
    'siteUrl' => '',
    // og:image 預設 /images/og.jpg（建議 1200x630），可在單頁 front matter 用 ogImage 覆寫
    'siteName' => '崴東科技',
    'siteDescription' => '公司描述',
    'language' => 'zh-Hant',
    'collections' => [],

    /*
    |--------------------------------------------------------------------------
    | 功能開關（決定 head 是否載入對應 CDN）
    |--------------------------------------------------------------------------
    | 沒用到的套件改 false。本站 Hero 用 Swiper；Fancybox 尚未使用故關閉。
    */
    'features' => [
        'lenis' => true,
        'swiper' => true,
        'fancybox' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | 聯絡資訊（頁尾／聯絡頁共用）
    |--------------------------------------------------------------------------
    */
    'contactInfo' => [
        'tel' => '02-1234-5678',
        'telHref' => '0212345678',
        'email' => 'info@example.com',
        'address' => '台北市示例區示例路 1 號',
    ],

    /*
    |--------------------------------------------------------------------------
    | 社群連結（頁尾）
    |--------------------------------------------------------------------------
    | icon：facebook / instagram / youtube（footer 內建 SVG）
    | url 留空時該顆不輸出；開發中可用 '#' 當佔位仍會顯示
    */
    'socialLinks' => [
        ['label' => 'Facebook', 'url' => '#', 'icon' => 'facebook'],
        ['label' => 'Instagram', 'url' => '#', 'icon' => 'instagram'],
        ['label' => 'YouTube', 'url' => '#', 'icon' => 'youtube'],
    ],

    'heroSlides' => [
        [
            'image' => '/images/main_product1.webp',
            'title' => '高精密切割刀具',
            'body' => '涵蓋鑽石燒結刀與奈米鍍膜切膜刀，適用於載板、玻璃、陶瓷與乾/濕膜製程，大幅提升良率與切削壽命。',
            'link' => '/products/',
        ],
        [
            'image' => '/images/main_product2.webp',
            'title' => '鑽石燒結刀具',
            'body' => '針對高硬度材料與精密製程優化，穩定切削表現，延長刀具壽命並維持加工精度。',
            'link' => '/products/',
        ],
        [
            'image' => '/images/main_product3.webp',
            'title' => '奈米鍍膜切膜刀',
            'body' => '高硬度、耐磨與耐酸性佳，適用乾／濕膜與多種基材，協助產線提升良率與效率。',
            'link' => '/products/',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 首頁產品 slider（hero 下方，與 hero 共用 bg_main）
    |--------------------------------------------------------------------------
    */
    'productCards' => [
        [
            'category' => '刀具類',
            'title' => '奈米鍍膜切膜刀',
            'body' => '結合超硬基底與先進的奈米複合鍍膜技術，大幅降低切削阻力與摩擦係數，有效解決生產過程中常見的毛邊、殘膠與刀刃磨損問題，為產線帶來極致的耐用度與高精度切削表現。',
            'image' => '/images/product1.webp',
            'link' => '/products/',
        ],
        [
            'category' => '刀具類',
            'title' => '鑽石燒結刀具',
            'body' => '針對高硬度材料與精密製程優化，穩定切削表現，延長刀具壽命並維持加工精度，適用載板、玻璃與陶瓷等製程需求。',
            'image' => '/images/product2.webp',
            'link' => '/products/',
        ],
        [
            'category' => '刀具類',
            'title' => '高精密切割刀具',
            'body' => '涵蓋多種精密刀具規格，協助產線提升良率與切削壽命，兼顧耐用度與穩定的加工品質。',
            'image' => '/images/product3.webp',
            'link' => '/products/',
        ],
        [
            'category' => '刀具類',
            'title' => '精密加工刀具',
            'body' => '以穩定切削與長壽命為設計核心，因應多元基材與產線條件，維持高精度與一致性表現。',
            'image' => '/images/product4.webp',
            'link' => '/products/',
        ],
        [
            'category' => '刀具類',
            'title' => '耐磨切膜刀',
            'body' => '強化耐磨與抗沾黏特性，降低換刀頻率與停機時間，讓產線維持連續且穩定的產出效率。',
            'image' => '/images/product1.webp',
            'link' => '/products/',
        ],
        [
            'category' => '刀具類',
            'title' => '複合鍍膜刀具',
            'body' => '以複合鍍膜提升刃口保護與切削順暢度，減少毛邊與殘膠，協助製程品質更加穩定可控。',
            'image' => '/images/product2.webp',
            'link' => '/products/',
        ],
    ],
    'navItems' => [
        ['label' => '關於我們', 'path' => '/about'],
        ['label' => '產品介紹', 'path' => '/products'],
        ['label' => '合作夥伴', 'path' => '/partners'],
        ['label' => '聯絡我們', 'path' => '/contact'],
    ],
    'isActive' => function ($page, $path) {
        $current = trim($page->getPath(), '/');
        $target = trim($path, '/');

        if ($target === '') {
            return $current === '' ? 'active' : '';
        }

        return ($current === $target || str_starts_with($current . '/', $target . '/'))
            ? 'active'
            : '';
    },

    // Jigsaw 設定常為 IterableObject；丟進 foreach／empty 前先轉純陣列
    'asArray' => function ($page, $value) {
        if (is_null($value)) {
            return [];
        }

        if (is_object($value) && method_exists($value, 'toArray')) {
            $value = $value->toArray();
        }

        return is_array($value) ? $value : (array) $value;
    },
];

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
        'tel' => '03-3235998',
        'telHref' => '033235998',
        'email' => 'sylvia@windone-tech.com',
        'address' => '桃園市蘆竹區大新路257號3樓',
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

    /*
    |--------------------------------------------------------------------------
    | 首頁企業理念 sticky 疊卡
    |--------------------------------------------------------------------------
    */
    'valueCards' => [
        [
            'num' => '01',
            'title' => '誠信正直',
            'body' => '誠信是崴東科技經營企業最重要的核心價值。我們秉持誠實、透明、負責的態度面對每一位客戶、合作夥伴與員工，遵守商業道德與承諾，建立長期互信的合作關係。我們相信，唯有以誠信為本，才能創造企業永續發展的基石。',
            'image' => '/images/concept1.jpg',
        ],
        [
            'num' => '02',
            'title' => '專業、效率、創新',
            'body' => '我們持續精進專業技術與服務能力，深入了解客戶需求，提供最適切的產品與解決方案。同時，透過高效率的作業流程、快速的服務反應，以及不斷追求技術創新與產品升級，協助客戶提升競爭力，創造更高的市場價值。',
            'image' => '/images/concept2.jpg',
        ],
        [
            'num' => '03',
            'title' => '客戶信任',
            'body' => '客戶的信任是崴東科技持續成長的重要動力。我們始終以客戶需求為中心，提供高品質產品、穩定交期及完善的售前、售中與售後服務，成為客戶值得信賴的長期合作夥伴。我們期望透過持續的品質提升與服務精進，與客戶共同成長、共創雙贏。',
            'image' => '/images/concept3.jpg',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 首頁數據區（bg_data 底圖；W／D／T 寫死在 HTML）
    |--------------------------------------------------------------------------
    | 後台只編：enTitle、body、stats（兩欄各若干 label／value）
    */
    'dataPanel' => [
        'enTitle' => 'Precision in Every Cut',
        // 單一文字欄（後台 textarea）；換行即斷行
        'body' => "深耕高精密刀具與半導體載板製程多年，\n以嚴格品管與快速響應的備料機制，\n成為各大高科技大廠長期信賴的製程夥伴。",
        // [0]＝中欄 D、[1]＝右欄 T
        'stats' => [
            [
                ['label' => '創立年份', 'value' => '1995'],
                ['label' => '合作廠商數', 'value' => '10+'],
            ],
            [
                ['label' => '專業產品線', 'value' => '14+'],
                ['label' => '客戶平均備料支援', 'value' => '2 month'],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 首頁關於我們（左文右圖）
    |--------------------------------------------------------------------------
    */
    'aboutPanel' => [
        'enTitle' => 'About',
        'headline' => "為 PCB 廠及半導體封測廠\n提供高精度的製程支援",
        'body' => '崴東科技（崴東科技有限公司）是一家成立於1995年、總部位於桃園市蘆竹區的精密耗材與治具供應商。該公司深耕於電子半導體製程週邊耗材領域，致力於為PCB（印刷電路板）廠及半導體封測廠提供高精度的製程支援。',
        'link' => '/about/',
        'image' => '/images/about_index.jpg',
        'badgeEn' => 'Since 1995 ・ Taoyuan, Taiwan',
        'badgeZh' => '桃園蘆竹總部',
    ],

    /*
    |--------------------------------------------------------------------------
    | 首頁合作夥伴 logo
    |--------------------------------------------------------------------------
    */
    'partnerLogos' => [
        ['image' => '/images/partner1.png', 'alt' => 'Partner'],
        ['image' => '/images/partner2.png', 'alt' => 'Partner'],
        ['image' => '/images/partner3.png', 'alt' => 'Partner'],
        ['image' => '/images/partner4.png', 'alt' => 'Partner'],
        ['image' => '/images/partner5.png', 'alt' => 'Partner'],
        ['image' => '/images/partner6.png', 'alt' => 'Partner'],
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

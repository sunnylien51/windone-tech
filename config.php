<?php

return [
    'production' => false,
    'baseUrl' => '',
    'siteName' => '崴東科技',
    'siteDescription' => '公司描述',
    'description' => '公司描述',
    'language' => 'zh-Hant',
    'collections' => [],
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
];

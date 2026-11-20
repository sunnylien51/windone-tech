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
    /*
    |--------------------------------------------------------------------------
    | 產品內頁 collection（檔案由 bootstrap beforeBuild 依 productsPage 同步）
    | 輸出：/products/{slug}/
    |--------------------------------------------------------------------------
    */
    'collections' => [
        'products' => [
            'path' => 'products/{filename}',
        ],
    ],

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
        'fax' => '03-3753801',
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
            'body' => '包含鑽石切割刀與奈米鍍膜切膜刀，適用於載板切割及乾／濕膜製程。具備高硬度、低摩擦與穩定切削表現，協助提升良率並支援客製備料。',
            'link' => '/products/nano-coated-cutter/',
        ],
        [
            'image' => '/images/main_product2.webp',
            'title' => '加工治具',
            'body' => '涵蓋切割機治具組、彈匣框架、迴焊／清洗治具與 Holding Tray 等。可依需求客製並強化抗熱變形與定位穩定，提升加工與檢測效率。',
            'link' => '/products/cutting-machine-jig/',
        ],
        [
            'image' => '/images/main_product3.webp',
            'title' => '膜(膠)捲類',
            'body' => '提供抗靜電多孔透氣膜、免刀式除塵紙捲與抗靜電黏塵滾輪。適用於真空吸附與無塵室清潔控管，兼具抗靜電、低殘膠與尺寸客製。',
            'link' => '/products/antistatic-porous-film/',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 首頁產品 slider（hero 下方，與 hero 共用 bg_main）
    |--------------------------------------------------------------------------
    */
    'productCards' => [
        [
            'category' => '精密刀具',
            'title' => '奈米鍍膜切膜刀',
            'body' => '結合超硬基底與先進的奈米複合鍍膜技術，大幅降低切削阻力與摩擦係數，有效解決生產過程中常見的毛邊、殘膠與刀刃磨損問題，為產線帶來極致的耐用度與高精度切削表現。',
            'image' => '/images/product1.webp',
            'link' => '/products/nano-coated-cutter/',
        ],
        [
            'category' => '精密刀具',
            'title' => '鑽石切割刀',
            'body' => '針對高硬度材料與精密製程優化，穩定切削表現，延長刀具壽命並維持加工精度，適用載板、玻璃與陶瓷等製程需求。',
            'image' => '/images/product2.webp',
            'link' => '/products/diamond-cutter/',
        ],
        [
            'category' => '加工治具',
            'title' => '切割機治具組',
            'body' => '對應各式切割機台的定位與夾持需求，提升換線效率與加工穩定度，協助產線維持高精度與一致性表現。',
            'image' => '/images/product3.webp',
            'link' => '/products/cutting-machine-jig/',
        ],
        [
            'category' => '加工治具',
            'title' => '磁性迴焊治具',
            'body' => '磁性固定設計協助 SMT 迴焊製程穩固載板，減少位移與翹曲風險，讓產線維持連續且穩定的產出效率。',
            'image' => '/images/product4.webp',
            'link' => '/products/magnetic-reflow-jig/',
        ],
        [
            'category' => '膜(膠)捲類',
            'title' => '抗靜電多孔透氣膜',
            'body' => '兼具抗靜電與透氣特性，適用需平衡防護與排氣的製程包裝場景，協助製程品質更加穩定可控。',
            'image' => '/images/product1.webp',
            'link' => '/products/antistatic-porous-film/',
        ],
        [
            'category' => '膜(膠)捲類',
            'title' => '免刀式除塵紙捲',
            'body' => '免刀具撕取設計，快速清除表面微塵，降低換捲與作業中斷時間，維持潔淨室作業節奏。',
            'image' => '/images/product2.webp',
            'link' => '/products/dust-free-paper-roll/',
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
            'title' => '創新突破',
            'body' => '秉持創新突破的精神，持續提升產品技術與製程應用。我們深入了解客戶需求，協助解決生產難題，創造更高的作業效率與競爭優勢。',
            'image' => '/images/concept1.jpg',
        ],
        [
            'num' => '02',
            'title' => '專業服務',
            'body' => '真正的價值不僅在於提供產品，更在於專業服務與即時支援。以務實態度回應製程需求，讓客戶在面對產線挑戰時擁有穩健依靠。',
            'image' => '/images/concept2.jpg',
        ],
        [
            'num' => '03',
            'title' => '永續經營',
            'body' => '以永續經營為核心，以專業技術為基礎、客戶需求為核心。透過持續精進品質與服務，攜手合作夥伴共同成長，共創產業新價值。',
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
        'headline' => "精準製程，穩健效能\n深耕載板與電子應用",
        'body' => '崴東科技有限公司深耕電子與 IC 載板領域，專注提供高精密切割刀具、加工治具、彈匣承載框架、功能性膜材及表面鍍膜處理等產品與技術服務。我們持續整合專業技術與資源，致力於滿足客戶在製程穩定、品質提升與效率優化上的多元需求。',
        'link' => '/about/',
        'image' => '/images/about_index.jpg',
        'badgeEn' => 'Since 1995 ・ Taoyuan, Taiwan',
        'badgeZh' => '桃園蘆竹總部',
    ],

    /*
    |--------------------------------------------------------------------------
    | 產品介紹／合作夥伴／聯絡我們 — banner 文案（頁面建好後沿用）
    | 關於我們內頁改整頁編輯器：文案在 source/about.blade.php，不走此處
    |--------------------------------------------------------------------------
    */
    'productsPage' => [
        'banner' => [
            'title' => 'PRODUCTS',
            'crumbs' => [
                ['name' => '產品介紹'],
            ],
            'subtitle' => '涵蓋高精密切割刀具、特用膜類耗材、先進生產治具與表面處理。崴東以嚴格品管與客製化能力，全面滿足產線的高效能需求。',
        ],
        // 分類選單：slug 對應下方 groups；label 顯示文字
        'categories' => [
            ['slug' => 'all', 'label' => '全部'],
            ['slug' => 'tools', 'label' => '精密刀具'],
            ['slug' => 'jigs', 'label' => '加工治具'],
            ['slug' => 'films', 'label' => '膜(膠)捲類'],
            ['slug' => 'surface', 'label' => '表面處理'],
            ['slug' => 'cutting', 'label' => '代工切割'],
        ],
        // 產品列表＋內頁（圖暫用既有 product*.webp；有專圖再換路徑）
        // body：卡片 line-clamp-2；lead／applications／specs|steps：內頁用
        // applications 會併入規格重點第一列「適用場景」；kind：product＝規格表；service＝另加流程步驟
        'groups' => [
            [
                'slug' => 'tools',
                'title' => '精密刀具',
                'items' => [
                    [
                        'slug' => 'nano-coated-cutter',
                        'title' => '奈米鍍膜切膜刀',
                        'body' => '奈米複合鍍膜降低切削阻力與殘膠，厚度／外徑可依產線需求客製。',
                        'lead' => '結合超硬基底與奈米複合鍍膜，降低切削阻力與殘膠，協助載板與乾／濕膜製程維持穩定良率。',
                        'image' => '/images/product1.webp',
                        'kind' => 'product',
                        'applications' => [
                            ['title' => 'IC 載板切割', 'body' => '降低毛邊與刃口沾黏，維持切口平整。'],
                            ['title' => '乾／濕膜製程', 'body' => '對膜材切削更順暢，減少殘膠與換刀頻率。'],
                            ['title' => '客製備料', 'body' => '厚度、外徑可依機台與產線條件調整。'],
                        ],
                        'specs' => [
                            ['label' => '鍍膜類型', 'value' => '奈米複合鍍膜'],
                            ['label' => '適用材料', 'value' => '載板、乾膜、濕膜相關製程'],
                            ['label' => '客製項目', 'value' => '厚度、外徑、刃口規格'],
                            ['label' => '核心優勢', 'value' => '低摩擦、抗殘膠、延長刃口壽命'],
                        ],
                    ],
                    [
                        'slug' => 'diamond-cutter',
                        'title' => '鑽石切割刀',
                        'body' => '適用玻璃、陶瓷、PCB 與半導體封裝等硬脆材料，維持高精度切割。',
                        'lead' => '針對硬脆材料優化的鑽石切割刀，穩定切削表現並延長刀具壽命，適合高精度製程需求。',
                        'image' => '/images/product2.webp',
                        'kind' => 'product',
                        'applications' => [
                            ['title' => '玻璃／陶瓷', 'body' => '硬脆材料切割，維持邊緣品質。'],
                            ['title' => 'PCB／封裝', 'body' => '對應精密線路與封裝製程切割需求。'],
                            ['title' => '高壽命產線', 'body' => '降低換刀停機，維持連續產出。'],
                        ],
                        'specs' => [
                            ['label' => '刀具類型', 'value' => '鑽石切割刀'],
                            ['label' => '適用材料', 'value' => '玻璃、陶瓷、PCB、半導體封裝'],
                            ['label' => '客製項目', 'value' => '刃口、外徑、厚度'],
                            ['label' => '核心優勢', 'value' => '高硬度、高精度、長壽命'],
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'jigs',
                'title' => '加工治具',
                'items' => [
                    [
                        'slug' => 'cutting-machine-jig',
                        'title' => '切割機治具組',
                        'body' => '對應各式切割機台的定位與夾持需求，提升換線效率與加工穩定度。',
                        'lead' => '依機台與工件條件設計定位夾持結構，縮短換線時間並提升切割穩定度。',
                        'image' => '/images/product3.webp',
                        'kind' => 'product',
                        'applications' => [
                            ['title' => '切割機定位', 'body' => '穩固夾持，降低加工偏移。'],
                            ['title' => '多機台對應', 'body' => '可依機型客製治具組配置。'],
                            ['title' => '換線效率', 'body' => '縮短上下料與對位時間。'],
                        ],
                        'specs' => [
                            ['label' => '治具類型', 'value' => '切割機治具組'],
                            ['label' => '適用場景', 'value' => '載板／PCB 切割機台'],
                            ['label' => '客製項目', 'value' => '定位結構、夾持方式、尺寸'],
                            ['label' => '核心優勢', 'value' => '穩定定位、快速換線'],
                        ],
                    ],
                    [
                        'slug' => 'magnetic-reflow-jig',
                        'title' => '磁性迴焊治具',
                        'body' => '磁性固定設計協助 SMT 迴焊製程穩固載板，減少位移與翹曲風險。',
                        'lead' => '以磁性固定協助 SMT 迴焊製程穩固載板，降低位移與翹曲，提升製程一致性。',
                        'image' => '/images/product4.webp',
                        'kind' => 'product',
                        'applications' => [
                            ['title' => 'SMT 迴焊', 'body' => '磁性固定減少板件位移。'],
                            ['title' => '薄板／載板', 'body' => '協助抑制翹曲與變形風險。'],
                            ['title' => '產線穩定', 'body' => '提升重複定位與良率表現。'],
                        ],
                        'specs' => [
                            ['label' => '治具類型', 'value' => '磁性迴焊治具'],
                            ['label' => '適用製程', 'value' => 'SMT 迴焊'],
                            ['label' => '客製項目', 'value' => '磁性配置、板件開口、尺寸'],
                            ['label' => '核心優勢', 'value' => '穩固夾持、降低翹曲'],
                        ],
                    ],
                    [
                        'slug' => 'cleaning-jig',
                        'title' => '清洗治具',
                        'body' => '依工件外形客製承載結構，確保清洗過程定位確實、不易刮傷。',
                        'lead' => '依工件外形客製承載與定位，確保清洗過程穩定且降低刮傷風險。',
                        'image' => '/images/product1.webp',
                        'kind' => 'product',
                        'applications' => [
                            ['title' => '製程清洗', 'body' => '穩固定位，避免清洗中晃動。'],
                            ['title' => '表面防護', 'body' => '降低接觸刮傷與損傷。'],
                            ['title' => '異形工件', 'body' => '可依外形客製承載結構。'],
                        ],
                        'specs' => [
                            ['label' => '治具類型', 'value' => '清洗治具'],
                            ['label' => '適用場景', 'value' => '工件清洗與表面處理前後'],
                            ['label' => '客製項目', 'value' => '承載結構、定位點、材質'],
                            ['label' => '核心優勢', 'value' => '定位確實、減少刮傷'],
                        ],
                    ],
                    [
                        'slug' => 'holding-tray',
                        'title' => 'Holding Tray治具',
                        'body' => '精密承載托盤，方便製程間搬運與暫存，兼顧防護與作業效率。',
                        'lead' => '精密承載托盤設計，方便製程間搬運與暫存，兼顧防護與作業節奏。',
                        'image' => '/images/product2.webp',
                        'kind' => 'product',
                        'applications' => [
                            ['title' => '製程搬運', 'body' => '穩定承載，降低搬運風險。'],
                            ['title' => '暫存緩衝', 'body' => '協助產線節點暫存與流轉。'],
                            ['title' => '表面防護', 'body' => '減少碰撞與刮傷。'],
                        ],
                        'specs' => [
                            ['label' => '治具類型', 'value' => 'Holding Tray'],
                            ['label' => '適用場景', 'value' => '製程間搬運／暫存'],
                            ['label' => '客製項目', 'value' => '穴位、尺寸、材質'],
                            ['label' => '核心優勢', 'value' => '防護佳、流轉效率高'],
                        ],
                    ],
                    [
                        'slug' => 'board-cleaner-cover-jig',
                        'title' => '板清機上蓋治具',
                        'body' => '配合板清機上蓋結構設計，穩定夾持並提升清潔製程一致性。',
                        'lead' => '配合板清機上蓋結構，穩定夾持工件並提升清潔製程一致性。',
                        'image' => '/images/product3.webp',
                        'kind' => 'product',
                        'applications' => [
                            ['title' => '板清製程', 'body' => '對應板清機上蓋夾持需求。'],
                            ['title' => '清潔一致性', 'body' => '穩定定位提升清潔效果。'],
                            ['title' => '機台匹配', 'body' => '可依機型調整結構。'],
                        ],
                        'specs' => [
                            ['label' => '治具類型', 'value' => '板清機上蓋治具'],
                            ['label' => '適用設備', 'value' => '板清機'],
                            ['label' => '客製項目', 'value' => '夾持結構、尺寸、開口'],
                            ['label' => '核心優勢', 'value' => '穩定夾持、製程一致'],
                        ],
                    ],
                    [
                        'slug' => 'micro-vu-jig',
                        'title' => 'Micro VU治具',
                        'body' => '專為光學量測機台設計的定位治具，協助快速對位與重複量測。',
                        'lead' => '專為光學量測機台設計，協助快速對位與重複量測，提升檢測效率。',
                        'image' => '/images/product4.webp',
                        'kind' => 'product',
                        'applications' => [
                            ['title' => '光學量測', 'body' => '快速對位，縮短準備時間。'],
                            ['title' => '重複量測', 'body' => '穩定定位提升量測再現性。'],
                            ['title' => '品管檢測', 'body' => '支援產線抽檢與全檢流程。'],
                        ],
                        'specs' => [
                            ['label' => '治具類型', 'value' => 'Micro VU 定位治具'],
                            ['label' => '適用設備', 'value' => '光學量測機台'],
                            ['label' => '客製項目', 'value' => '定位基準、穴位、尺寸'],
                            ['label' => '核心優勢', 'value' => '快速對位、重複性佳'],
                        ],
                    ],
                    [
                        'slug' => 'cassette-frame',
                        'title' => '彈匣框架',
                        'body' => '高強度框架結構，穩固承載晶圓／基板彈匣，利於自動化上下料。',
                        'lead' => '高強度框架穩固承載晶圓／基板彈匣，利於自動化上下料與產線流轉。',
                        'image' => '/images/product1.webp',
                        'kind' => 'product',
                        'applications' => [
                            ['title' => '彈匣承載', 'body' => '穩固支撐晶圓／基板彈匣。'],
                            ['title' => '自動化上下料', 'body' => '對應自動化設備接口需求。'],
                            ['title' => '產線流轉', 'body' => '提升搬運與暫存穩定度。'],
                        ],
                        'specs' => [
                            ['label' => '治具類型', 'value' => '彈匣框架'],
                            ['label' => '適用場景', 'value' => '晶圓／基板彈匣承載'],
                            ['label' => '客製項目', 'value' => '尺寸、強度、接口'],
                            ['label' => '核心優勢', 'value' => '高強度、利於自動化'],
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'films',
                'title' => '膜(膠)捲類',
                'items' => [
                    [
                        'slug' => 'antistatic-porous-film',
                        'title' => '抗靜電多孔透氣膜',
                        'body' => '兼具抗靜電與透氣特性，適用需平衡防護與排氣的製程包裝場景。',
                        'lead' => '兼具抗靜電與透氣特性，適用需同時兼顧防護與排氣的製程包裝場景。',
                        'image' => '/images/product2.webp',
                        'kind' => 'product',
                        'applications' => [
                            ['title' => '製程包裝', 'body' => '防護同時保留適當透氣。'],
                            ['title' => '靜電敏感件', 'body' => '降低靜電累積風險。'],
                            ['title' => '真空相關應用', 'body' => '協助平衡吸附與排氣需求。'],
                        ],
                        'specs' => [
                            ['label' => '產品類型', 'value' => '抗靜電多孔透氣膜'],
                            ['label' => '主要特性', 'value' => '抗靜電、透氣'],
                            ['label' => '客製項目', 'value' => '尺寸、卷規'],
                            ['label' => '核心優勢', 'value' => '防護與排氣兼顧'],
                        ],
                    ],
                    [
                        'slug' => 'dust-free-paper-roll',
                        'title' => '免刀式除塵紙捲',
                        'body' => '免刀具撕取設計，快速清除表面微塵，降低換捲與作業中斷時間。',
                        'lead' => '免刀具撕取設計，快速清除表面微塵，降低換捲與作業中斷。',
                        'image' => '/images/product3.webp',
                        'kind' => 'product',
                        'applications' => [
                            ['title' => '表面除塵', 'body' => '快速清除微塵與顆粒。'],
                            ['title' => '潔淨作業', 'body' => '減少刀具介入，作業更簡潔。'],
                            ['title' => '產線節奏', 'body' => '縮短換捲與中斷時間。'],
                        ],
                        'specs' => [
                            ['label' => '產品類型', 'value' => '免刀式除塵紙捲'],
                            ['label' => '主要特性', 'value' => '免刀撕取、低塵'],
                            ['label' => '客製項目', 'value' => '寬幅、長度'],
                            ['label' => '核心優勢', 'value' => '作業快、中斷少'],
                        ],
                    ],
                    [
                        'slug' => 'antistatic-roller',
                        'title' => '抗靜電黏塵滾輪(包膠/新品)',
                        'body' => '包膠抗靜電滾輪有效黏除微粒，適合潔淨室與精密組裝產線使用。',
                        'lead' => '包膠抗靜電滾輪有效黏除微粒，適合潔淨室與精密組裝產線。',
                        'image' => '/images/product4.webp',
                        'kind' => 'product',
                        'applications' => [
                            ['title' => '潔淨室除塵', 'body' => '黏除微粒，維持作業環境。'],
                            ['title' => '精密組裝', 'body' => '降低微塵對組裝品質影響。'],
                            ['title' => '抗靜電需求', 'body' => '減少靜電吸附粉塵。'],
                        ],
                        'specs' => [
                            ['label' => '產品類型', 'value' => '抗靜電黏塵滾輪（包膠）'],
                            ['label' => '主要特性', 'value' => '抗靜電、高黏塵'],
                            ['label' => '客製項目', 'value' => '尺寸、硬度'],
                            ['label' => '核心優勢', 'value' => '潔淨穩定、易替換'],
                        ],
                    ],
                    [
                        'slug' => 'handheld-antistatic-roller',
                        'title' => '手持式抗靜電黏塵輪',
                        'body' => '輕巧手持操作，針對局部區域快速除塵，靈活補足自動設備死角。',
                        'lead' => '輕巧手持操作，針對局部區域快速除塵，補足自動設備死角。',
                        'image' => '/images/product1.webp',
                        'kind' => 'product',
                        'applications' => [
                            ['title' => '局部除塵', 'body' => '針對邊角與局部快速處理。'],
                            ['title' => '補足自動化', 'body' => '處理設備不易到達區域。'],
                            ['title' => '機動作業', 'body' => '輕巧好攜，隨線使用。'],
                        ],
                        'specs' => [
                            ['label' => '產品類型', 'value' => '手持式抗靜電黏塵輪'],
                            ['label' => '主要特性', 'value' => '抗靜電、手持操作'],
                            ['label' => '客製項目', 'value' => '滾輪寬度、握把'],
                            ['label' => '核心優勢', 'value' => '靈活、補死角'],
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'surface',
                'title' => '表面處理',
                'items' => [
                    [
                        'slug' => 'surface-treatment',
                        'title' => '表面處理服務',
                        'body' => '依製程需求提供表面處理與相關技術支援，詳情歡迎與我們聯繫。',
                        'lead' => '依工件與製程條件提供表面處理與技術支援，協助提升耐磨、抗沾黏或機能表現。',
                        'image' => '/images/product2.webp',
                        'kind' => 'service',
                        'applications' => [
                            ['title' => '刀具／治具強化', 'body' => '提升表面機能與使用壽命。'],
                            ['title' => '製程適配', 'body' => '依材料與條件調整處理方案。'],
                            ['title' => '技術諮詢', 'body' => '從需求評估到方案建議。'],
                        ],
                        'steps' => [
                            ['title' => '需求評估', 'body' => '了解工件材質、使用環境與目標特性。'],
                            ['title' => '方案建議', 'body' => '提出適合的表面處理方向與條件。'],
                            ['title' => '處理執行', 'body' => '依確認方案進行表面處理作業。'],
                            ['title' => '結果確認', 'body' => '回饋處理結果並協助後續優化。'],
                        ],
                    ],
                ],
            ],
            [
                'slug' => 'cutting',
                'title' => '代工切割',
                'items' => [
                    [
                        'slug' => 'contract-cutting',
                        'title' => '代工切割服務',
                        'body' => '提供精密代工切割與委外加工支援，依料件規格與產線條件客製方案。',
                        'lead' => '提供精密代工切割與委外加工支援，依料件規格與產線條件客製加工方案。',
                        'image' => '/images/product3.webp',
                        'kind' => 'service',
                        'applications' => [
                            ['title' => '產能支援', 'body' => '補足尖峰產能或專案委外需求。'],
                            ['title' => '精密切割', 'body' => '依公差與材料條件穩定加工。'],
                            ['title' => '彈性配合', 'body' => '可討論交期、批量與規格細節。'],
                        ],
                        'steps' => [
                            ['title' => '規格確認', 'body' => '確認材料、尺寸公差與交期需求。'],
                            ['title' => '試切評估', 'body' => '必要時進行試切並調整參數。'],
                            ['title' => '批量加工', 'body' => '依確認條件執行代工切割。'],
                            ['title' => '出貨交付', 'body' => '完成品檢後依約定時程交貨。'],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'partnersPage' => [
        'banner' => [
            'title' => 'PARTNERS',
            'crumbs' => [
                ['name' => '合作夥伴'],
            ],
            'subtitle' => '憑藉穩定的交期與優異的產品良率，崴東深獲台積電、日月光與欣興電子等國內外高科技大廠的長期信賴與肯定。',
        ],
        // CTA 文案寫在 source/partners.blade.php，不走此處
    ],

    'contactPage' => [
        'banner' => [
            'title' => 'CONTACT',
            'crumbs' => [
                ['name' => '聯絡我們'],
            ],
            'subtitle' => '無論是標準產品諮詢、客製化開發或委外代切需求，崴東團隊隨時提供您最即時、專業的技術支援與服務。',
            // 1920×960（原 720 置中＋上下視差留白）；換圖建議同比例
            'image' => '/images/banner_contact.jpg',
        ],
        'companyName' => '崴東科技有限公司',
        'formTitle' => '線上諮詢',
    ],

    /*
    |--------------------------------------------------------------------------
    | 首頁合作夥伴 logo
    |--------------------------------------------------------------------------
    */
    'partnerLogos' => [
        [
            'name' => '佰鼎',
            'image' => '/images/partner1.png',
            'alt' => '佰鼎科技',
            'link' => 'https://www.braiics.com/',
        ],
        [
            'name' => '欣興電子',
            'image' => '/images/partner2.png',
            'alt' => '欣興電子',
            'link' => 'https://demo.whitenight.tw/unimicron-csr/index.html',
        ],
        [
            'name' => '景碩',
            'image' => '/images/partner3.png',
            'alt' => '景碩科技',
            'link' => 'https://www.kinsus.com.tw/zh-tw/home/index',
        ],
        [
            'name' => '興森快捷',
            'image' => '/images/partner4.png',
            'alt' => '興森快捷',
            'link' => 'https://www.chinafastprint.com/',
        ],
        [
            'name' => 'AT&S',
            'image' => '/images/partner5.png',
            'alt' => 'AT&S',
            'link' => 'https://ats-solutions.cn/',
        ],
        [
            'name' => '南亞電路板',
            'image' => '/images/partner6.png',
            'alt' => '南亞電路板',
            'link' => 'https://www.nanyapcb.com.tw/nypcb/chinese/index',
        ],
    ],

    // label＝預設繁中（footer 等）；labels＝語系示意（主選單 JS 切換）
    'navItems' => [
        [
            'path' => '/about',
            'label' => '關於我們',
            'labels' => [
                'zh-Hant' => '關於我們',
                'en' => 'About',
                'ja' => '会社概要',
                'zh-Hans' => '关于我们',
            ],
        ],
        [
            'path' => '/products',
            'label' => '產品介紹',
            'labels' => [
                'zh-Hant' => '產品介紹',
                'en' => 'Products',
                'ja' => '製品紹介',
                'zh-Hans' => '产品介绍',
            ],
        ],
        [
            'path' => '/partners',
            'label' => '合作夥伴',
            'labels' => [
                'zh-Hant' => '合作夥伴',
                'en' => 'Partners',
                'ja' => 'パートナー',
                'zh-Hans' => '合作伙伴',
            ],
        ],
        [
            'path' => '/contact',
            'label' => '聯絡我們',
            'labels' => [
                'zh-Hant' => '聯絡我們',
                'en' => 'Contact',
                'ja' => 'お問い合わせ',
                'zh-Hans' => '联系我们',
            ],
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

    // 扁平化產品清單（含 categorySlug／categoryTitle）
    'productCatalog' => function ($page) {
        $productsPage = $page->asArray($page->productsPage ?? []);
        $groups = $page->asArray($productsPage['groups'] ?? []);
        $items = [];

        foreach ($groups as $group) {
            $group = is_array($group) ? $group : (array) $group;
            $categorySlug = $group['slug'] ?? '';
            $categoryTitle = $group['title'] ?? '';
            $groupItems = $page->asArray($group['items'] ?? []);

            foreach ($groupItems as $item) {
                $item = is_array($item) ? $item : (array) $item;
                $slug = $item['slug'] ?? '';
                if ($slug === '') {
                    continue;
                }
                $items[] = array_merge($item, [
                    'categorySlug' => $categorySlug,
                    'categoryTitle' => $categoryTitle,
                    'link' => '/products/' . $slug . '/',
                ]);
            }
        }

        return $items;
    },

    'productBySlug' => function ($page, $slug) {
        foreach ($page->productCatalog() as $item) {
            if (($item['slug'] ?? '') === $slug) {
                return $item;
            }
        }

        return null;
    },

    'relatedProducts' => function ($page, $slug, $limit = 3) {
        $current = $page->productBySlug($slug);
        if (!$current) {
            return [];
        }

        $categorySlug = $current['categorySlug'] ?? '';
        $related = [];

        foreach ($page->productCatalog() as $item) {
            if (($item['slug'] ?? '') === $slug) {
                continue;
            }
            if (($item['categorySlug'] ?? '') !== $categorySlug) {
                continue;
            }
            $related[] = $item;
            if (count($related) >= $limit) {
                break;
            }
        }

        return $related;
    },
];

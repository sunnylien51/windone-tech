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
    | 產品 collection（檔案由 bootstrap beforeBuild 依 productsPage 同步）
    | 產品內頁／分類分頁皆輸出：/products/{slug}/（分類與產品 slug 不可撞名）
    |--------------------------------------------------------------------------
    */
    'collections' => [
        'products' => [
            'path' => 'products/{filename}',
        ],
        'product_categories' => [
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
            'link' => '/products/tools/',
        ],
        [
            'image' => '/images/main_product2.webp',
            'title' => '加工治具',
            'body' => '涵蓋切割機治具組、彈匣框架、迴焊／清洗治具與 Holding Tray 等。可依需求客製並強化抗熱變形與定位穩定，提升加工與檢測效率。',
            'link' => '/products/jigs/',
        ],
        [
            'image' => '/images/main_product3.webp',
            'title' => '膜(膠)捲類',
            'body' => '提供抗靜電多孔透氣膜、免刀式除塵紙捲與抗靜電黏塵滾輪。適用於真空吸附與無塵室清潔控管，兼具抗靜電、低殘膠與尺寸客製。',
            'link' => '/products/films/',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 首頁產品（與 productsPage 連動；依 showOnHome 上下架）
    |--------------------------------------------------------------------------
    */
    'homeProductsLimit' => 10,

    /*
    |--------------------------------------------------------------------------
    | 首頁企業理念 sticky 疊卡（固定 3 筆；不可增刪）
    |--------------------------------------------------------------------------
    */
    // 編號依排序自動產生（01／02／03），不進欄位
    'valueCards' => [
        [
            'title' => '創新突破',
            'body' => '秉持創新突破的精神，持續提升產品技術與製程應用。我們深入了解客戶需求，協助解決生產難題，創造更高的作業效率與競爭優勢。',
            'image' => '/images/concept1.jpg',
        ],
        [
            'title' => '專業服務',
            'body' => '真正的價值不僅在於提供產品，更在於專業服務與即時支援。以務實態度回應製程需求，讓客戶在面對產線挑戰時擁有穩健依靠。',
            'image' => '/images/concept2.jpg',
        ],
        [
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
    // link 固定 /about/；英文標題 About、角標英文固定於首頁 HTML（不進此處）
    'aboutPanel' => [
        'headline' => "精準製程，穩健效能\n深耕載板與電子應用",
        'body' => '崴東科技有限公司深耕電子與 IC 載板領域，專注提供高精密切割刀具、加工治具、彈匣承載框架、功能性膜材及表面鍍膜處理等產品與技術服務。我們持續整合專業技術與資源，致力於滿足客戶在製程穩定、品質提升與效率優化上的多元需求。',
        'image' => '/images/about_index.jpg',
    ],

    /*
    |--------------------------------------------------------------------------
    | 關於我們內頁 — Banner 圖／引言可編；其餘文案寫在 about.blade.php（HTML 範本）
    |--------------------------------------------------------------------------
    */
    'aboutPage' => [
        'banner' => [
            // 1920×960；換圖建議同比例
            'image' => '/images/banner_about.jpg',
            'subtitle' => '崴東自 1995 年深耕高精密工業刀具與治具領域。我們秉持品質卓越與服務至誠的精神，為半導體與 PCB 產業提供最穩定的製程解決方案。',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 產品介紹／合作夥伴／聯絡我們 — banner 文案（頁面建好後沿用）
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
        // 分類選單：slug 對應下方 groups；網址 /products/{slug}/（all＝/products/）
        // 分類 slug 不可與產品 slug 相同
        'categories' => [
            ['slug' => 'all', 'label' => '全部'],
            ['slug' => 'tools', 'label' => '精密刀具'],
            ['slug' => 'jigs', 'label' => '加工治具'],
            ['slug' => 'films', 'label' => '膜(膠)捲類'],
            ['slug' => 'surface', 'label' => '表面處理'],
            ['slug' => 'cutting', 'label' => '代工切割'],
        ],
        // 產品列表＋內頁（圖暫用既有 product*.webp；有專圖再換路徑）
        // body：列表／首頁／內頁共用簡介（列表 line-clamp-2）；specs：內頁規格重點
        // showOnHome：是否上架首頁（homeProductsLimit 上限）
        'groups' => [
            [
                'slug' => 'tools',
                'title' => '精密刀具',
                'items' => [
                    [
                        'slug' => 'nano-coated-cutter',
                        'showOnHome' => true,
                        'title' => '奈米鍍膜切膜刀',
                        'body' => '結合超硬基底與先進的奈米複合鍍膜技術，大幅降低切削阻力與摩擦係數，有效解決生產過程中常見的毛邊、殘膠與刀刃磨損問題，為產線帶來極致的耐用度與高精度切削表現。',
                        'image' => '/images/product1.webp',
                        'specs' => [
                            ['label' => '適用場景', 'value' => 'IC 載板切割、乾／濕膜製程、客製備料'],
                            ['label' => '鍍膜類型', 'value' => '奈米複合鍍膜'],
                            ['label' => '適用材料', 'value' => '載板、乾膜、濕膜相關製程'],
                            ['label' => '客製項目', 'value' => '厚度、外徑、刃口規格'],
                            ['label' => '核心優勢', 'value' => '低摩擦、抗殘膠、延長刃口壽命'],
                        ],
                    ],
                    [
                        'slug' => 'diamond-cutter',
                        'showOnHome' => true,
                        'title' => '鑽石切割刀',
                        'body' => '針對高硬度材料與精密製程優化，穩定切削表現，延長刀具壽命並維持加工精度，適用載板、玻璃與陶瓷等製程需求。',
                        'image' => '/images/product2.webp',
                        'specs' => [
                            ['label' => '適用場景', 'value' => '玻璃／陶瓷、PCB／封裝、高壽命產線'],
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
                        'showOnHome' => true,
                        'title' => '切割機治具組',
                        'body' => '對應各式切割機台的定位與夾持需求，提升換線效率與加工穩定度，協助產線維持高精度與一致性表現。',
                        'image' => '/images/product3.webp',
                        'specs' => [
                            ['label' => '治具類型', 'value' => '切割機治具組'],
                            ['label' => '適用場景', 'value' => '載板／PCB 切割機台'],
                            ['label' => '客製項目', 'value' => '定位結構、夾持方式、尺寸'],
                            ['label' => '核心優勢', 'value' => '穩定定位、快速換線'],
                        ],
                    ],
                    [
                        'slug' => 'magnetic-reflow-jig',
                        'showOnHome' => true,
                        'title' => '磁性迴焊治具',
                        'body' => '磁性固定設計協助 SMT 迴焊製程穩固載板，減少位移與翹曲風險，讓產線維持連續且穩定的產出效率。',
                        'image' => '/images/product4.webp',
                        'specs' => [
                            ['label' => '適用場景', 'value' => 'SMT 迴焊、薄板／載板、產線穩定'],
                            ['label' => '治具類型', 'value' => '磁性迴焊治具'],
                            ['label' => '適用製程', 'value' => 'SMT 迴焊'],
                            ['label' => '客製項目', 'value' => '磁性配置、板件開口、尺寸'],
                            ['label' => '核心優勢', 'value' => '穩固夾持、降低翹曲'],
                        ],
                    ],
                    [
                        'slug' => 'cleaning-jig',
                        'showOnHome' => false,
                        'title' => '清洗治具',
                        'body' => '依工件外形客製承載結構，確保清洗過程定位確實、不易刮傷。',
                        'image' => '/images/product1.webp',
                        'specs' => [
                            ['label' => '治具類型', 'value' => '清洗治具'],
                            ['label' => '適用場景', 'value' => '工件清洗與表面處理前後'],
                            ['label' => '客製項目', 'value' => '承載結構、定位點、材質'],
                            ['label' => '核心優勢', 'value' => '定位確實、減少刮傷'],
                        ],
                    ],
                    [
                        'slug' => 'holding-tray',
                        'showOnHome' => false,
                        'title' => 'Holding Tray治具',
                        'body' => '精密承載托盤，方便製程間搬運與暫存，兼顧防護與作業效率。',
                        'image' => '/images/product2.webp',
                        'specs' => [
                            ['label' => '治具類型', 'value' => 'Holding Tray'],
                            ['label' => '適用場景', 'value' => '製程間搬運／暫存'],
                            ['label' => '客製項目', 'value' => '穴位、尺寸、材質'],
                            ['label' => '核心優勢', 'value' => '防護佳、流轉效率高'],
                        ],
                    ],
                    [
                        'slug' => 'board-cleaner-cover-jig',
                        'showOnHome' => false,
                        'title' => '板清機上蓋治具',
                        'body' => '配合板清機上蓋結構設計，穩定夾持並提升清潔製程一致性。',
                        'image' => '/images/product3.webp',
                        'specs' => [
                            ['label' => '適用場景', 'value' => '板清製程、清潔一致性、機台匹配'],
                            ['label' => '治具類型', 'value' => '板清機上蓋治具'],
                            ['label' => '適用設備', 'value' => '板清機'],
                            ['label' => '客製項目', 'value' => '夾持結構、尺寸、開口'],
                            ['label' => '核心優勢', 'value' => '穩定夾持、製程一致'],
                        ],
                    ],
                    [
                        'slug' => 'micro-vu-jig',
                        'showOnHome' => false,
                        'title' => 'Micro VU治具',
                        'body' => '專為光學量測機台設計的定位治具，協助快速對位與重複量測。',
                        'image' => '/images/product4.webp',
                        'specs' => [
                            ['label' => '適用場景', 'value' => '光學量測、重複量測、品管檢測'],
                            ['label' => '治具類型', 'value' => 'Micro VU 定位治具'],
                            ['label' => '適用設備', 'value' => '光學量測機台'],
                            ['label' => '客製項目', 'value' => '定位基準、穴位、尺寸'],
                            ['label' => '核心優勢', 'value' => '快速對位、重複性佳'],
                        ],
                    ],
                    [
                        'slug' => 'cassette-frame',
                        'showOnHome' => false,
                        'title' => '彈匣框架',
                        'body' => '高強度框架結構，穩固承載晶圓／基板彈匣，利於自動化上下料。',
                        'image' => '/images/product1.webp',
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
                        'showOnHome' => true,
                        'title' => '抗靜電多孔透氣膜',
                        'body' => '兼具抗靜電與透氣特性，適用需平衡防護與排氣的製程包裝場景，協助製程品質更加穩定可控。',
                        'image' => '/images/product2.webp',
                        'specs' => [
                            ['label' => '適用場景', 'value' => '製程包裝、靜電敏感件、真空相關應用'],
                            ['label' => '產品類型', 'value' => '抗靜電多孔透氣膜'],
                            ['label' => '主要特性', 'value' => '抗靜電、透氣'],
                            ['label' => '客製項目', 'value' => '尺寸、卷規'],
                            ['label' => '核心優勢', 'value' => '防護與排氣兼顧'],
                        ],
                    ],
                    [
                        'slug' => 'dust-free-paper-roll',
                        'showOnHome' => true,
                        'title' => '免刀式除塵紙捲',
                        'body' => '免刀具撕取設計，快速清除表面微塵，降低換捲與作業中斷時間，維持潔淨室作業節奏。',
                        'image' => '/images/product3.webp',
                        'specs' => [
                            ['label' => '適用場景', 'value' => '表面除塵、潔淨作業、產線節奏'],
                            ['label' => '產品類型', 'value' => '免刀式除塵紙捲'],
                            ['label' => '主要特性', 'value' => '免刀撕取、低塵'],
                            ['label' => '客製項目', 'value' => '寬幅、長度'],
                            ['label' => '核心優勢', 'value' => '作業快、中斷少'],
                        ],
                    ],
                    [
                        'slug' => 'antistatic-roller',
                        'showOnHome' => false,
                        'title' => '抗靜電黏塵滾輪(包膠/新品)',
                        'body' => '包膠抗靜電滾輪有效黏除微粒，適合潔淨室與精密組裝產線使用。',
                        'image' => '/images/product4.webp',
                        'specs' => [
                            ['label' => '適用場景', 'value' => '潔淨室除塵、精密組裝、抗靜電需求'],
                            ['label' => '產品類型', 'value' => '抗靜電黏塵滾輪（包膠）'],
                            ['label' => '主要特性', 'value' => '抗靜電、高黏塵'],
                            ['label' => '客製項目', 'value' => '尺寸、硬度'],
                            ['label' => '核心優勢', 'value' => '潔淨穩定、易替換'],
                        ],
                    ],
                    [
                        'slug' => 'handheld-antistatic-roller',
                        'showOnHome' => false,
                        'title' => '手持式抗靜電黏塵輪',
                        'body' => '輕巧手持操作，針對局部區域快速除塵，靈活補足自動設備死角。',
                        'image' => '/images/product1.webp',
                        'specs' => [
                            ['label' => '適用場景', 'value' => '局部除塵、補足自動化、機動作業'],
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
                        'showOnHome' => false,
                        'title' => '表面處理服務',
                        'body' => '依製程需求提供表面處理與相關技術支援，詳情歡迎與我們聯繫。',
                        'image' => '/images/product2.webp',
                        'specs' => [
                            ['label' => '適用場景', 'value' => '刀具／治具強化、製程適配、技術諮詢'],
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
                        'showOnHome' => false,
                        'title' => '代工切割服務',
                        'body' => '提供精密代工切割與委外加工支援，依料件規格與產線條件客製方案。',
                        'image' => '/images/product3.webp',
                        'specs' => [
                            ['label' => '適用場景', 'value' => '產能支援、精密切割、彈性配合'],
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
        // 洽詢合作 CTA；連結固定 /contact/
        'cta' => [
            'title' => '歡迎洽詢合作',
            'body' => '無論是供應諮詢、客製開發或長期合作規劃，崴東團隊樂於與您深入討論。',
            'button' => '聯絡我們',
        ],
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
        // 表單標題「線上諮詢」固定於 contact HTML
    ],

    /*
    |--------------------------------------------------------------------------
    | 隱私權聲明／服務條款 — Banner 引言可編；內文為 HTML 範本
    |--------------------------------------------------------------------------
    */
    'privacyPage' => [
        'banner' => [
            'subtitle' => '說明本站如何蒐集、處理、利用與保護您的個人資料。',
        ],
    ],
    'termsPage' => [
        'banner' => [
            'subtitle' => '使用本網站前，請詳閱下列服務條款。',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 合作夥伴 logo（首頁／內頁共用；首頁最多 homePartnersLimit 筆）
    |--------------------------------------------------------------------------
    */
    'homePartnersLimit' => 12,
    'partnerLogos' => [
        [
            'name' => '佰鼎科技',
            'image' => '/images/partner1.png',
            'link' => 'https://www.braiics.com/',
        ],
        [
            'name' => '欣興電子',
            'image' => '/images/partner2.png',
            'link' => 'https://demo.whitenight.tw/unimicron-csr/index.html',
        ],
        [
            'name' => '景碩科技',
            'image' => '/images/partner3.png',
            'link' => 'https://www.kinsus.com.tw/zh-tw/home/index',
        ],
        [
            'name' => '興森快捷',
            'image' => '/images/partner4.png',
            'link' => 'https://www.chinafastprint.com/',
        ],
        [
            'name' => 'AT&S',
            'image' => '/images/partner5.png',
            'link' => 'https://ats-solutions.cn/',
        ],
        [
            'name' => '南亞電路板',
            'image' => '/images/partner6.png',
            'link' => 'https://www.nanyapcb.com.tw/nypcb/chinese/index',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 產品型錄下載（主選單）；file 留空＝不顯示按鈕
    |--------------------------------------------------------------------------
    | 檔案放 source/files/，路徑例：'/files/catalog.pdf'
    */
    'catalogDownload' => [
        'file' => '/files/catalog.pdf',
        'labels' => [
            'zh-Hant' => '型錄下載',
            'zh-Hans' => '型录下载',
            'en' => 'Catalog',
            'ja' => 'カタログ',
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


    // 首頁產品：productsPage 中 showOnHome=true，依分類／列表順序，最多 homeProductsLimit 筆
    'homeProducts' => function ($page) {
        $limit = (int) ($page->homeProductsLimit ?? 10);
        if ($limit < 1) {
            return [];
        }

        $items = [];
        foreach ($page->productCatalog() as $item) {
            if (empty($item['showOnHome'])) {
                continue;
            }
            $items[] = [
                'category' => $item['categoryTitle'] ?? '',
                'title' => $item['title'] ?? '',
                'body' => $item['body'] ?? '',
                'image' => $item['image'] ?? '/images/product1.webp',
                'link' => $item['link'] ?? '/products/',
            ];
            if (count($items) >= $limit) {
                break;
            }
        }

        return $items;
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

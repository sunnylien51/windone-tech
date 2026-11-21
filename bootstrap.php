<?php

use Illuminate\Container\Container;
use TightenCo\Jigsaw\Events\EventBus;
use TightenCo\Jigsaw\Jigsaw;

/** @var Container $container */
/** @var EventBus $events */

/*
 * 依 config productsPage 同步：
 * 1) source/_products/{slug}.blade.php → /products/{slug}/（產品內頁）
 * 2) source/_product_categories/{slug}.blade.php → /products/{slug}/（分類分頁；勿與產品 slug 撞名）
 */
$events->beforeBuild(function (Jigsaw $jigsaw) {
    $config = $jigsaw->getConfig();
    $productsPage = is_object($config) && method_exists($config, 'get')
        ? $config->get('productsPage')
        : ($config['productsPage'] ?? null);

    if (is_object($productsPage) && method_exists($productsPage, 'toArray')) {
        $productsPage = $productsPage->toArray();
    }
    if (!is_array($productsPage)) {
        return;
    }

    $yamlQuote = static function (string $value): string {
        $escaped = str_replace(['\\', '"'], ['\\\\', '\\"'], $value);

        return '"' . $escaped . '"';
    };

    $groups = $productsPage['groups'] ?? [];
    if (is_object($groups) && method_exists($groups, 'toArray')) {
        $groups = $groups->toArray();
    }
    if (!is_array($groups)) {
        $groups = [];
    }

    $categories = $productsPage['categories'] ?? [];
    if (is_object($categories) && method_exists($categories, 'toArray')) {
        $categories = $categories->toArray();
    }
    if (!is_array($categories)) {
        $categories = [];
    }

    $categorySlugs = [];
    foreach ($categories as $cat) {
        $cat = is_array($cat) ? $cat : (array) $cat;
        $slug = $cat['slug'] ?? '';
        if ($slug === '' || $slug === 'all' || !preg_match('/^[a-z0-9\-]+$/', $slug)) {
            continue;
        }
        $categorySlugs[$slug] = $cat['label'] ?? $slug;
    }

    // --- 產品內頁 ---
    $productsDir = $jigsaw->getSourcePath() . '/_products';
    if (!is_dir($productsDir)) {
        mkdir($productsDir, 0755, true);
    }

    $expectedProducts = [];

    foreach ($groups as $group) {
        $group = is_array($group) ? $group : (array) $group;
        $items = $group['items'] ?? [];
        if (is_object($items) && method_exists($items, 'toArray')) {
            $items = $items->toArray();
        }
        if (!is_array($items)) {
            continue;
        }

        foreach ($items as $item) {
            $item = is_array($item) ? $item : (array) $item;
            $slug = $item['slug'] ?? '';
            if ($slug === '' || !preg_match('/^[a-z0-9\-]+$/', $slug)) {
                continue;
            }
            if (isset($categorySlugs[$slug])) {
                // 與分類網址撞名時略過內頁檔，避免互相覆蓋
                continue;
            }

            $title = str_replace(["\r", "\n"], '', (string) ($item['title'] ?? $slug));
            $description = str_replace(["\r", "\n"], ' ', (string) ($item['body'] ?? $title));
            $description = trim(preg_replace('/\s+/', ' ', $description));

            $expectedProducts[$slug] = true;
            $path = $productsDir . '/' . $slug . '.blade.php';
            $contents = "---\n"
                . "extends: _layouts.product\n"
                . 'title: ' . $yamlQuote($title) . "\n"
                . 'description: ' . $yamlQuote($description) . "\n"
                . "---\n";

            if (!is_file($path) || file_get_contents($path) !== $contents) {
                file_put_contents($path, $contents);
            }
        }
    }

    foreach (glob($productsDir . '/*.blade.php') ?: [] as $file) {
        $slug = basename($file, '.blade.php');
        if (!isset($expectedProducts[$slug])) {
            unlink($file);
        }
    }

    // --- 分類分頁 ---
    $categoriesDir = $jigsaw->getSourcePath() . '/_product_categories';
    if (!is_dir($categoriesDir)) {
        mkdir($categoriesDir, 0755, true);
    }

    $expectedCategories = [];

    foreach ($categorySlugs as $slug => $label) {
        $title = str_replace(["\r", "\n"], '', (string) $label);
        $description = '產品介紹｜' . $title;
        $expectedCategories[$slug] = true;
        $path = $categoriesDir . '/' . $slug . '.blade.php';
        $contents = "---\n"
            . "extends: _layouts.product-category\n"
            . 'title: ' . $yamlQuote($title) . "\n"
            . 'description: ' . $yamlQuote($description) . "\n"
            . "---\n";

        if (!is_file($path) || file_get_contents($path) !== $contents) {
            file_put_contents($path, $contents);
        }
    }

    foreach (glob($categoriesDir . '/*.blade.php') ?: [] as $file) {
        $slug = basename($file, '.blade.php');
        if (!isset($expectedCategories[$slug])) {
            unlink($file);
        }
    }
});

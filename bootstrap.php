<?php

use Illuminate\Container\Container;
use TightenCo\Jigsaw\Events\EventBus;
use TightenCo\Jigsaw\Jigsaw;

/** @var Container $container */
/** @var EventBus $events */

/*
 * 依 config productsPage 同步 source/_products/{slug}.blade.php，
 * 讓 Jigsaw collection 輸出 /products/{slug}/；內容仍以 config 為唯一來源。
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

    $groups = $productsPage['groups'] ?? [];
    if (is_object($groups) && method_exists($groups, 'toArray')) {
        $groups = $groups->toArray();
    }
    if (!is_array($groups)) {
        return;
    }

    $dir = $jigsaw->getSourcePath() . '/_products';
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    $yamlQuote = static function (string $value): string {
        $escaped = str_replace(['\\', '"'], ['\\\\', '\\"'], $value);

        return '"' . $escaped . '"';
    };

    $expected = [];

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

            $title = str_replace(["\r", "\n"], '', (string) ($item['title'] ?? $slug));
            $description = str_replace(["\r", "\n"], ' ', (string) ($item['body'] ?? $title));
            $description = trim(preg_replace('/\s+/', ' ', $description));

            $expected[$slug] = true;
            $path = $dir . '/' . $slug . '.blade.php';
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

    foreach (glob($dir . '/*.blade.php') ?: [] as $file) {
        $slug = basename($file, '.blade.php');
        if (!isset($expected[$slug])) {
            unlink($file);
        }
    }
});

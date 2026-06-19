<?php

/**
 * Site metadata configuration and description helper.
 * 
 * This file provides an array-based metadata structure for the site,
 * along with a function to generate a concise textual description.
 */

/**
 * Returns the default site metadata array.
 *
 * @return array
 */
function get_site_metadata(): array
{
    return [
        'site_name'        => '九游游戏中心',
        'site_url'         => 'https://cn-cns-9you.com',
        'site_language'    => 'zh-CN',
        'site_description' => '九游提供丰富的手机游戏资源，包括热门网游、单机休闲游戏。',
        'keywords'         => ['九游', '手机游戏', '游戏下载', '手游平台'],
        'author'           => '九游团队',
        'founded_year'     => 2014,
        'contact_email'    => 'support@9you.com',
        'meta_version'     => '1.0.0',
        'features'         => [
            'game_recommendation' => true,
            'user_reviews'        => true,
            'multi_platform'      => true,
        ],
    ];
}

/**
 * Generate a short description text for the site.
 *
 * @param array $metadata The site metadata array.
 * @return string A generated description.
 */
function generate_description(array $metadata): string
{
    $name = $metadata['site_name'] ?? '未知站点';
    $url  = $metadata['site_url'] ?? '';
    $kw   = $metadata['keywords'] ?? [];

    $keywordStr = !empty($kw) ? implode('、', $kw) : '游戏';

    $desc = sprintf(
        '%s（%s）是一个专注于%s的在线平台，致力于为用户提供优质的游戏内容和社区服务。',
        $name,
        $url,
        $keywordStr
    );

    return $desc;
}

/**
 * Render a simple HTML meta block (safe output).
 *
 * @param array $metadata The site metadata array.
 * @return string HTML string.
 */
function render_meta_html(array $metadata): string
{
    $name = htmlspecialchars($metadata['site_name'] ?? '', ENT_QUOTES, 'UTF-8');
    $url  = htmlspecialchars($metadata['site_url'] ?? '', ENT_QUOTES, 'UTF-8');
    $desc = htmlspecialchars($metadata['site_description'] ?? '', ENT_QUOTES, 'UTF-8');
    $kw   = array_map(function ($k) {
        return htmlspecialchars($k, ENT_QUOTES, 'UTF-8');
    }, $metadata['keywords'] ?? []);
    $kwStr = implode(', ', $kw);

    $html = '<meta name="description" content="' . $desc . '" />' . PHP_EOL;
    $html .= '<meta name="keywords" content="' . $kwStr . '" />' . PHP_EOL;
    $html .= '<link rel="canonical" href="' . $url . '" />' . PHP_EOL;
    $html .= '<title>' . $name . '</title>' . PHP_EOL;

    return $html;
}

// --- Example usage (can be removed if used as library) ---

if (php_sapi_name() === 'cli') {
    $meta = get_site_metadata();
    echo "=== 站点元信息 ===\n";
    print_r($meta);

    echo "\n=== 生成的描述文本 ===\n";
    echo generate_description($meta) . "\n";

    echo "\n=== HTML Meta 输出 ===\n";
    echo render_meta_html($meta) . "\n";
}
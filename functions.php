<?php
/**
 * テーマの設定と機能
 *
 * @package WordPress_Custom_Theme_Template
 */

/**
 * コンテンツ幅の設定
 */
if (!isset($content_width)) {
    $content_width = 800;
}

/**
 * テーマのセットアップ
 */
function wctt_setup()
{
    add_theme_support("title-tag");
    add_theme_support("custom-logo");
    add_theme_support("post-thumbnails");
    add_theme_support("editor-styles");
    add_theme_support("html5", array(
        "search-form",
        "comment-form",
        "comment-list",
        "gallery",
        "caption",
        "style",
        "script",
    ));
    add_theme_support("wp-block-styles");
    add_theme_support("automatic-feed-links");
    add_theme_support("responsive-embeds");

    add_editor_style("assets/css/2-base.css");

    register_nav_menus(
        array(
            "header-menu" => esc_html__("ヘッダーメニュー", "wordpress-custom-theme-template"),
            "footer-menu" => esc_html__("フッターメニュー", "wordpress-custom-theme-template"),
        )
    );
}
add_action("after_setup_theme", "wctt_setup");

/**
 * Google Fonts の URL
 */
define("WCTT_GOOGLE_FONTS_URL", "https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap");

/**
 * Google Fonts のプリコネクト（Resource Hints）
 *
 * @param array  $urls          既存のリソースヒントURL配列
 * @param string $relation_type リレーションタイプ
 * @return array フィルタ後のURL配列
 */
function wctt_resource_hints($urls, $relation_type)
{
    if ($relation_type === 'preconnect') {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $urls;
}
add_filter('wp_resource_hints', 'wctt_resource_hints', 10, 2);

/**
 * スタイルシートとスクリプトを読み込み
 */
function wctt_enqueue_assets()
{
    $theme_version = wp_get_theme()->get("Version");

    wp_enqueue_style(
        "wctt-google-fonts",
        WCTT_GOOGLE_FONTS_URL,
        array(),
        null
    );

    wp_enqueue_style(
        "wctt-reset",
        get_theme_file_uri("assets/css/1-reset.css"),
        array(),
        $theme_version
    );

    wp_enqueue_style(
        "wctt-base",
        get_theme_file_uri("assets/css/2-base.css"),
        array("wctt-reset"),
        $theme_version
    );

    wp_enqueue_style(
        "wctt-layout",
        get_theme_file_uri("assets/css/3-layout.css"),
        array("wctt-base"),
        $theme_version
    );

    wp_enqueue_style(
        "wctt-header",
        get_theme_file_uri("assets/css/4-components/header.css"),
        array("wctt-layout"),
        $theme_version
    );

    wp_enqueue_style(
        "wctt-footer",
        get_theme_file_uri("assets/css/4-components/footer.css"),
        array("wctt-layout"),
        $theme_version
    );

    wp_enqueue_style(
        "wctt-utilities",
        get_theme_file_uri("assets/css/5-utilities.css"),
        array("wctt-header", "wctt-footer"),
        $theme_version
    );

    wp_enqueue_script(
        "wctt-utils",
        get_theme_file_uri("assets/js/utils.js"),
        array(),
        $theme_version,
        true
    );

    wp_enqueue_script(
        "wctt-viewport",
        get_theme_file_uri("assets/js/viewport.js"),
        array("wctt-utils"),
        $theme_version,
        true
    );
}
add_action("wp_enqueue_scripts", "wctt_enqueue_assets");

<?php
/**
 * 404エラーページテンプレート
 *
 * @package WordPress_Custom_Theme_Template
 */

get_header();
?>

<main class="site-main">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e('ページが見つかりません', 'wordpress-custom-theme-template'); ?></h1>
    </header>

    <div class="page-content">
        <p><?php esc_html_e('お探しのページは存在しないか、移動された可能性があります。以下の検索フォームをお試しください。', 'wordpress-custom-theme-template'); ?>
        </p>

        <?php get_search_form(); ?>
    </div>
</main>

<?php
get_footer();

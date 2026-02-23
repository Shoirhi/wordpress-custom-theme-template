<?php
/**
 * 検索結果テンプレート
 *
 * @package WordPress_Custom_Theme_Template
 */

get_header();
?>

<main class="site-main">
    <?php if (have_posts()): ?>
        <header class="page-header">
            <h1 class="page-title">
                <?php
                printf(
                    /* translators: %s: search query */
                    esc_html__('「%s」の検索結果', 'wordpress-custom-theme-template'),
                    '<span class="search-query">' . esc_html(get_search_query()) . '</span>'
                );
                ?>
            </h1>
        </header>

        <div class="post-list">
            <?php
            while (have_posts()):
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h2>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                    </header>

                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <?php
        the_posts_pagination(
            array(
                'prev_text' => esc_html__('前のページ', 'wordpress-custom-theme-template'),
                'next_text' => esc_html__('次のページ', 'wordpress-custom-theme-template'),
            )
        );
        ?>

    <?php else: ?>
        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e('検索結果が見つかりませんでした', 'wordpress-custom-theme-template'); ?></h1>
        </header>
        <div class="page-content">
            <p><?php esc_html_e('別のキーワードで再度お試しください。', 'wordpress-custom-theme-template'); ?></p>
            <?php get_search_form(); ?>
        </div>
    <?php endif; ?>
</main>

<?php
get_footer();

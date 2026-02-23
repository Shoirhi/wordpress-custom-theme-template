<?php
/**
 * アーカイブテンプレート
 *
 * @package WordPress_Custom_Theme_Template
 */

get_header();
?>

<main class="site-main">
    <?php if ( have_posts() ) : ?>
        <header class="archive-header">
            <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="archive-description">', '</div>' );
            ?>
        </header>

        <div class="post-list">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h2>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <div class="entry-meta">
                            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                <?php echo esc_html( get_the_date() ); ?>
                            </time>
                        </div>
                    </header>

                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <?php
        /* ページネーションの翻訳テキストを明示的に指定 */
        the_posts_pagination(
            array(
                'prev_text' => esc_html__( '前のページ', 'wordpress-custom-theme-template' ),
                'next_text' => esc_html__( '次のページ', 'wordpress-custom-theme-template' ),
            )
        );
        ?>

    <?php else : ?>
        <header class="archive-header">
            <h1 class="page-title"><?php esc_html_e( '何も見つかりませんでした', 'wordpress-custom-theme-template' ); ?></h1>
        </header>
        <div class="page-content">
            <p><?php esc_html_e( 'お探しの記事は見つかりませんでした。', 'wordpress-custom-theme-template' ); ?></p>
        </div>
    <?php endif; ?>
</main>

<?php
get_footer();
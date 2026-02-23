<?php
/**
 * 個別投稿テンプレート
 *
 * @package WordPress_Custom_Theme_Template
 */

get_header();
?>

<main class="site-main">
    <?php
    while (have_posts()):
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1>
                    <?php the_title(); ?>
                </h1>

                <div class="entry-meta">
                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                        <?php echo esc_html(get_the_date()); ?>
                    </time>
                </div>
            </header>

            <div class="entry-content">
                <?php the_content(); ?>
                <?php
                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">',
                        'after' => '</div>',
                    )
                );
                ?>
            </div>

            <footer class="entry-footer">
                <?php
                the_category(', ');
                the_tags('<span class="tag-links">', ', ', '</span>');
                ?>
            </footer>
        </article>

        <?php
        the_post_navigation(
            array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__('前の記事', 'wordpress-custom-theme-template') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__('次の記事', 'wordpress-custom-theme-template') . '</span> <span class="nav-title">%title</span>',
            )
        );
        ?>

        <?php
        if (comments_open() || get_comments_number()):
            comments_template();
        endif;
        ?>
    <?php endwhile; ?>
</main>

<?php
get_footer();

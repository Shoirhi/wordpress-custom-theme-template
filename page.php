<?php
/**
 * 固定ページテンプレート
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
        </article>
    <?php endwhile; ?>
</main>

<?php
get_footer();

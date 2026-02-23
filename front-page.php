<?php
/**
 * フロントページテンプレート
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

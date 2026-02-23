<?php
/**
 * フッターテンプレート
 *
 * @package WordPress_Custom_Theme_Template
 */
?>

<footer class="site-footer">
    <?php
    wp_nav_menu(
        array(
            "theme_location" => "footer-menu",
            "container" => "nav",
            "fallback_cb" => false,
        )
    );
    ?>

    <p class="copyright">
        <small>&copy; <?php echo esc_html(date("Y")); ?> <?php bloginfo("name"); ?></small>
    </p>
</footer>

<?php wp_footer(); ?>
</body>

</html>
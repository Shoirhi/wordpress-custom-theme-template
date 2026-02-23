<?php
/**
 * コメントテンプレート
 *
 * @package WordPress_Custom_Theme_Template
 */

/*
 * パスワード保護された投稿の場合はコメントを表示しない
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()): ?>
        <h2 class="comments-title">
            <?php
            $wctt_comment_count = get_comments_number();
            printf(
                /* translators: %s: comment count */
                esc_html(_n('%s件のコメント', '%s件のコメント', $wctt_comment_count, 'wordpress-custom-theme-template')),
                esc_html(number_format_i18n($wctt_comment_count))
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style' => 'ol',
                    'short_ping' => true,
                )
            );
            ?>
        </ol>

        <?php
        the_comments_navigation(
            array(
                'prev_text' => esc_html__('古いコメント', 'wordpress-custom-theme-template'),
                'next_text' => esc_html__('新しいコメント', 'wordpress-custom-theme-template'),
            )
        );
        ?>

    <?php endif; ?>

    <?php
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')):
        ?>
        <p class="no-comments"><?php esc_html_e('コメントは受け付けていません。', 'wordpress-custom-theme-template'); ?></p>
    <?php endif; ?>

    <?php comment_form(); ?>
</div>
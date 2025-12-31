<?php
/**
 * The template for displaying comments
 *
 * @package XDM_Theme
 */

// Don't load directly
if (!defined('ABSPATH')) {
    exit;
}

// Password protected posts
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area mt-2xl">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ('1' === $comment_count) {
                printf(
                    esc_html__('Un comentario en "%1$s"', 'xdm-theme'),
                    '<span>' . get_the_title() . '</span>'
                );
            } else {
                printf(
                    esc_html(_n('%1$s comentario en "%2$s"', '%1$s comentarios en "%2$s"', $comment_count, 'xdm-theme')),
                    number_format_i18n($comment_count),
                    '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size' => 50,
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation();
        
        // If comments are closed and there are comments
        if (!comments_open()) :
        ?>
            <p class="no-comments"><?php esc_html_e('Os comentarios están pechados.', 'xdm-theme'); ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply'        => __('Deixa un comentario', 'xdm-theme'),
        'title_reply_to'     => __('Responder a %s', 'xdm-theme'),
        'cancel_reply_link'  => __('Cancelar resposta', 'xdm-theme'),
        'label_submit'       => __('Enviar comentario', 'xdm-theme'),
        'comment_field'      => '<p class="comment-form-comment"><label for="comment">' . _x('Comentario', 'noun', 'xdm-theme') . '</label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>',
    ));
    ?>
</div>

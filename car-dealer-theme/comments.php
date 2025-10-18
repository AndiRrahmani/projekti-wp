<?php
// This file handles the display of comments and the comment form.

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php
    if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            printf(
                esc_html( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'car-dealer-theme' ) ),
                number_format_i18n( get_comments_number() )
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'      => 'ol',
                'short_ping' => true,
            ) );
            ?>
        </ol>

        <?php
        the_comments_navigation();

    else :
        if ( comments_open() ) :
            // If comments are open, but there are no comments.
        else :
            // If comments are closed.
        endif;
    endif;
    ?>

    <?php
    comment_form();
    ?>

</div>
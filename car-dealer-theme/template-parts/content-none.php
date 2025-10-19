<?php
// This file is displayed when no content is found.

get_header(); ?>

<div class="no-content">
    <h2><?php esc_html_e( 'No Cars Found', 'car-dealer-theme' ); ?></h2>
    <p><?php esc_html_e( 'Sorry, but there are no cars available at the moment. Please check back later.', 'car-dealer-theme' ); ?></p>
</div>

<?php
get_footer();
<?php
<?php
// ...existing code...
get_header();
while ( have_posts() ) : the_post(); ?>
    <div class="container">
        <article class="car-single">
            <header>
                <h1><?php the_title(); ?></h1>
                <div class="car-meta small">
                    <span><?php echo esc_html( get_post_meta( get_the_ID(), 'year', true ) ); ?></span>
                    <span><?php echo esc_html( get_post_meta( get_the_ID(), 'mileage', true ) ); ?></span>
                    <span><?php echo esc_html( get_the_term_list( get_the_ID(), 'make', '', ', ', '' ) ); ?></span>
                </div>
            </header>

            <section class="car-gallery">
                <?php
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'car-hero' );
                }
                $attachments = get_attached_media( 'image', get_the_ID() );
                if ( $attachments ) {
                    echo '<div class="gallery-grid">';
                    foreach ( $attachments as $att ) {
                        echo wp_get_attachment_image( $att->ID, 'car-thumb' );
                    }
                    echo '</div>';
                }
                ?>
            </section>

            <section class="car-description">
                <?php the_content(); ?>
                <ul class="specs small">
                    <li><strong><?php _e( 'Price', 'car-dealer-pro' ); ?>:</strong> <?php echo cdt_price(); ?></li>
                    <li><strong><?php _e( 'VIN', 'car-dealer-pro' ); ?>:</strong> <?php echo esc_html( get_post_meta( get_the_ID(), 'vin', true ) ); ?></li>
                    <li><strong><?php _e( 'Fuel', 'car-dealer-pro' ); ?>:</strong> <?php echo esc_html( get_post_meta( get_the_ID(), 'fuel', true ) ); ?></li>
                </ul>
            </section>

            <aside class="sidebar">
                <h2><?php _e( 'Contact about this car', 'car-dealer-pro' ); ?></h2>
                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <?php wp_nonce_field( 'cdt_inquiry', '_cdt_nonce' ); ?>
                    <input type="hidden" name="action" value="cdt_inquiry">
                    <input type="hidden" name="car_id" value="<?php echo esc_attr( get_the_ID() ); ?>">
                    <label><?php _e( 'Name', 'car-dealer-pro' ); ?><input name="name" required></label>
                    <label><?php _e( 'Email', 'car-dealer-pro' ); ?><input name="email" type="email" required></label>
                    <label><?php _e( 'Message', 'car-dealer-pro' ); ?><textarea name="message" rows="4" required></textarea></label>
                    <button class="btn btn-primary" type="submit"><?php _e( 'Send inquiry', 'car-dealer-pro' ); ?></button>
                </form>
            </aside>
        </article>
    </div>
<?php endwhile;
get_footer();
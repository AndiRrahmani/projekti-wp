<?php
<?php
// ...existing code...
get_header();
?>
<div class="container">
    <section class="hero">
        <div class="lead">
            <h1><?php bloginfo( 'name' ); ?></h1>
            <nav>
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => '' ) ); ?>
            </nav>
        </div>
        <form method="get" class="search" role="search">
            <input name="s" type="text" placeholder="<?php esc_attr_e( 'Search cars, keywords...', 'car-dealer-pro' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>">
            <?php
            // Make filter selects from taxonomies
            $makes = get_terms( array( 'taxonomy' => 'make', 'hide_empty' => true ) );
            if ( $makes && ! is_wp_error( $makes ) ) {
                echo '<select name="make"><option value="">' . esc_html__( 'All makes', 'car-dealer-pro' ) . '</option>';
                $sel = sanitize_text_field( wp_unslash( $_GET['make'] ?? '' ) );
                foreach ( $makes as $m ) {
                    printf( '<option value="%s"%s>%s</option>', esc_attr( $m->slug ), selected( $sel, $m->slug, false ), esc_html( $m->name ) );
                }
                echo '</select>';
            }
            ?>
            <input type="number" name="price_min" placeholder="<?php esc_attr_e( 'Min price', 'car-dealer-pro' ); ?>" value="<?php echo esc_attr( $_GET['price_min'] ?? '' ); ?>">
            <input type="number" name="price_max" placeholder="<?php esc_attr_e( 'Max price', 'car-dealer-pro' ); ?>" value="<?php echo esc_attr( $_GET['price_max'] ?? '' ); ?>">
            <button class="btn btn-primary" type="submit"><?php _e( 'Filter', 'car-dealer-pro' ); ?></button>
        </form>
    </section>

    <div class="content-row">
        <main>
            <?php
            // Build query for cars
            $paged = max( 1, get_query_var( 'paged' ) );
            $args = array(
                'post_type' => 'car',
                'post_status' => 'publish',
                'posts_per_page' => 12,
                'paged' => $paged,
            );

            // tax_query
            $tax_query = array();
            if ( ! empty( $_GET['make'] ) ) {
                $tax_query[] = array(
                    'taxonomy' => 'make',
                    'field' => 'slug',
                    'terms' => sanitize_text_field( wp_unslash( $_GET['make'] ) ),
                );
            }
            if ( $tax_query ) $args['tax_query'] = $tax_query;

            // meta_query for price range
            $meta_query = array( 'relation' => 'AND' );
            if ( isset( $_GET['price_min'] ) && $_GET['price_min'] !== '' ) {
                $meta_query[] = array( 'key' => 'price', 'value' => absint( $_GET['price_min'] ), 'compare' => '>=', 'type' => 'NUMERIC' );
            }
            if ( isset( $_GET['price_max'] ) && $_GET['price_max'] !== '' ) {
                $meta_query[] = array( 'key' => 'price', 'value' => absint( $_GET['price_max'] ), 'compare' => '<=', 'type' => 'NUMERIC' );
            }
            if ( count( $meta_query ) > 1 ) $args['meta_query'] = $meta_query;

            $loop = new WP_Query( $args );

            if ( $loop->have_posts() ) : ?>
                <div class="car-grid">
                <?php while ( $loop->have_posts() ) : $loop->the_post();
                    get_template_part( 'template-parts/content', 'car' );
                endwhile; ?>
                </div>

                <nav class="pagination">
                    <?php
                    echo paginate_links( array(
                        'total' => $loop->max_num_pages,
                        'current' => $paged,
                    ) );
                    ?>
                </nav>
            <?php else: ?>
                <p><?php _e( 'No cars found.', 'car-dealer-pro' ); ?></p>
            <?php endif;
            wp_reset_postdata();
            ?>
        </main>

        <aside class="sidebar">
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
            <h2><?php _e( 'Quick Contact', 'car-dealer-pro' ); ?></h2>
            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                <?php wp_nonce_field( 'cdt_inquiry', '_cdt_nonce' ); ?>
                <input type="hidden" name="action" value="cdt_inquiry">
                <label><?php _e( 'Name', 'car-dealer-pro' ); ?><input name="name" required></label>
                <label><?php _e( 'Email', 'car-dealer-pro' ); ?><input name="email" type="email" required></label>
                <label><?php _e( 'Message', 'car-dealer-pro' ); ?><textarea name="message" rows="4" required></textarea></label>
                <button class="btn btn-primary" type="submit"><?php _e( 'Send', 'car-dealer-pro' ); ?></button>
            </form>
        </aside>
    </div>
</div>
<?php get_footer(); ?>
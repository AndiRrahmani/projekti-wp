<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register the Projekti Settings page under Appearance
 */
function projekti_admin_menu() {
    add_theme_page(
        __( 'Parametrat Projekti', 'projekti-car-repair' ),
        __( 'Parametrat Projekti', 'projekti-car-repair' ),
        'manage_options',
        'projekti-settings',
        'projekti_settings_page'
    );
}
add_action( 'admin_menu', 'projekti_admin_menu' );


/**
 * Handle save action from admin_post
 */
function projekti_handle_save_settings() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( __( 'Insufficient permissions', 'projekti-car-repair' ) );
    }
    if ( empty( $_POST['projekti_settings_nonce'] ) || ! wp_verify_nonce( $_POST['projekti_settings_nonce'], 'projekti_settings_save' ) ) {
        wp_die( __( 'Security check failed', 'projekti-car-repair' ) );
    }

    // Services
    $services = array();
    if ( isset( $_POST['services_title'] ) && is_array( $_POST['services_title'] ) ) {
        $titles = $_POST['services_title'];
        $descs = isset( $_POST['services_description'] ) && is_array( $_POST['services_description'] ) ? $_POST['services_description'] : array();
        $prices = isset( $_POST['services_price'] ) && is_array( $_POST['services_price'] ) ? $_POST['services_price'] : array();
        for ( $i = 0; $i < count( $titles ); $i++ ) {
            $title = sanitize_text_field( wp_unslash( $titles[ $i ] ) );
            $desc = isset( $descs[ $i ] ) ? sanitize_textarea_field( wp_unslash( $descs[ $i ] ) ) : '';
            $price = isset( $prices[ $i ] ) ? preg_replace( '/[^0-9\.]/', '', wp_unslash( $prices[ $i ] ) ) : '';
            if ( $title ) {
                $services[] = array( 'title' => $title, 'description' => $desc, 'price' => $price );
            }
        }
    }

    // Packages
    $packages = array();
    if ( isset( $_POST['packages_title'] ) && is_array( $_POST['packages_title'] ) ) {
        $ptitles = $_POST['packages_title'];
        $pdescs = isset( $_POST['packages_description'] ) && is_array( $_POST['packages_description'] ) ? $_POST['packages_description'] : array();
        $pprices = isset( $_POST['packages_price'] ) && is_array( $_POST['packages_price'] ) ? $_POST['packages_price'] : array();
        for ( $i = 0; $i < count( $ptitles ); $i++ ) {
            $title = sanitize_text_field( wp_unslash( $ptitles[ $i ] ) );
            $desc = isset( $pdescs[ $i ] ) ? sanitize_textarea_field( wp_unslash( $pdescs[ $i ] ) ) : '';
            $price = isset( $pprices[ $i ] ) ? preg_replace( '/[^0-9\.]/', '', wp_unslash( $pprices[ $i ] ) ) : '';
            if ( $title ) {
                $packages[] = array( 'title' => $title, 'description' => $desc, 'price' => $price );
            }
        }
    }

    update_option( 'projekti_services', $services );
    update_option( 'projekti_packages', $packages );

    $redirect = add_query_arg( 'projekti_settings_saved', '1', wp_get_referer() ? wp_get_referer() : admin_url( 'themes.php?page=projekti-settings' ) );
    wp_safe_redirect( $redirect );
    exit;
}
add_action( 'admin_post_projekti_save_settings', 'projekti_handle_save_settings' );


/**
 * Output the settings page
 */
function projekti_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $services = function_exists( 'projekti_get_services' ) ? projekti_get_services() : array();
    $packages = function_exists( 'projekti_get_packages' ) ? projekti_get_packages() : array();
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Parametrat Projekti', 'projekti-car-repair' ); ?></h1>
        <?php if ( isset( $_GET['projekti_settings_saved'] ) ): ?>
            <div class="updated notice is-dismissible"><p><?php esc_html_e( 'Parametrat u ruajtën.', 'projekti-car-repair' ); ?></p></div>
        <?php endif; ?>

        <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <?php wp_nonce_field( 'projekti_settings_save', 'projekti_settings_nonce' ); ?>
            <input type="hidden" name="action" value="projekti_save_settings">

            <h2><?php esc_html_e( 'Sherbimet', 'projekti-car-repair' ); ?></h2>
            <p class="description">Shtoni, hiqni ose redaktoni shërbimet. Lini rreshtat bosh nëse nuk përdoren.</p>
            <table class="widefat projekti-table" id="projekti-services-table">
                <thead><tr><th style="width:30%">Title</th><th>Description</th><th style="width:12%">Price</th><th style="width:6%">&nbsp;</th></tr></thead>
                <tbody>
                <?php if ( ! empty( $services ) ): foreach ( $services as $s ): ?>
                    <tr>
                        <td><input type="text" name="services_title[]" value="<?php echo esc_attr( $s['title'] ); ?>" class="widefat"></td>
                        <td><textarea name="services_description[]" class="widefat" rows="2"><?php echo esc_textarea( $s['description'] ); ?></textarea></td>
                        <td><input type="text" name="services_price[]" value="<?php echo esc_attr( $s['price'] ); ?>" class="widefat"></td>
                        <td><button type="button" class="button projekti-remove-row">Remove</button></td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
            <p><button type="button" class="button" id="projekti-add-service">Add Service</button></p>

            <h2><?php esc_html_e( 'Paketat', 'projekti-car-repair' ); ?></h2>
            <table class="widefat projekti-table" id="projekti-packages-table">
                <thead><tr><th style="width:30%">Title</th><th>Description</th><th style="width:12%">Price</th><th style="width:6%">&nbsp;</th></tr></thead>
                <tbody>
                <?php if ( ! empty( $packages ) ): foreach ( $packages as $p ): ?>
                    <tr>
                        <td><input type="text" name="packages_title[]" value="<?php echo esc_attr( $p['title'] ); ?>" class="widefat"></td>
                        <td><textarea name="packages_description[]" class="widefat" rows="2"><?php echo esc_textarea( $p['description'] ); ?></textarea></td>
                        <td><input type="text" name="packages_price[]" value="<?php echo esc_attr( $p['price'] ); ?>" class="widefat"></td>
                        <td><button type="button" class="button projekti-remove-row">Remove</button></td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
            <p><button type="button" class="button" id="projekti-add-package">Add Package</button></p>

            <p class="submit"><button type="submit" class="button button-primary">Ruaj ndryshimet</button></p>
        </form>
    </div>

    <script>
    (function(){
        function createRow(cols){
            var tr = document.createElement('tr');
            tr.innerHTML = cols;
            return tr;
        }

        document.getElementById('projekti-add-service').addEventListener('click', function(){
            var cols = '<td><input type="text" name="services_title[]" class="widefat"></td>'+
                       '<td><textarea name="services_description[]" class="widefat" rows="2"></textarea></td>'+
                       '<td><input type="text" name="services_price[]" class="widefat"></td>'+
                       '<td><button type="button" class="button projekti-remove-row">Remove</button></td>';
            document.querySelector('#projekti-services-table tbody').appendChild(createRow(cols));
        });

        document.getElementById('projekti-add-package').addEventListener('click', function(){
            var cols = '<td><input type="text" name="packages_title[]" class="widefat"></td>'+
                       '<td><textarea name="packages_description[]" class="widefat" rows="2"></textarea></td>'+
                       '<td><input type="text" name="packages_price[]" class="widefat"></td>'+
                       '<td><button type="button" class="button projekti-remove-row">Remove</button></td>';
            document.querySelector('#projekti-packages-table tbody').appendChild(createRow(cols));
        });

        document.addEventListener('click', function(e){
            if ( e.target && e.target.classList.contains('projekti-remove-row') ){
                var tr = e.target.closest('tr');
                if ( tr ) tr.parentNode.removeChild(tr);
            }
        });
    })();
    </script>

    <style>
    .projekti-table td{vertical-align:top}
    </style>

    <?php
}

<?php
// This file defines theme options and settings for the car dealer theme.

if ( ! function_exists( 'car_dealer_theme_options' ) ) {
    function car_dealer_theme_options() {
        // Add theme options page
        add_menu_page(
            'Car Dealer Options',
            'Car Dealer',
            'manage_options',
            'car-dealer-options',
            'car_dealer_options_page',
            'dashicons-car',
            60
        );
    }
    add_action( 'admin_menu', 'car_dealer_theme_options' );

    function car_dealer_options_page() {
        ?>
        <div class="wrap">
            <h1>Car Dealer Theme Options</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields( 'car_dealer_options_group' );
                do_settings_sections( 'car_dealer_options_group' );
                ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Contact Email</th>
                        <td><input type="email" name="car_dealer_contact_email" value="<?php echo esc_attr( get_option('car_dealer_contact_email') ); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Phone Number</th>
                        <td><input type="text" name="car_dealer_phone_number" value="<?php echo esc_attr( get_option('car_dealer_phone_number') ); ?>" /></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    function car_dealer_register_settings() {
        register_setting( 'car_dealer_options_group', 'car_dealer_contact_email' );
        register_setting( 'car_dealer_options_group', 'car_dealer_phone_number' );
    }
    add_action( 'admin_init', 'car_dealer_register_settings' );
}
?>
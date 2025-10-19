<?php
<?php
// ...existing code...
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'customize_register', function( $wp_customize ){
    $wp_customize->add_section( 'cdt_general', array(
        'title' => __( 'Car Dealer Settings', 'car-dealer-pro' ),
        'priority' => 30,
    ) );

    $wp_customize->add_setting( 'dealer_contact_email', array(
        'default' => get_option( 'admin_email' ),
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'dealer_contact_email', array(
        'label' => __( 'Contact email', 'car-dealer-pro' ),
        'section' => 'cdt_general',
        'type' => 'email',
    ) );

    $wp_customize->add_setting( 'dealer_accent', array(
        'default' => '#1e6fd8',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dealer_accent', array(
        'label' => __( 'Accent color', 'car-dealer-pro' ),
        'section' => 'cdt_general',
    ) ) );
});
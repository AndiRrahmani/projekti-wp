<?php
function car_dealer_customize_register($wp_customize) {
    // Add a section for the car dealer settings
    $wp_customize->add_section('car_dealer_settings', array(
        'title'    => __('Car Dealer Settings', 'car-dealer-theme'),
        'priority' => 30,
    ));

    // Add a setting for the dealership logo
    $wp_customize->add_setting('dealership_logo', array(
        'default'   => '',
        'transport' => 'refresh',
    ));

    // Add a control for the dealership logo
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'dealership_logo_control', array(
        'label'    => __('Dealership Logo', 'car-dealer-theme'),
        'section'  => 'car_dealer_settings',
        'settings' => 'dealership_logo',
    )));

    // Add a setting for the dealership phone number
    $wp_customize->add_setting('dealership_phone', array(
        'default'   => '',
        'transport' => 'refresh',
    ));

    // Add a control for the dealership phone number
    $wp_customize->add_control('dealership_phone_control', array(
        'label'    => __('Dealership Phone Number', 'car-dealer-theme'),
        'section'  => 'car_dealer_settings',
        'settings' => 'dealership_phone',
        'type'     => 'text',
    ));
}

add_action('customize_register', 'car_dealer_customize_register');
?>
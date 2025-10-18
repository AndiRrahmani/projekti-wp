<?php
// functions.php

// Enqueue styles and scripts
function car_dealer_theme_enqueue_scripts() {
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/css/main.css');
    wp_enqueue_script('jquery');
}

add_action('wp_enqueue_scripts', 'car_dealer_theme_enqueue_scripts');

// Theme support
function car_dealer_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('custom-background');
}

add_action('after_setup_theme', 'car_dealer_theme_setup');

// Register custom post types
require get_template_directory() . '/inc/post-types.php';

// Include customizer options
require get_template_directory() . '/inc/customizer.php';

// Include theme options
require get_template_directory() . '/inc/theme-options.php';

// Include helper functions
require get_template_directory() . '/inc/helpers.php';
?>
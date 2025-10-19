<?php
<?php
// ...existing code...
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'CDT_THEME_DIR', get_template_directory() );

require_once CDT_THEME_DIR . '/inc/post-types.php';
require_once CDT_THEME_DIR . '/inc/customizer.php';
require_once CDT_THEME_DIR . '/inc/helpers.php';

/* Theme setup */
add_action( 'after_setup_theme', function(){
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'car-hero', 1600, 900, true );
    add_image_size( 'car-thumb', 600, 400, true );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'car-dealer-pro' ),
        'footer'  => __( 'Footer Menu', 'car-dealer-pro' ),
    ) );
});

/* Enqueue styles (no JS) */
add_action( 'wp_enqueue_scripts', function(){
    wp_enqueue_style( 'car-dealer-style', get_template_directory_uri() . '/assets/css/main.css', array(), filemtime( CDT_THEME_DIR . '/assets/css/main.css' ) );
    wp_enqueue_style( 'car-dealer-style-css', get_stylesheet_uri(), array(), filemtime( CDT_THEME_DIR . '/style.css' ) );
});

/* Register widgets area */
add_action( 'widgets_init', function(){
    register_sidebar( array(
        'name' => __( 'Sidebar', 'car-dealer-pro' ),
        'id' => 'sidebar-1',
        'before_widget' => '<aside class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
});

/* Simple inquiry handler (server-side, secure) */
add_action( 'admin_post_nopriv_cdt_inquiry', 'cdt_handle_inquiry' );
add_action( 'admin_post_cdt_inquiry',        'cdt_handle_inquiry' );

function cdt_handle_inquiry(){
    if ( ! isset( $_POST['_cdt_nonce'] ) || ! wp_verify_nonce( wp_unslash($_POST['_cdt_nonce']), 'cdt_inquiry' ) ) {
        wp_die( __( 'Security check failed', 'car-dealer-pro' ), 403 );
    }
    $name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
    $email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
    $message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );
    $car_id  = absint( $_POST['car_id'] ?? 0 );

    $subject = sprintf( '[Inquiry] %s - %s', get_bloginfo( 'name' ), $car_id ? get_the_title( $car_id ) : 'General' );
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message\n\nCar ID: $car_id\nSite: " . home_url();

    $to = get_theme_mod( 'dealer_contact_email', get_option( 'admin_email' ) );
    wp_mail( $to, wp_specialchars_decode( $subject ), $body, array( 'Content-Type: text/plain; charset=UTF-8' ) );

    wp_safe_redirect( wp_get_referer() ? wp_get_referer() . '#inquiry-sent' : home_url() );
    exit;
}
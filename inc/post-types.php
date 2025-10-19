<?php
<?php
// ...existing code...
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'init', function(){
    $labels = array(
        'name'               => __( 'Cars', 'car-dealer-pro' ),
        'singular_name'      => __( 'Car', 'car-dealer-pro' ),
        'add_new_item'       => __( 'Add New Car', 'car-dealer-pro' ),
        'edit_item'          => __( 'Edit Car', 'car-dealer-pro' ),
        'new_item'           => __( 'New Car', 'car-dealer-pro' ),
        'view_item'          => __( 'View Car', 'car-dealer-pro' ),
        'search_items'       => __( 'Search Cars', 'car-dealer-pro' ),
    );

    register_post_type( 'car', array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'cars' ),
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest' => false,
        'menu_icon' => 'dashicons-car',
    ) );

    register_taxonomy( 'make', 'car', array(
        'label' => __( 'Make', 'car-dealer-pro' ),
        'hierarchical' => true,
        'rewrite' => array( 'slug' => 'make' ),
    ) );

    register_taxonomy( 'model', 'car', array(
        'label' => __( 'Model', 'car-dealer-pro' ),
        'hierarchical' => false,
        'rewrite' => array( 'slug' => 'model' ),
    ) );
});

/* Register standardized meta keys (server-side usage) */
add_action( 'init', function(){
    register_post_meta( 'car', 'price', array( 'single' => true, 'type' => 'number', 'show_in_rest' => false ) );
    register_post_meta( 'car', 'year', array( 'single' => true, 'type' => 'number', 'show_in_rest' => false ) );
    register_post_meta( 'car', 'mileage', array( 'single' => true, 'type' => 'string', 'show_in_rest' => false ) );
    register_post_meta( 'car', 'fuel', array( 'single' => true, 'type' => 'string', 'show_in_rest' => false ) );
    register_post_meta( 'car', 'vin', array( 'single' => true, 'type' => 'string', 'show_in_rest' => false ) );
});

/* Admin columns */
add_filter( 'manage_edit-car_columns', function( $cols ){
    $cols = array(
        'cb' => '<input type="checkbox" />',
        'thumb' => __( 'Photo', 'car-dealer-pro' ),
        'title' => __( 'Title', 'car-dealer-pro' ),
        'price' => __( 'Price', 'car-dealer-pro' ),
        'make' => __( 'Make', 'car-dealer-pro' ),
        'year' => __( 'Year', 'car-dealer-pro' ),
        'date' => __( 'Date', 'car-dealer-pro' ),
    );
    return $cols;
});
add_action( 'manage_car_posts_custom_column', function( $column, $post_id ){
    if ( 'thumb' === $column ) {
        echo get_the_post_thumbnail( $post_id, array(80,60) );
    } elseif ( 'price' === $column ) {
        $p = get_post_meta( $post_id, 'price', true );
        echo $p ? esc_html( number_format_i18n( $p ) ) : '-';
    } elseif ( 'make' === $column ) {
        $terms = wp_get_post_terms( $post_id, 'make', array( 'fields' => 'names' ) );
        echo $terms ? esc_html( implode( ', ', $terms ) ) : '-';
    } elseif ( 'year' === $column ) {
        echo esc_html( get_post_meta( $post_id, 'year', true ) ?: '-' );
    }
}, 10, 2 );
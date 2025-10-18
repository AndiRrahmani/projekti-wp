<?php
// Register Custom Post Type for Cars
function car_dealer_register_car_post_type() {
    $labels = array(
        'name'                  => _x('Cars', 'Post Type General Name', 'car-dealer-theme'),
        'singular_name'         => _x('Car', 'Post Type Singular Name', 'car-dealer-theme'),
        'menu_name'             => __('Cars', 'car-dealer-theme'),
        'name_admin_bar'        => __('Car', 'car-dealer-theme'),
        'archives'              => __('Car Archives', 'car-dealer-theme'),
        'attributes'            => __('Car Attributes', 'car-dealer-theme'),
        'parent_item_colon'     => __('Parent Car:', 'car-dealer-theme'),
        'all_items'             => __('All Cars', 'car-dealer-theme'),
        'add_new_item'          => __('Add New Car', 'car-dealer-theme'),
        'add_new'               => __('Add New', 'car-dealer-theme'),
        'new_item'              => __('New Car', 'car-dealer-theme'),
        'edit_item'             => __('Edit Car', 'car-dealer-theme'),
        'update_item'           => __('Update Car', 'car-dealer-theme'),
        'view_item'             => __('View Car', 'car-dealer-theme'),
        'view_items'            => __('View Cars', 'car-dealer-theme'),
        'search_items'          => __('Search Cars', 'car-dealer-theme'),
        'not_found'             => __('Not found', 'car-dealer-theme'),
        'not_found_in_trash'    => __('Not found in Trash', 'car-dealer-theme'),
    );

    $args = array(
        'label'                 => __('Car', 'car-dealer-theme'),
        'description'           => __('Post Type for Cars', 'car-dealer-theme'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'              => true,
        'show_in_menu'         => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'rewrite'               => array('slug' => 'cars'),
    );

    register_post_type('car', $args);
}

add_action('init', 'car_dealer_register_car_post_type');
?>
<?php
// Minimal functions for Projekti Car Repair theme
// Load centralized includes
require_once get_template_directory() . '/inc/services.php';
// Admin includes
if ( is_admin() ) {
    require_once get_template_directory() . '/inc/admin.php';
}
if ( ! function_exists( 'projekti_enqueue_assets' ) ) {
    function projekti_enqueue_assets() {
        // Load a clean system font stack (no external requests) and theme stylesheet
        wp_enqueue_style( 'projekti-style', get_stylesheet_uri(), array(), '1.2' );
    }
    add_action( 'wp_enqueue_scripts', 'projekti_enqueue_assets' );
}

// Minimal theme supports
add_theme_support( 'title-tag' );

// Additional supports: custom logo and menu
add_theme_support( 'custom-logo' );
register_nav_menus( array( 'primary' => __( 'Primary Menu', 'projekti-car-repair' ) ) );

// Add wp_body_open compatibility
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

// Handle the static contact form (no DB). Uses wp_mail and redirects back with a query flag.
if ( ! function_exists( 'projekti_handle_contact_form' ) ) {
    function projekti_handle_contact_form() {
        if ( 'POST' === $_SERVER['REQUEST_METHOD'] && ! empty( $_POST['projekti_contact_nonce'] ) ) {
            // Verify nonce
            if ( ! function_exists( 'wp_verify_nonce' ) || ! wp_verify_nonce( $_POST['projekti_contact_nonce'], 'projekti_contact' ) ) {
                return;
            }

            $name = isset( $_POST['name'] ) ? sanitize_text_field( wp_strip_all_tags( $_POST['name'] ) ) : '';
            $email = isset( $_POST['email'] ) ? sanitize_email( wp_strip_all_tags( $_POST['email'] ) ) : '';
            $message = isset( $_POST['message'] ) ? sanitize_textarea_field( $_POST['message'] ) : '';

            $subject = 'Website Contact: ' . ( $name ? $name : 'Visitor' );
            $body = "Name: " . $name . "\nEmail: " . $email . "\n\nMessage:\n" . $message;
            $to = get_option( 'admin_email' );
            $headers = array( 'Content-Type: text/plain; charset=UTF-8' );
            if ( is_email( $email ) ) {
                $headers[] = 'Reply-To: ' . $email;
            }

            // Attempt to send mail
            $sent = false;
            if ( function_exists( 'wp_mail' ) ) {
                $sent = wp_mail( $to, $subject, $body, $headers );
            }

            // Redirect back with status in query string (no DB used)
            $referer = wp_get_referer();
            if ( ! $referer ) {
                $referer = home_url();
            }
            $status = $sent ? 'success' : 'fail';
            $redirect = add_query_arg( 'projekti_contact', $status, $referer );
            wp_safe_redirect( $redirect );
            exit;
        }
    }
    add_action( 'init', 'projekti_handle_contact_form' );
}

<?php
<?php
// ...existing code...
if ( ! defined( 'ABSPATH' ) ) exit;

function cdt_price( $post_id = 0 ) {
    $post_id = $post_id ?: get_the_ID();
    $p = get_post_meta( $post_id, 'price', true );
    if ( ! $p ) return '';
    return esc_html( number_format_i18n( $p ) );
}

function cdt_get( $key, $default = '' ) {
    $v = get_theme_mod( $key );
    return $v === null ? $default : $v;
}

function cdt_esc_attr( $v ) { return esc_attr( $v ); }
function cdt_esc_html( $v ) { return esc_html( $v ); }
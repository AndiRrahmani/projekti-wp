<?php
// This file contains helper functions used throughout the theme.

if ( ! function_exists( 'cd_get_car_price' ) ) {
    function cd_get_car_price( $price ) {
        return '$' . number_format( $price, 2 );
    }
}

if ( ! function_exists( 'cd_get_car_year' ) ) {
    function cd_get_car_year( $year ) {
        return esc_html( $year );
    }
}

if ( ! function_exists( 'cd_get_car_mileage' ) ) {
    function cd_get_car_mileage( $mileage ) {
        return number_format( $mileage ) . ' miles';
    }
}

if ( ! function_exists( 'cd_get_car_condition' ) ) {
    function cd_get_car_condition( $condition ) {
        return esc_html( ucfirst( $condition ) );
    }
}

if ( ! function_exists( 'cd_get_car_image' ) ) {
    function cd_get_car_image( $image_url ) {
        return esc_url( $image_url );
    }
}
?>
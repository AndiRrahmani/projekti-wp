<?php
// Centralized services and packages for Projekti theme.
// Functions return arrays from options if set, otherwise default hardcoded arrays.

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function projekti_services_defaults() {
    return array(
    array('title' => 'Ndryshim i vajit', 'description' => 'Ndryshim komplet i vajit sintetik me ndërrim filtri.', 'price' => '49.99'),
        array('title' => 'Inspektim dhe Ndërrim frenash', 'description' => 'Inspektim i sistemit të frenave dhe ndërrim i këpucëve kur është e nevojshme.', 'price' => '129.00'),
        array('title' => 'Rrotullim dhe Balancim goma', 'description' => 'Rrotullim i të gjitha gomave dhe balancim për vozitje të qetë.', 'price' => '39.00'),
        array('title' => 'Kontroll dhe Ndërrim baterie', 'description' => 'Testim i baterisë dhe ndërrim profesional.', 'price' => '89.00'),
        array('title' => 'Diagnostikë motori', 'description' => 'Diagnostikë kompjuterike dhe zgjidhje e problemeve për dritat e motorit.', 'price' => '69.00'),
        array('title' => 'Servis i kondicionerit', 'description' => 'Kontroll i kondicionerit, mbushje gazesh dhe inspektim për rrjedhje.', 'price' => '79.00'),
    );
}

function projekti_packages_defaults() {
    return array(
    array('title' => 'Kujdes Bazë', 'description' => 'Ndryshim vajti, kontroll goma, inspektim 15-pikësh.', 'price' => '59.00'),
        array('title' => 'Shërbim Standard', 'description' => 'Përfshin Kujdes Bazë + inspektim frenash dhe test baterie.', 'price' => '129.00'),
        array('title' => 'Shërbim i Plotë', 'description' => 'Kontroll i plotë, plotësim lëngjesh, diagnostikë dhe riparim prioritizuar.', 'price' => '249.00'),
    );
}

/**
 * Get services array. Returns option if available, otherwise defaults.
 * @return array
 */
function projekti_get_services() {
    $opt = get_option( 'projekti_services' );
    if ( ! empty( $opt ) && is_array( $opt ) ) {
        return $opt;
    }
    return projekti_services_defaults();
}

/**
 * Get pricing packages array. Returns option if available, otherwise defaults.
 * @return array
 */
function projekti_get_packages() {
    $opt = get_option( 'projekti_packages' );
    if ( ! empty( $opt ) && is_array( $opt ) ) {
        return $opt;
    }
    return projekti_packages_defaults();
}

/**
 * Create a URL-friendly slug from a title.
 */
function projekti_make_slug( $title ) {
    $slug = sanitize_title( $title );
    return $slug;
}

/**
 * Find a service by slug. Returns array or null.
 */
function projekti_get_service_by_slug( $slug ) {
    $services = projekti_get_services();
    foreach ( $services as $s ) {
        if ( projekti_make_slug( $s['title'] ) === $slug ) {
            return $s;
        }
    }
    return null;
}

/**
 * Find a package by slug. Returns array or null.
 */
function projekti_get_package_by_slug( $slug ) {
    $packages = projekti_get_packages();
    foreach ( $packages as $p ) {
        if ( projekti_make_slug( $p['title'] ) === $slug ) {
            return $p;
        }
    }
    return null;
}

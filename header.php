<?php
<?php
// ...existing code...
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header>
    <div class="container">
        <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <span class="brand-mark" aria-hidden="true"></span>
            <h1><?php bloginfo( 'name' ); ?></h1>
        </a>
        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false ) ); ?>
    </div>
</header>
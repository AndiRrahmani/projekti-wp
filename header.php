<?php
// Minimal header for Projekti Car Repair theme
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php bloginfo('name'); ?><?php wp_title(' - '); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <div class="site">
    <header class="header">
      <div class="brand">
        <div class="logo">PR</div>
        <div>
          <div style="font-weight:700"><?php bloginfo('name'); ?></div>
          <div style="font-size:12px;color:#6b7280">Puntoria juaj e besueshme e riparimeve</div>
        </div>
      </div>
      <nav class="nav">
        <a href="#services">Sherbimet</a>
        <a href="#pricing">Çmimet</a>
        <a href="#contact">Kontakti</a>
      </nav>
    </header>
    
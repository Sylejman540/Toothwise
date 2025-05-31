<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <header class="site-header">
  <div class="container header-inner">
    <div class="site-branding">
      <img src="http://localhost/Wordpress/wordpress/wp-content/uploads/2025/05/logo-5.png" alt="Toothwise Logo" class="logo">
    </div>
    <nav class="main-nav">
      <?php
        wp_nav_menu([
          'theme_location' => 'primary',
          'menu_class' => 'nav-menu',
          'container' => false
        ]);
      ?>
    </nav>
    <div class="header-search">
      <?php get_search_form(); ?>
    </div>
  </div>
</header>

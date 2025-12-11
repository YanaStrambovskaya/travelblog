<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <!-- language_attributes() - Wordpress function that prints  attr on the  -->
    <!-- HTML tag to define the language and text direction of the site.  -->
    <!-- <html lang="en-US"> -->
    <!-- It comes from Settings → General → Site Language -->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <!-- prints the character encoding for the site. Usually UTF-8 -->
     <!-- It tells browser how to correctly display the text -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- Is a wordpress function that prints CSS classes inside of body tag based on the current page -->
    <!-- WordPress automatically detects:
     - page type (home, single post, archive, search, 404, etc.);
     - post type (post, page, custom post types);
     - post ID;
     - template used;
     - user login status;
     - custom post type;
     - custom taxonomies;
     - body class filters added by your theme or plugins. -->
<header class="site-header">
    <div class="logo">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php bloginfo( 'name' ); ?>
        </a>
    </div>

    <nav class="main-nav">
        <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'main menu'
                )
            )
        ?>
        <?php
        // wp_nav_menu( array(
        //     'theme_location' => 'primary',
        //     'container'      => false,
        //     'menu_class'     => 'menu',
        // ) );
        ?>
    </nav>
</header>

<main class="site-main">

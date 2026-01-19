<?php 
    // $theme_uri = get_template_directory_uri();
    // $site_name = get_bloginfo( 'name' ); // outputs (prints) site title of the Wordpress website;
    // $phone_icon = esc_url(get_template_directory_uri() . '/assets/icons/phone-svgrepo-com.svg');
;?>
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

<style>
    /* DELETE!!!!! */
    #wpadminbar {
        display: none;
    }
    :root {
        /* --icon-phone: url('<?php echo $phone_icon; ?>');  */
  }
</style>

<header>
    <div class="hidden visible-tablet visible-desktop">
        <?php get_template_part( 'template-parts/header/topbar' ); ?>
        <?php get_template_part( 'template-parts/header/site-menu' ); ?>
    </div>
    <div class="hidden-tablet hidden-desktop">
        <?php get_template_part( 'template-parts/header/mobile-header' ); ?>
    </div>
</header>

<main class="site-main">

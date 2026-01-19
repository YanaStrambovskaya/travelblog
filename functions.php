
<?php
// <!-- register assets & theme features -->
// <!-- Assets are all static files that the website needs to run or display properly. -->


// <!-- ideas!!! -->
// <!-- Add conditional loading (load JS/CSS only on home page) -->
// <!-- Add Google Fonts preload -->
// <!-- Add versioning automatically based on file modification time -->
// functions.php

define( 'THEME_URI', get_template_directory_uri() );

add_action('wp_enqueue_scripts', function () {
    // Main stylesheet
    wp_enqueue_style(
        'travelblog-style', // A unique name of this stylesheet in Wordpress
        get_stylesheet_uri(),  // URL to style.css
        array(), // dependencies
        wp_get_theme()->get( 'Version' ) // version for cache busting
    );

    // Example: main.js in /public/js/ (if you build assets there)
    wp_enqueue_script(
        'travelblog-main-js',
        get_template_directory_uri() . '/public/js/main.bundle.js',
        array(),
        '1.0', // version
        true // loads it in the footer. Good for performance.
    );

    wp_enqueue_style(
        'travelblog-main-css', // Unique name
        get_template_directory_uri() . '/public/css/style.css', 
        // get_template_directory_uri() - URL path (Browser URL). Returns the public URL. So browser can load files.
        // https://example.com/wp-content/themes/travelblog
        array(), // dependencies
        filemtime( get_template_directory() . '/public/css/style.css' ) // Version number. It forces the browser to refrech a file when it is modified.
        // get_template_directory() - File system path (server path). Returns absolute path on the server.
        // home/user/public_html/wp-content/themes/travelblog
    );
}, 20);

add_action('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', ['post', 'page', 'destination']);  // add your CPTs too if needed
        $query->set('posts_per_page', 6); 
    }
});

function travelblog_setup() {
    add_theme_support( 'title-tag' ); // generate Title tag in the header section. So there is no need to hardcode it manually in the header.php
    add_theme_support( 'post-thumbnails' ); // Enables features images for posts and pages. The Wordpress editor shows Features images panel. It is possible to call the_post_thumbnail() in the template.
    add_theme_support('custom-logo', array(
        'height'      => 160,
        'width'       => 286,
        'flex-width' => true,
        'flex-height' => true,
    )); // Enable custom logo support in the theme. The Wordpress editor shows Custom Logo panel. It is possible to call the_custom_logo() in the template.

    register_nav_menus( // Create a place in the theme where the menu can be assigned
        array(
        'main_menu_left' => __( 'Main Menu Left', 'travelblog' ), //'travelblog' is important for localization.
        'main_menu_right' => __( 'Main Menu Right', 'travelblog' ), //'travelblog' is important for localization.
        'topbar_left'  => __('Topbar Left', 'travelblog'),
        'social_menu' => __('Topbar Right', 'travelblog'),
        'mobile_menu' => __('Mobile menu', 'travelblog'),
        )
    );
}
add_action( 'after_setup_theme', 'travelblog_setup' ); // after_setup_theme is a special Wordpress event that runs after the theme is intializied.

add_filter( 'acf/settings/remove_wp_meta_box', '__return_false' ); // Show ACF (Advanced Custom Field) boxes on the page/post edit screens.


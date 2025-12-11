<!-- register assets & theme features -->
<!-- Assets are all static files that the website needs to run or display properly. -->


<!-- ideas!!! -->
<!-- Add conditional loading (load JS/CSS only on home page) -->
<!-- Add Google Fonts preload -->
<!-- Add versioning automatically based on file modification time -->
<?php
// functions.php

// 1. Theme supports
function travelblog_setup() {
    add_theme_support( 'title-tag' ); // generate Title tag in the header section. So there is no need to hardcode it manually in the header.php
    add_theme_support( 'post-thumbnails' ); // Enables features images for posts and pages. The Wordpress editor shows Features images panel. It is possible to call the_post_thumbnail() in the template.

    register_nav_menus( // Create a place in the theme where the menu can be assigned
        array(
        'main menu' => __( 'Main menu', 'travelblog' ), //'travelblog' is important for localization.
    ) 
);
}
add_action( 'after_setup_theme', 'travelblog_setup' ); // after_setup_theme is a special Wordpress event that runs after the theme is intializied.

// 2. Make the custom theme translatable.
// 2.1 Add text-domain loading (UI text translations); 
// function travelblog_load_textdomain() {
//     load_theme_textdomain(
//         'travelblog',
//         get_template_directory() . '/languages'
//     );
// }
// add_action( 'after_setup_theme', 'travelblog_load_textdomain' );


// 3. Enqueue styles and scripts
function travelblog_theme_style() {
    // Main stylesheet
    wp_enqueue_style(
        'travelblog-style', // A unique name of this stylesheet in Wordpress
        get_stylesheet_uri(),  // URL to style.css
        array(), // dependencies
        wp_get_theme()->get( 'Version' ) // version for cache busting
    );

    // Example: main.js in /public/js/ (if you build assets there)
    // wp_enqueue_script(
    //     'travelblog-main-js',
    //     get_template_directory_uri() . '/public/js/main.js',
    //     array(),
    //     '1.0', // version
    //     true // loads it in the footer. Good for performance.
    // );
}
add_action( 'wp_enqueue_scripts', 'travelblog_theme_style' );

function travelblog_assets() {
    $theme_dir = get_template_directory(); // File system path (server path). Returns absolute path on the server.
    // /home/user/public_html/wp-content/themes/travelblog
    // PHP includes, file operations`
    $theme_uri = get_template_directory_uri(); // URL path (Browser URL). Returns the public URL. So browser can load files.
    // https://example.com/wp-content/themes/travelblog
    // CSS, JS, images in browser

    // Load main Webpack CSS
    $css_path = $theme_dir . '/public/css/style.css'; // A real Server path. Check if the file exists and get modification time.
    $css_uri  = $theme_uri . '/public/css/style.css'; // A public URL for the browser to load.

    if ( file_exists( $css_path ) ) { 
        // wp_enqueue_style(
        //     $handle,        // (string) Unique name for the stylesheet
        //     $src,           // (string|bool) URL to the CSS file
        //     $deps,          // (array) Styles that must be loaded before this one
        //     $ver,           // (string|bool|null) Version number for cache-busting
        //     $media          // (string) Media type (e.g., 'all', 'screen')
        // );
        wp_enqueue_style(
            'travelblog-main-css', // Unique name
            $css_uri, // Public URL
            array(), // dependencies
            filemtime( $css_path ) // Version number. It forces the browser to refrech a file when it is modified.
            // media type. All by default.
        );
    }
}
add_action( 'wp_enqueue_scripts', 'travelblog_assets' );

function travelblog_react_script() {

    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    $react_js = $theme_dir . '/public/js/reactApp.bundle.js';

    if ( file_exists( $react_js ) ) {
        // wp_enqueue_script(
        //     $handle,        // (string) Unique name for the script
        //     $src,           // (string|bool) URL to the JS file
        //     $deps,          // (array) Scripts this file depends on
        //     $ver,           // (string|bool|null) Version number
        //     $in_footer      // (bool) true = load in footer, false = load in <head>
        // );
        wp_enqueue_script(
            'travelblog-react', // Unique name
            $theme_uri . '/public/js/reactApp.bundle.js', // Public URL
            array(), // Dependencies.
            filemtime( $react_js ), // Version number based on file mdification time.
            true // Load in footer for better performance.
        );
    }
}
add_action( 'wp_enqueue_scripts', 'travelblog_react_script' );

add_filter( 'acf/settings/remove_wp_meta_box', '__return_false' ); // Show ACF (Advanced Custom Field) boxes on the page/post edit screens.


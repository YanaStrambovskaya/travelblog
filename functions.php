<?php
// functions.php

// 1. Theme supports
function travelblog_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'travelblog' ),
    ) );
}
add_action( 'after_setup_theme', 'travelblog_setup' );

// 2. Enqueue styles and scripts
function travelblog_scripts() {
    // Main stylesheet
    wp_enqueue_style(
        'travelblog-style',
        get_stylesheet_uri(),  // style.css
        array(),
        wp_get_theme()->get( 'Version' )
    );

    // Example: main.js in /public/js/ (if you build assets there)
    // wp_enqueue_script(
    //     'travelblog-main-js',
    //     get_template_directory_uri() . '/public/js/main.js',
    //     array(),
    //     '1.0',
    //     true
    // );
}
add_action( 'wp_enqueue_scripts', 'travelblog_scripts' );

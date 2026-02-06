
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

    wp_localize_script('travelblog-main-js', 'TravelblogFilters', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('travelblog_filter_form_nonce'),
    ]);

    wp_enqueue_style(
        'travelblog-main-css', // Unique name
        get_template_directory_uri() . '/public/css/main.css', 
        // get_template_directory_uri() - URL path (Browser URL). Returns the public URL. So browser can load files.
        // https://example.com/wp-content/themes/travelblog
        array(), // dependencies
        filemtime( get_template_directory() . '/public/css/main.css' ) // Version number. It forces the browser to refrech a file when it is modified.
        // get_template_directory() - File system path (server path). Returns absolute path on the server.
        // home/user/public_html/wp-content/themes/travelblog
    );
}, 20);

add_action('wp_head', function() {
    // Choose critical file by template (examples)
    $files = [get_stylesheet_directory() . '/public/css/critical/global.css'];
    if (is_front_page()) {
        $files[] = get_stylesheet_directory() . '/public/css/critical/front-page.css';
    }

    $output = '';
    foreach ($files as $file) {
        if (file_exists($file)) {
            $output.= file_get_contents($file) . "\n";
        }
    }
    if ($output) {
        echo "<style id='critical-css'>\n$output\n</style>\n";
    }

    $favicon = get_stylesheet_directory_uri() . '/assets/images/cropped-favicon-img-192x192.jpg';
    ?>
    <link rel="icon" href="<?php echo esc_url($favicon); ?>" sizes="32x32" type="image/png">
    <link rel="apple-touch-icon" href="<?php echo esc_url($favicon); ?>">
    <?php
    // $fontOswald = get_template_directory_uri() . '/fonts/Oswald-SemiBold.woff2';
    // $fontRoboto = get_template_directory_uri() . '/fonts/Roboto-Lightd.woff2';
    
    // echo '<link
    //     rel="preload"
    //     href="'. esc_url($fontOswald) .'"
    //     as="font"
    //     type="font/woff2"
    //     crossorigin
    // >';
    // echo '<link
    //     rel="preload"
    //     href="'. esc_url($fontRoboto) .'"
    //     as="font"
    //     type="font/woff2"
    //     crossorigin
    // >';
    
}, 1);

add_action('pre_get_posts', function ($query) {
    // here we determine how thw WP search works. Specifically to control witch content types arrear in the search results. 
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        // it does not effact the admin area, only main query on the search result page.
        $query->set('post_type', ['post', 'page', 'destination']);  // add your CPTs too if needed
        // it expands search to include pages _ CPT, not only posts.
        // by default wP search includes only posts.
        $query->set('posts_per_page', 6); 
    }
});

function travelblog_setup() {
    add_theme_support( 'title-tag' ); // generate Title tag in the header section. So there is no need to hardcode it manually in the header.php
    add_theme_support( 'post-thumbnails' ); // Enables features images for posts and pages. The Wordpress editor shows Features images panel. It is possible to call the_post_thumbnail() in the template.
    add_theme_support('custom-logo', array(
        'height'      => 160,
        'width'       => 286,
        'flex-width' => true, // allow width more than 286px;
        'flex-height' => true, // allow height more than 160px;
    )); // Enable custom logo support in the theme. The Wordpress editor shows Custom Logo panel. It is possible to call the_custom_logo() in the template.
    add_theme_support('responsive-embeds'); // Makes embedded content responsive automatically: videos, maps, etc. Embeds can overflow or break layouts.
    add_theme_support('align-wide'); // Enable wide and full alignments for Gutenberg blocks. Perfect for hero banners and edge-to-edge blocks.
    add_theme_support('html5' , [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ]);
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

add_action('widgets_init', function () {
    // %1$s → widget ID
    // %2$s → widget CSS classes
    $common = [
        'before_widget' => '<div class="footer-widget %2$s">', // HTML wrapper before each widget. %2$s = WordPress placeholder for widget CSS classes (like widget_text).
        'after_widget'  => '</div>', // HTML wrapper after each widget.
        'before_title'  => '<h4 class="footer__title">', // Wraps widget titles inside <h4> with a custom class.
        'after_title'   => '</h4>',
    ]; // Defines a reusable array of shared settings for all widget areas.

    register_sidebar($common + [ // Each register_sidebar() creates one widget area visible in WP Admin → Appearance → Widgets.
        'name' => __('Logo', 'travelblog'),
        'id'   => 'footer_top_logo_widget',
        'description' => __('Logo widget.', 'travelblog'),
    ]);

    register_sidebar($common + [
        'name' => __('Footer welcome text', 'travelblog'),
        'id'   => 'footer_intro_widget',
        'description' => __('Welcome text widget.', 'travelblog'),
    ]);
    register_sidebar($common + [
        'name' => __('About', 'travelblog'),
        'id'   => 'about_widget',
        'description' => __('About widget.', 'travelblog'),
    ]);
    register_sidebar($common + [
        'name' => __('Subscribe', 'travelblog'),
        'id'   => 'subscribe_widget',
        'description' => __('Subscribe widget.', 'travelblog'),
    ]);
    register_sidebar($common + [
        'name' => __('Recent news s', 'travelblog'),
        'id'   => 'recent_news_widget',
        'description' => __('Recent news widget.', 'travelblog'),
    ]);
    register_sidebar($common + [
        'name' => __('Socials icons'),
        'id' => 'social_icons',
        'description' => __('Socials icons widget.', 'travelblog')
    ]);
    register_sidebar($common + [
        'name' => __('Contacts widget'),
        'id' => 'contacts_widget',
        'description' => __('Contact widget (phone + email).', 'travelblog')
    ]);
});

add_shortcode('footer_recent_news', function() {

    $recent = new WP_Query([
        'post_type'           => 'post',
        'posts_per_page'      => 3,
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
    ]);

    ob_start();
    echo '<ul class="footer__recent-list">';
    if ( $recent->have_posts() ) {

        while ( $recent->have_posts() ) {

            $recent->the_post();

            echo '<li class="footer__recent-item flex gap-5 flex-center-vertical mb-5">';
            echo '<img class="calendar-icon--grey" src="' . esc_url(get_template_directory_uri()) . '/assets/icons/calendar-gray.svg" alt="calendar">';
            echo '<a href="" class="recent__date">';
            echo esc_html( get_the_date('F j, Y') );
            echo '</a>';
            echo '<a class="recent__link multi-line-underline multi-line-underline-light" href="' . esc_url(get_permalink()) . '">';
            echo esc_html(get_the_title());
            echo '</a>';
            echo '</li>';
        }

    wp_reset_postdata();
    
    } else {
        echo '<li class="footer__recent-empty">No posts yet.</li>';
    }
    echo '</ul>';
    
    return ob_get_clean();
});

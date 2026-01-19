<?php
// wp_nav_menu( array(
//     'theme_location'  => '',      // Menu location registered in functions.php
//     'menu'            => '',      // Menu name, ID, or slug (alternative to theme_location)
//     'container'       => 'div',   // Wrapper element (div, nav, false)
//     'container_class' => '',      // Class for wrapper
//     'container_id'    => '',      // ID for wrapper
//     'menu_class'      => 'menu',  // Class applied to <ul>
//     'menu_id'         => '',      // ID applied to <ul>
//     'echo'            => true,    // true = output directly, false = return as string
//     'fallback_cb'     => 'wp_page_menu', // Callback if no menu assigned
//     'before'          => '',      // HTML before each <a>
//     'after'           => '',      // HTML after each <a>
//     'link_before'     => '',      // HTML inside <a>, before text
//     'link_after'      => '',      // HTML inside <a>, after text
//     'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>', // UL wrapper template
//     'item_spacing'    => 'preserve', // 'preserve' or 'discard'
//     'depth'           => 0,       // How many submenu levels (0 = unlimited)
//     'walker'          => '',      // Custom Walker class
// ) );

// $theme_uri = get_template_directory_uri();
// $site_name = get_bloginfo( 'name' ); // outputs (prints) site title of the Wordpress website;
// $phone_icon = esc_url(get_template_directory_uri() . '/assets/icons/phone-svgrepo-com.svg');
?>

<div class="bar">
    <div class="container flex flex-between">
        <div class="bar_left flex">
            <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'topbar_left',
                        'container' => false,
                        'menu_class' => 'bar_left flex',
                        'fallback_cb' => false, // if no menu is assigned to this location, do not display any menu.
                        'before' => '<div class="bar_icon"></div>',
                        )
                )
            ?>
        </div>
        <?php get_template_part('template-parts/components/socials') ;?>
    </div>
</div>
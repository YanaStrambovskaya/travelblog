<?php 

$site_name = get_bloginfo( 'name' ); // outputs (prints) site title of the Wordpress website;
?>
<div class="container mobile-site-menu site-menu">
        <div class="mobile-header-holder flex space-between flex-center-vertical">
            <?php
                if (has_custom_logo()) {
                    echo the_custom_logo();
                } else {
                    echo '<h1>' .$site_name. '</h1>';
                }
            ;?>
            <button type="button" id="mobile-menu-trigger">
                <h5 class="mobile-menu-text no-margin">MENU</h5>
                <span class="mobile-menu-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>
        </div>
        <nav class="mobile-nav" role="navigation" aria-label="Mobile Menu">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'mobile_menu',
                    'container' => false,
                    'menu_class' => 'mobile-menu flex',
                    'fallback_cb' => false, // if no menu is assigned to this location, do not display any menu.
                    )
            )
            ?>
            <div class="header-search">
                <?php get_search_form(); ?>
            </div>
        </nav>
        <div class="background"></div>
    </div>

<?php 

$site_name = get_bloginfo( 'name' ); // outputs (prints) site title of the Wordpress website;
?>
<div class="container mobile-menu__container site-menu">
    <div class="mobile-menu__header">
        <?php
            if (has_custom_logo()) {
                echo the_custom_logo();
            } else {
                echo '<h1>' .$site_name. '</h1>';
            }
        ;?>
        <button type="button" id="mobile-menu__trigger">
            <h5 class="mobile-menu__title">MENU</h5>
            <span class="mobile-menu__icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </button>
    </div>
    <nav class="mobile__nav" role="navigation" aria-label="Mobile Menu">
        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'mobile_menu',
                'container' => false,
                'menu_class' => 'flex-column-direction-mobile',
                'fallback_cb' => false, // if no menu is assigned to this location, do not display any menu.
                'link_after' => '<button type="button" class="mobile-menu__toggle" aria-label="Open submenu"><img class="mobile-menu__arrow" width="20" height="20" src="'. THEME_URI . '/assets/icons/dropdown-arrow.svg" alt="arrow-icon"></button>'
                )
        )
        ?>
        <div class="header-search">
            <?php get_search_form(); ?>
        </div>
        <div class="mobile-widgets__container dark">
            <div class="flex">
                <?php 
                    if (is_active_sidebar('contacts_widget')) {
                        dynamic_sidebar('contacts_widget');
                    }
                ;?>
            </div>
                </br>
            <?php 
                if (is_active_sidebar('social_icons')) {
                    dynamic_sidebar('social_icons');
                }
            ;?>
        </div>
        <div class="spacer"></div>
    </nav>
    <div class="background"></div>
</div>

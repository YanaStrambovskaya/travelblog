<div class="bar flex">
    <span>Social &nbsp;&nbsp;</span>
    <?php
        wp_nav_menu(
            array(
                'theme_location' => 'social_menu',
                'container' => false,
                'menu_class' => 'social_block flex',
                'fallback_cb' => false, // if no menu is assigned to this location, do not display any menu.
                'before' => '<div class="bar_icon"></div><span class="social-text">',
                'after' => '</span>',
                )
        )
    ?>
</div>
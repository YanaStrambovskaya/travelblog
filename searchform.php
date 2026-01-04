<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="screen-reader-text" for="search-input">
        <?php _e( 'Search for:', 'textdomain' ); ?>
    </label>

    <input
        type="search"
        id="search-input"
        class="search-field"
        placeholder="<?php echo esc_attr_x( 'Search…', 'placeholder', 'textdomain' ); ?>"
        value="<?php echo get_search_query(); ?>"
        name="s"
    />

    <button type="submit" class="search-submit" aria-label="<?php esc_attr_e( 'Search', 'textdomain' ); ?>">
        <img src="<?php echo THEME_URI . '/assets/icons/search.svg' ;?>" alt="Search">
    </button>
</form>

<form role="search" method="get" class="search-form flex gap-10" action="<?php echo esc_url( home_url( '/' ) ); ?>">
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

    <button type="submit" class="color-olive-green-btn btn search__submit-btn" aria-label="<?php esc_attr_e( 'Search', 'textdomain' ); ?>">
        Search <img class="search__submit-btn__icon" src="<?php echo THEME_URI . '/assets/icons/search-white.svg' ;?>" loading="lazy"
        decoding="async" alt="Search">
    </button>
</form>

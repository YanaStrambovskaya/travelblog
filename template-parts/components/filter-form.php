<?php
$action_url = $args['action_url'] ?? '';
$freFilledValues = $args['pre-filled-form-values'] ?? [];
$selectedCountry = $freFilledValues['country_id'] ?? '';
$selectedCity = $freFilledValues['city_id'] ?? '';
$selectedBudgetLevel = $freFilledValues['budget_level_id'] ?? '';
$selectedSeason = $freFilledValues['season_id'] ?? '';
$selectedTripDuration = $freFilledValues['trip_duration_id'] ?? '';

$is_preload_data = $freFilledValues ? true : '';
$countries = get_terms([
    'taxonomy' => 'country',
    'hide_empty' => false,
    'orderby' => 'name',
    'order' => 'ASC',
    // 'fields' => 'names',
    'parent' => 0,
]);
$budget_levels = get_terms([
    'taxonomy' => 'budget_level',
    'hide_empty' => false,
    'orderby' => 'name',
    'order' => 'ASC',
    // 'fields' => 'names',
]);
$seasons = get_terms([
    'taxonomy' => 'season',
    'hide_empty' => false,
    'orderby' => 'name',
    'order' => 'ASC',
    // 'fields' => 'names',
]);
$trip_durations = get_terms([
    'taxonomy' => 'trip_duration',
    'hide_empty' => false,
    'orderby' => 'name',
    'order' => 'ASC',
    // 'fields' => 'names',
]);
function renderFilterDropdown ($itemsArray, $label = '', $taxonomy_name = '', $selected_option = '') {
    if (!is_wp_error($itemsArray) && !empty($itemsArray) && is_array($itemsArray)) {
        $first_term = null;
        foreach ($itemsArray as $item) {
            if ($item instanceof WP_Term) {
                $first_term = $item;
                break;
            }
        }
        if (empty($first_term)) {
            return;
        }

        $taxonomy_name = !empty($taxonomy_name) ? $taxonomy_name : $first_term->taxonomy;

        if (empty($taxonomy_name)) {
            return;
        };

        // Fallback label
        if (empty($label)) {
            $tax = get_taxonomy($taxonomy_name);
            $label = $tax ? $tax->label : 'Select';
        };
        
        echo '<div id="js-filter-'. $taxonomy_name .'" data-filter="'. $taxonomy_name .'" class="filters__item has-dropdown">';
        echo '<button type="button" class="filters__item-toggle toggle">';
        echo '<span class="filters__item-toggle-text">'. esc_html($label) .'</span>';
        echo '<img width="20" height="20" src="'. THEME_URI . '/assets/icons/dropdown-arrow.svg" alt="'. $label .'-icon">';
        echo '</button>';
        echo '<ul class="filters__item-dropdown">';
            foreach ($itemsArray as $item) {
                if ( !($item instanceof WP_Term)  ) {
                    continue;
                }
                echo '<li class="filters__item-dropdown-item">';
                echo '<a href="#" data-term-id="' . esc_attr($item->term_id) . '">';
                echo esc_html($item->name);
                echo '</a>';
                echo '</li>';
            }
        echo '</ul>';
        
        echo '<input class="dropdown-input '. $taxonomy_name .'" type="hidden" value="'. $selected_option .'" name="' . esc_attr($taxonomy_name) . '_id">';
        echo '</div>';
    }
}
;?>

<form id="tb-filter" class="tb-filter" data-preload="<?php echo $is_preload_data ;?>" method="get" action="<?php echo esc_url($action_url) ;?>">
    <div class="filters">
        <?php renderFilterDropdown($countries, 'Country', 'country', $selectedCountry) ;?>
        <?php
            if (!is_wp_error($countries) && !empty($countries) && is_array($countries) && !empty($selectedCity)) {
                $cities = get_terms([
                    'taxonomy'   => 'country',
                    'hide_empty' => false,
                    'parent'     => $selectedCountry,
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                ]);
                renderFilterDropdown($cities, 'City', 'city', $selectedCity);
            } else if (!is_wp_error($countries) && !empty($countries) && is_array($countries) && empty($selectedCity)) : ?>
                <!-- Render City filter dropdoe=wn only if Country is exist and no prefilled data for City dropdown -->
                <div id="js-filter-city" data-filter="city" class="filters__item">
                    <button type="button" class="filters__item-toggle disabled" disabled>
                        <span class="filters__item-toggle-text">City</span>
                        <img src="<?php echo THEME_URI . '/assets/icons/dropdown-arrow.svg' ;?>" alt="city-icon">
                    </button>
                    <ul class="filters__item-dropdown js-city-options"></ul>
                    <input class="dropdown-input city" type="hidden" name="city_id" value="<?php echo esc_attr($selectedCity) ;?>">
                </div>
        <?php endif ;?>
        <?php renderFilterDropdown($budget_levels, 'Budget level', 'budget_level', $selectedBudgetLevel) ;?>
        <?php renderFilterDropdown($seasons, 'Seasons', 'season', $selectedSeason) ;?>
        <?php renderFilterDropdown($trip_durations, 'Trip duration', 'trip_duration', $selectedTripDuration) ;?>
        <button type="submit" class="filters_submitBtn btn disabled" disabled>
            <img class="filters__searchIcon" width="20" height="20" src="<?php echo THEME_URI . '/assets/icons/search-white.svg' ;?>" alt="search-icon">
            Search
        </button>
    </div>
</form>

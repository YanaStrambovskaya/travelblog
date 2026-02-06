<?php
;?>
<?php get_header(); ?>
<!-- Category-specific pages -->
<?php
    get_template_part(
        'template-parts/components/common-hero-section',
        null,
        ['title' => post_type_archive_title('', false)]
    )
;?>

<div class="spacer visible-tablet visible-desktop"></div>
<div class="spacer"></div>
<section class="">
    <div class="container">
        <?php ;
            get_template_part(
                'template-parts/components/filter-form',
                null,
                [
                    'action' => '',
                    'pre-filled-form-values' => [
                        'country_id' => $_GET['country_id'] ?? '',
                        'city_id' => $_GET['city_id'] ?? '',
                        'budget_level_id' => $_GET['budget_level_id'] ?? '',
                        'season_id' => $_GET['season_id'] ?? '',
                        'trip_duration_id' => $_GET['trip_duration_id'] ?? '',

                    ]
                ]
            )
        ?>
        
        <div class="result">
            <?php
                if (!empty($_GET)) {
                    $country_id = sanitize_text_field($_GET['country_id'] ?? '');
                    $city_id = sanitize_text_field($_GET['city_id'] ?? '');
                    $budget_level_id = sanitize_text_field($_GET['budget_level_id'] ?? '');
                    $season_id = sanitize_text_field($_GET['season_id'] ?? '');
                    $trip_duration_id = sanitize_text_field($_GET['trip_duration_id'] ?? '');

                    $tax_query = ['relation' => 'AND'];

                    if ($city_id) {
                        $tax_query[] = [
                            'taxonomy' => 'country',
                            'field'    => 'term_id',
                            'terms'    => [$city_id],
                        ];
                    } elseif ($country_id) {
                        $tax_query[] = [
                            'taxonomy'         => 'country',
                            'field'            => 'term_id',
                            'terms'            => [$country_id],
                            'include_children' => true,
                        ];
                    }
            
                    if ($budget_level_id) {
                        $tax_query[] = [
                            'taxonomy' => 'budget_level',
                            'field'    => 'term_id',
                            'terms'    => [$budget_level_id],
                        ];
                    }
            
                    if ($season_id) {
                        $tax_query[] = [
                            'taxonomy' => 'season',
                            'field'    => 'term_id',
                            'terms'    => [$season_id],
                        ];
                    }
            
                    if ($trip_duration_id) {
                        $tax_query[] = [
                            'taxonomy' => 'trip_duration',
                            'field'    => 'term_id',
                            'terms'    => [$trip_duration_id],
                        ];
                    }
                    $paged = max(1, get_query_var('paged'), get_query_var('page'));
                    $query = new WP_Query([
                        'post_type'      => 'destination',
                        'orderby' => 'name',
                        'order' => 'DESC',
                        'post_status'    => 'publish',
                        'posts_per_page' => 4,
                        'paged'          => $paged,
                        'tax_query' => $tax_query
                    ]);


                    if ($query->have_posts()) {
                        echo '<div class="cards-grid grid-1-column-mobile grid-3-columns-desktop grid-2-columns-tablet">';

                        while ($query->have_posts()) {
                            $query->the_post();
                            get_template_part(
                                'template-parts/components/card-item',
                                null,
                                []
                            );
                        }
                        echo '</div>';
                    } else {
                        echo '<p class="no-results-text">No destinations found matching your criteria.</p>';
                    }
                    wp_reset_postdata();
                } else {
                    $paged = max(1, get_query_var('paged'), get_query_var('page'));
                    
                    $query = new WP_Query([
                        'post_type'      => 'destination',
                        'post_status'    => 'publish',
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'posts_per_page' => 6,
                        'paged' => $paged
                    ]);

                    if ($query->have_posts()) {
                        echo '<div class="card-items grid-2-columns-desktop grid-1-columns-tablet grid-1-column-mobile gap-30">';

                        while ($query->have_posts()) {
                            $query->the_post();
                            get_template_part(
                                'template-parts/components/search-result',
                                null,
                                ['']
                            );
                        }
                        echo '</div>';
                    } else {
                        echo '<p class="no-results-text">No destinations found matching your criteria.</p>';
                    }
                    wp_reset_postdata();
                }
            ;?>
            
        </div>
        <div class="spacer"></div>
        <div class="pagination">
            <?php 
                if (isset($query) && $query->max_num_pages > 1) {
                    if (!empty($_GET)) {

                        the_posts_pagination([
                            'current' => $paged,
                            'total' => $query->max_num_pages,
                            'add_args' => array_filter([
                                'country_id'       => $_GET['country_id'] ?? '',
                                'city_id'          => $_GET['city_id'] ?? '',
                                'budget_level_id'  => $_GET['budget_level_id'] ?? '',
                                'season_id'        => $_GET['season_id'] ?? '',
                                'trip_duration_id' => $_GET['trip_duration_id'] ?? '',
                            ]),
                        ]);
                    } else {
                        
                        the_posts_pagination([
                            'current' => $paged,
                            'total' => $query->max_num_pages,
                        ]);
                    }
                    
                }
            ;?>
        </div>
    </div>
</section>
<div class="spacer"></div>
<div class="spacer"></div>

<?php get_footer(); ?>


<!-- // $countries = get_terms([
//     'taxonomy' => 'country',
//     'hide_empty' => false,
//     'orderby' => 'name',
//     'order' => 'ASC',
//     'parent' => 0,
// ]);
// $budget_levels = get_terms([
//     'taxonomy' => 'budget_level',
//     'hide_empty' => false,
//     'orderby' => 'name',
//     'order' => 'ASC',
// ]);
// $seasons = get_terms([
//     'taxonomy' => 'season',
//     'hide_empty' => false,
//     'orderby' => 'name',
//     'order' => 'ASC',
//     // 'fields' => 'names',
// ]);
// $trip_durations = get_terms([
//     'taxonomy' => 'trip_duration',
//     'hide_empty' => false,
//     'orderby' => 'name',
//     'order' => 'ASC',
//     // 'fields' => 'names',
// ]); -->

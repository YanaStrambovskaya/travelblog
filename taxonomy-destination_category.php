<?php
/**
 * Template: Destination Category archive
 * URL example: /destination_category/adventure/
 */
$term = get_queried_object(); // current destination_category term
get_header();
;?>
<section class="common-hero-section">
    <div class="container">
        <h1 class="common-hero-section_title"><?php single_term_title() ;?></h1>
    </div>
    <img class="common-hero-bg" src="<?php echo THEME_URI . '/assets/images/shop-title-img-01.jpg' ;?>" alt="">
</section>
<section class="category-content">
    <div class="container">
        <?php if (category_description()) : ?>
            <div class="category-description">
                <?php echo category_description() ;?>
            </div>
        <?php endif ;?>
        <?php
        // Pagination
        $paged = max( 1, get_query_var('paged') );

        // Query Destinations in this category
        $q = new WP_Query([
        'post_type'      => 'destination',
        'post_status'    => 'publish',
        'posts_per_page' => 9,
        'paged'          => $paged,
        'tax_query'      => [
            [
            'taxonomy' => 'destination_category',
            'field'    => 'term_id',
            'terms'    => $term->term_id,
            ]
        ],
        ]);
        ?>
         <?php if ( $q->have_posts() ) : ?>
        <div>
            <?php while ( $q->have_posts() ) : $q->the_post(); ?>
                <div class="destinations-grid">
                    <div class="destination-item">
                        <a href="<?php the_permalink(); ?>">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail('medium_large'); ?>
                            <?php endif; ?>
                            <h3 class="title"><?php the_title(); ?></h3>
                        </a>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php endif ;?>
        </div>
        <div class="pagination">
        <?php
        echo paginate_links([
          'total'   => $q->max_num_pages,
          'current' => $paged,
          'prev_text' => __('« Previous', 'travelblog'),
          'next_text' => __('Next »', 'travelblog'),
        ]);
        ?>
      </div>

      <?php wp_reset_postdata(); ?>
    </div>
</section>
<?php
get_footer();
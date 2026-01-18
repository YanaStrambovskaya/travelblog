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
        <h1 class="common-hero-section_title"><?php esc_html(single_term_title()) ;?></h1>
    </div>
    <img class="common-hero-bg" src="<?php echo THEME_URI . '/assets/images/shop-title-img-01.jpg' ;?>" alt="">
</section>
<section class="category-content">
    <div class="container">
        <div class="spacer"></div>
        <div class="spacer"></div>
        <?php if (category_description()) : ?>
            <div class="category-description">
                <?php echo esc_html(category_description()) ;?>
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
            <div class="destinations-grid grid-3-columns gap-30">
            <?php while ( $q->have_posts() ) : $q->the_post(); ?>
                    <div class="destination-item">
                        <a href="<?php esc_url(the_permalink()); ?>">
                            <h3 class="title-container position-relative">
                                <svg class="torn-side-left" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 15.7 30" style="enable-background:new 0 0 15.7 30;" xml:space="preserve" class="mkdf-active-hover-left"><polygon class="st0" points="2.6,1 0.7,3.3 2,5.8 2.3,7.6 2.9,8.7 4.4,10.5 3.9,10.8 4.4,11.9 4.4,12.8 4.1,13.8 3.3,14.7 3.9,15.8 4.4,16.8 4,17.5 3.5,18.1 2.2,20.2 3.4,21.5 4.2,24.1 3.4,25.4 2.5,27.4 2.5,27.8 3.2,28.3 4.1,28.5 4.9,29 14.8,29 14.8,1 "></polygon></svg>
                                <span class="torn-text"><?php esc_html(the_title()); ?></span>
                                <svg class="torn-side-right" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 13.3 30" style="enable-background:new 0 0 13.3 30;" xml:space="preserve" class="mkdf-active-hover-right"><polygon class="st0" points="10,1 10.2,2.1 10.6,2.9 10.6,3.3 10.8,3.7 10.8,4.3 11,5 11,5.7 11,6.3 10.5,6.7 10.8,7.3 11,7.8 	11.6,8.3 11.6,8.6 11.5,8.9 11.6,9.9 11.6,10.5 12.4,11.6 12.1,12 12.4,12.2 11.8,12.8 11.4,13.5 11.6,13.7 11.9,13.7 12,13.9 11.5,15.1 10.8,16 9.1,17.7 9.7,18.2 9.3,19 9.7,19.8 9.6,20.6 9.7,21.5 9.6,21.9 9.6,22.3 10.1,22.8 9.6,23.6 9.7,24 9.7,24.2 9.9,24.4 9.5,24.7 9.3,25.4 9.3,25.9 8.8,26.2 8.5,27.1 8.8,27.8 9.4,28.6 7.8,29 0.9,29 0.9,1 "></polygon></svg>    
                            </h3>
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail('medium_large'); ?>
                            <?php endif; ?>
                            <!-- <div class="torn-label-container">
                                <span class="torn-label-container_bg">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 15.7 30" style="enable-background:new 0 0 15.7 30;" xml:space="preserve" class="mkdf-active-hover-left"><polygon class="st0" points="2.6,1 0.7,3.3 2,5.8 2.3,7.6 2.9,8.7 4.4,10.5 3.9,10.8 4.4,11.9 4.4,12.8 4.1,13.8 3.3,14.7 3.9,15.8 4.4,16.8 4,17.5 3.5,18.1 2.2,20.2 3.4,21.5 4.2,24.1 3.4,25.4 2.5,27.4 2.5,27.8 3.2,28.3 4.1,28.5 4.9,29 14.8,29 14.8,1 "></polygon></svg>
                                    
                                    <span class="middle"><?php esc_html(the_title()); ?></span>

                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 13.3 30" style="enable-background:new 0 0 13.3 30;" xml:space="preserve" class="mkdf-active-hover-right"><polygon class="st0" points="10,1 10.2,2.1 10.6,2.9 10.6,3.3 10.8,3.7 10.8,4.3 11,5 11,5.7 11,6.3 10.5,6.7 10.8,7.3 11,7.8 	11.6,8.3 11.6,8.6 11.5,8.9 11.6,9.9 11.6,10.5 12.4,11.6 12.1,12 12.4,12.2 11.8,12.8 11.4,13.5 11.6,13.7 11.9,13.7 12,13.9 11.5,15.1 10.8,16 9.1,17.7 9.7,18.2 9.3,19 9.7,19.8 9.6,20.6 9.7,21.5 9.6,21.9 9.6,22.3 10.1,22.8 9.6,23.6 9.7,24 9.7,24.2 9.9,24.4 9.5,24.7 9.3,25.4 9.3,25.9 8.8,26.2 8.5,27.1 8.8,27.8 9.4,28.6 7.8,29 0.9,29 0.9,1 "></polygon></svg>    
                                </span>
                            </div> -->
                        </a>
                    </div>
                <?php endwhile; ?>
                </div>
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
      <div class="spacer"></div>
      <div class="spacer"></div>
    </div>
</section>
<?php
get_footer();
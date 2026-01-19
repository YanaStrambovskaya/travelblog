<?php
/* Template for the front page */

$hero_section_content = get_page_by_path('hero-section-content');
$hero_section_content_id = $hero_section_content ? $hero_section_content->ID : 0;
$hero_section_content_items = ['slide_one_content', 'slide_two_content', 'slide_three_content'];

$top_destinations = new WP_Query([ // Creates a custom database query, Returns a WP_Query object
    'post_type' => 'destination', //Tells WordPress what type of content to query, 'destination' = custom post type
    'posts_per_page' => 3, //Only 3 posts maximum
    'meta_key' => 'is_featured', //“I’m interested in posts that have a meta field called is_featured”
    'meta_value' => 1, //“Only posts where is_featured is enabled”
    'orderby' => ['date' => 'DESC'], //'DESC' = newest first
    'no_found_rows' => true, // Prevents WordPress from calculating: SQL_CALC_FOUND_ROWS (9Disables pagination data). Improves performance for simple queries
]);

$recent_posts = new WP_Query([
    'post_type'=> 'post',
    'posts_per_page' => 3,
    'no_found_rows' => true,
    'post_status' => 'publish',
]);

get_header();
?>
<section class="hero-section">
    <div class="glide js-glide" data-glide='{"animationDuration":0,"type":"carousel","perView":1}'>
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                <?php foreach ( $hero_section_content_items as $item ) : ?>
                    <?php
                        $item_content = get_field($item, $hero_section_content_id);
                        $image_url = $item_content['image'];
                        $header_text = $item_content['header_text'];
                        $subheader_text = $item_content['subheader_text'];
                        $related_post_id = $item_content['id'];
                        $related_post_url = get_permalink( $related_post_id );
                    ;?>
                    <?php if ( ! $item ) continue; ?>
                    <li class="glide__slide">
                        <div class="glide__slide-content">
                            <h2 class="hero-slide_title"><?php echo esc_html($header_text);?></h2>
                            <p class="hero-slide_description"><?php echo esc_html($subheader_text);?></p>
                            <?php get_template_part(
                                'template-parts/components/green-olive-btn',
                                null,
                                [
                                    'text' => 'Read more',
                                    'url' => $related_post_url
                                ]
                                );
                            ;?>
                        </div>
                        <img class="glide__slide-img" src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($header_text);?>">
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
         <!-- arrows -->
        <div class="glide__arrows" data-glide-el="controls">
            <button class="glide__arrow glide__arrow--left" data-glide-dir="<">
                <span class="glide__arrow--svg">
                    <svg class="glide__arrow--left--svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M11 18.75C10.9015 18.7505 10.8038 18.7313 10.7128 18.6935C10.6218 18.6557 10.5393 18.6001 10.47 18.53L4.47001 12.53C4.32956 12.3894 4.25067 12.1988 4.25067 12C4.25067 11.8013 4.32956 11.6107 4.47001 11.47L10.47 5.47003C10.6122 5.33755 10.8002 5.26543 10.9945 5.26885C11.1888 5.27228 11.3742 5.35099 11.5116 5.48841C11.649 5.62582 11.7278 5.81121 11.7312 6.00551C11.7346 6.19981 11.6625 6.38785 11.53 6.53003L6.06001 12L11.53 17.47C11.6705 17.6107 11.7494 17.8013 11.7494 18C11.7494 18.1988 11.6705 18.3894 11.53 18.53C11.4608 18.6001 11.3782 18.6557 11.2872 18.6935C11.1962 18.7313 11.0986 18.7505 11 18.75Z" fill="#000000"></path> <path d="M19 12.75H5C4.80109 12.75 4.61032 12.671 4.46967 12.5303C4.32902 12.3897 4.25 12.1989 4.25 12C4.25 11.8011 4.32902 11.6103 4.46967 11.4697C4.61032 11.329 4.80109 11.25 5 11.25H19C19.1989 11.25 19.3897 11.329 19.5303 11.4697C19.671 11.6103 19.75 11.8011 19.75 12C19.75 12.1989 19.671 12.3897 19.5303 12.5303C19.3897 12.671 19.1989 12.75 19 12.75Z" fill="#000000"></path> </g></svg>
                </span>
                <img class="default" src="<?php echo THEME_URI . '/assets/icons/hero-slider-torn-bg.svg' ;?>" alt="">
                <img class="hover" src="<?php echo THEME_URI . '/assets/icons/hero-slider-torn-bg-hover.svg' ;?>" alt="">
            </button>
            <button class="glide__arrow glide__arrow--right" data-glide-dir="<">
                <span class="glide__arrow--svg">
                    <svg class="glide__arrow--right--svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M11 18.75C10.9015 18.7505 10.8038 18.7313 10.7128 18.6935C10.6218 18.6557 10.5393 18.6001 10.47 18.53L4.47001 12.53C4.32956 12.3894 4.25067 12.1988 4.25067 12C4.25067 11.8013 4.32956 11.6107 4.47001 11.47L10.47 5.47003C10.6122 5.33755 10.8002 5.26543 10.9945 5.26885C11.1888 5.27228 11.3742 5.35099 11.5116 5.48841C11.649 5.62582 11.7278 5.81121 11.7312 6.00551C11.7346 6.19981 11.6625 6.38785 11.53 6.53003L6.06001 12L11.53 17.47C11.6705 17.6107 11.7494 17.8013 11.7494 18C11.7494 18.1988 11.6705 18.3894 11.53 18.53C11.4608 18.6001 11.3782 18.6557 11.2872 18.6935C11.1962 18.7313 11.0986 18.7505 11 18.75Z" fill="#000000"></path> <path d="M19 12.75H5C4.80109 12.75 4.61032 12.671 4.46967 12.5303C4.32902 12.3897 4.25 12.1989 4.25 12C4.25 11.8011 4.32902 11.6103 4.46967 11.4697C4.61032 11.329 4.80109 11.25 5 11.25H19C19.1989 11.25 19.3897 11.329 19.5303 11.4697C19.671 11.6103 19.75 11.8011 19.75 12C19.75 12.1989 19.671 12.3897 19.5303 12.5303C19.3897 12.671 19.1989 12.75 19 12.75Z" fill="#000000"></path> </g></svg>
                </span>
                <img class="default" src="<?php echo THEME_URI . '/assets/icons/hero-slider-torn-bg.svg' ;?>" alt="">
                <img class="hover" src="<?php echo THEME_URI . '/assets/icons/hero-slider-torn-bg-hover.svg' ;?>" alt="">
            </button>
        </div>
    </div>
    <img class="torn torn-bottom" src="<?php echo  THEME_URI . '/assets/images/torm-bottom.png'?>" alt="">
</section>
<div class="spacer"></div>
<section class="destinations-section">
    <div class="container">
        <h2 class="section-title">Top <span>Destinations</span></h2>
        <div class="grid-one-col-mobile grid-three-cols-tablet gap-20">
            <?php if ($top_destinations->have_posts()) : ?>
            <?php while ($top_destinations->have_posts()) : $top_destinations->the_post() ; ?>
                <div class="destination-card flex-column-direction">
                    <?php if (has_post_thumbnail()) :?>
                    <a href="<?= the_permalink() ;?>">
                            <?php the_post_thumbnail('medium', [
                                'class' => 'destination-image ratio-4-3'
                            ]); ?>
                    </a>
                    <?php endif ;?>
                    <h3 class="item-title">
                        <a class="multi-line-underline" href="<?= the_permalink() ;?>">
                            <span><?= the_title() ;?></span>
                        </a>
                    </h3>
                </div>
            <?php endwhile; 
                wp_reset_postdata(); //Restores global $wp_query context, Makes template tags work correctly again.
                // Always use after custom loops.
                // after new WP_Query(), get_posts(), any loop that calls the_post()
                endif ;?>
        </div>
    </div>
</section>
<div class="spacer"></div>
<section class="contact-section beige-bg">
    <img class="torn torn-top" src="<?php echo  THEME_URI . '/assets/images/torm-bottom.png'?>" alt="">
    <div class="container">
        <div class="contact-section_inner flex-one-col-mobile flex-equal-cols-desktop gap-30">
            <div>
                <img src="<?php echo get_template_directory_uri() . '/assets/images/h1-img-01.png' ;?>" alt="Subscribe">
            </div>
            <div>
                <p class="header-top-text no-margin-bottom">Lorem ipsum dolor</p>
                <h2 class="section-title no-margin text-left">
                    Finding the perfect trails to hike is easy with <span>newsletter</span>
                </h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididu nt ut labore et dolore minim veniam, quism.</p>
                <?php echo do_shortcode('[contact-form-7 id="cd232c9" title="Subscribe"]'); ?>
            </div>
        </div>
    </div>
    <img class="torn torn-bottom" src="<?php echo  THEME_URI . '/assets/images/torm-bottom.png'?>" alt="">
</section>
<div class="spacer"></div>
<section class="recent-post-section">
    <div class="container">
        <h2 class="section-title">Recent <span>Posts</span></h2>
        <div class="grid-one-col-mobile grid-three-cols-tablet gap-20">
            <?php if ($recent_posts->have_posts()) : ?>
                <?php while ($recent_posts->have_posts()) : $recent_posts->the_post() ; ?>
                    <?php get_template_part(
                        'template-parts/components/post-item',
                        null,
                        []
                        );
                    ;?>
                <?php endwhile;
                    wp_reset_postdata();
                 endif;?>
        </div>
    </div>
</section>
<div class="spacer"></div>
<section class="shop-section beige-bg">
    <img class="torn torn-top" src="<?php echo  THEME_URI . '/assets/images/torm-bottom.png'?>" alt="">
    <div class="container">
        <h2 class="section-title">Enjoy every <span>moment</span></h2>
    </div>
    <img class="torn torn-bottom" src="<?php echo  THEME_URI . '/assets/images/torm-bottom.png'?>" alt="">
</section>
<div class="spacer"></div>
<section class="destination-categories-section">
    <div class="container destination-categories-section_inner">
        <?php 
            $destination_categories = get_terms([ //Returns: array of WP_Term objects
                'taxonomy' => 'destination_category',
                'hide_empty' => false, // show even if the category is emppty
            ]) ;
        ;?>
        <?php if (!empty ($destination_categories) && ! is_wp_error($destination_categories)) :?>
            <?php foreach($destination_categories as $term) :?>
                
                <!-- $term->term_id   // ID -->
                <!-- $term->name      // "Adventure" -->
                <!-- $term->slug      // "adventure" -->
                <!-- $term->count     // number of Destinations in this category -->
                <!-- $term->taxonomy  // "destination_category" -->
                 <?php
                    $icon = get_field('icon', 'term_' . $term->term_id);
                    $icon_hover = get_field('icon-hover', 'term_' . $term->term_id);
                 ;?>
                <div class="destination-category-item">
                    <a class="" href="<?php echo get_category_link($term->term_id) ;?>">
                        <div class="item-icons">
                            <img class="icon" src="<?php echo $icon ;?>" alt="<?php echo $term->name;?>">
                            <img class="hover-icon" src="<?php echo $icon_hover ;?>" alt="<?php echo $term->name;?>">
                        </div>
                        <div class="number-of-destination">
                            <span class="number"><?php echo esc_html($term->count);?></span>
                            <span>destinations</span>
                        </div>
                        <h5 class="item-name no-margin"><?php echo $term->name ;?></h4>
                    </a>
                </div>
            <?php endforeach ;?>
        <?php endif ;?>
    </div>
</section>
<div class="spacer"></div>
<?php
get_footer();

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
<?php
    $swiperOptions = [
        "navigation" => [
            "nextEl" => ".swiper-button.next",
            "prevEl" => ".swiper-button.prev",
        ],
        "pagination" => [
            'el' => '.swiper-pagination',
            'clickable'=> true,
        ],
        "loop" => true,
        "slidesPerView" => 1
    ]
;?>
<?php
/**
 * HERO SECTION (Swiper) — LCP optimized
 * - Only the FIRST slide image is eager + fetchpriority=high
 * - Other slides are lazy
 * - Uses <picture> with mobile/desktop WebP sources
 */

$swiperOptions = $swiperOptions ?? [];
$hero_section_content_items = $hero_section_content_items ?? [];
$hero_section_content_id = $hero_section_content_id ?? 0;
?>

<section class="hero-section">
  <div class="swiper hero-swiper" data-swiper='<?php echo esc_attr(wp_json_encode($swiperOptions)); ?>'>
    <div class="swiper-wrapper">

      <?php $i = 0; ?>
      <?php foreach ($hero_section_content_items as $item) : ?>
        <?php if (!$item) continue; ?>

        <?php
          $item_content = get_field($item, $hero_section_content_id);

          if (!is_array($item_content)) {
            continue;
          }

          $image_url        = !empty($item_content['image']) ? $item_content['image'] : '';
          $mobile_image_url = !empty($item_content['mobile_img']) ? $item_content['mobile_img'] : $image_url;

          $header_text      = !empty($item_content['header_text']) ? $item_content['header_text'] : '';
          $subheader_text   = !empty($item_content['subheader_text']) ? $item_content['subheader_text'] : '';

          $related_post_id  = !empty($item_content['id']) ? absint($item_content['id']) : 0;
          $related_post_url = $related_post_id ? get_permalink($related_post_id) : '';

          $is_first = ($i === 0);
          $i++;

          // If no image, skip the slide
          if (!$image_url) {
            continue;
          }
        ?>

        <div class="swiper-slide grid">
          <div class="hero-swiper-slide__content">
            <?php if ($header_text) : ?>
              <h2 class="hero-swiper-slide__title">
                <?php if ($related_post_url) : ?>
                  <a class="multi-line-underline multi-line-underline-white"
                     href="<?php echo esc_url($related_post_url); ?>">
                    <?php echo esc_html($header_text); ?>
                  </a>
                <?php else : ?>
                  <?php echo esc_html($header_text); ?>
                <?php endif; ?>
              </h2>
            <?php endif; ?>

            <?php if ($subheader_text) : ?>
              <p class="hero-swiper-slide__description">
                <?php echo esc_html($subheader_text); ?>
              </p>
            <?php endif; ?>
          </div>

          <picture class="hero-swiper-slide__img">
            <?php if ($mobile_image_url) : ?>
              <source
                media="(max-width: 768px)"
                srcset="<?php echo esc_url($mobile_image_url); ?>"
                type="image/webp"
              />
            <?php endif; ?>

            <source
              media="(min-width: 769px)"
              srcset="<?php echo esc_url($image_url); ?>"
              type="image/webp"
            />

            <img
              class="hero-swiper-slide__img"
              src="<?php echo esc_url($mobile_image_url ?: $image_url); ?>"
              alt="<?php echo esc_attr($header_text); ?>"
              width="1920"
              height="882"
              decoding="async"
              loading="<?php echo $is_first ? 'eager' : 'lazy'; ?>"
              <?php if ($is_first) : ?>fetchpriority="high"<?php endif; ?>
              sizes="100vw"
            >
          </picture>
        </div>

      <?php endforeach; ?>
    </div>

    <!-- arrows -->
    <div class="swiper-button prev visible-tablet visible-desktop" aria-hidden="true">
      <div class="swiper-button__arrow">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M11 18.75c-.2 0-.39-.08-.53-.22l-6-6a.75.75 0 010-1.06l6-6a.75.75 0 011.06 1.06L6.06 12l5.47 5.47A.75.75 0 0111 18.75z" fill="currentColor"/>
          <path d="M19 12.75H5a.75.75 0 010-1.5h14a.75.75 0 010 1.5z" fill="currentColor"/>
        </svg>
        <picture class="default">
            <source media="(min-width: 769px)" srcset="<?php echo THEME_URI . '/assets/icons/hero-slider-torn-bg.svg' ;?>">
            <img src="<?php echo THEME_URI . '/assets/icons/hero-slider-torn-bg.svg' ;?>" loading="lazy"
            decoding="async" alt="">
        </picture>
        <picture class="hover">
            <source media="(min-width: 769px)" srcset="<?php echo THEME_URI . '/assets/icons/hero-slider-torn-bg-hover.svg' ;?>">
            <img src="<?php echo THEME_URI . '/assets/icons/hero-slider-torn-bg-hover.svg' ;?>" loading="lazy"
            decoding="async" alt="">
        </picture>
        <!-- <img class="default" src="<?php echo esc_url(THEME_URI . '/assets/icons/hero-slider-torn-bg.svg'); ?>" alt="" aria-hidden="true">
        <img class="hover"   src="<?php echo esc_url(THEME_URI . '/assets/icons/hero-slider-torn-bg-hover.svg'); ?>" alt="" aria-hidden="true"> -->
      </div>
    </div>

    <div class="swiper-button next visible-tablet visible-desktop" aria-hidden="true">
      <div class="swiper-button__arrow">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M13 18.75c-.2 0-.39-.08-.53-.22a.75.75 0 010-1.06L17.94 12l-5.47-5.47a.75.75 0 011.06-1.06l6 6a.75.75 0 010 1.06l-6 6c-.14.14-.33.22-.53.22z" fill="currentColor"/>
          <path d="M19 12.75H5a.75.75 0 010-1.5h14a.75.75 0 010 1.5z" fill="currentColor"/>
        </svg>

        <picture class="default">
            <source media="(min-width: 769px)" srcset="<?php echo THEME_URI . '/assets/icons/hero-slider-torn-bg.svg' ;?>">
            <img src="<?php echo THEME_URI . '/assets/icons/hero-slider-torn-bg.svg' ;?>" loading="lazy"
            decoding="async" alt="">
        </picture>
        <picture class="hover">
            <source media="(min-width: 769px)" srcset="<?php echo THEME_URI . '/assets/icons/hero-slider-torn-bg-hover.svg' ;?>">
            <img src="<?php echo THEME_URI . '/assets/icons/hero-slider-torn-bg-hover.svg' ;?>" loading="lazy"
            decoding="async" alt="">
        </picture>
        <!-- <img class="default" src="<?php echo esc_url(THEME_URI . '/assets/icons/hero-slider-torn-bg.svg'); ?>" alt="" aria-hidden="true">
        <img class="hover"   src="<?php echo esc_url(THEME_URI . '/assets/icons/hero-slider-torn-bg-hover.svg'); ?>" alt="" aria-hidden="true"> -->
      </div>
    </div>

    <div class="swiper-pagination hidden-tablet hidden-desktop"></div>

    <img class="torn torn-bottom"
         src="<?php echo esc_url(THEME_URI . '/assets/images/torm-bottom.png'); ?>"
         alt=""
         aria-hidden="true">
  </div>
</section>

<div class="spacer"></div>
<section class="filter__section">
    <div class="container">
        <?php get_template_part(
            'template-parts/components/filter-form',
            null,
            ['action_url' => get_post_type_archive_link('destination')]
            );
        ;?>
    </div>
</section>
<div class="spacer"></div>
<section class="destinations-section">
    <div class="container">
        <h2 class="section-title">Top <span>Destinations</span></h2>
        <div class="grid-1-column-mobile grid-3-columns-desktop grid-3-columns-tablet gap-20">
            <?php if ($top_destinations->have_posts()) : ?>
            <?php while ($top_destinations->have_posts()) : $top_destinations->the_post() ; ?>
                <div class="flex-column-direction-mobile">
                    <?php if (has_post_thumbnail()) :?>
                    <a href="<?= the_permalink() ;?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                            <?php the_post_thumbnail('medium', [
                                'class' => 'ratio-4-3'
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
        <div class="spacer"></div>
        <div class="text-center">
            <a class="color-olive-green-btn btn" href="<?php echo get_post_type_archive_link('destination'); ;?>">
                <span>View All Destinations</span>
                <img class="arrow-icon" src="<?php echo get_template_directory_uri() . "/assets/icons/arrow-up-right.svg";?>" loading="lazy"
                decoding="async" alt="View All Destinations">
            </a>
        </div>
    </div>
</section>
<div class="spacer"></div>
<section class="contact-section beige-bg">
    <img class="torn torn-top" src="<?php echo  THEME_URI . '/assets/images/torm-bottom.png'?>" loading="lazy"
    decoding="async" alt="">
    <div class="container">
        <div class="contact-section_inner grid grid-1-column-mobile grid-2-columns-desktop grid-2-columns-tablet gap-30">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/h1-img-01.png' ;?>" loading="lazy"
            decoding="async" alt="Subscribe">
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
    <img class="torn torn-bottom" src="<?php echo  THEME_URI . '/assets/images/torm-bottom.png'?>" loading="lazy"
    decoding="async" alt="">
</section>
<div class="spacer"></div>
<section class="recent-post-section">
    <div class="container">
        <h2 class="section-title">Recent <span>Posts</span></h2>
        <div class="grid-3-columns-desktop grid-3-columns-tablet grid-1-column-mobile gap-20">
            <?php if ($recent_posts->have_posts()) : ?>
                <?php while ($recent_posts->have_posts()) : $recent_posts->the_post() ; ?>
                    <?php get_template_part(
                        'template-parts/components/card-item',
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
    <img class="torn torn-top" src="<?php echo  THEME_URI . '/assets/images/torm-bottom.png'?>" loading="lazy"
    decoding="async" alt="">
    <div class="container">
        <h2 class="section-title">Enjoy every <span>moment</span></h2>
    </div>
    <img class="torn torn-bottom" src="<?php echo  THEME_URI . '/assets/images/torm-bottom.png'?>" loading="lazy"
    decoding="async" alt="">
</section>
<section class="destination-categories__section">
    <div class="container destination-categories__inner">
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
                <div class="destination-category__item">
                    <a class="" href="<?php echo get_category_link($term->term_id) ;?>">
                        <div class="destination-category__item-icons">
                            <img class="default-icon" src="<?php echo $icon ;?>" alt="<?php echo $term->name;?>" loading="lazy"
                            decoding="async">
                            <img class="hover-icon" src="<?php echo $icon_hover ;?>" alt="<?php echo $term->name;?>" loading="lazy"
                            decoding="async">
                        </div>
                        <div class="destination-category__item-number-of-destination">
                            <span class="number"><?php echo esc_html($term->count);?></span>
                            <span>destinations</span>
                        </div>
                        <h5 class="destination-category__item-title no-margin"><?php echo $term->name ;?></h4>
                    </a>
                </div>
            <?php endforeach ;?>
        <?php endif ;?>
    </div>
</section>
<div class="spacer"></div>
<div class="spacer"></div>
<?php
get_footer();

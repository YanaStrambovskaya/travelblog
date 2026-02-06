<?php
/**
 * Single Destination Template
 */
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();

  // $destination_categories = get_the_terms( get_the_ID(), 'destination_category' );

  // ACF fields (add them later; template will still work if empty)
  $subtitle      = get_field('subtitle');
  $facts         = get_field('facts');    // Group field (recommended)
  $related_posts = get_field('related_posts'); // Relationship field (recommended)
  $gallery = get_field('gallery');
  $costs = get_field('average-costs-in-this-area', get_the_ID()); // <-- field NAME, not label
?>
<?php
    get_template_part(
        'template-parts/components/common-hero-section',
        null,
        ['title' => get_the_title()]
    )
;?>
<div class="spacer"></div>
<section>
  <div class="container">
  <div class="flex-column-direction-mobile flex-row-direction-desktop space-between gap-20 flex-start">
    <div class="content col-70-desktop  full-width">
      <!-- CONTENT START-------------------------------------------------------- -->
      <article class="content">
        <?php the_content(); ?>
      </article>
      <!-- CONTENT END-------------------------------------------------------- -->

      <!-- FACTS START-------------------------------------------------------- -->
      <?php if ( ! empty($facts) ) : ?>
      <div class="destination-facts">
        <div class="container">
          <h2 id="facts" class="section-title text-left">Facts</h2>
          <div class="facts-grid">
            <?php if ( !empty($facts['country']) ) : ?>
              <div class="fact">
                <span class="label">Country:&nbsp;</span>
                <span class="value"><?php echo esc_html($facts['country']); ?></span>
              </div>
            <?php endif; ?>
            <?php if ( !empty($facts['best_time']) ) : ?>
              <div class="fact">
                <span class="label">Best time:&nbsp;</span>
                <span class="value"><?php echo esc_html($facts['best_time']); ?></span>
              </div>
            <?php endif; ?>
            <?php if ( !empty($facts['currency']) ) : ?>
              <div class="fact">
                <span class="label">Currency:&nbsp;</span>
                <span class="value"><?php echo esc_html($facts['currency']); ?></span>
              </div>
            <?php endif; ?>
            <?php if ( !empty($facts['budget']) ) : ?>
              <div class="fact">
                <span class="label">Budget:&nbsp;</span>
                <span class="value"><?php echo esc_html($facts['budget']); ?></span>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <!-- FACTS END-------------------------------------------------------- -->

      <!-- GALLERY START-------------------------------------------------------- -->
      <?php if ( ! empty($gallery) ) : ?>
      <div class="destination-gallery">
        <div class="container">
          <h2 id="gallery" class="section-title text-left">GALLERY</h2>
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
                "slidesPerView" => 2
            ]
        ;?>
          <div class="swiper sigle-destination-swiper" data-swiper=<?php echo json_encode($swiperOptions) ;?>>
            <div class="swiper-wrapper">
              <?php foreach ($gallery as $image) : ?>
                <div class="swiper-slide grid">
                    <img class="ratio-4-3" src="<?php echo esc_url( $image ); ?>" alt="">
                </div>
              <?php endforeach; ?>
            </div>
            <div class="swiper-button prev visible-tablet visible-desktop">
              <div class="swiper-button__arrow">
                <svg class="" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M11 18.75C10.9015 18.7505 10.8038 18.7313 10.7128 18.6935C10.6218 18.6557 10.5393 18.6001 10.47 18.53L4.47001 12.53C4.32956 12.3894 4.25067 12.1988 4.25067 12C4.25067 11.8013 4.32956 11.6107 4.47001 11.47L10.47 5.47003C10.6122 5.33755 10.8002 5.26543 10.9945 5.26885C11.1888 5.27228 11.3742 5.35099 11.5116 5.48841C11.649 5.62582 11.7278 5.81121 11.7312 6.00551C11.7346 6.19981 11.6625 6.38785 11.53 6.53003L6.06001 12L11.53 17.47C11.6705 17.6107 11.7494 17.8013 11.7494 18C11.7494 18.1988 11.6705 18.3894 11.53 18.53C11.4608 18.6001 11.3782 18.6557 11.2872 18.6935C11.1962 18.7313 11.0986 18.7505 11 18.75Z" fill="#000000"></path> <path d="M19 12.75H5C4.80109 12.75 4.61032 12.671 4.46967 12.5303C4.32902 12.3897 4.25 12.1989 4.25 12C4.25 11.8011 4.32902 11.6103 4.46967 11.4697C4.61032 11.329 4.80109 11.25 5 11.25H19C19.1989 11.25 19.3897 11.329 19.5303 11.4697C19.671 11.6103 19.75 11.8011 19.75 12C19.75 12.1989 19.671 12.3897 19.5303 12.5303C19.3897 12.671 19.1989 12.75 19 12.75Z" fill="#000000"></path> </g></svg>
                <img class="default" src="<?php echo THEME_URI . '/assets/icons/hero-slider-torn-bg.svg' ;?>" alt="">
                <img class="hover" src="<?php echo THEME_URI . '/assets/icons/hero-slider-torn-bg-hover.svg' ;?>" alt="">
            </div>
          </div>
          <div class="swiper-button next visible-tablet visible-desktop">
            <div class="swiper-button__arrow">
                <svg class="" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M11 18.75C10.9015 18.7505 10.8038 18.7313 10.7128 18.6935C10.6218 18.6557 10.5393 18.6001 10.47 18.53L4.47001 12.53C4.32956 12.3894 4.25067 12.1988 4.25067 12C4.25067 11.8013 4.32956 11.6107 4.47001 11.47L10.47 5.47003C10.6122 5.33755 10.8002 5.26543 10.9945 5.26885C11.1888 5.27228 11.3742 5.35099 11.5116 5.48841C11.649 5.62582 11.7278 5.81121 11.7312 6.00551C11.7346 6.19981 11.6625 6.38785 11.53 6.53003L6.06001 12L11.53 17.47C11.6705 17.6107 11.7494 17.8013 11.7494 18C11.7494 18.1988 11.6705 18.3894 11.53 18.53C11.4608 18.6001 11.3782 18.6557 11.2872 18.6935C11.1962 18.7313 11.0986 18.7505 11 18.75Z" fill="#000000"></path> <path d="M19 12.75H5C4.80109 12.75 4.61032 12.671 4.46967 12.5303C4.32902 12.3897 4.25 12.1989 4.25 12C4.25 11.8011 4.32902 11.6103 4.46967 11.4697C4.61032 11.329 4.80109 11.25 5 11.25H19C19.1989 11.25 19.3897 11.329 19.5303 11.4697C19.671 11.6103 19.75 11.8011 19.75 12C19.75 12.1989 19.671 12.3897 19.5303 12.5303C19.3897 12.671 19.1989 12.75 19 12.75Z" fill="#000000"></path> </g></svg>
                <img class="default" src="<?php echo THEME_URI . '/assets/icons/hero-slider-torn-bg.svg' ;?>" alt="">
                <img class="hover" src="<?php echo THEME_URI . '/assets/icons/hero-slider-torn-bg-hover.svg' ;?>" alt="">
            </div>
          </div>
          <div class="swiper-pagination hidden-tablet hidden-desktop"></div>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <!-- GALLERY END-------------------------------------------------------- -->

      <!-- COSTS START-------------------------------------------------------- -->
      <?php if ( ! empty($costs) ) : ?>
        <div class="dest-costs">
          <div class="container">
            <h2 id="costs" class="section-title text-left">Average costs in this area</h2>
            <div class="costs-grid">
              <?php if ( ! empty($costs['transportation']) ) : ?>
                <div class="cost-item">
                  <h3 class="no-margin-bottom">Transportation</h3>
                  <p class="no-margin-bottom"><?php echo esc_html($costs['transportation']); ?></p>
                </div>
              <?php endif; ?>
              <?php if ( ! empty($costs['accommodation']) ) : ?>
                <div class="cost-item">
                  <h3 class="no-margin-bottom">Accommodation</h3>
                  <p class="no-margin-top"><?php echo esc_html($costs['accommodation']); ?></p>
                </div>
              <?php endif; ?>
              <?php if ( ! empty($costs['food']) ) : ?>
                <div class="cost-item">
                  <h3 class="no-margin-bottom">Food</h3>
                  <p class="no-margin-top"><?php echo esc_html($costs['food']); ?></p>
                </div>
              <?php endif; ?>
            </div>
            <?php if ( ! empty($costs['daily_budget_note']) ) : ?>
              <div class="daily-budget">
                <h3 class="no-margin-bottom">Suggested daily budget</h3>
                <p class="no-margin-top"><?php echo esc_html($costs['daily_budget_note']); ?></p>
              </div>
            <?php endif; ?>

          </div>
        </div>
      <?php endif; ?>
      <!-- COSTS END-------------------------------------------------------- -->
      <div class="spacer"></div>
      <div class="container">
        <div class="line"></div>
      </div>
      <div class="spacer"></div>
      <!-- RELATED POSTS-------------------------------------------------------- -->
      <?php if ( ! empty($related_posts) ) : ?>
        <div class="destination__related-links">
          <div class="container">
            <div class="flex space-between">
            <?php foreach ( $related_posts as $index => $p ) : ?>
                  <a class="flex gap-5" href="<?php echo esc_url( get_permalink( $p->ID ) ); ?>">
                    <?php
                      if ( $index === 0 ) { ;?>
                        <?php echo get_the_post_thumbnail( $p->ID, 'medium_large', ['class' => 'ratio-4-3 hidden visible-tablet visible-desktop'] ); ?>
                        <svg width="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" transform="rotate(90)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 20L11.2929 20.7071L12 21.4142L12.7071 20.7071L12 20ZM13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5L13 5ZM5.29289 14.7071L11.2929 20.7071L12.7071 19.2929L6.70711 13.2929L5.29289 14.7071ZM12.7071 20.7071L18.7071 14.7071L17.2929 13.2929L11.2929 19.2929L12.7071 20.7071ZM13 20L13 5L11 5L11 20L13 20Z" fill="#33363F"></path> </g></svg>
                        <h5 class="no-margin">Previous Destination</h5>
                        <?php } else { ;?>
                        <h5 class="no-margin">Next Destination</h5>
                        <svg width="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" transform="rotate(270)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 20L11.2929 20.7071L12 21.4142L12.7071 20.7071L12 20ZM13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5L13 5ZM5.29289 14.7071L11.2929 20.7071L12.7071 19.2929L6.70711 13.2929L5.29289 14.7071ZM12.7071 20.7071L18.7071 14.7071L17.2929 13.2929L11.2929 19.2929L12.7071 20.7071ZM13 20L13 5L11 5L11 20L13 20Z" fill="#33363F"></path> </g></svg>
                        <?php echo get_the_post_thumbnail( $p->ID, 'medium_large', ['class' => 'ratio-4-3 hidden visible-tablet visible-desktop'] ); ?>
                        <?php }?>
                  </a>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="spacer visible-desktop visible-tablet"></div>
      <div class="spacer"></div>
  </div>
  <aside class="sidebar col-30-desktop full-width">
    <?php if ( has_post_thumbnail() ) : ?>
        <div><?php the_post_thumbnail('full', ['class' => 'hero-image']); ?></div>
    <?php endif; ?>
    <div class="key-points__container flex-column-direction-mobile">
      <h3 class="sidebar-title text-center">KEY POINTS</h3>
      <a href="#facts" class="flex gap-5">
          <img src="<?php echo THEME_URI . '/assets/icons/destination-single-img-05.png' ;?>" alt="">
        <span>Facts</span>
      </a>
      <a href="#gallery" class="flex gap-5">
          <img src="<?php echo THEME_URI . '/assets/icons/destination-single-img-06.png' ;?>" alt="">
        <span>Gallery</span>
      </a>
      <a href="#costs" class="flex gap-5">
          <img src="<?php echo THEME_URI . '/assets/icons/destination-single-img-07.png' ;?>" alt="">
        <span>Costs</span>
      </a>
    </div>
    <div class="spacer"></div>
  </aside>
</div>
</section>

<?php
endwhile; endif;

get_footer();

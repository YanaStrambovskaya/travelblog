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
<!-- HERO -->
<section class="common-hero-section">
    <div class="container">
        <h1 class="common-hero-section_title"><?php the_title() ;?></h1>
    </div>
    <img class="common-hero-bg" src="<?php echo THEME_URI . '/assets/images/shop-title-img-01.jpg' ;?>" alt="">
</section>
<div class="spacer"></div>
<section>
  <div class="container">
  <div class="flex-col-mobile flex-row-desktop flex-between gap-20 flex-start">
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
          <div class="glide js-glide" data-glide='{"animationDuration":400,"type":"carousel","perView":3,"gap":16}'>
            <div class="glide__track" data-glide-el="track">
              <ul class="glide__slides">
                <?php foreach ($gallery as $image) : ?>
                <li class="glide__slide ratio-4-3">
                  <img src="<?php echo esc_url( $image ); ?>" alt="">
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="glide__arrows white-arrows" data-glide-el="controls">
              <button class="glide__arrow glide__arrow--left" data-glide-dir="<">‹</button>
              <button class="glide__arrow glide__arrow--right" data-glide-dir=">">›</button>
            </div>
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
        <div class="destination-related">
          <div class="container">
            <div class="posts-items flex space-between">
            <?php foreach ( $related_posts as $index => $p ) : ?>
                <div class="post-card">
                  <a class="flex" href="<?php echo esc_url( get_permalink( $p->ID ) ); ?>">
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
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="spacer"></div>
      <div class="spacer"></div>
  </div>
  <aside class="sidebar col-30-desktop full-width">
    <?php if ( has_post_thumbnail() ) : ?>
        <div><?php the_post_thumbnail('full', ['class' => 'hero-image']); ?></div>
    <?php endif; ?>
    <div class="key-points-container flex-column-direction">
      <h3 class="sidebar-title text-center">KEY POINTS</h3>
      <a href="#facts" class="flex gap-5">
        <div class="img-container"><img class="icon" src="<?php echo THEME_URI . '/assets/icons/destination-single-img-05.png' ;?>" alt=""></div>
        <span>Facts</span>
      </a>
      <a href="#gallery" class="flex gap-5">
        <div class="img-container"><img class="icon" src="<?php echo THEME_URI . '/assets/icons/destination-single-img-06.png' ;?>" alt=""></div>
        <span>Gallery</span>
      </a>
      <a href="#costs" class="flex gap-5">
        <div class="img-container"><img class="icon" src="<?php echo THEME_URI . '/assets/icons/destination-single-img-07.png' ;?>" alt=""></div>
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

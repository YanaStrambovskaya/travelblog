<?php 
    $footer_page = get_page_by_path('footer-content');
    $footer_page_id = $footer_page ? $footer_page->ID : 0;
;?>

<section class="footer-top">
    <div class="container">
        <div class="row flex-between gap-30">
            <div class="col-30">
                <a href="<?php echo esc_url(home_url('/')) ?>">
                    <img class="footer-top_logo" src="<?= get_field('footer_logo', $footer_page_id) ;?>" alt="Footer logo">
                </a>
            </div>
            <div class="col-70">
             <p class="footer-top_text">
                    <?= get_field('footer_top_text', $footer_page_id); ?>
                </p>
            </div>
        </div>
        <div class="row flex-between gap-30 flex-start">
            <div class="col-30 footer-top_about">
                <h4 class="footer-top_title">
                    <?= get_field('footer_about_title', $footer_page_id); ?>
                </h4>
                <p class="footer-top_about-description">
                    <?= get_field('footer_about_text', $footer_page_id); ?>
                </p>
            </div>
            <div class="col-70 flex-between gap-30 flex-start equal-columns">
                <div class="footer-top_subscribe">
                    <h4 class="footer-top_title">
                        <?= get_field('footer_subscribe_title', $footer_page_id); ?>
                    </h4>
                    <div class="footer-top_form">
                        <?php echo do_shortcode('[contact-form-7 id="cd232c9" title="Subscribe"]'); ?>
                    </div>
                </div>
                <div class="footer-top_news">
                    <h4 class="footer-top_title">
                        <?= get_field('footer_recent_news_title', $footer_page_id); ?>
                    </h4>
                    <ul class="footer-recent__list">
                        <?php
                        $recent = new WP_Query([
                        'post_type'           => 'post',
                        'posts_per_page'      => 3,
                        'post_status'         => 'publish',
                        'ignore_sticky_posts' => true,
                        'no_found_rows'       => true,
                        ]);

                        if ( $recent->have_posts() ) :
                        while ( $recent->have_posts() ) : $recent->the_post(); ?>
                            <li class="footer-recent__item">
                                <img class="calendar_icon" src="<?php echo get_template_directory_uri() . '/assets/icons/calendar-gray.svg' ;?>" alt="calendar">

                                <a href class="footer-recent__date">
                                    <?php echo esc_html( get_the_date('F j, Y') ); ?>
                                </a>

                                <a class="footer-recent__link multi-line-underline multi-line-underline-light" href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </li>
                        <?php endwhile;
                            wp_reset_postdata();
                        else : ?>
                            <li class="footer-recent__empty">No posts yet.</li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="footer-top_instagram-feed">
                    <h4 class="footer-top_title">
                        <?= get_field('footer_instagram_feed_title', $footer_page_id); ?>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</section>
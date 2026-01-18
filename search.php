<?php get_header(); ?>
<section class="common-hero-section">
    <div class="container">
        <h1 class="common-hero-section_title">
            Search page results for:
            <strong><?php echo esc_html(get_search_query()) ;?></strong>
        </h1>
    </div>
    <img class="common-hero-bg" src="<?php echo THEME_URI . '/assets/images/shop-title-img-01.jpg' ;?>" alt="">
</section>
<div class="spacer"></div>
<div class="spacer"></div>
<section class="category-content">
    <div class="container">
    <?php
        if (have_posts()) {
            echo '<div class="post-items grid-2-columns gap-30">';
            while(have_posts()) {
                the_post();
                get_template_part(
                    'template-parts/components/search-result',
                    null,
                    []
                );
            };
            echo '</div>';
            echo '<div class="spacer"></div>';
            echo '<div class="pagination">';
            the_posts_pagination(
                [
                    'mid_size' => 2,
                    'prev_text' => __('«', 'travelblog'),
                    'next_text' => __('»', 'travelblog'),
                ]
            );
            echo '</div>';
        };
    ;?>
    </div>
</section>
<div class="spacer"></div>
<div class="spacer"></div>
<?php get_footer() ;?>
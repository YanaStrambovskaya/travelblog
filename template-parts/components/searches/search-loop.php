<?php
$args = wp_parse_args($args, [
    'title' => ''
]);
get_header(); ?>
<?php
    get_template_part(
        'template-parts/components/common-hero-section',
        null,
        ['title' => $args['title']]
    )
;?>
<div class="spacer"></div>
<div class="spacer"></div>
<section class="category-content">
    <div class="container">
    <?php
        if (have_posts()) {
            echo '<div class="card-items grid-2-columns-desktop grid-1-columns-tablet grid-1-column-mobile gap-30">';
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
            get_template_part(
                'template-parts/components/pagination',
                null,
                []
            );
        };
    ;?>
    </div>
</section>
<div class="spacer"></div>
<div class="spacer"></div>
<?php get_footer() ;?>
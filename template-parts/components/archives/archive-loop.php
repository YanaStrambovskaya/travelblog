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
<section class="category-content">
    <div class="container">
        <?php if (category_description()) : ?>
            <div class="category-description">
                <?php echo category_description() ;?>
            </div>
            <div class="spacer"></div>
        <?php endif ;?>
        <div class="flex-column-direction-mobile flex-row-direction-desktop space-between gap-40 flex-start">
            <div class="col-70-desktop  full-width">
                <div class="card-items grid gap-60">
                    <?php if (have_posts()) :?>
                        <?php while (have_posts()) : the_post(); ?>
                            <?php get_template_part(
                                'template-parts/components/card-item',
                                null,
                                []
                                );
                            ;?>
                        <?php endwhile; wp_reset_postdata() ;?>
                        <?php
                            get_template_part(
                                'template-parts/components/pagination',
                                null,
                                []
                            )
                        ;?>
                    <?php else : ?>
                        <p class="no-results-text">No posts found</p>
                    <?php endif; ?>
                </div>
                <div class="spacer"></div>
                <div class="spacer"></div>
            </div>
            <?php
                get_template_part(
                    'template-parts/components/aside',
                    null,
                    ['title' => 'Categories']
                )
            ;?>
        </div>
    </div>
</section>

<?php get_footer(); ?>

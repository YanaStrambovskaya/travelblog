<?php
$categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
) );
// blog listing template
// This one file will display all posts as your blog page.

get_header(); ?>
<section class="common-hero-section">
    <div class="container">
        <h1 class="common-hero-section_title"><?php single_post_title() ;?></h1>
    </div>
    <img class="common-hero-bg" src="<?php echo THEME_URI . '/assets/images/shop-title-img-01.jpg' ;?>" alt="">
</section>
<div class="spacer"></div>
<section class="category-content">
    <div class="container">
        <?php if (category_description()) : ?>
            <div class="category-description">
                <?php echo category_description() ;?>
            </div>
            <div class="spacer"></div>
        <?php endif ;?>
        <div class="flex-between gap-40 flex-start">
            <div class="col-70">
                <div class="post-items">
                    <?php if (have_posts()) :?>
                        <?php while (have_posts()) : the_post(); ?>
                            <?php get_template_part(
                                'template-parts/components/post-item',
                                null,
                                []
                                );
                            ;?>
                        <?php endwhile; wp_reset_postdata() ;?>
                        <div class="pagination">
                            <?php the_posts_pagination( array(
                                'mid_size' => 2,
                                'prev_text' => __('«', 'travelblog'),
                                'next_text' => __('»', 'travelblog'),
                            ) );?>
                        </div>
                    <?php endif ;?>
                </div>
                <div class="spacer"></div>
                <div class="spacer"></div>
            </div>
            <aside class="sidebar col-30"> 
                <a href="/about">
                    <img src="<?php echo THEME_URI . '/assets/images/sidebar-img.png' ;?>" alt="">
                    <h3 class="sidebar-title">Wanderlust blog</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipi</p>
                </a>
                <h3 class="sidebar-title">Categories</h3>
                <?php foreach($categories as $category) : ?>
                    <div class="category-item">
                        <a href="<?php echo get_category_link( $category->term_id ) ;?>">
                            <?php echo $category->name ;?> (<?php echo $category->count ;?>)
                        </a>
                    </div>
                <?php endforeach ;?>
                <div class="spacer"></div>
                <div class="spacer"></div>
            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>

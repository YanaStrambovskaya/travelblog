<?php
$categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
) );
$tags = get_the_tags();
// single post template
// Now every post you open (like /blog/my-first-post/) will use single.php.
get_header(); ?>

<section class="common-hero-section">
    <div class="container">
        <h1 class="common-hero-section_title">Blog</h1>
    </div>
    <img class="common-hero-bg" src="<?php echo THEME_URI . '/assets/images/blog-post-img-09.jpg' ;?>" alt="">
</section>
<section class="blog-content">
    <div class="container">
        <div class="flex-between">
            <div class="col-70">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <!-- the_post() prepares the global post context -->
                <!-- the_post() does critical setup: -->
                <!-- sets the global $post -->
                <!-- prepares: -->
                    <!-- the_title() -->
                    <!-- the_content() -->
                    <!-- get_the_date() -->
                    <!-- get_the_author() -->
                    <!-- the_post_thumbnail() -->
                    <!-- sets internal loop state -->
                    <!-- The Loop is not about quantity -->
                    <!-- It’s about context -->
                    <!-- Even one post needs context. -->
                    <article id="post-<?php the_ID(); ?>" class="post-item">
                        <?php the_post_thumbnail('medium') ;?>
                        <?php the_title() ;?>
                        <div class="meta">
                            <?php get_the_date() ;?> | <?php get_the_author() ;?>
                        </div>
                        <?php the_content() ;?>
                    </article>
                    <nav class="post-navigation">
                        <?php
                        the_post_navigation([
                        // If you want to navigate within same Destination, uncomment:
                        // 'in_same_term' => true,
                        // 'taxonomy'     => 'destination',

                        'prev_text' => '<span class="nav-label">' . esc_html__( 'Previous', 'travelblog' ) . '</span><span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-label">' . esc_html__( 'Next', 'travelblog' ) . '</span><span class="nav-title">%title</span>',
                        ]);
                        ?>
                    </nav>
                    <?php
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                    ?>
                <?php endwhile; endif; ?>
            </div>
            <aside class="sidebar col-30"> 
                <h3>Categories</h3>
                <?php foreach($categories as $category) : ?>
                    <div class="category-item">
                        <a href="<?php echo get_category_link( $category->term_id ) ;?>">
                            <?php echo $category->name ;?> (<?php echo $category->count ;?>)
                        </a>
                    </div>
                <?php endforeach ;?>
                <h3>Tags</h3>
                <?php foreach($tags as $tag) : ?>
                    <div class="tag-item">
                        <a href="<?php echo get_category_link( $tag->term_id ) ;?>">
                            <?php echo $tag->name ;?> (<?php echo $tag->count ;?>)
                        </a>
                    </div>
                <?php endforeach ;?>
            </aside>
        </div>
    </div>
</section>
<?php get_footer(); ?>

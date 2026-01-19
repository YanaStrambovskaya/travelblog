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
<div class="spacer"></div>
<section class="blog-content">
    <div class="container">
        <div class="flex-col-mobile flex-row-desktop flex-between gap-20 flex-start">
            <div class="col-70-desktop  full-width">
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

                        'prev_text' => '<span class="nav-label"><svg width="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" transform="rotate(90)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 20L11.2929 20.7071L12 21.4142L12.7071 20.7071L12 20ZM13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5L13 5ZM5.29289 14.7071L11.2929 20.7071L12.7071 19.2929L6.70711 13.2929L5.29289 14.7071ZM12.7071 20.7071L18.7071 14.7071L17.2929 13.2929L11.2929 19.2929L12.7071 20.7071ZM13 20L13 5L11 5L11 20L13 20Z" fill="#33363F"></path> </g></svg></span><span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-title">%title</span><span class="nav-label"><svg width="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" transform="rotate(270)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 20L11.2929 20.7071L12 21.4142L12.7071 20.7071L12 20ZM13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5L13 5ZM5.29289 14.7071L11.2929 20.7071L12.7071 19.2929L6.70711 13.2929L5.29289 14.7071ZM12.7071 20.7071L18.7071 14.7071L17.2929 13.2929L11.2929 19.2929L12.7071 20.7071ZM13 20L13 5L11 5L11 20L13 20Z" fill="#33363F"></path> </g></svg></span>',
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
            <aside class="sidebar col-30-desktop full-width"> 
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
<div class="spacer"></div>
<?php get_footer(); ?>

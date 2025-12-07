<?php
/* Template for the front page */
get_header();
?>

<section class="hero">
    Hello!
    <h1><?php bloginfo( 'name' ); ?></h1>
    <p><?php bloginfo( 'description' ); ?></p>
</section>

<section class="latest-posts">
    <h2>Latest posts</h2>
    <?php
    $query = new WP_Query( array( 'posts_per_page' => 3 ) );
    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post(); ?>
            <article <?php post_class(); ?>>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php the_excerpt(); ?>
            </article>
        <?php endwhile;
        wp_reset_postdata();
    endif;
    ?>
</section>

<?php
get_footer();

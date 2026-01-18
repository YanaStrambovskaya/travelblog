<?php get_header(); ?>
<!-- Category-specific pages -->
<main class="container archive-list">

    <h1 class="archive-title">
        <?php the_archive_title(); ?>
    </h1>
    <div class="archive-description">
        <?php the_archive_description(); ?>
    </div>

    <?php if ( have_posts() ) : ?>
        <div class="posts-grid">
            <?php while ( have_posts() ) : the_post(); ?>
                <!-- same card markup as in home.php -->
            <?php endwhile; ?>
        </div>

        <div class="pagination">
            <?php the_posts_pagination( array(
                'mid_size' => 2,
                'prev_text' => __('«', 'travelblog'),
                'next_text' => __('»', 'travelblog'),
            ) );?>
        </div>
    <?php else : ?>
        <p><?php _e( 'No posts found.', 'travelblog' ); ?></p>
    <?php endif; ?>

</main>

<?php get_footer(); ?>

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

        <?php the_posts_pagination(); ?>
    <?php else : ?>
        <p><?php _e( 'No posts found.', 'travelblog' ); ?></p>
    <?php endif; ?>

</main>

<?php get_footer(); ?>

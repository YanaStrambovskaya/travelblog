<?php ;
    $args = wp_parse_args($args, [
        'title' => ''
    ]);
?>
<section class="common-hero-section">
    <div class="container">
        <h1 class="common-hero-section_title"><?php echo esc_html($args['title']) ;?></h1>
    </div>
    <img class="common-hero-bg" src="<?php echo THEME_URI . '/assets/images/shop-title-img-01.jpg' ;?>" alt="">
</section>
<?php
    $args = wp_parse_args($args, [
        'title' => ''
    ]);

    $categories = get_categories(array(
        'orderby' => 'name',
        'order'   => 'ASC'
    ));
;?>

<aside class="sidebar col-30-desktop full-width"> 
    <h3 class="sidebar-title"><?php echo $args['title'] ;?></h3>
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
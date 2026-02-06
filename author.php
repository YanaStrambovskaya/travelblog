<?php
get_header(); ?>
<?php
    $title = 'Posts by:' . get_the_author();
    get_template_part(
        'template-parts/components/archives/archive-loop',
        null,
        ['title' => $title]
    )
;?>

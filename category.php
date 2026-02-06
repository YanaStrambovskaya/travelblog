
<?php
get_header(); ?>
<?php
    get_template_part(
        'template-parts/components/archives/archive-loop',
        null,
        ['title' => single_cat_title('', false)]
    )
;?>

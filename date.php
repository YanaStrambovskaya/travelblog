<?php
get_header(); ?>
<?php
    $title = '';
    if (is_day()) {
        $title = 'Posts from ' . get_the_date();
    } elseif (is_month()) {
        $title = 'Posts from ' . get_the_date('F Y');
    } elseif (is_year()) {
        $title = 'Posts from ' . get_the_date('Y');
    }
    get_template_part(
        'template-parts/components/archives/archive-loop',
        null,
        ['title' => $title]
    )
;?>
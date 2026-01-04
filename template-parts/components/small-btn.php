<?php
    $args = wp_parse_args($args ?? [], ['text' => '', 'url' => '#']);
?>

<a class="btn" href="<?php echo esc_url($args['url']); ?>">
    <span><?php echo $args['text']; ?></span>
    <img src="<?php echo get_template_directory_uri() . "/assets/icons/arrow-up-right.svg";?>">
</a>
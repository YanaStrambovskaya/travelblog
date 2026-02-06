<?php
?>
<div class="card-item card-item_horizontal flex gap-20">
    <a class="col-30" href="<?= esc_url(get_permalink()) ;?>">
        <?= the_post_thumbnail('medium', [
            'class' => 'ratio-4-3'
        ]) ;?>
    </a>
    <div class="col-70 card-item_inner gap-10 flex-column-direction-mobile">
        <h3 class="item-title no-margin">
            <a class="multi-line-underline" href="<?= esc_url(get_permalink()) ;?>">
                <span><?= esc_html(the_title()) ;?></span>
            </a>
        </h3>
        <div class="meta-date-container flex gap-10">
            <div class="date gap-5">
                <img class="calendar-icon--grey" src="<?php echo get_template_directory_uri() . '/assets/icons/calendar-gray.svg' ;?>" alt="calendar">
                <span><?php echo get_the_date(); ?></span>
            </div>
            <div class="author">
                <img class="pencil_icon--grey" src="<?php echo get_template_directory_uri() . '/assets/icons/pencil-gray.svg' ;?>" alt="calendar">
                <span><?php echo esc_html( get_the_author() ); ?></span>
            </div>
        </div>
        <p class="content no-margin flex-grow">
            <?php echo wp_trim_words( get_the_content(), 25, '…' ); ?>
        </p>
        <a href="<?= get_permalink() ;?>">
            <span class="read-more-text">READ MORE</span>
            <img class="arrow-icon" width="20" height="20" src="<?php echo get_template_directory_uri() . '/assets/icons/arrow-up-right-svgrepo-com.svg' ;?>" alt="Read more"/>
        </a>
    </div>
    
</div>
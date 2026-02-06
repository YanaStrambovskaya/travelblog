<?php
    $related_category = get_the_category(get_the_ID());
    if (empty($related_category)) {
        $related_category = get_the_terms(get_the_ID(), 'destination_category');
    }
    $related_category = $related_category[0];
?>
<div class="card-item gap-5 flex-column-direction-mobile">
    <div class="thumbnail-container position-relative">
        <a class="torn-label__container" href="<?= esc_url( get_category_link( $related_category->term_id ) ); ?>">
            <svg class="torn--side-left" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 15.7 30" style="enable-background:new 0 0 15.7 30;" xml:space="preserve" class="mkdf-active-hover-left"><polygon class="st0" points="2.6,1 0.7,3.3 2,5.8 2.3,7.6 2.9,8.7 4.4,10.5 3.9,10.8 4.4,11.9 4.4,12.8 4.1,13.8 3.3,14.7 3.9,15.8 4.4,16.8 4,17.5 3.5,18.1 2.2,20.2 3.4,21.5 4.2,24.1 3.4,25.4 2.5,27.4 2.5,27.8 3.2,28.3 4.1,28.5 4.9,29 14.8,29 14.8,1 "></polygon></svg>
            <span class="torn-text">
                <svg class="label-icon" fill="#878787" height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve" stroke="#878787"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M24.896,9.463c-0.188-0.188-0.441-0.293-0.707-0.293L11.232,9.169c-0.551,0-0.998,0.445-1,0.996L10.186,23.17 c-0.001,0.267,0.104,0.522,0.293,0.711l16.995,16.995c0.188,0.188,0.441,0.293,0.707,0.293s0.52-0.105,0.707-0.293l13.004-13.004 c0.391-0.391,0.391-1.023,0-1.414L24.896,9.463z M28.181,38.755L12.188,22.761l0.041-11.592l11.547,0.001l15.995,15.995 L28.181,38.755z"></path> <circle cx="20.362" cy="19.346" r="2.61"></circle> </g></svg>
                <span><?= esc_html( $related_category->name ); ?></span>
            </span>
            <svg class="torn--side-right" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 13.3 30" style="enable-background:new 0 0 13.3 30;" xml:space="preserve" class="mkdf-active-hover-right"><polygon class="st0" points="10,1 10.2,2.1 10.6,2.9 10.6,3.3 10.8,3.7 10.8,4.3 11,5 11,5.7 11,6.3 10.5,6.7 10.8,7.3 11,7.8 	11.6,8.3 11.6,8.6 11.5,8.9 11.6,9.9 11.6,10.5 12.4,11.6 12.1,12 12.4,12.2 11.8,12.8 11.4,13.5 11.6,13.7 11.9,13.7 12,13.9 11.5,15.1 10.8,16 9.1,17.7 9.7,18.2 9.3,19 9.7,19.8 9.6,20.6 9.7,21.5 9.6,21.9 9.6,22.3 10.1,22.8 9.6,23.6 9.7,24 9.7,24.2 9.9,24.4 9.5,24.7 9.3,25.4 9.3,25.9 8.8,26.2 8.5,27.1 8.8,27.8 9.4,28.6 7.8,29 0.9,29 0.9,1 "></polygon></svg>    
        </a>
        <a class="full-width" href="<?= esc_url(get_permalink()) ;?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
            <?= the_post_thumbnail('medium', [
                'class' => 'ratio-4-3'
            ]) ;?>
        </a>
    </div>
    <div class="flex flex-grow-desktop flex-grow-tablet gap-10 flex-column-direction-mobile ">
        <h3 class="item-title no-margin-top">
            <a class="multi-line-underline" href="<?= esc_url(get_permalink()) ;?>">
                <span><?= esc_html(the_title()) ;?></span>
            </a>
        </h3>
        <div class="meta-date-container flex gap-10">
            <a href="<?php echo esc_url(
                get_day_link(get_the_time('Y'),
                get_the_time('m'),
                get_the_time('d')));?>" 
                class="date gap-5"
            >
                <img class="calendar-icon--grey" src="<?php echo get_template_directory_uri() . '/assets/icons/calendar-gray.svg' ;?>" alt="calendar">
                <span><?php echo get_the_date(); ?></span>
            </a>
            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>" class="author">
                <img class="pencil_icon--grey" src="<?php echo get_template_directory_uri() . '/assets/icons/pencil-gray.svg' ;?>" alt="calendar">
                <span><?php echo esc_html( get_the_author() ); ?></span>
            </a>
        </div>
        <p class="description no-margin flex-grow">
            <?php echo wp_trim_words( get_the_content(), 25, '…' ); ?>
        </p>
        <a href="<?= get_permalink() ;?>">
            <span class="read-more-text">READ MORE</span>
            <img class="arrow-icon" width="20" height="20" src="<?php echo get_template_directory_uri() . '/assets/icons/arrow-up-right-svgrepo-com.svg' ;?>" alt="Read more"/>
        </a>
    </div>
</div>
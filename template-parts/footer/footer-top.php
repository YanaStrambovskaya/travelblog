<?php 
    $footer_page = get_page_by_path('footer-content');
    $footer_page_id = $footer_page ? $footer_page->ID : 0;
;?>

<section class="footer">
    <div class="container footer__inner grid">
        <div class="footer__logo-widget">
            <?php 
                if (is_active_sidebar('footer_top_logo_widget')) {
                    dynamic_sidebar('footer_top_logo_widget');
                }
            ;?>
        </div>
        <div class="footer__desc-intro">
            <?php 
                if (is_active_sidebar('footer_intro_widget')) {
                    dynamic_sidebar('footer_intro_widget');
                }
            ;?>
        </div>
        <div class="footer__about-widget">
            <?php 
                if (is_active_sidebar('about_widget')) {
                    dynamic_sidebar('about_widget');
                }
            ;?>
        </div>
        <div class="footer__subscribe-widget">
            <?php 
                if (is_active_sidebar('subscribe_widget')) {
                    dynamic_sidebar('subscribe_widget');
                }
            ;?>
        </div>
        <div class="footer__news-widget">
            <?php 
                if (is_active_sidebar('recent_news_widget')) {
                    dynamic_sidebar('recent_news_widget');
                }
            ;?>
        </div>
    </div>
</section>

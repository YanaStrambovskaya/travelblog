
<div class="bar">
    <div class="container flex space-between">
        <div class="flex">
            <?php 
                if (is_active_sidebar('contacts_widget')) {
                    dynamic_sidebar('contacts_widget');
                }
            ;?>
        </div>
        <?php 
            if (is_active_sidebar('social_icons')) {
                dynamic_sidebar('social_icons');
            }
        ;?>
    </div>
</div>
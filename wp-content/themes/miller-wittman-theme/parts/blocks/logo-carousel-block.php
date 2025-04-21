<?php

$logos = get_field('logos') ?: [];

openBlock();
?>


<div class="logoCarousel mt-96 mb-96">
    <div class="logoCarousel__marqueeContainer">
        <div class="logoCarousel__marquee">
            <div class="logoCarousel__marqueeContent">
                <?php foreach( $logos as $logo ): ?>
                    <div class="logoCarousel__item">
                        <?php echo wp_get_attachment_image( $logo, 'medium'); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php
closeBlock();

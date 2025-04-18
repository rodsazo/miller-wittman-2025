<?php
$text = get_field('text');
$link = get_field('link');
$background_image = get_field('background_image');
$carousel = get_field('carousel') ?: [];

?>

<div class="homeIntro">
    <?php if( $background_image ): ?>
        <div class="homeIntro__bg">
            <?php echo wp_get_attachment_image( $background_image, 'large' ) ?>
        </div>
    <?php endif; ?>

    <div class="container">

    </div>

</div>

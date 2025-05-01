<?php
$text = get_field('text');
$link = get_field('cta_button') ?: [];
$background_image = get_field('background_image');
$carousel = get_field('carousel') ?: [];

$link = get_link_params($link);

?>

<div class="homeIntro scheme--dark" data-scrollvars>
    <?php if( $background_image ): ?>
        <div class="homeIntro__bg u-of">
            <?php echo wp_get_attachment_image( $background_image, 'large', false, ['alt' => '' , 'role' => 'decoration'] ) ?>
        </div>
    <?php endif; ?>

    <div class="container">

        <div class="homeIntro__text">
            <?php echo $text; ?>
        </div>

        <?php if( $link ): ?>
            <div class="homeIntro__cta">
                <?php the_button( $link ); ?>
            </div>
        <?php endif; ?>

        <?php if( !empty($carousel) ): ?>
            <div class="homeIntro__marqueeContainer">
                <div class="homeIntro__marquee">
                    <div class="homeIntro__marqueeContent">
                        <?php foreach( $carousel as $phrase ): ?>
                                <div class="homeIntro__phrase">
                                    <?php echo $phrase['item']; ?>
                                </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>

</div>

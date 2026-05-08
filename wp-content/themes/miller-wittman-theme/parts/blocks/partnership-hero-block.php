<?php

openBlock();

$title = get_field('title');
$logos = get_field('logos') ?: [];
$text = get_field('text');

?>

<div class="partnershipHero">
    <div class="container container--large">
        <div class="partnershipHero__row">
            <div class="partnershipHero__main">
                <?php if( $title ): ?>
                    <h1 class="partnershipHero__title">
                        <?php echo $title; ?>
                    </h1>
                <?php endif; ?>
            </div>

            <div class="partnershipHero__aside">
                <?php if( !empty( $logos ) ): ?>
                    <div class="partnershipHero__logos">
                        <?php foreach( $logos as $logo ): ?>
                            <div class="partnershipHero__logo">
                                <?php echo wp_get_attachment_image( $logo, 'medium' ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if( $text ): ?>
                    <div class="partnershipHero__text wpContent">
                        <?php echo $text; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
closeBlock();

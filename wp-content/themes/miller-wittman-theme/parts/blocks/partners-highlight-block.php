<?php

openBlock();

$number = get_field( 'number' );
$large_text = get_field( 'large_text' );
$text = get_field( 'text' );

?>

<div class="partnersHighlight">
    <div class="container container--large partnersHighlight__container">
        <div class="partnersHighlight__panel">
            <div class="partnersHighlight__content">
                <?php if ( $number ) : ?>
                    <div class="partnersHighlight__number" aria-hidden="true">
                        <?php echo esc_html( $number ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( $large_text ) : ?>
                    <div class="partnersHighlight__largeText">
                        <?=$large_text; ?>
                    </div>
                <?php endif; ?>

                <?php if ( $text ) : ?>
                    <div class="partnersHighlight__text">
                        <?=$text; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
closeBlock();

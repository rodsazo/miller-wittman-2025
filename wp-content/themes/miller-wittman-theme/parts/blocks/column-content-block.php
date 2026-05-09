<?php

openBlock();

$title = get_field('title');
$text = get_field('text');

?>

<div class="columnContentBlock">
    <div class="container container--large">
        <div class="columnContentBlock__row">
            <?php if( $title ): ?>
                <h2 class="columnContentBlock__title">
                    <?php echo esc_html( $title ); ?>
                </h2>
            <?php endif; ?>

            <?php if( $text ): ?>
                <div class="columnContentBlock__text wpContent">
                    <?php echo $text; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
closeBlock();

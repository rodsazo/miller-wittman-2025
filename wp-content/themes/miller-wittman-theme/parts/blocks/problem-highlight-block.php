<?php

openBlock();

$title = get_field('title');
$main_paragraph = get_field('main_paragraph');
$text = get_field('text');

?>

<div class="container container--large">
    <div class="problemHighlight">    
        <div class="problemHighlight__inner">
            <?php if( $title ): ?>
                <h2 class="problemHighlight__title">
                    <?php echo esc_html( $title ); ?>
                </h2>
            <?php endif; ?>

            <div class="problemHighlight__icon" aria-hidden="true">
                <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 32H46" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M34 20L46 32L34 44" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <div class="problemHighlight__content">
                <?php if( $main_paragraph ): ?>
                    <div class="problemHighlight__lead">
                        <?php echo nl2br( esc_html( $main_paragraph ) ); ?>
                    </div>
                <?php endif; ?>

                <?php if( $text ): ?>
                    <div class="problemHighlight__text wpContent">
                        <?php echo $text; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
closeBlock();

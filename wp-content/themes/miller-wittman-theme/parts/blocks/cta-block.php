<?php

openBlock();

$title = get_field( 'title' );
$text = get_field( 'text' );
$button_link = get_field( 'link' );
$button_link = get_link_params( $button_link );

?>

<div class="ctaBlock">
    <div class="container container--large">
        <div class="ctaBlock__inner">
            <?php if ( $title ) : ?>
                <div class="ctaBlock__titleWrap">
                    <h2 class="ctaBlock__title">
                        <?=$title; ?>
                    </h2>
                </div>
            <?php endif; ?>

            <div class="ctaBlock__aside">
                <?php if ( $text ) : ?>
                    <div class="ctaBlock__text">
                        <?=$text; ?>
                    </div>
                <?php endif; ?>

                <?php if ( $button_link ) : ?>
                    <div class="ctaBlock__actions">
                        <a class="ctaBlock__button" href="<?php echo esc_url( $button_link['url'] ); ?>" <?php echo $button_link['target_attr']; ?>>
                            <span class="ctaBlock__buttonLabel">
                                <?php echo esc_html( $button_link['title'] ); ?>
                            </span>
                        </a>

                        <a class="ctaBlock__arrowButton" href="<?php echo esc_url( $button_link['url'] ); ?>" <?php echo $button_link['target_attr']; ?> aria-label="<?php echo esc_attr( $button_link['title'] ); ?>">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                                <path d="M7.05733 16.0573L8.94267 17.9426L17.8853 8.99992L8.94267 0.057251L7.05733 1.94258L12.7813 7.66658H0V10.3333H12.7813L7.05733 16.0573Z" fill="currentColor"/>
                            </svg>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
closeBlock();

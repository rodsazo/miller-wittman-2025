<?php

openBlock();

$title = get_field( 'title' );
$subtitle = get_field( 'subtitle' );
$text = get_field( 'text' );
$cards = get_field( 'cards' ) ?: [];

$cards_count = count( $cards );
?>

<div class="process">
    <div class="container container--large process__container">
        <div class="process__inner">
            <div class="process__header">
                <?php if ( $title ) : ?>
                    <h2 class="process__title">
                        <?php echo esc_html( $title ); ?>
                    </h2>
                <?php endif; ?>

                <div class="process__summary">
                    <?php if ( $subtitle ) : ?>
                        <div class="process__subtitle">
                            <?php echo esc_html( $subtitle ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( $text ) : ?>
                        <div class="process__text">
                            <?=$text; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ( $cards ) : ?>
                <div class="process__cards" style="--process-cards-count: <?php echo esc_attr( max( 1, $cards_count ) ); ?>;">
                    <?php foreach ( $cards as $index => $card ) :
                        $card_title = $card['title'] ?? '';
                        $card_text = $card['text'] ?? '';
                        $partners = $card['partners'] ?? '';
                        $card_number = str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT );
                        ?>
                        <article class="process__card">
                            <div class="process__cardNumber" aria-hidden="true">
                                <?php echo esc_html( $card_number ); ?>
                            </div>

                            <div class="process__cardBody">
                                <?php if ( $card_title ) : ?>
                                    <h3 class="process__cardTitle heading-cap-height">
                                        <?php echo esc_html( $card_title ); ?>
                                    </h3>
                                <?php endif; ?>

                                <?php if ( $card_text ) : ?>
                                    <div class="process__cardText">
                                        <?=$card_text; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if ( $partners ) : ?>
                                <div class="process__cardPartners">
                                    <svg class="process__cardPartnersIcon" viewBox="0 0 20 20" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 10H14" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                                        <path d="M10 6L14 10L10 14" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="process__cardPartnersText">
                                        <?php echo esc_html( $partners ); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
closeBlock();

<?php

openBlock();

$title = get_field( 'title' );
$subtitle = get_field( 'subtitle' );
$text = get_field( 'text' );
$callout = get_field( 'callout' );
$cards = get_field( 'cards' ) ?: [];

?>

<div class="solutionHighlight">
    <div class="container container--large solutionHighlight__container">
        <div class="solutionHighlight__inner">
            <div class="solutionHighlight__header">
                <?php if ( $title ) : ?>
                    <h2 class="solutionHighlight__title heading-cap-height">
                        <?php echo esc_html( $title ); ?>
                    </h2>
                <?php endif; ?>

                <div class="solutionHighlight__summary">
                    <?php if ( $subtitle ) : ?>
                        <div class="solutionHighlight__subtitle">
                            <?php echo esc_html( $subtitle ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( $text ) : ?>
                        <div class="solutionHighlight__text">
                            <?=$text; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ( $cards ) : ?>
                <div class="solutionHighlight__cards">
                    <?php foreach ( $cards as $card ) :
                        $card_title = $card['title'] ?? '';
                        $partner_name = $card['partner_name'] ?? '';
                        $partner_location = $card['partner_location'] ?? '';
                        $description = $card['description'] ?? '';
                        $features = $card['features'] ?? [];
                        $feature_count = is_array( $features ) ? count( $features ) : 0;
                        ?>
                        <article class="solutionHighlight__card">
                            <?php if ( $card_title ) : ?>
                                <h3 class="solutionHighlight__cardTitle heading-cap-height">
                                    <?php echo esc_html( $card_title ); ?>
                                </h3>
                            <?php endif; ?>

                            <div class="solutionHighlight__cardMeta">
                                <?php if ( $partner_name ) : ?>
                                    <div class="solutionHighlight__partnerName">
                                        <?php echo esc_html( $partner_name ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ( $partner_location ) : ?>
                                    <div class="solutionHighlight__partnerLocation">
                                        <?php echo esc_html( $partner_location ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if ( $description ) : ?>
                                <div class="solutionHighlight__description">
                                    <?php echo nl2br( esc_html( $description ) ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( $features ) : ?>
                                <div class="solutionHighlight__features">
                                    <?php foreach ( $features as $feature_index => $feature ) :
                                        $feature_text = $feature['text'] ?? '';
                                        $is_full_width = $feature_count % 2 === 1 && $feature_index === $feature_count - 1;
                                        ?>
                                        <?php if ( $feature_text ) : ?>
                                            <div class="solutionHighlight__feature<?php echo $is_full_width ? ' solutionHighlight__feature--fullWidth' : ''; ?>">
                                                <svg class="solutionHighlight__featureIcon" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M19 7L10.5 16L5 10.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                <span class="solutionHighlight__featureText">
                                                    <?php echo esc_html( $feature_text ); ?>
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if ( $callout ) : ?>
        <div class="solutionHighlight__calloutWrap">
            <div class="container container--large">
                <div class="solutionHighlight__callout">
                    <?=$callout; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php
closeBlock();

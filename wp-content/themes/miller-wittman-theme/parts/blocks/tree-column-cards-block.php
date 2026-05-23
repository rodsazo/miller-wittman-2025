<?php
openBlock();

$title = get_field( 'title' );
$subtitle = get_field( 'subtitle' );
$cards = get_field( 'cards' ) ?: [];
$cards_count = count( $cards );
$cards_columns = max( 1, min( 3, $cards_count ?: 3 ) );
$has_header = $title || $subtitle;
?>

<div class="treeColumnCards<?php echo $has_header ? '' : ' no-header'; ?>" style="--tree-column-cards-columns: <?php echo esc_attr( $cards_columns ); ?>;">
    <div class="container container--large treeColumnCards__container">
        <div class="treeColumnCards__inner<?php echo $has_header ? ' has-header' : ' no-header'; ?>">
            <div class="treeColumnCards__header<?php echo $subtitle ? ' has-subtitle' : ''; ?>">
                <?php if ( $title ) : ?>
                    <h2 class="treeColumnCards__title">
                        <?php echo esc_html( $title ); ?>
                    </h2>
                <?php endif; ?>

                <?php if ( $subtitle ) : ?>
                    <div class="treeColumnCards__subtitle heading-cap-height">
                        <?php echo esc_html( $subtitle ); ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ( $cards ) : ?>
                <div class="treeColumnCards__grid">
                    <?php foreach ( $cards as $card ) :
                        $large_text = $card['large_text'] ?? '';
                        $card_title = $card['title'] ?? '';
                        $text = $card['text'] ?? '';
                        $logo = $card['logo'] ?? 0;
                        $logo_id = 0;
                        $has_card_content = $large_text || $card_title || $text || $logo;
                        $card_class = $large_text ? ' has-large-text' : '';

                        if ( is_array( $logo ) && ! empty( $logo['ID'] ) ) {
                            $logo_id = (int) $logo['ID'];
                        } elseif ( is_numeric( $logo ) ) {
                            $logo_id = (int) $logo;
                        }
                        ?>
                        <div class="treeColumnCards__card<?php echo esc_attr( $card_class ); ?>">
                            <?php if ( $has_card_content ) : ?>
                                <div class="treeColumnCards__rule"></div>
                            <?php endif; ?>

                            <?php if ( $large_text ) : ?>
                                <div class="treeColumnCards__largeText">
                                    <?php echo esc_html( $large_text ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( $card_title ) : ?>
                                <h3 class="treeColumnCards__cardTitle heading-cap-height">
                                    <?php echo esc_html( $card_title ); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if ( $text ) : ?>
                                <div class="treeColumnCards__text">
                                    <?php echo nl2br( esc_html( $text ) ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( $logo_id ) : ?>
                                <div class="treeColumnCards__logo">
                                    <?php echo wp_get_attachment_image( $logo_id, 'medium' ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
closeBlock();

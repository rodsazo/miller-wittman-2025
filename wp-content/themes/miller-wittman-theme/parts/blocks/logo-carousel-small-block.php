<?php
$logos = get_field( 'logos' ) ?: [];
$items = [];

if ( is_array( $logos ) ) {
    foreach ( $logos as $logo ) {
        $logo_id = 0;

        if ( is_array( $logo ) && ! empty( $logo['ID'] ) ) {
            $logo_id = (int) $logo['ID'];
        } elseif ( is_numeric( $logo ) ) {
            $logo_id = (int) $logo;
        }

        if ( ! $logo_id ) {
            continue;
        }

        $items[] = $logo_id;
    }
}

$has_items = ! empty( $items );
$should_loop = count( $items ) > 1;
?>

<?php if ( $has_items ) : ?>
<?php openBlock(); ?>
<div class="logoCarouselSmall">
    <div class="logoCarouselSmall__viewport">
        <div class="logoCarouselSmall__track<?php echo $should_loop ? ' is-looping' : ''; ?>" data-logo-carousel-small-track>
            <div class="logoCarouselSmall__group">
                <?php foreach ( $items as $index => $logo_id ) : ?>
                <div class="logoCarouselSmall__item">
                    <?php
                    echo wp_get_attachment_image(
                        $logo_id,
                        SIZE_FULL,
                        false,
                        [
                            'class' => 'logoCarouselSmall__image',
                            'loading' => 0 === $index ? 'eager' : 'lazy',
                        ]
                    );
                    ?>
                </div>
                <?php endforeach; ?>
            </div>

            <?php if ( $should_loop ) : ?>
            <div class="logoCarouselSmall__group" aria-hidden="true">
                <?php foreach ( $items as $logo_id ) : ?>
                <div class="logoCarouselSmall__item">
                    <?php
                    echo wp_get_attachment_image(
                        $logo_id,
                        SIZE_FULL,
                        false,
                        [
                            'class' => 'logoCarouselSmall__image',
                            'loading' => 'lazy',
                        ]
                    );
                    ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php closeBlock(); ?>
<?php endif; ?>

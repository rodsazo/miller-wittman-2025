<?php
openBlock();

$eyebrow = get_field('eyebrow');
$content = get_field('content');
$link = get_field('link');
$link = get_link_params( $link );

$text_position  = get_field('text_position');
$is_reversed    = $text_position == 'left';
$reversed_class = $is_reversed ? 'reversed' : '';

$type = get_field('type');

$cols_class     = '';

if( $type == 'dates' ) {
    $cols_class = $is_reversed ? 'cols--8-4' : 'cols--4-8';
}


?>

<div class="container mt-80 mb-80">
    <div class="cols <?php echo $reversed_class; ?> <?php echo $cols_class; ?>" data-scrollvars>

        <?php part('two-column-' . $type ); ?>

        <div>
            <div class="flow">
                <?php if( $eyebrow ): ?>
                    <h2 class="eyebrow"><?php echo $eyebrow; ?></h2>
                <?php endif; ?>

                <div class="wpContent wpContent--large">
                    <?php echo $content; ?>
                </div>

                <?php if( $link ): ?>
                    <div>
                        <?php the_button( $link ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<?php
closeBlock();

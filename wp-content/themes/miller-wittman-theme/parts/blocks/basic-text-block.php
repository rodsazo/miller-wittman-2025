<?php
openBlock();

$eyebrow = get_field('eyebrow');
$content = get_field('content');
$link = get_field('link');
$link = get_link_params( $link );

?>

<div class="container mt-80 mb-96">
    <div class="cols cols--4-8">
        <div>
            <h2 class="eyebrow">
                <?php echo $eyebrow; ?>
            </h2>
        </div>

        <div>
            <div class="flow">
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

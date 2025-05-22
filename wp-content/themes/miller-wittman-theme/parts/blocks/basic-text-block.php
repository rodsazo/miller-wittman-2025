<?php
openBlock();

$eyebrow = get_field('eyebrow');
$heading = get_field('heading');
$content = get_field('content');
$link = get_field('link');
$link = get_link_params( $link );

?>

<div class="container mt-80 mb-96">
    <div class="cols">
        <div class="flow">
            <h2 class="eyebrow">
                <?php echo $eyebrow; ?>
            </h2>
            <?php if( $heading ): ?>
            <div class="wpContent">
                <h2>
                    <?php echo $heading; ?>
                </h2>
            </div>
            <?php endif; ?>
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

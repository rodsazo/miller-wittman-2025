<?php

openBlock();

$eyebrow = get_field('eyebrow');
$heading = get_field('heading');
$content = get_field('content');

?>

    <div class="container container--small mt-80 mb-96">

        <div class="flow">

            <?php if( $eyebrow ): ?>
                <p class="eyebrow"><?php echo $eyebrow; ?></p>
            <?php endif; ?>
            <h1 class="h-2 intersect animation | highlightHeading">
                <?php echo $heading; ?>
            </h1>

            <div class="wpContent wpContent--large">
                <?php echo $content; ?>
            </div>

        </div>

    </div>

<?php
closeBlock();

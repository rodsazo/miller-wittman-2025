<?php

openBlock();
$gallery = get_field('gallery') ?: [];
$odd = count($gallery) % 2;
?>

<div class="container mt-128 mb-128">
    <div class="imageGrid">
        <?php foreach( $gallery as $i => $image ):
            $first_and_odd          = $i === 0 && $odd;
            $item_class = $first_and_odd ? 'full-width' : '';
            $image_size = $first_and_odd ? SIZE_FULL : 'large';
            ?>
            <div class="imageGrid__item u-of <?php echo $item_class; ?>">
                <?php echo wp_get_attachment_image( $image, $image_size ); ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
closeBlock();

<?php

openBlock();
$image_crop = get_field('image_crop') ?? '4_3';
$gallery = get_field('gallery') ?: [];
$odd = count($gallery) % 2;

$grid_style_string = '';
switch( $image_crop ) {
    case '4_3':
        $grid_style_string = '--image-grid-aspect-ratio: 1.3333';
        $crop_class = 'u-of';
        break;
    case '3_2':
        $grid_style_string = '--image-grid-aspect-ratio: 1.5';
        $crop_class = 'u-of';
        break;
    case 'none':
        $crop_class = 'imageGrid__item--auto';
        break;
}

?>

<div class="container mt-128 mb-128">
    <div class="imageGrid" style="<?php echo $grid_style_string; ?>">
        <?php foreach( $gallery as $i => $image ):
            $first_and_odd          = $i === 0 && $odd;
            $item_class = $first_and_odd ? 'full-width' : '';
            $image_size = $first_and_odd ? SIZE_FULL : 'large';
            ?>
            <div class="imageGrid__item <?php echo $crop_class; ?> <?php echo $item_class; ?>">
                <?php echo wp_get_attachment_image( $image, $image_size ); ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
closeBlock();

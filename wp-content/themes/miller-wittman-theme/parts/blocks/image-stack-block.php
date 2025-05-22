<?php
openBlock();
$gallery = get_field('gallery');
?>

<div class="container mt-128 mb-128">
    <div class="imageStack">
        <?php foreach( $gallery as $one_image_id ): ?>
            <?php echo wp_get_attachment_image( $one_image_id, SIZE_FULL ); ?>
        <?php endforeach; ?>
    </div>
</div>

<?php
closeBlock();

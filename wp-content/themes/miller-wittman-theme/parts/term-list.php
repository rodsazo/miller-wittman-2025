<?php
$terms = $args['terms'] ?? [];
if (empty($terms)){
    return;
}
?>

<div class="text-cap-height | termList">
    <?php while( $term = array_shift($terms) ): ?>
        <span><?php echo $term->name; ?></span>
        <?php if( count($terms) ): ?>
            •
        <?php endif; ?>
    <?php endwhile; ?>
</div>




<?php
$terms = wp_get_post_terms( $post->ID, \Theme\CustomTaxonomies::TAX_WORK_CAT );
?>
<div class="workGrid__item flow flow--small">

    <a class="workGrid__image | u-of" href="<?php the_permalink(); ?>">
        <?php if( $thumb = get_post_thumbnail_id() ): ?>
            <?php echo wp_get_attachment_image( $thumb, 'large'); ?>
        <?php endif; ?>
    </a>

    <?php if( count($terms) ): ?>
        <div class="workGrid__terms text-cap-height">
            <?php while( $term = array_shift($terms) ): ?>
                <span><?php echo $term->name; ?></span>
                <?php if( count($terms) ): ?>
                    •
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>

    <h3 class="h-3">
        <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
        </a>
    </h3>

</div>
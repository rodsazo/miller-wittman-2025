<?php
$terms = wp_get_post_terms( get_the_ID(), \Theme\CustomTaxonomies::TAX_WORK_CAT );
?>
<div class="workGrid__item flow flow--small">

    <a class="workGrid__image | intersect animation fadeInTop | u-of" href="<?php the_permalink(); ?>">
        <?php if( $thumb = get_post_thumbnail_id() ): ?>
            <?php echo wp_get_attachment_image( $thumb, 'large'); ?>
        <?php endif; ?>
    </a>

    <?php if( count($terms) ): ?>
        <div class="workGrid__terms | intersect animation fadeInTop">
            <?php part('term-list', ['terms' => $terms]); ?>
        </div>
    <?php endif; ?>

    <h3 class="h-3 | intersect animation fadeInTop">
        <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
        </a>
    </h3>

</div>
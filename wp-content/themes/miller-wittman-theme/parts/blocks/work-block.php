<?php
openBlock();

$items = new WP_Query([
    'post_type' => \Theme\CustomPostTypes::WORK,
    'posts_per_page' => -1,
]);

?>
<div class="workPage scheme--dark">
    <div class="container">
        <h1 class="h-1 workPage__title"><?php the_field('title'); ?></h1>

        <div class="workGrid">
            <?php while( $items->have_posts()): $items->the_post(); ?>
                <?php part('work-article'); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</div>
<?php
closeBlock();

<?php
openBlock();

$items_order = get_field('items_order') ?: 'auto';
$items_ids   = get_field('items') ?: [];

$query_args = [
    'post_type' => \Theme\CustomPostTypes::WORK,
    'posts_per_page' => -1,
];

if( $items_order === 'manual' ) {
    $query_args['post__in'] = $items_ids;
    $query_args['orderby'] = 'post__in';
}

$posts = new WP_Query( $query_args );

?>
<div class="workPage scheme--dark">
    <div class="container">
        <h1 class="h-1 workPage__title">
            <?php the_field('title'); ?>
        </h1>

        <div class="workGrid">
            <?php while( $posts->have_posts()): $posts->the_post(); ?>
                <?php part('work-article'); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</div>
<?php
closeBlock();

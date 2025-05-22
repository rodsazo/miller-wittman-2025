<?php
$work_page_id = get_work_page_id();
$section_title = get_field('title');

$max_items = get_field('max_items');
$selection_mode = get_field('selection_mode') ?? 'latest';

openBlock();

$query_args = [
    'post_type' => \Theme\CustomPostTypes::WORK,
];

if( $selection_mode === 'latest') {
    $query_args['posts_per_page'] = $max_items;
} else if( $selection_mode === 'manual') {
    $selected_posts_ids = get_field('featured_items') ?? [];
    $query_args['post__in'] = $selected_posts_ids;
    $query_args['orderby'] = 'post__in';
}


$work_posts = new WP_Query( $query_args );

?>

<div class="workPreview | scheme--dark">
    <div class="container">
        <h2 class="workPreview__title h-2 | intersect animation fadeInTop" data-scrollvars><?php echo $section_title; ?></h2>

        <div class="workGrid workPreview__grid">
            <?php while( $work_posts->have_posts()): $work_posts->the_post(); ?>
                <?php part('work-article'); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <?php if( $work_page_id ): ?>
            <div class="workPreview__cta">
                <?php the_button(['url' => get_permalink($work_page_id), 'title' => 'View More Work']); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
closeBlock();

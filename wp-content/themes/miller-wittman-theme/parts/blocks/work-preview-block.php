<?php
$max_items = get_field('max_items');
$section_title = get_field('title');
$work_page_id = get_work_page_id();
openBlock();

$work_posts = new WP_Query([
    'post_type' => \Theme\CustomPostTypes::WORK,
    'posts_per_page' => $max_items,
]);

?>

<div class="workPreview | scheme--dark">
    <div class="container">
        <h2 class="workPreview__title h-2" data-scrollvars><?php echo $section_title; ?></h2>

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

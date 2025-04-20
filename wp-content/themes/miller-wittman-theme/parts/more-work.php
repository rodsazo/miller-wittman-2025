<?php
$posts = new WP_Query([
    'post_type' => \Theme\CustomPostTypes::WORK,
    'posts_per_page' => 2,
    'post__not_in' => [ get_the_ID() ],
    'orderby' => 'rand'
]);
?>
<div class="workPreview scheme--dark">

    <div class="container">
        <h2 class="h-2">More Work</h2>

        <div class="workGrid workPreview__grid">
            <?php while( $posts->have_posts()): $posts->the_post(); ?>
                <?php part('work-article'); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</div>
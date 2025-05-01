<?php
global $post;
openBlock();
$title = get_field('title');
$intro = get_field('intro');

$featured_post = get_field('featured_post');
$not_in = $featured_post ? [ $featured_post->ID ] : [];
$posts = get_posts([
    'posts_per_page' => -1,
    'post__not_in' => $not_in,
]);

if( !$featured_post ) {
    $featured_post = array_shift( $posts );
}

?>


<div class="insights__header" data-scrollvars>
    <div class="container">
        <h1 class="h-1">
            <?php echo $title; ?>
        </h1>

        <div class="insights__intro text-cap-height">
            <?php echo $intro; ?>
        </div>
    </div>
</div>

<div class="insights__body">

    <div class="container">
        <?php if( $post = $featured_post ):
            setup_postdata( $post );
            ?>

            <div class="insights__featured">
                <a class="insights__image u-of" href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('medium_large'); ?>
                </a>

                <h2 class="insights__featuredTitle | heading-cap-height">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
            </div>

        <?php
            wp_reset_postdata();
        endif; ?>

        <div class="insights__grid">

            <?php foreach( $posts as $post ):
                setup_postdata( $post );
                $thumb_id = get_post_thumbnail_id( $post->ID );
                ?>
                <div class="insights__item flow flow--small">
                    <?php if( $thumb_id ): ?>
                        <a class="insights__image u-of" href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium_large'); ?>
                        </a>
                    <?php endif; ?>
                    <h3 class="insights__title | heading-cap-height">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                </div>
            <?php wp_reset_postdata(); endforeach; ?>

        </div>
    </div>

</div>


<?php
closeBlock();

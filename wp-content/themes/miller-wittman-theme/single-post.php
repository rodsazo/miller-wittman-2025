<?php
the_post();
get_header();

?>

<div class="container">

    <div class="singlePost">
        <div class="singlePost__image u-of">
            <?php the_post_thumbnail('medium_large'); ?>
        </div>

        <div class="singlePost__main">
            <header class="singlePost__header flow flow--tiny">
                <p class="eyebrow">Insight</p>
                <h1 class="h-3"><?php the_title(); ?></h1>
            </header>

            <div class="singlePost__content">
                <div class="wpContent wpContent--single">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>

</div>

<?php

get_footer();
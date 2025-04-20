<?php
openBlock();
$image = get_field('image');
$title = get_field('title');
?>

<div class="pageHero scheme--dark">
    <div class="container">

        <div class="pageHero__image u-of">
            <?php echo wp_get_attachment_image( $image, 'large') ?>
        </div>
        <div class="pageHero__main">
            <h1 class="h-1">
                <?php echo $title; ?>
            </h1>
        </div>

    </div>
</div>

<?php
closeBlock();

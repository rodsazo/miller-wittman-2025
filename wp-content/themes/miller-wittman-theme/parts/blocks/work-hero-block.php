<?php
openBlock();

$terms = wp_get_post_terms( get_the_ID(), \Theme\CustomTaxonomies::TAX_WORK_CAT );
$tags = get_field('tags');
$tags = explode('<br />', $tags);
$content = get_field('content');

$image_id = get_field('image');
if( !$image_id ){
    $image_id = get_post_thumbnail_id();
}
?>

<div class="container">
    <?php if( $image_id ): ?>
        <div class="workHero__thumbnail">
            <?php echo wp_get_attachment_image( $image_id, SIZE_FULL ) ?>
        </div>
    <?php endif; ?>
    <header class="workHero__header flow flow--tiny">
        <h1 class="workHero__title | heading-cap-height">
            <?php the_title(); ?>
        </h1>
        <?php if( !empty($terms) ): ?>
            <div class="workHero__terms">
                <?php part('term-list', ['terms' => $terms]); ?>
            </div>
        <?php endif; ?>
    </header>

    <div class="mt-80 mb-96 cols cols--5-7">
        <div>
            <div class="tagList flow flow--tight">
                <?php foreach( $tags as $one_tag ): ?>
                    <div class="tagList__item heading-cap-height">
                        <?php echo $one_tag; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div>
            <div class="wpContent">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</div>



<?php
closeBlock();

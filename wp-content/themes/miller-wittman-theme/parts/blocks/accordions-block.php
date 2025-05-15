<?php
global $not_first_accordion;
openBlock();
$title = get_field('title');
$text = get_field('text');
$text_heading = get_field('text_heading');
$accordions = get_field('accordions') ?: [];

$accordion_class = isset( $not_first_accordion ) ? 'not-first' : '';
$not_first_accordion = true;
?>

<div class="accordions <?php echo $accordion_class; ?>">

    <div class="container">

        <div class="accordions__header">
            <div class="cols">
                <div>
                    <h2 class="h-2"><?php echo $title; ?></h2>
                </div>
                <div class="flow flow--tiny">

                    <?php if( $text_heading ): ?>
                        <h3 class="accordions__textHeading heading-cap-height">
                            <?php echo $text_heading; ?>
                        </h3>
                    <?php endif; ?>

                    <div class="wpContent wpContent--large">
                        <?php echo $text; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordions__grid">
            <?php foreach( $accordions as $one_accordion ):
                $title = $one_accordion['title'];
                $content = $one_accordion['content'];
                ?>
            <div class="accordions__gridItem">
                <div class="flow flow--tiny">

                    <h4 class="accordions__gridTitle heading-cap-height"><?php echo $title; ?></h4>

                    <div class="accordions__gridContent text-cap-height">
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>

</div>

<?php
closeBlock();

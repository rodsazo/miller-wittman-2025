<?php
openBlock();
$title = get_field('title');
$text = get_field('text');
$accordions = get_field('accordions') ?: [];
?>

<div class="accordions">

    <div class="container">

        <div class="accordions__header">
            <div class="cols">
                <div>
                    <h2 class="h-2"><?php echo $title; ?></h2>
                </div>
                <div>
                    <div class="wpContent wpContent--large">
                        <p>
                            <?php echo $text; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordions__list">
            <?php foreach( $accordions as $one_accordion ):
                $title = $one_accordion['title'];
                $content = $one_accordion['content'];
                ?>
            <div class="accordions__item">
                <button class="accordions__handle" type="button">
                    <span class="accordions__title heading-cap-height"><?php echo $title; ?></span>
                    <span class="accordions__plus">
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <div class="accordions__content">
                    <div class="wpContent">
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

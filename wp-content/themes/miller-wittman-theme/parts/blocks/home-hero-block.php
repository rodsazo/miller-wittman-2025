<?php
openBlock();
$text = get_field('text');
$highlights = get_field('highlights') ?: [];

foreach ($highlights as $one_highlight) {
    $h_image = $one_highlight['bg_image'];
    $h_text = $one_highlight['text'];
    list( $i_url, $i_title, $i_text ) = wp_get_attachment_image_src( $h_image, 'full' );

    $replacement  = "<span class=\"homeHero__highlight\" style=\"--bg-image: url('{$i_url}')\">{$h_text}</span>";
    $text = str_replace( $h_text, $replacement, $text );
}

?>

<div class="container">
    <div class="homeHero" data-scrollvars>

        <h1 class="homeHero__text">
            <?php echo $text; ?>
        </h1>
    </div>
</div>


<?php
closeBlock();

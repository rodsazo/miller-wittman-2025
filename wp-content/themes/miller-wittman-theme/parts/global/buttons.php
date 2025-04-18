<?php
$buttons = $args['buttons'] ?? [];
$centered = $args['centered'] ?? false;

if(!$buttons){ return; }

?>

<div class="btn__group <?php echo $centered ? '--centered' : ''; ?>">
    <?php foreach( $buttons as $one_button ):
        $link = $one_button['link'];
        $style = $one_button['style'];

        if( !is_array( $link )) {
            continue;
        }

        $link = get_link_params( $link );

        if( !isset($link['url']) ){ continue; }

        ?>

        <?php the_button( $link, $style ) ?>

    <?php endforeach; ?>
</div>
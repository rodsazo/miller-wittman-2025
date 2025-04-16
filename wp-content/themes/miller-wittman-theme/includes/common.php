<?php

add_theme_support('post-thumbnails');
function part( $name, $args = [] ) : void
{
    get_template_part( 'parts/'. $name, '', $args );
}

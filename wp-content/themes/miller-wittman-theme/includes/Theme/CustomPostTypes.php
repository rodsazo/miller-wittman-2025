<?php

namespace Theme;

use Picol\PicolPostType;

class CustomPostTypes
{
    const WORK = 'work';
    public static function start() : void
    {

        $work = new PicolPostType( self::WORK, 'work' );
        $work->autoLabels('Post', 'Posts');
        $work->l_menu_name = 'Work';
        $work->use_gutenberg = true;
        $work->supports[] = 'thumbnail';
        $work->supports[] = 'editor';

    }
}

<?php

namespace Theme;

use Picol\PicolPostType;

class CustomPostTypes
{

    const TEAM = 'team';
    const WORK = 'work';
    public static function start() : void
    {
        $members = new PicolPostType(
            self::TEAM,
            'team'
        );

        $work = new PicolPostType( self::WORK, 'work' );
        $work->autoLabels('Post', 'Posts');
        $work->l_menu_name = 'Work';
        $work->supports[] = 'thumbnail';

    }
}

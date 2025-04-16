<?php

namespace Theme;

use Picol\PicolPostType;

class CustomPostTypes
{

    const TEAM = 'team';
    public static function start() : void
    {
        $members = new PicolPostType(
            self::TEAM,
            'team'
        );

    }
}

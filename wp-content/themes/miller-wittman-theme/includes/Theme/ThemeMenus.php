<?php

namespace Theme;

class ThemeMenus
{

    const MAIN_MENU = 'main-menu';

    public static function start() : void
    {
        register_nav_menus([
            self::MAIN_MENU => 'Main menu',
        ]);
    }
}

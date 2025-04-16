<?php

namespace Theme;

class ThemeSetup
{
    public static function start() : void
    {
        CustomBlocks::start();
        CustomPostTypes::start();
        CustomTaxonomies::start();
        AdminScripts::start();
        ThemeMenus::start();
        ThemeDefaults::start();
        ThemeScripts::start();
        SvgSupport::start();
    }

    public static function getFontsUrls() : array
    {
        return [
            'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap'
        ];
    }
}
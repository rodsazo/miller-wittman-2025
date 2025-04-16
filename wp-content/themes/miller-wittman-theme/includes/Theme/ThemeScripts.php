<?php

namespace Theme;

class ThemeScripts
{
    public static function start() : void
    {
        add_action('wp_enqueue_scripts', function(){
            // get the theme version
            $theme_version = wp_get_theme()->get('Version');
            self::enqueueStyles( $theme_version );
            self::enqueueScripts( $theme_version );
        });
    }

    public static function enqueueStyles( $theme_version ) : void
    {
        wp_enqueue_style('theme-styles', TEMPLATE_URL . '/assets/css/style.css', '', $theme_version );
    }

    public static function enqueueScripts( $theme_version ) : void
    {
        wp_enqueue_script('theme-scripts', TEMPLATE_URL . '/assets/js/main.min.js', ['jquery'], $theme_version );
    }


}

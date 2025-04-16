<?php
namespace Theme;

class AdminScripts
{
    protected static array $styles = [
        'theme-admin-styles' => TEMPLATE_URL . '/assets/css/admin-styles.css',
        'theme-gutenberg'    => TEMPLATE_URL . '/assets/css/gutenberg.css'
    ];

    public static function start() : void
    {
        add_action('admin_enqueue_scripts', [self::class, 'enqueue']);
    }

    public static function enqueue() : void
    {
        // get the theme version
        $theme_version = wp_get_theme()->get('Version');

        foreach ( self::$styles as $name => $url ) {
            wp_enqueue_style( $name, $url, '', $theme_version );
        }

        foreach (ThemeSetup::getFontsUrls() as $index => $font_url) {
            wp_enqueue_style( 'fonts-' . $index , $font_url, '', $theme_version );
        }
    }
}

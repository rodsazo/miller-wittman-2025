<?php

namespace Theme;

class ThemeDefaults
{
    public static function start() : void
    {
        add_action('get_header', [self::class, 'removeHeaderBump']);
        add_action( 'admin_menu', [self::class, 'addReusableBlocks'] );
        self::removeGutenbergStyles();

    }

    public static function removeHeaderBump() {
        remove_action('wp_head', '_admin_bar_bump_cb');
    }

    public static function addReusableBlocks() : void
    {
        add_menu_page( 'Saved Patterns', 'Reusable blocks', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22 );
    }


    protected static function removeGutenbergStyles() : void
    {
        add_filter( 'block_editor_settings_all' , function ( $settings ) {
            $settings['defaultEditorStyles'][0]['css'] = '';
            return $settings;
        });
    }
}

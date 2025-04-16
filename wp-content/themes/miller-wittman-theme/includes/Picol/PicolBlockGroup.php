<?php

namespace Picol;
class PicolBlockGroup
{

    protected static array $block_groups;
    protected static bool $is_setup;

    protected string $title;
    protected array $blocks;
    protected string $prefix;
    protected string $slug;

    protected static function registerBlockGroup( PicolBlockGroup $block_group ) : void
    {
        self::setup();
        self::$block_groups[] = $block_group;
    }

    protected static function setup() : void
    {
        if( !isset( self::$is_setup )) {
            self::$is_setup = true;
            add_action('acf/init', [__CLASS__, 'runBlockRegistration']);
            add_filter('block_categories_all', [__CLASS__, 'registerCustomCategories'], 10, 2);
        }
    }

    public static function runBlockRegistration() : void
    {
        // Register a card block.
        foreach (self::$block_groups as $block_group) {
            $block_group->register();
        }
    }

    public static function registerCustomCategories($categories, $editor_context) {
        if (!empty($editor_context->post)) {

            $block_groups = array_reverse( self::$block_groups );

            foreach ($block_groups as $one_group) {
                $category = [
                    'slug' => $one_group->slug,
                    'title' => $one_group->title,
                    'icon' => null
                ];
                array_unshift($categories, $category);
            }
            return $categories;
        }
    }

    function __construct( $group_title, $prefix = '' ){
        $this->blocks = [];
        $this->title = $group_title;
        $this->prefix = $prefix;
        $this->slug = sanitize_title( $group_title );

        self::registerBlockGroup( $this );
    }


    public function addBlock( $name, $title, $description = '', $keywords = [], $icon = 'id' ) : PicolBlockGroup
    {

        $title = $this->prefix ? $this->prefix . ': ' . $title : $title;

        $this->blocks[] = [
            'name'              => $name,
            'title'             => $title,
            'description'       => $description,
            'render_template'   => ( TEMPLATE_PATH . '/parts/blocks/'.$name.'-block.php' ),
            'category'          => $this->slug,
            'icon'              => $icon,
            'keywords'          => $keywords,
            'supports'          => [
                'jsx' => true
            ]
        ];

        return $this;
    }


    function register() : void
    {
        // Sort the blocks
        usort($this->blocks, function($a, $b) {
            return strcmp($a['title'], $b['title']);
        });

        // Register a card block.
        if( function_exists('acf_register_block_type' )) {
            foreach ( $this->blocks as $block_args) {
                acf_register_block_type( $block_args );
            }
        }
    }


}

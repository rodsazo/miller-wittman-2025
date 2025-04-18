<?php

define('TEMPLATE_URL',  get_template_directory_uri());
define('TEMPLATE_PATH', get_template_directory());
define('URL',           get_site_url());

define('SIZE_FULL', 'size-full');
add_image_size( SIZE_FULL, 1600, 0 );

require_once 'includes/autoload.php';
require_once 'includes/common.php';
require_once 'setup/setup.php';

// Block functions


function openBlock( $use_fields = true, $classes = []) : void {

    if( !is_array( $classes )) {
        $classes = [ $classes ];
    }

    $field_list = $use_fields
        ? [
            'top_spacing' => false,
            'bottom_spacing' => false,
            'block_background' => 'dark',
        ]
        : [];

    $class_str = classesFromFields( $field_list, $classes );

    $block_id = get_field('block_id');
    $id_attr = $block_id ? sprintf('id="%s"', $block_id) : '';

    ?>
    <!-- BLOCK START -->
    <section class="gcBlock <?php echo $class_str; ?>" <?php echo $id_attr; ?>>
    <div class="gcBlock__content">
    <?php

}

function classesFromFields( $field_list, $extra_classes = [] ) : string {

    $block_classes = [];

    foreach ($field_list as $one_field => $default_value ) {
        $field_value = get_field( $one_field );

        if( !$field_value && !$default_value ){
            continue;
        }

        $field_value = $field_value ?: $default_value;

        $block_classes[] = '--' . $one_field . '-' . sanitize_title( strtolower($field_value) );
    }

    $class_list = array_merge( $block_classes, $extra_classes );
    return implode(' ', $class_list );
}

function closeBlock() {
    ?>
    </div>
    </section>
    <!-- BLOCK END -->
    <?php
}

// Flexible Content

function theFlexibleContent( $content = null ) : void
{
    if( !$content ) {
        $content = get_field('flex_content');
    }

    if( !$content ) {
        return;
    }

    ?>
    <div class="flexContent flow">
        <?php foreach( $content as $one_item ):
            $layout = $one_item['acf_fc_layout'];
            ?>
            <div class="flexContent__layout flexContent__layout--<?php echo $layout; ?>">

                <?php part('flex/layout-' . $layout, $one_item ); ?>

            </div>
        <?php endforeach; ?>
    </div>
    <?php
}

// Functions start here

function accentize( $text ): string
{
    return preg_replace('/\*([^*]+)\*/', '<span class="color-accent">$1</span>', $text );
}

function the_buttons( $field_name = null, $centered = false ) {
    if( is_string($field_name) ) {
        $buttons = get_field( $field_name );
    } elseif( is_array( $field_name )) {
        $buttons = $field_name;
    }

    if( !isset($buttons) ) {
        $buttons = get_field('buttons');
    }
    part('global/buttons', ['buttons' => $buttons, 'centered' => $centered]);
}

function the_button ( $link, $style = 'primary')
{
    ?>
    <a class="btn btn--<?php echo $style; ?>" href="<?php echo $link['url']; ?>" <?php echo $link['target_attr']; ?>>
        <span class="btn__bubble">
            <?php echo $link['title']; ?>
        </span>
        <span class="btn__arrow">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.05733 16.0573L8.94267 17.9426L17.8853 8.99992L8.94267 0.057251L7.05733 1.94258L12.7813 7.66658H0V10.3333H12.7813L7.05733 16.0573Z" fill="white"/>
            </svg>
        </span>
    </a>
    <?php
}

function theGravityForm( $form_id ) : void
{
    if(function_exists('gravity_form')){
        gravity_form($form_id, false, ajax: true );
    }
}


function get_link_params( $link ) : array|false {
    if( empty( $link ) || empty($link['url'])) {
        return false;
    }

    $link['target_attr'] = $link['target']
        ? sprintf('target="%s"', $link['target'])
        : '';

    return $link;
}
remove_filter('the_content', 'wptexturize');

function get_menu_items( $menu_name ) {
    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
        $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        return (array) $menu_items;
    }
    return false;
}


function get_work_page_id()
{
    return get_field('work_page_id', 'options');
}


function get_blog_page_id()
{
    return get_field('blog_page_id', 'options');
}

/*
 * Disable Gutenberg for posts
 */
function disable_gutenberg_editor( $is_enabled, $post_type ) {
    if ( 'post' === $post_type ) {
        return false;
    }
    return $is_enabled;
}
add_filter( 'use_block_editor_for_post_type', 'disable_gutenberg_editor', 10, 2 );

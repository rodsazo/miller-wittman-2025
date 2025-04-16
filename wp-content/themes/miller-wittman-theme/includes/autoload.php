<?php

function picol_autoload( $class_name ) {
    $classes_dir = realpath( get_template_directory() . DIRECTORY_SEPARATOR . 'includes' ) . DIRECTORY_SEPARATOR;
    $class_file = str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';
    if( file_exists($classes_dir . $class_file) ) {
        require_once $classes_dir . $class_file;
    }
}

spl_autoload_register('picol_autoload');
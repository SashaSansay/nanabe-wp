<?php
require_once 'image-contain.php';
require_once 'image-double.php';
require_once 'image-full.php';
require_once 'image-slider.php';
require_once 'blockqoute.php';

add_editor_style( get_template_directory_uri() .'/inc/tinymce/css/style.css' );

function my_format_TinyMCE($in ) {
    $in['keep_styles'] = false;
    return $in;
}

add_filter( 'tiny_mce_before_init', 'my_format_TinyMCE' );
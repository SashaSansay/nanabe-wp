<?php
function image_double_plugin() {
    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
        return;
    }
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', 'naba_add_tinymce_plugin_double' );
        add_filter( 'mce_buttons', 'naba_register_mce_button_double' );
    }
}
add_action('admin_head', 'image_double_plugin');

// Declare script for new button
function naba_add_tinymce_plugin_double( $plugin_array ) {
    $plugin_array['image_double_plugin'] = get_template_directory_uri() .'/inc/tinymce/js/image-double.js';
    return $plugin_array;
}

// Register new button in the editor
function naba_register_mce_button_double( $buttons ) {
    array_push( $buttons, 'image_double_plugin' );
    return $buttons;
}
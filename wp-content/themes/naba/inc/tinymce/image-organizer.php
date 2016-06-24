<?php
function image_organizer_plugin() {
    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
        return;
    }
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', 'naba_add_tinymce_plugin_organizer' );
        add_filter( 'mce_buttons', 'naba_register_mce_button_organizer' );
    }
}
add_action('admin_head', 'image_organizer_plugin');

// Declare script for new button
function naba_add_tinymce_plugin_organizer( $plugin_array ) {
    $plugin_array['image_organizer_plugin'] = get_template_directory_uri() .'/inc/tinymce/js/image-organizer.js';
    return $plugin_array;
}

// Register new button in the editor
function naba_register_mce_button_organizer( $buttons ) {
    array_push( $buttons, 'image_organizer_plugin' );
    return $buttons;
}
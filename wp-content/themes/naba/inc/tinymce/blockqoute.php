<?php
function blockqoute_plugin() {
    if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
        return;
    }
    if ( 'true' == get_user_option( 'rich_editing' ) ) {
        add_filter( 'mce_external_plugins', 'naba_add_tinymce_plugin_blockqoute' );
        add_filter( 'mce_buttons', 'naba_register_mce_button_blockqoute' );
    }
}
add_action('admin_head', 'blockqoute_plugin');

// Declare script for new button
function naba_add_tinymce_plugin_blockqoute( $plugin_array ) {
    $plugin_array['blockqoute_plugin'] = get_template_directory_uri() .'/inc/tinymce/js/blockqoute.js';
    return $plugin_array;
}

// Register new button in the editor
function naba_register_mce_button_blockqoute( $buttons ) {
    array_push( $buttons, 'blockqoute_plugin' );
    return $buttons;
}
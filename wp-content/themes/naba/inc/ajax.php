<?php
add_action('wp_ajax_shares', 'inc_shares');
add_action('wp_ajax_nopriv_shares', 'inc_shares');

function inc_shares(){
    $id = absint($_POST['post_id']);
    $sc = get_shares($id);
    $sc++;
    update_post_meta($id,'naba_shares-count',$sc);
}


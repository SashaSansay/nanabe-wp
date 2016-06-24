<?php
//You need to create $billboard array in the parent template part
foreach($billboard as $post):
    $id = $post->ID;
    $colors = get_pallet($id);
    $type = get_post_main_type($id);
    $cat = get_post_billboard_cat($id);
    $is_refresh = get_post_meta($id,'naba_is-update',true);
    if($type=="post_half"){
        include 'atom.posts/atom.post-half.php';
    }elseif($type=="post_full"){
        include 'atom.posts/atom.post-full.php';
    }elseif($type=="post_icon"){
        include 'atom.posts/atom.post-icon.php';
    }
endforeach;
?>
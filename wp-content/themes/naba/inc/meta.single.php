<?php
while ( have_posts() ) : the_post();
    $id = get_the_id();
    $header_text = get_post_header_text($id);
    $header_image = get_header_image_url($id);
    $sc = get_shares($id);
?>
    <meta name="shares-count" content="<?=$sc;?>">
    <meta name="post-id" content="<?=$id;?>">
    <meta name="description" content="<?=$header_text;?>">
    <meta property="og:title" content="<?=get_the_title();?>" />
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
    <meta property="og:url" content="<?=get_permalink($id);?>" />
    <meta property="og:description" content="<?=$header_text;?>" />
    <meta property="og:image" content="<?=$header_image;?>" />
    <meta property="image" content="<?=$header_image;?>" />
    <meta name="post-id" content="<?=get_the_id();?>">
<?php
endwhile;
?>

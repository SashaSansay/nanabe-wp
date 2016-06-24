<?php
while ( have_posts() ) : the_post();
$id = get_the_id();
?>
    <meta name="page-id" content="<?=$id;?>">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta property="og:title" content="<?=get_the_title();?>" />
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
    <meta property="og:url" content="<?php bloginfo('url');?>" />
    <meta property="og:description" content="<?php bloginfo('description'); ?>" />
    <meta property="og:image" content="" />
    <meta property="image" content="" />
    <?php
endwhile;
?>

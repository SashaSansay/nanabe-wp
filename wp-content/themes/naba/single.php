<?php
get_header('page');
?>
<?php
$id = 0;
while ( have_posts() ) : the_post();
    $id = get_the_id();
    $colors = get_pallet($id);
    $header_image = get_header_image_url($id);
    $views = get_views($id);
    $header_text = get_post_header_text($id);
    $subline_text = get_post_subline_text($id);

    $icon = get_post_icon($id);

    update_views($id);
    ?>
<section class="section--page">
    <div class="page__header<?php if(!$header_image):?> page__header--noimage<?php endif;?>" style="<?php if($header_image):?>background-image: url(<?=$header_image;?>);<?php endif;?>background-color: <?=$colors[0];?>">
            <div class="page-header__inner">
            <?php if($icon && !$header_image):?>
                <span class="page-header__icon" style="color: <?=$colors[1];?>">
                    <?=$icon;?>
                </span>
            <?php endif;?>
            <div class="page-header__date">
                <span><?php the_time('j F, Y');?></span>
                <div class="eye-container eye-container--page-header">
                    <?php include('inc/eye.php');?>
                </div>
                <span><?=$views;?></span>
            </div>
            <h1 class="page-header__title">
                <?php the_title();?>
            </h1>
            <div class="page-header__text">
                <?=$header_text;?>
            </div>
            <div class="page-header__bottom">
                <?=$subline_text;?>
            </div>
            <div class="page-header__social">
                <div class="fb-like" data-href="<?=get_permalink($id);?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                <a href="https://twitter.com/share" class="twitter-share-button" data-lang="ru">Твитнуть</a>
                <div id="vk_like"></div>
            </div>
        </div>
    </div>
    <div class="page__body">
        <div class="scrolltop"></div>
        <div class="page-body__inner">
            <?php the_content(); ?>
        </div>
        <div class="page-body__social">
            <div class="fb-like" data-href="<?=get_permalink($id);?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
            <a href="https://twitter.com/share" class="twitter-share-button" data-lang="ru">Твитнуть</a>
            <div id="vk_like1"></div>
        </div>
        <div class="page-body__comments">
            <h4>Комментарии:</h4>
            <?php comments_template(); ?>
        </div>
    </div>
</section>
<section class="billboard billboard--recent">
<?php
endwhile;
$cat = get_post_cat($id);

$args = array(
    'category__in' => array($cat),
    'post__not_in' => array($id),
    'post_type' => 'post',
    'orderby' => 'rand',
    'posts_per_page' => 3
);
$billboard = query_posts($args);

include('billboard.items.php');
?>
</section>
<script>
    var icon_color = "<?=$colors[1];?>";
    var back_color = "<?=$colors[0];?>";
</script>
<?php
get_footer('page');
?>

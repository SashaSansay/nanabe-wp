<?php
$img = get_main_page_image_url($id);
?>
<div class="billboard__item billboard__item--half" style="background-color: <?=$colors[0];?>">
    <div class="billboard__wrap">
        <a href="<?=get_the_permalink();?>" class="billboard__wrap-link"></a>
        <div class="billboard__image-wrap">
            <img src="<?=$img;?>" alt="" class="billboard__half-image">
        </div>
        <div class="billboard__body">
            <h3 class="billboard__big-title">
                <a href="<?=get_the_permalink();?>" class="billboard__link-title">
                    <?php
                        the_title();
                    ?>
                </a>
            </h3>
            <?php
            if($is_refresh):?>
                <div class="billboard__material-refresh">
                    <span>материал обновляется</span>
                </div>
                <?php
            endif;
            ?>
        </div>
        <div class="billboard__bottom">
            <?=$cat;?>
        </div>
    </div>
</div>
<?php
$img = get_main_page_image_url($id);
?>
<div class="billboard__item billboard__item--full" >
    <div class="billboard__image-wrap billboard__image-wrap--full">
        <img src="<?=$img;?>" alt="" class="billboard__full-image">
    </div>
    <div class="billboard__wrap">
        <a href="<?=get_the_permalink();?>" class="billboard__wrap-link"></a>
        <div class="billboard__top">
            <div class="billboard__top-wrap">
                <div class="eye-container">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="17.3px" height="9px" viewBox="0 0 17.3 9"
                         xml:space="preserve">
                            <style type="text/css">
                                .rou{opacity:0.6;fill:none;stroke:#232222;stroke-miterlimit:10;enable-background:new    ;}
                                .eye{opacity:0.6;fill:#232222;}
                            </style>
                        <defs>
                        </defs>
                        <path class="rou" d="M16.2,3.9c-3.6-4.1-9.9-4.6-14-1c-0.3,0.3-0.7,0.6-1,1L0.7,4.5l0.5,0.6c3.6,4.1,9.9,4.6,14,1
                            	c0.3-0.3,0.7-0.6,1-1l0.5-0.6L16.2,3.9z"/>
                        <circle class="eye" cx="8.7" cy="4.5" r="2.5"/>
                            </svg>
                </div>
                <?=get_views($id);?>
                &nbsp;
                <svg class="shares" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="11" height="10" viewBox="0 0 11 10"><path d="M10.367,9.992 L0.623,9.992 C0.278,9.992 -0.003,9.703 -0.003,9.344 L-0.003,0.646 C-0.003,0.288 0.277,-0.002 0.623,-0.002 L5.075,-0.002 C5.420,-0.002 5.700,0.288 5.700,0.646 C5.700,1.004 5.421,1.294 5.075,1.294 L1.249,1.294 L1.249,8.697 L9.742,8.697 L9.742,6.266 C9.742,5.908 10.022,5.618 10.367,5.618 C10.713,5.618 10.993,5.908 10.993,6.266 L10.993,9.344 C10.992,9.702 10.713,9.992 10.367,9.992 ZM10.659,3.488 C10.652,3.526 10.649,3.564 10.635,3.601 C10.631,3.612 10.629,3.622 10.625,3.633 C10.611,3.665 10.586,3.690 10.568,3.719 C10.551,3.747 10.542,3.778 10.520,3.803 L8.242,6.426 C8.118,6.568 7.948,6.640 7.777,6.640 C7.627,6.640 7.478,6.585 7.358,6.474 C7.101,6.235 7.080,5.826 7.311,5.559 L8.651,4.017 L6.473,4.017 C5.276,4.017 4.301,5.026 4.301,6.266 C4.301,6.624 4.022,6.914 3.676,6.914 C3.330,6.914 3.051,6.624 3.051,6.266 C3.051,4.351 4.526,2.789 6.362,2.728 C6.372,2.727 6.380,2.722 6.390,2.722 L8.651,2.722 L7.312,1.181 C7.081,0.915 7.101,0.506 7.358,0.266 C7.614,0.027 8.009,0.048 8.241,0.314 L10.520,2.936 C10.541,2.960 10.549,2.990 10.566,3.016 C10.566,3.017 10.567,3.018 10.567,3.019 C10.586,3.049 10.611,3.075 10.625,3.107 C10.629,3.117 10.632,3.128 10.635,3.139 C10.648,3.174 10.651,3.210 10.658,3.246 C10.665,3.282 10.676,3.317 10.677,3.354 C10.677,3.359 10.681,3.364 10.681,3.370 C10.681,3.375 10.677,3.380 10.677,3.386 C10.676,3.421 10.666,3.454 10.659,3.488 Z" class="cls-1"/></svg>
                <?=get_shares($id);?>
            </div>
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
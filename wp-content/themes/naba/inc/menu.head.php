<?php
$terms = get_terms( array(
    'taxonomy' => 'category',
    'hide_empty' => false,
) );
?>
<!--div class="rek">
    <div class="rek__inner">
        <img src="<?=get_template_directory_uri();?>/build/img/rekl-wide.png" alt="REKLAMA" class="rek__img">
    </div>
</div-->
<header class="header--main">
    <div class="header__inner">
        <ul class="menu menu--left">
            <li class="menu__item">
                <a href="<?=get_post_type_archive_link('events');?>" class="menu__link">События</a>
            </li>
            <!--li class="menu__item">
                <a href="#" class="menu__link third-menu-start">Активность</a>
            </li-->
            <li class="menu__item">
                <a href="#" class="menu__link  second-menu-start">Статьи</a>
            </li>
        </ul>
        <a href="/" class="logo">
            <img src="<?=get_template_directory_uri();?>/build/img/logo.svg" alt="На набе" class="logo__img">
        </a>
        <ul class="menu menu--right">
            <li class="menu__item">
                <a href="<?=get_the_permalink(96);?>" class="menu__link"><?=get_the_title(96);?></a>
            </li>
            <li class="menu__item">
                <a href="<?=get_post_type_archive_link('society');?>" class="menu__link">Общество</a>
            </li>
            <!--li class="menu__item">
                <a href="<?=get_the_permalink(167);?>" class="menu__link"><?=get_the_title(167);?></a>
            </li-->
        </ul>

        <div class="hamburger hamburger--squeeze js-hamburger">
            <div class="hamburger-box">
                <div class="hamburger-inner"></div>
            </div>
        </div>
    </div>

    <div class="header__second">
        <ul class="menu">
            <li class="menu__item">
                <div class="hamburger hamburger--squeeze js-hamburger is-active close-sec">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </li>
            <?php
            foreach($terms as $term):
                if($term->parent == 0 && $term->term_id != 1):
                    $link = get_term_link($term->term_id);
                    ?>
                    <li class="menu__item">
                        <a href="<?=$link;?>" class="menu__link"><?=$term->name;?></a>
                    </li>
                    <?php
                endif;
            endforeach;
            ?>
        </ul>
    </div>

    <div class="header__third">
        <ul class="menu">
            <li class="menu__item">
                <div class="hamburger hamburger--squeeze js-hamburger is-active close-third">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </li>
            <li class="menu__item">
                <a href="<?=get_post_type_archive_link('events');?>" class="menu__link">События</a>
            </li>
            <li class="menu__item">
                <a href="<?=get_post_type_archive_link('society');?>" class="menu__link">Общество</a>
            </li>
        </ul>
    </div>
</header>
<div class="offcanvas">
    <div class="offcanvas__inner">
        <ul class="menu menu--offcanvas">
            <li class="menu__item">
                <a href="<?=get_post_type_archive_link('events');?>" class="menu__link">События</a>
            </li>
            <li class="menu__item">
                <a href="<?=get_post_type_archive_link('society');?>" class="menu__link">Общество</a>
            </li>
            <?php
            foreach($terms as $term):
                if($term->parent == 0 && $term->term_id != 1):
                    $link = get_term_link($term->term_id);
                    ?>
                <li class="menu__item">
                    <a href="<?=$link;?>" class="menu__link"><?=$term->name;?></a>
                </li>
            <?php
                endif;
            endforeach;
            ?>
            <li class="menu__item">
                <a href="<?=get_the_permalink(96);?>" class="menu__link"><?=get_the_title(96);?></a>
            </li>
            <!--li class="menu__item">
                <a href="<?=get_the_permalink(167);?>" class="menu__link"><?=get_the_title(167);?></a>
            </li-->
        </ul>
    </div>
</div>
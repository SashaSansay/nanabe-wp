<?php
get_header('map');

include 'inc/places.vars.php';


?>
    <section class="section--map">
        <div class="map__zoom map__zoom--in"></div>
        <div class="map__zoom map__zoom--out"></div>
        <div class="map__menu-wrap">
            <h3 class="map__title">
                Карта набережной
            </h3>
            <div class="map__wrap">
                <ul class="map__menu">
                    <?php
                    foreach($places_vars as $key => $var):
                        ?>
                    <li class="menu__item menu__item--map">
                        <a href="#" class="menu__link menu__link--map" data-target="pin.<?=$key+1;?>">
                            <img src="<?=$var['icon'];?>" alt="<?=$var['title'];?>" class="image--pin"> <?=$var['title'];?>
                        </a>
                    </li>
                    <?php
                    endforeach;
                    ?>
                </ul>
                <div class="map__tabs">
                    <?php
                    foreach($places_vars as $key => $var):
                        $args = array(
                            'meta_query' => array(
                                'date_event'=> array(
                                    'key' => 'naba_place-type',
                                    'compare' => '=',
                                    'value' => $key
                                )
                            ),
                            'post_type' => array('map-pins'),
                            'posts_per_page' => -1
                        );
                        $places = query_posts($args);
                    ?>
                    <div class="tabs__tab" data-element="pin.<?=$key+1;?>">
                        <ul class="menu menu--inner">
                            <?php
                            foreach($places as $k => $place):
                                $image = get_menu_image_url($place->ID);
                                $time = get_post_meta($place->ID, 'naba_time-work',true);
                                $free = get_post_meta($place->ID, 'naba_place-free',true);
                                $price = get_post_meta($place->ID, 'naba_avg-price',true);
                                ?>
                            <li class="menu__item menu__item--inner" data-item="<?=$k;?>">
                                <a href="#" class="menu__link menu__link--inner">
                                </a>
                                <figure class="menu__image">
                                    <img src="<?=$image;?>" alt="" >
                                </figure>
                                <div class="menu__info">
                                    <h4 class="menu__title"><?=$place->post_title;?></h4>
                                    <p class="menu__text">
                                        <?php
                                        if($time):?>
                                        Время работы:
                                        <br>
                                        <?=$time;?>
                                        <br>
                                        <?php
                                        endif;
                                        if($free):?>
                                        <span class="green">
                                            Бесплатно
                                        </span>
                                        <?php
                                        elseif($price):?>
                                        <span class="yellow">
                                            Средний чек: <br><?=$price;?>
                                        </span>
                                        <?php
                                        endif;
                                        ?>
                                    </p>

                                </div>
                            </li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
        <div class="map__control">
            <ul class="control__list">
                <li class="control__item">
                    <a href="#[control][map]" class="control__link">Карта</a>
                </li>
                <li class="control__item">
                    <a href="#[control][info]" class="control__link">Информация</a>
                </li>
            </ul>
        </div>
        <div class="map" id="map">

        </div>
    </section>

    <script>

        var pins = [
        <?php
        foreach($places_vars as $key => $var):
            $args = array(
                'meta_query' => array(
                    'date_event'=> array(
                        'key' => 'naba_place-type',
                        'compare' => '=',
                        'value' => $key
                    )
                ),
                'post_type' => array('map-pins'),
                'posts_per_page' => -1
            );
            ?>
            [
            <?php
            $places = query_posts($args);
            foreach($places as $place):
                $time = get_post_meta($place->ID, 'naba_time-work',true);
                $free = get_post_meta($place->ID, 'naba_place-free',true);
                $price = get_post_meta($place->ID, 'naba_avg-price',true);
                $pos = get_post_meta($place->ID, 'naba_place-pin',true);
                $posLL = explode(',',$pos);

                $pr = $free ? 'Бесплатно' : $price;
                if(!$pos || $pos==""){

                }else{

        ?>
                ['<?=$place->post_title;?>','<?=$time;?>','<?=$pr;?>','','',<?=$posLL[0];?>, <?=$posLL[1];?>],
        <?php
            }

            endforeach;?>
            ],
            <?php
        endforeach;
        ?>
        ];
    </script>
<?php
get_footer('map');
?>
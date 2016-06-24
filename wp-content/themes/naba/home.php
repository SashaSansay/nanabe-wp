<?php
get_header('main');
$args = array(
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'naba_on-main',
        ),
        array(
            'key' => 'naba_post-type'
        )
    ),
    'posts_per_page' => 14
);
$billboard = query_posts($args);

$today = new DateTime();
$today->setTimezone(new DateTimeZone("Europe/Samara"));
$today->modify('-1 day');
$args = array(
    'meta_query' => array(
        'relation' => 'AND',
        'date_event'=> array(
            'key' => 'naba_date-event',
            'type' => 'DATETIME',
            'compare' => '>=',
            'value' => $today->format('Y-m-d H:i')
        )
    ),
    'orderby' => 'date_event',
    'order' => 'ASC',
    'post_type' => array('events','society'),
    'posts_per_page' => 3
);
$today->modify('+1 day');
$events = query_posts($args);
$weather = get_option('naba_weather');
?>
<section class="billboard">
    <div class="billboard__item billboard__item--forecast" >
        <div class="billboard__wrap">
            <div class="billboard__header billboard__header--forecast">
                <div class="billboard__inner">
                    <div class="billboard__title">
                        <div class="on-air-wave">
                            <div class="c-dot"></div>
                            <div class="c-on c-1"></div>
                            <div class="c-on c-2"></div>
                            <div class="c-on c-3"></div>
                        </div>
                        набережная Live
                    </div>
                    <div class="billboard__subtitle">
                        <?=get_day_of_week(current_time('w'));?>, <?=current_time('j');?> <?=get_month_name(current_time('n'));?>
                    </div>
                </div>
            </div>
            <div class="billboard__body billboard__body--forecast">
                <div class="billboard__inner billboard__inner--bottom">
                    <div class="forecast">
                        <div class="forecast__item">
                            <img src="<?=get_template_directory_uri();?>/build/img/weather/<?=$weather['icon'];?>.svg" alt="<?=$weather['descr'];?>" class="forecast__image">
                            <div class="forecast__temp">
                                <span class="capital"><?=$weather['temp'];?></span>
                            </div>
                            <div class="forecast__decr">
                                <?=$weather['descr'];?>
                            </div>
                        </div>
                        <div class="forecast__item">
                            <img src="<?=get_template_directory_uri();?>/build/img/forecast.water.svg" alt="Погода в Самаре" class="forecast__image">
                            <div class="forecast__temp">
                                <?=$weather['water'];?>
                            </div>
                            <div class="forecast__decr">
                                Температура<br>
                                воды в  <span class="capital">Волге</span>
                            </div>
                        </div>
                    </div>
                    <div class="events">
                        <div class="events__title">
                            Ближайшие события
                        </div>
                        <?php
                        if(sizeof($events)>0):
                            foreach($events as $event):
                                $date = get_post_meta($event->ID,'naba_date-event',true);
                                $date2 = get_post_meta($event->ID,'naba_date-end-event',true);
                                $d = DateTime::createFromFormat('Y-m-d H:i',$date);
                                $d2 = DateTime::createFromFormat('Y-m-d H:i',$date2);
                                $greenContent = get_short_day_of_week($d->format('w'));
                                $greenContent .= " ";
                                $greenContent .= $d->format('d.m.Y');
                                $greenContent .= " ";
                                $greenContent .= $d->format('H:i');
                                if($date2){
                                    $greenContent .= " — ";
                                    $greenContent .= get_short_day_of_week($d2->format('w'));
                                    $greenContent .= " ";
                                    $greenContent .= $d2->format('d.m.Y');
                                    $greenContent .= " ";
                                    $greenContent .= $d2->format('H:i');
                                }
                        ?>
                                <div class="events__item">
                                    <a href="<?=get_permalink($event->ID);?>" target="_blank" class="events__link">
                                            <span class="events__green">
                                                <?=$greenContent;?>
                                            </span>
                                            <?=$event->post_title;?>
                                    </a>
                                </div>
                        <?php
                            endforeach;
                        else:
                        ?>
                            <div class="billboard__subtitle">
                                Сейчас нет новых мероприятий на набережной
                            </div>
                            <br>
                            <a href="#[popup][soc]" class="button button--hollow button--c-black">Создать событие</a>
                            <div class="forecast__decr billboard__create-event">
                                Вы можете организовать свое мероприятие, заполнив заявку
                            </div>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('billboard.items.php');
    ?>
</section>
<section class="section--popup">
    <div class="popup">
        <div class="popup__inner">
            <?=do_shortcode('[contact-form-7 id="152" title="Форма добавления общественного события"]');?>
        </div>
    </div>
</section>
<?php
get_footer('main');
?>

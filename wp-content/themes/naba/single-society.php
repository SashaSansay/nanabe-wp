<?php
get_header('event');
?>

<section class="section--event">
    <?php
    $id = get_the_id();
    while ( have_posts() ) : the_post();
        $header_image = get_header_image_url($id);
        $views = get_views($id);
        $header_text = get_post_header_text($id);
        $cat = get_event_cat($id);
        $colors = get_pallet($id);
        $d = get_society_date($id);
        $date = DateTime::createFromFormat(NABA_DATE_FORMAT,$d);
        $price = get_post_meta($id,'naba_price',true);
        $place = get_post_meta($id,'naba_where',true);
        $cal_link = make_google_calendar_link(get_the_title(),$date->getTimestamp(),$date->getTimestamp(), $header_text, $place);

        update_views($id);
    ?>
    <div class="event__header" style="background-image: url(<?=$header_image;?>); color: #232222;">
        <div class="event-header__inner">
            <div class="event-header__half">
                <div class="event-header__info" style="background-color: <?=$colors[0];?>">
                    <h2 class="event-header__date">
                        <?=$date->format('j');?> <?=get_month_name($date->format('n'));?>
                    </h2>
                    <h4 class="event-header__small-date">
                        <?=get_day_of_week($date->format('w'));?>, <?=$date->format('H:i');?>
                    </h4>
                    <div class="event-header__where">
                        <?=$place;?>
                    </div>
                    <div class="clear"></div>
                    <div class="event-header__money">
                        <?=$price;?>
                    </div>
                    <div class="clear"></div>
                    <a href="<?=$cal_link;?>" target="_blank" class="button button--hollow">Добавить в календарь</a>
                </div>
            </div>
            <div class="event-header__half" style="color: #fff;">
                <div class="event-header__views">
                    <?=$cat;?>
                    <div class="eye-container eye-container--event-header">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="17.3px" height="9px" viewBox="0 0 17.3 9" style="enable-background:new 0 0 17.3 9;"
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
                    <?=$views;?>
                </div>
                <h2 class="event-header__title">
                    <?=get_the_title();?>
                </h2>
                <div class="event-header__social">
                    <div class="fb-like" data-href="<?=get_the_permalink();?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="ru">Твитнуть</a>
                    <div id="vk_like"></div>
                </div>
                <div class="event-header__text">
                    <?=$header_text;?>
                </div>
            </div>
        </div>
    </div>
    <div class="event__body">
        <div class="event-body__inner">
            <?php the_content(); ?>
        </div>
        <div class="event-body__social">
            <a href="<?=$cal_link;?>" target="_blank" class="button button--green button--social">Добавить в календарь</a>
            <div class="fb-like" data-href="<?=get_the_permalink();?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
            <a href="https://twitter.com/share" class="twitter-share-button" data-lang="ru">Твитнуть</a>
            <div id="vk_like1"></div>
        </div>
        <div class="event-body__comments">
            <h4>Комментарии:</h4>
            <?php comments_template(); ?>
        </div>
    </div>
    <?php
    endwhile;
    ?>
</section>
<?php
get_footer('event');
?>

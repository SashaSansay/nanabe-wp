<?php
/*****
 * society page template
 *
 *
 */
get_header('society');
$terms = get_terms('society-events',array(
    'hide_empty' => false
));
$today = new DateTime();
$today->setTimezone(new DateTimeZone("Europe/Samara"));
$args = array(
    'meta_query' => array(
        'relation' => 'AND',
        'date_event'=> array(
            'key' => 'naba_date-event',
            'type' => 'DATETIME',
            'compare' => '>=',
            'value' => $today->format(NABA_DATE_FORMAT)
        )
    ),
    'orderby' => 'date_event',
    'order' => 'ASC',
    'post_type' => 'events',
    'posts_per_page' => -1
);
$events = query_posts($args);
$today->setTime(0,0,0);

$result = array();
foreach ($events as $post) {
    $d = get_post_meta($post->ID,'naba_date-event',true);
    $date = DateTime::createFromFormat(NABA_DATE_FORMAT,$d);
    $date->setTime(0,0,0);
    $id = $date->format('Y-m-d');
    if (isset($result[$id])) {
        $result[$id][] = $post;
    } else {
        $result[$id] = array($post);
    }
}
?>

<section class="section--society">
    <header class="header--society">
        <div class="header__inner header__inner--society header__inner--events">
            <h3 class="society__title">События</h3>
        </div>
    </header>
    <?php
    if(sizeof($result)>0):
        ?>
        <div class="society__items">
            <?php
            foreach($result as $date => $events):
                $d = DateTime::createFromFormat('Y-m-d',$date);
//                var_dump($d,$date);
                $day = get_dates_diff($today,$d);
                ?>
                <div class="society__group">
                    <div class="society__day-title">
                        <div class="society__wrap">
                            <div class="day-title__small">
                                <?=$day;?>
                            </div>
                            <div class="day-title__big">
                                <?=get_day_of_week($d->format('w'));?>,  <?=$d->format('j');?> <?=get_month_name($d->format('n'));?>
                            </div>
                        </div>
                    </div>
                    <?php
                    foreach($events as $event):
                        $eDate = DateTime::createFromFormat(NABA_DATE_FORMAT,get_post_meta($event->ID,'naba_date-event',true));
                        $org = get_event_organizer($event->ID);
                        ?>
                        <div class="society__item" style="border-color: #ffcc99">
                            <div class="society__wrap">
                                <?php
                                $ev_r_img = get_event_header_image_url($event->ID);
                                if($ev_r_img):
                                ?>
                                <figure class="image image--society">
                                    <img src="<?=$ev_r_img;?>" alt="<?=get_the_title($event->ID);?>">
                                </figure>
                                <?php
                                endif;
                                ?>
                                <div class="society-item__head">
                                    <?=$eDate->format('H:i');?>
                                    <span class="spacer"></span>
                                    События
                                </div>
                                <h3 class="society-item__title"><a href="<?=get_the_permalink($event->ID);?>">
                                        <?=get_the_title($event->ID);?>
                                    </a>
                                </h3>
                                <?php
                                if($org):?>
                                <div class="society-item__footer">
                                    <?php
                                    $evImg = get_event_list_image_url($event->ID);
                                    if($evImg):?>
                                    <figure class="image image--org">
                                        <img src="<?=$evImg;?>" alt="<?=$org;?>">
                                    </figure>
                                        <?php
                                    endif;?>
                                    Организатор: <?=$org;?>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
                <?php
            endforeach;
            ?>
        </div>
        <?php
    else:
        include 'inc/events.empty.php';
    endif;
    ?>
</section>
<?php
get_footer('society');
?>

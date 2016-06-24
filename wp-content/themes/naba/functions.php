<?php
if(is_admin()){

    require 'inc/metaboxes/meta_box.php';

    $prefix = 'naba_';

    $fields = array(
        array(
            'label' => 'Пост на главной',
            'desc'  => 'Пост в биллборде на главной стринце',
            'id'    => $prefix.'on-main',
            'type'  => 'checkbox'
        ),
        array(
            'label' => 'Пост обновляется',
            'desc'  => 'Текст под название поста в плитке об обновлении поста',
            'id'    => $prefix.'is-update',
            'type'  => 'checkbox'
        ),
        array(
            'label' => 'Тип поста',
            'desc'  => 'Вариант отображения поста в биллборде.',
            'id'    => $prefix.'post-type',
            'type'  => 'select',
            'required' => true,
            'options' => array(
                array(
                    'label' => 'Половина изображения',
                    'value' => 'post_half'
                ),
                array(
                    'label' => 'Полное изображение',
                    'value' => 'post_full'
                ),
                array(
                    'label' => 'Пост с иконкой',
                    'value' => 'post_icon'
                )
            )
        ),
        array(
            'label' => 'Изображение в плитке',
            'desc'  => 'Изображение в плитке на главной странице',
            'id'    => $prefix.'main-image',
            'type'  => 'image'
        ),
        array(
            'label' => 'Изображение внутри поста',
            'desc'  => 'Изображение в заголовке поста',
            'id'    => $prefix.'inner-image',
            'type'  => 'image'
        ),
        array(
            'label' => 'Текст в заголовке поста',
            'desc'  => 'Текст в хедере поста',
            'id'    => $prefix.'preview-text',
            'type'  => 'textarea',
            'sanitize' => false
        ),
        array(
            'label' => 'Текст в подписи в заголовке поста',
            'desc'  => 'Текст в подписи в хедере поста',
            'id'    => $prefix.'subline-text',
            'type'  => 'textarea',
            'sanitize' => false
        ),
    );

    $colors = array(
        array(
            '#B4CBE6',
            '#FFE33E',
            '#000000'),


        array(
            '#d4c1fb',
            '#3f1cee',
            '#000000'),


        array(
            '#ffe5a2',
            '#FDC7C5',
            '#000000'),


        array(
            '#fff2e6',
            '#fd5757',
            '#000000'),


        array(
            '#f7e9d8',
            '#1c604a',
            '#000000'),


        array(
            '#faeef2',
            '#fd0c23',
            '#000000'),


        array(
            '#E4F0E4',
            '#FDC7C5',
            '#000000'),


        array(
            '#ffaeb3',
            '#1910cf',
            '#000000'),


        array(
            '#fff1e9',
            '#000000',
            '#000000'),


        array(
            '#edd5ca',
            '#04bb8d',
            '#000000'),


        array(
            '#fbefd5',
            '#fba673',
            '#000000'),


        array(
            '#d9f0f6',
            '#072872',
            '#000000'),


        array(
            '#eceee2',
            '#c1465e',
            '#000000'),


        array(
            '#e4eef8',
            '#fbd746',
            '#000000'),


        array(
            '#fdeed6',
            '#286f7d',
            '#000000'),


        array(
            '#efdede',
            '#1151b0',
            '#000000'),


        array(
            '#d5f9f1',
            '#f26c85',
            '#000000'),


        array(
            '#d5f9f1',
            '#f26c85',
            '#000000'),


        array(
            '#febca4',
            '#d4173b',
            '#000000'),


        array(
            '#ffcc99',
            '#ff471a',
            '#000000'),


        array(
            '#f1eff0',
            '#0067da',
            '#000000'),


        array(
            '#ffd7b3',
            '#911b5e',
            '#000000'),


        array(
            '#f8eaa9',
            '#9eccc3',
            '#000000'),


        array(
            '#e2d9fb',
            '#fe7168',
            '#000000'),


        array(
            '#ffc9ed',
            '#0080e0',
            '#000000'),


        array(
            '#f7f7f7',
            '#abddda',
            '#000000'),


        array(
            '#F9E2D7',
            '#007F48',
            '#000000'),


        array(
            '#dc1f29',
            '#ffd3ba',
            '#000000'),


        array(
            '#efdede',
            '#9f5c98',
            '#000000'),


        array(
            '#c0e7f7',
            '#1270e2',
            '#000000'),


        array(
            '#fcc6b9',
            '#e44630',
            '#000000'),


        array(
            '#c1defb',
            '#ea2d2d',
            '#000000'),


        array(
            '#e1eee4',
            '#60f8e9',
            '#000000'),


        array(
            '#efdaca',
            '#d898e5',
            '#000000'),


        array(
            '#f7f6e7',
            '#fc63a1',
            '#000000'),

    );

    $fields2 = array(
        array(
            'label' => 'Тип поста',
            'desc'  => 'Вариант отображения поста в биллборде.',
            'id'    => $prefix.'color-pallet',
            'type'  => 'color-pallet',
            'options' => array()
        )
    );

    foreach($colors as $color){
        $srt = $color[0].','.$color[1].','.$color[2];
        $fields2[0]['options'][] = array(
            'label' => '',
            'value' => $srt,
            'colors' => $color
        );
    }

    $fields3 = array(
        array(
            'label' => 'Иконка поста',
            'desc'  => 'Иконка для поста в биллборде.',
            'id'    => $prefix.'icon-pallet',
            'type'  => 'icons-pallet',
            'count' => 17,
            'options' => array()
        )
    );

    $post_box = new custom_add_meta_box( 'post_box', 'Пост', $fields, 'post', true );
    $pallet_box = new custom_add_meta_box( 'pallet_box', 'Цветовая палитра', $fields2, 'post', true );
    $icons_box = new custom_add_meta_box( 'icon_box', 'Иконка поста', $fields3, 'post', true );


    $fields4 = array(
        array(
            'label' => 'Дата события',
            'desc'  => 'Дата события',
            'id'    => $prefix.'date-event',
            'type'  => 'date'
        ),
        array(
            'label' => 'Где',
            'desc'  => 'Место проведение события',
            'id'    => $prefix.'where',
            'type'  => 'text',
            'sanitize' => false
        ),
        array(
            'label' => 'Цена',
            'desc'  => 'Цена события',
            'id'    => $prefix.'price',
            'type'  => 'text',
            'sanitize' => false
        ),
        array(
            'label' => 'Огранизатор',
            'desc'  => 'Название организатора',
            'id'    => $prefix.'organizer',
            'type'  => 'text',
            'sanitize' => false
        ),
        array(
            'label' => 'Изображение внутри события',
            'desc'  => 'Изображение в заголовке события',
            'id'    => $prefix.'inner-image',
            'type'  => 'image'
        ),
        array(
            'label' => 'Текст в заголовке события',
            'desc'  => 'Текст в хедере события',
            'id'    => $prefix.'preview-text',
            'type'  => 'textarea',
            'sanitize' => false
        ),
        array(
            'label' => 'Изображение организатора в списке событий',
            'desc'  => 'Изображение организатора в списке событий',
            'id'    => $prefix.'list-image',
            'type'  => 'image'
        ),
    );

    $society_box = new custom_add_meta_box( 'society_box', 'Общественное событие', $fields4, 'society', true );

    $fields5 = array(
        array(
            'label' => 'Дата начала события',
            'desc'  => 'Дата начала события',
            'id'    => $prefix.'date-event',
            'type'  => 'date'
        ),
        array(
            'label' => 'Дата окончания события',
            'desc'  => 'Дата окончания события',
            'id'    => $prefix.'date-end-event',
            'type'  => 'date'
        ),
        array(
            'label' => 'Где',
            'desc'  => 'Место проведение события',
            'id'    => $prefix.'where',
            'type'  => 'text',
            'sanitize' => false
        ),
        array(
            'label' => 'Цена',
            'desc'  => 'Цена события',
            'id'    => $prefix.'price',
            'type'  => 'text',
            'sanitize' => false
        ),
        array(
            'label' => 'Огранизатор',
            'desc'  => 'Название организатора',
            'id'    => $prefix.'organizer',
            'type'  => 'text',
            'sanitize' => false
        ),
        array(
            'label' => 'Изображение внутри события',
            'desc'  => 'Изображение в заголовке события',
            'id'    => $prefix.'inner-image',
            'type'  => 'image'
        ),
        array(
            'label' => 'Текст в заголовке события',
            'desc'  => 'Текст в хедере события',
            'id'    => $prefix.'preview-text',
            'type'  => 'textarea',
            'sanitize' => false
        ),
        array(
            'label' => 'Изображение организатора в списке событий',
            'desc'  => 'Изображение организатора в списке событий',
            'id'    => $prefix.'list-image',
            'type'  => 'image'
        ),
    );

    $event_box = new custom_add_meta_box( 'event_box', 'Событие', $fields5, 'events', true );

    require_once 'inc/places.vars.php';

    $fields6 = array(
        array(
            'label' => 'Время работы',
            'desc'  => 'Время работы данного места',
            'id'    => $prefix.'time-work',
            'type'  => 'text',
            'sanitize' => false
        ),
        array(
            'label' => 'Бесплатное?',
            'desc'  => 'Беслпатно ли данное место',
            'id'    => $prefix.'place-free',
            'type'  => 'checkbox',
            'sanitize' => false
        ),
        array(
            'label' => 'Средний чек',
            'desc'  => 'Средний чек в данном месте',
            'id'    => $prefix.'avg-price',
            'type'  => 'text',
            'sanitize' => false
        ),
        array(
            'label' => 'Тип места',
            'desc'  => '',
            'id'    => $prefix.'place-type',
            'type'  => 'places-pallet',
            'options' => $places_vars,
            'sanitize' => false
        ),
        array(
            'label' => 'Изображение для меню',
            'desc'  => 'Изображение для меню',
            'id'    => $prefix.'menu-image',
            'type'  => 'image'
        ),
        array(
            'label' => 'Выберите место на карте',
            'desc'  => 'Выбор места на карте',
            'id'    => $prefix.'place-pin',
            'type'  => 'places-map',
            'sanitize' => false
        )
    );


    $map_box = new custom_add_meta_box( 'map_box', 'Пины на карте', $fields6, 'map-pins', true );

}

function get_pallet($id){
    $colors = get_post_meta($id,'naba_color-pallet',true);

    if(!$colors){
        $colors = '#fff2e6,#fd5757,#000000';
    }

    return explode(',',$colors);
}

function get_header_image_url($id){
    $img_id = get_post_meta($id, 'naba_inner-image',true);

    if(!$img_id){
        return false;
    }

    $thumb = wp_get_attachment_image_src( $img_id, 'full' );
    $url = $thumb['0'];
    return $url;
}

function get_event_header_image_url($id){
    $img_id = get_post_meta($id, 'naba_inner-image',true);

    if(!$img_id){
        return false;
    }

    $thumb = wp_get_attachment_image_src( $img_id, 'medium_large' );
    $url = $thumb['0'];
    return $url;
}

function get_event_list_image_url($id){
    $img_id = get_post_meta($id, 'naba_list-image',true);

    if(!$img_id){
        return false;
    }

    $thumb = wp_get_attachment_image_src( $img_id, 'full' );
    $url = $thumb['0'];
    return $url;

}

function get_main_page_image_url($id){
    $img_id = get_post_meta($id, 'naba_main-image',true);

    if(!$img_id){
        return false;
    }

    $thumb = wp_get_attachment_image_src( $img_id, 'full' );
    $url = $thumb['0'];
    return $url;
}

function get_menu_image_url($id){
    $img_id = get_post_meta($id, 'naba_menu-image',true);

    if(!$img_id){
        return false;
    }

    $thumb = wp_get_attachment_image_src( $img_id, 'medium' );
    $url = $thumb['0'];
    return $url;
}


function get_views($id){
    $views = get_post_meta($id,'naba_views-count',true);
    if(!$views){
        return 0;
    }
    return $views;
}

function update_views($id){
    $c = get_views($id);
    $c++;
    update_post_meta($id,'naba_views-count',$c);
}

function get_post_header_text($id){
    $header_text = get_post_meta($id, 'naba_preview-text',true);
    if(!$header_text){
        return'';
    }
    return nl2br($header_text);
}

function get_post_subline_text($id){
    $header_text = get_post_meta($id, 'naba_subline-text',true);
    if(!$header_text){
        return'';
    }
    return nl2br($header_text);
}

function get_post_icon($id){
    $icon_id = get_post_meta($id, 'naba_icon-pallet',true);
    if(!$icon_id){
        return false;
    }
    return file_get_contents(get_template_directory_uri().'/icons/ico'.$icon_id.'.svg');

}

function get_post_main_type($id){
    $type = get_post_meta($id, 'naba_post-type',true);
    if(!$type){
        return false;
    }
    return $type;
}

function get_event_organizer($id){
    $org = get_post_meta($id, 'naba_organizer',true);
    if(!$org){
        return false;
    }
    return $org;
}

function get_post_billboard_cat($id){
    $terms = wp_get_post_terms( $id, 'category');
    if(sizeof($terms)==0){
        return 'Без категории';
    }
    $parent = '';
    foreach($terms as $term){
        if($term->parent==0){
            $parent = $term->name;
        }else{
            return $term->name;
        }
    }
    return $parent;
}

function get_event_cat($id){
    $terms = wp_get_post_terms( $id, 'society-events');
    if(sizeof($terms)==0){
        return 'Без категории';
    }
    $parent = '';
    foreach($terms as $term){
        if($term->parent==0){
            $parent = $term->name;
        }else{
            return $term->name;
        }
    }
    return $parent;
}

function make_google_calendar_link($name, $begin, $end, $location, $details) {
    $params = array('&dates=', '/', '&details=', '&location=', '&sf=true&output=xml');
    $url = 'https://www.google.com/calendar/render?action=TEMPLATE&text=';
    $arg_list = func_get_args();
    for ($i = 0; $i < count($arg_list); $i++) {
        $current = $arg_list[$i];
        if(is_int($current)) {
            $t = new DateTime('@' . $current, new DateTimeZone('UTC'));
            $current = $t->format('Ymd\THis\Z');
            unset($t);
        }
        else {
            $current = urlencode($current);
        }
        $url .= (string) $current . $params[$i];
    }
    return $url;
}

function get_society_date($id){
    $date = get_post_meta($id,'naba_date-event',true);

    return $date;
}

function get_day_of_week($day){
    switch($day){
        case '0' : return 'Воскресенье'; break;
        case '1' : return 'Понедельник'; break;
        case '2' : return 'Вторник'; break;
        case '3' : return 'Среда'; break;
        case '4' : return 'Четверг'; break;
        case '5' : return 'Пятница'; break;
        case '6' : return 'Суббота'; break;
        default : return ''; break;
    }
}

function get_short_day_of_week($day){
    switch($day){
        case '0' : return 'вс'; break;
        case '1' : return 'пн'; break;
        case '2' : return 'вт'; break;
        case '3' : return 'ср'; break;
        case '4' : return 'чт'; break;
        case '5' : return 'пт'; break;
        case '6' : return 'сб'; break;
        default : return ''; break;
    }
}

function get_month_name($month){
    switch($month){
        case '1' : return 'января'; break;
        case '2' : return 'февраля'; break;
        case '3' : return 'марта'; break;
        case '4' : return 'апреля'; break;
        case '5' : return 'мая'; break;
        case '6' : return 'июня'; break;
        case '7' : return 'июля'; break;
        case '8' : return 'августа'; break;
        case '9' : return 'сентября'; break;
        case '10' : return 'октября'; break;
        case '11' : return 'ноября'; break;
        case '12' : return 'декаб'; break;
        default : return ''; break;
    }
}


function get_dates_diff(DateTime $today,DateTime $date){
    $today->setTime(0,0,0);
    $date->setTime(0,0,0);
    $diff = $today->diff($date);
    $diffDays = (integer)$diff->format( "%R%a" );
    switch($diffDays){
        case 0 : return 'Сегодня';break;
        case +1 : return 'Завтра';break;
        default: return 'Ближайшее время';break;
    }
}

function get_shares($id){
    $sc = get_transient('naba_shares-count_'.$id);
    if($sc===false){
        $fb_c = 0;
        $tw_c = 0;
        $vk_c = 0;
        $Context = stream_context_create(array(
            'http' => array(
                'method' => 'GET',
                'timeout' => 5
            )
        ));
        try{
            $url = get_the_permalink($sc);

            $file = file_get_contents('http://graph.facebook.com/?id='.$url,false,$Context);
            if($file){
                $fb = json_decode($file,true);
                if(isset($fb['shares'])){
                    $fb_c = $fb['shares'];
                }
            }

        }catch (Exception $ex){
        }
        try{
            $file = file_get_contents('http://opensharecount.com/count.json?url=http://nabawp.c.roky.rocks',false,$Context);
            if($file){
                $tw = json_decode($file,true);
                $tw_c = $tw['count'];
            }
        }catch (Exception $ex){
        }
        try{
            $file = file_get_contents('https://vk.com/share.php?act=count&index=1&url=http://nabawp.c.roky.rocks',false,$Context);
            if($file){
                $vk = str_replace(array('VK.Share.count(',');',' '),array('','',''),$file);
                $vk_c = intval(explode(',',$vk)[1]);
            }
        }catch (Exception $ex){
        }
        $sc = $fb_c + $tw_c + $vk_c;
        set_transient('naba_shares-count_'.$id,$sc,60*60);
    }
    return $sc;
}

//flush_rewrite_rules();


function naba_unregister_tax() {
    register_taxonomy('post_tag', array());

    register_taxonomy_for_object_type('category', array('post'));

}
add_action('admin_init', 'naba_unregister_tax');

function remove_menus(){
    remove_submenu_page('edit.php','edit-tags.php?taxonomy=post_tag');
    remove_submenu_page('edit.php','edit-tags.php?taxonomy=category&post_type=society');
}

add_action( 'admin_menu', 'remove_menus' );

function myformatTinyMCE($in) {
    $in['block_formats'] = "Абзац=p;Заголовок=h4;Заголовок 2=h5";
    return $in;
}
add_filter('tiny_mce_before_init', 'myformatTinyMCE' );

function naba_post_tinymce_plugins( $current_screen ) {
//    var_dump($current_screen);
    if ( 'post' == $current_screen->post_type ) {
        require_once 'inc/tinymce/plugins.php';
        require_once 'inc/tinymce/post-sanitizer.php';
    }
    if ( 'society' == $current_screen->post_type || 'events' == $current_screen->post_type){
        require_once 'inc/tinymce/plugins.event.php';
    }
}
add_action( 'current_screen', 'naba_post_tinymce_plugins' );

function wpse8170_loop() {
    global $wp_query;
    $loop = 'notfound';

    if ( $wp_query->is_page ) {
        $loop = is_front_page() ? 'front' : 'page';
    } elseif ( $wp_query->is_home ) {
        $loop = 'home';
    } elseif ( $wp_query->is_single ) {
        $loop = ( $wp_query->is_attachment ) ? 'attachment' : 'single';
    } elseif ( $wp_query->is_category ) {
        $loop = 'category';
    } elseif ( $wp_query->is_tag ) {
        $loop = 'tag';
    } elseif ( $wp_query->is_tax ) {
        $loop = 'tax';
    } elseif ( $wp_query->is_archive ) {
        if ( $wp_query->is_day ) {
            $loop = 'day';
        } elseif ( $wp_query->is_month ) {
            $loop = 'month';
        } elseif ( $wp_query->is_year ) {
            $loop = 'year';
        } elseif ( $wp_query->is_author ) {
            $loop = 'author';
        } else {
            $loop = 'archive';
        }
    } elseif ( $wp_query->is_search ) {
        $loop = 'search';
    } elseif ( $wp_query->is_404 ) {
        $loop = 'notfound';
    }

    return $loop;
}

require_once 'inc/post.types.php';
require_once 'inc/ajax.php';
require_once 'inc/weather.php';
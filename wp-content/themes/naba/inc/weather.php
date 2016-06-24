<?php
if ( ! wp_next_scheduled( 'get_weather_hook' ) ) {
    wp_schedule_event( time(), 'hourly', 'get_weather_hook' );
}

add_action( 'get_weather_hook', 'get_weather' );

function get_weather() {
    try{
        $cont = file_get_contents('http://api.openweathermap.org/data/2.5/weather?id=499099&appid=43e1efbfba8a5a16d613deb7313c860f&lang=ru&units=metric');
        $weather = json_decode($cont);

        $w = array(
            'icon' => $weather->weather[0]->icon,
            'descr' => $weather->weather[0]->description,
            'temp' => round($weather->main->temp).'°C'
        );

        $w_t = "0°C";
        try {
            require_once 'libs/simple_html_dom.php';

            $gis = file_get_html('http://travel.org.ua/water.php?t_id=1534');

            $w_forecast = $gis->find('.f10');

            $w_t = $w_forecast[0]->plaintext;

        }catch (Exception $ex){

        }
        $w['water'] = $w_t;

        update_option('naba_weather',$w);

    }catch (Exception $exep){

    };
}

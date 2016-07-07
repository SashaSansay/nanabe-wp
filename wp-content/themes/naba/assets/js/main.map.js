jQuery.fn.justtext = function() {

    return $(this).clone()
        .children()
        .remove()
        .end()
        .text();

};

google.maps.event.addDomListener(window, 'load', init);
var map;
function init() {
    var mapOptions = {
        center: new google.maps.LatLng(53.2094506,50.1167126),
        zoom: 16,
        zoomControl: false,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.DEFAULT,
        },
        disableDoubleClickZoom: true,
        mapTypeControl: false,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
        },
        scaleControl: true,
        scrollwheel: false,
        panControl: false,
        streetViewControl: false,
        draggable : true,

        overviewMapControl: true,
        overviewMapControlOptions: {
            opened: false,
        },
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: [{"featureType":"all","elementType":"geometry","stylers":[{"lightness":"26"},{"gamma":"1.14"},{"saturation":"38"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#c7c7c7"}]}]
    }
    var mapElement = document.getElementById('map');
    map = new google.maps.Map(mapElement, mapOptions);
    //var locations = [
    //    ['Название 1','','','','',53.206570, 50.111386,'http://nabatest.c.roky.rocks/build/img/pins/pin.1.svg'],
    //    ['Название 2','','','','',53.209697, 50.118561,'http://nabatest.c.roky.rocks/build/img/pins/pin.2.svg'],
    //    ['Название 3','','','','',53.210301, 50.119383,'http://nabatest.c.roky.rocks/build/img/pins/pin.3.svg'],
    //    ['Название 4','','','','',53.203500, 50.104232,'http://nabatest.c.roky.rocks/build/img/pins/pin.4.svg'],
    //    ['Название 5','','','','',53.201984, 50.101470,'http://nabatest.c.roky.rocks/build/img/pins/pin.5.svg'],
    //    ['Название 6','','','','',53.200190, 50.097717,'http://nabatest.c.roky.rocks/build/img/pins/pin.6.svg'],
    //    ['Название 7','','','','',53.204989, 50.104357,'http://nabatest.c.roky.rocks/build/img/pins/pin.7.svg'],
    //    ['Название 8','','','','',53.199504, 50.096065,'http://nabatest.c.roky.rocks/build/img/pins/pin.8.svg']
    //];
    for (var i = 0; i < pins.length; i++) {
        for(var j = 0; j < pins[i].length; j++){
            var title = pins[i][j][0];
            var time = pins[i][j][1];
            var price = pins[i][j][2];
            //if (pins[i][j][1] =='undefined'){ description ='';} else { description = pins[i][j][1];}
            //if (pins[i][j][2] =='undefined'){ telephone ='';} else { telephone = pins[i][j][2];}
            if (pins[i][j][3] =='undefined'){ email ='';} else { email = pins[i][j][3];}
            if (pins[i][j][4] =='undefined'){ web ='';} else { web = pins[i][j][4];}
            //if (pins[i][j][7] =='undefined'){ markericon ='';} else { markericon = locations[i][7];}
            markericon = 'http://nabatest.c.roky.rocks/build/img/pins/pin.'+(i+1)+'.svg';
            marker = new google.maps.Marker({
                icon: markericon,
                position: new google.maps.LatLng(pins[i][j][5], pins[i][j][6]),
                map: map,
                title: title,
                //desc: description,
                //tel: telephone,
                email: email,
                web: web
            });
            marker.iK = i;
            marker.jK = j;
            link = '';

            var contentString = '<div class="popup">'+
                '<div class="popup__head">'+title+'</div>';
                contentString += '<div class="popup__inner">';
            if(time!=''){
                contentString += 'Время работы:' + '<br>';
                contentString += time + '<br>';
            }
            if(price!=''){
                if(price=='Бесплатно'){
                    contentString += '<span class="green">Бесплатно</span>';
                }else{
                    contentString += '<span class="yellow">Средний чек: '+price+'</span>'
                }
            }
                contentString += '</div>';
            contentString +='<div>';

            pins[i][j].push(new google.maps.InfoWindow({
                content: contentString
            }));

            pins[i][j].push(marker);

            marker.addListener('click', function(e) {
                //console.log(this);
                $('.map__menu-wrap').addClass('map__menu-wrap--active');
                $('.section--map').addClass('section--map--active-menu');
                closeInfoWindows();
                var pin = pins[this.iK][this.jK];
                pin[7].open(map, pin[8]);
                map.panTo(this.getPosition());


                var target = 'pin.'+(this.iK+1);
                var targetObj = $('[data-element="'+target+'"]');

                var text = $('[data-target="'+target+'"]').justtext();

                var item = $('[data-item="'+this.jK+'"]', targetObj);
                $('.map__tabs').addClass('map__tabs--active');
                $('.map__menu').addClass('map__menu--active');
                $('.map__title').addClass('map__title--active');
                $('.map__title').html(text);
                $('[data-element]').removeClass('tabs__tab--active');
                targetObj.addClass('tabs__tab--active');
                $('.menu__link--inner-active').removeClass('menu__link--inner-active');
                item.addClass('menu__link--inner-active');
                $('.map__wrap').animate({scrollTop: item.position().top}, 300, 'swing', function(){anim = false;});

            });
        }
    }

}

function closeInfoWindows(){

    for (var i = 0; i < pins.length; i++) {
        for(var j = 0; j < pins[i].length; j++){
            pins[i][j][7].close();
        }
    }
}

$(function() {
    var vw;

    $('.map__zoom--in').click(function(){
        map.setZoom(map.getZoom()+1);
    })
    $('.map__zoom--out').click(function(){
        map.setZoom(map.getZoom()-1);
    })

    function resize(){
        var h1 = $('header').outerHeight(true);
        var h2 = 0;
        if($('.rek').length>0){
            h2 = $('.rek').outerHeight(true);
        }
        var vh = $(window).height();
        $('.map').height(vh-h1-h2);

        vw = $(window).innerWidth();

        if(vw<=840){
            $('.map__menu-wrap').addClass('map__menu-wrap--active');
            $('.section--map').addClass('section--map--active-menu');
        }else{

            $('.map__menu-wrap').removeClass('map__menu-wrap--active');
            $('.section--map').removeClass('section--map--active-menu');
        }
    }

    $(window).resize(function(){
       resize();
    });

    resize();

    var mapTitleText = $('.map__title').justtext();

    $('.menu__link--map').click(function(e){
        var target = $(this).data('target');
        var text = $(this).justtext();

        $('.map__title').html(text);
        $('.map__tabs').addClass('map__tabs--active');
        $('.map__menu').addClass('map__menu--active');
        $('.map__title').addClass('map__title--active');
        $('[data-element]').removeClass('tabs__tab--active');
        $('[data-element="'+target+'"]').addClass('tabs__tab--active');

        $('.menu__link--inner-active').removeClass('menu__link--inner-active')
        var nJ = target.replace('pin.','')-1;

        for (var i = 0; i < pins.length; i++) {
            for(var j = 0; j < pins[i].length; j++){
                pins[i][j][8].setVisible(false);
                if(i == nJ){
                    pins[i][j][8].setVisible(true);
                }

            }
        }
        e.preventDefault();
    });

    $('.menu__item--inner').click(function(e){
        var item = $(this).data('item');
        var target = $(this).closest('[data-element]');
        var targetPin = target.data('element').replace('pin.','')-1;

        google.maps.event.trigger(pins[targetPin][item][8], 'click', {
            latLng: new google.maps.LatLng(0, 0)
        });

        $('.menu__item--inner').removeClass('menu__link--inner-active');

        $('.map__menu-wrap--active').removeClass('map__menu-wrap--active');
        $('.section--map').removeClass('section--map--active-menu');
        $(this).addClass('menu__link--inner-active');
        e.preventDefault();
    })

    $(document).on('click','.map__title--active',function(){
        $('.map__tabs').removeClass('map__tabs--active');
        $('.map__menu').removeClass('map__menu--active');
        $('.map__title').removeClass('map__title--active');
        $('[data-element]').removeClass('tabs__tab--active');
        $('.menu__link--inner-active').removeClass('.menu__link--inner-active');
        $('.map__title').html(mapTitleText);

        for (var i = 0; i < pins.length; i++) {
            for(var j = 0; j < pins[i].length; j++){
                pins[i][j][8].setVisible(true);
            }
        }

        closeInfoWindows();
    });

    $('[href="#[control][map]"]').click(function(e){

        $('.map__menu-wrap--active').removeClass('map__menu-wrap--active');
        $('.section--map').removeClass('section--map--active-menu');

        e.preventDefault();
    });

    $('[href="#[control][info]"]').click(function(e){

        $('.map__menu-wrap').addClass('map__menu-wrap--active');
        $('.section--map').addClass('section--map--active-menu');

        e.preventDefault();
    });

});

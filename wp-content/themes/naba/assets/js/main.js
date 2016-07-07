window.addEventListener('load', function() {
    new FastClick(document.body);
}, false);

$.fn.eyes = function(){
    return this.each(function(){
        var self = this;
        var eye = $('.eye-container',this);
        if(eye.length==0){
            return;
        }
        $(self).on('mousemove', function(e) {
            var top =       eye.offset().top,
                left =      eye.offset().left,
                height =    eye.height(),
                width =     eye.width();

            var className = '';

            if (e.pageY > top + height) {
                className += 's';
            } else if (e.pageY < top) {
                className += 'n';
            }

            if (e.pageX > left + width) {
                className += 'e';
            } else if (e.pageX < left) {
                className += 'w';
            }
            className += ' eye-container ';

            eye.attr('class', className);
            e.stopPropagation();
        });
        return $(self);
    });
};


$(function(){
    $('.time-half__inner, .billboard__item--forecast .billboard__wrap').mCustomScrollbar({
        theme : "minimal-dark",
        scrollInertia : 0,
        autoHideScrollbar : false
    });

    $('.billboard__item').eyes();

    //eyesWatch.init();
});

$('.fb-like').attr('data-href',window.location);


//google.maps.event.addDomListener(window, 'load', init);
var map;
function init() {
    var mapOptions = {
        center: new google.maps.LatLng(-9.817329,84.832763),
        zoom: 3,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.DEFAULT,
        },
        disableDoubleClickZoom: true,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
        },
        scaleControl: true,
        scrollwheel: true,
        panControl: true,
        streetViewControl: true,
        draggable : true,
        overviewMapControl: true,
        overviewMapControlOptions: {
            opened: false,
        },
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    }
    var mapElement = document.getElementById('main-map');
    var map = new google.maps.Map(mapElement, mapOptions);
    var locations = [

    ];
    for (i = 0; i < locations.length; i++) {
        if (locations[i][1] =='undefined'){ description ='';} else { description = locations[i][1];}
        if (locations[i][2] =='undefined'){ telephone ='';} else { telephone = locations[i][2];}
        if (locations[i][3] =='undefined'){ email ='';} else { email = locations[i][3];}
        if (locations[i][4] =='undefined'){ web ='';} else { web = locations[i][4];}
        if (locations[i][7] =='undefined'){ markericon ='';} else { markericon = locations[i][7];}
        marker = new google.maps.Marker({
            icon: markericon,
            position: new google.maps.LatLng(locations[i][5], locations[i][6]),
            map: map,
            title: locations[i][0],
            desc: description,
            tel: telephone,
            email: email,
            web: web
        });
        link = '';     }

}
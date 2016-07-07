$(document).ready(function(){
    $( ".second-menu-start" ).click(function() {
        $(".header--main").removeClass( "sec-off" );
        $(".header--main").addClass( "sec-on" );
    });

    $( ".close-sec" ).click(function() {
        $(".header--main").removeClass( "sec-on" );
        $(".header--main").addClass( "sec-off" );
    });

    $( ".third-menu-start" ).click(function() {
        $(".header--main").removeClass( "thr-off");
        $(".header--main").addClass( "thr-on" );
    });

    $( ".close-third" ).click(function() {
        $(".header--main").removeClass( "thr-on" );
        $(".header--main").addClass( "thr-off" );
    });

});
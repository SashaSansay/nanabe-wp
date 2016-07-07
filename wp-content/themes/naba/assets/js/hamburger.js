var keys = {37: 1, 38: 1, 39: 1, 40: 1};

function preventDefault(e) {
    e = e || window.event;
    if (e.preventDefault)
        e.preventDefault();
    e.returnValue = false;
}

function preventDefaultForScrollKeys(e) {
    if (keys[e.keyCode]) {
        preventDefault(e);
        return false;
    }
}

function disableScroll() {
    if (window.addEventListener) // older FF
        window.addEventListener('DOMMouseScroll', preventDefault, false);
    window.onwheel = preventDefault; // modern standard
    window.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
    window.ontouchmove  = preventDefault; // mobile
    document.onkeydown  = preventDefaultForScrollKeys;
}

function enableScroll() {
    if (window.removeEventListener)
        window.removeEventListener('DOMMouseScroll', preventDefault, false);
    window.onmousewheel = document.onmousewheel = null;
    window.onwheel = null;
    window.ontouchmove = null;
    document.onkeydown = null;
}



$(function(){
   $('.hamburger:not(.close-sec):not(.close-third)').click(function(){
        $(this).toggleClass('is-active');
       $('body').toggleClass('body--menu-opened')
   });
    $( ".second-menu-start" ).click(function(e) {
        $(".header--main").removeClass( "sec-off" );
        $(".header--main").addClass( "sec-on" );
        e.preventDefault();
    });

    $( ".close-sec" ).click(function(e) {
        $(".header--main").removeClass( "sec-on" );
        $(".header--main").addClass( "sec-off" );
        e.preventDefault();
    });


    $( ".third-menu-start" ).click(function(e) {
        $(".header--main").removeClass( "thr-off");
        $(".header--main").addClass( "thr-on" );
        e.preventDefault();
    });

    $( ".close-third" ).click(function(e) {
        $(".header--main").removeClass( "thr-on" );
        $(".header--main").addClass( "thr-off" );
        e.preventDefault();
    });



    $('[href="#[popup][soc]"]').click(function(e){
        $('.section--popup').addClass('section--opened');
        disableScroll();
        e.preventDefault();
    });

    $('.section--popup').click(function(e){
        if (e.target !== this)
            return;
        $('.section--popup').removeClass('section--opened');
        enableScroll();
    })

    $('.button--dropdown').click(function(e){
        var parent = $(this).closest('.dropdown');
        var menu = $('.dropdown__menu',parent);

        parent.toggleClass('dropdown--active');

        e.preventDefault();
    })

    $(document).click(function(){
        $(".dropdown").removeClass('dropdown--active');
    });

    $(".dropdown").click(function(e){
        e.stopPropagation();
    });
});


try{
    //var id = $('meta[name=post-id]').attr("content");
    //console.log(id);

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.6&appId=725233204284587";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');

    var image = $('meta[property="og:image"]').attr('content');
    var descr = $('meta[property="og:description"]').attr('content');
    var title = $('meta[property="og:title"]').attr('content');
    VK.init({apiId: 5500298, onlyWidgets: true});
    VK.Widgets.Like("vk_like", {type: "button", height: 20,pageImage: image, pageDescription: descr, pageTitle: title});
    VK.Widgets.Like("vk_like1", {type: "button", height: 20,pageImage: image, pageDescription: descr, pageTitle: title});
    //
    //VK.Observer.subscribe("widgets.like.shared", function (){
    //    $.post(ajaxUrl,{action: 'shares',post_id: id})
    //});
    //FB.Event.subscribe('edge.create', function(){
    //    $.post(ajaxUrl,{action: 'shares',post_id: id})
    //});

}catch (e){

}
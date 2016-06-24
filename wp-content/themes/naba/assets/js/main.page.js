window.addEventListener('load', function() {
    new FastClick(document.body);
}, false);


function resize(){
    vw = $(window).width();
    $('.image--full').each(function(){
        var img = $('img',$(this));
        img.width(vw);
        $('.image__wrap',$(this)).height(img.height());
    });
}

$(function(){
    $('body').flowtype({
        minimum   : 320,
        minFont   : 14,
        maxFont   : 20  ,
        fontRatio : 80
    });

    var vw = $(window).width();

    $(window).resize(function(){
        resize();
    })

    resize();

    $(window).scroll(function(){
        var sT = $('body').scrollTop();
        var oT = $('.page__body').offset().top;
        if(sT >= oT){
            $('.scrolltop').addClass('scrolltop--active');
        }else{
            $('.scrolltop').removeClass('scrolltop--active');
        }
    });

    $('.scrolltop').click(function(){
        $('html,body').animate({
            scrollTop: 0
        },500)
    })

    $('.slider').slick({
        dots: true,
        arrows: true
    });
});

$(window).load(function(){
    resize();
});

var disqus_config = function () {
    this.page.url = window.location;
    this.page.identifier = window.location;
};
(function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');

    s.src = 'https://nabka.disqus.com/embed.js';

    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
})();

(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.6&appId=202796623395890";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');

VK.init({apiId: 5500298, onlyWidgets: true});
VK.Widgets.Like("vk_like", {type: "button", height: 20});
VK.Widgets.Like("vk_like1", {type: "button", height: 20});
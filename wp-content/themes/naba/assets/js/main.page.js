window.addEventListener('load', function() {
    new FastClick(document.body);
}, false);


function resize(){
    var vw = $(window).width();
    $('.image--full').each(function(){
        var img = $('img',$(this));
        img.width(vw);
        $('.image__wrap',$(this)).height(img.height());
    });
}

$(function(){

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

    $('.page-body__inner a').css('color',icon_color);

    $('.scrolltop').click(function(){
        $('html,body').animate({
            scrollTop: $('.page__header').offset().top
        },500)
    })

    $('.slider').slick({
        dots: true,
        arrows: true
    });

    var speech_bottom = '<svg xmlns="http://www.w3.org/2000/svg" width="11.62" height="11.4" viewBox="0 0 11.62 11.4"> <path id="_copy" data-name="» copy" class="cls-1" d="M1547.91,6645.31l4.25-5.61v-0.21l-4.25-5.59-1.52.89,3.54,4.83-3.54,4.83Zm5.85,0,4.25-5.61v-0.21l-4.25-5.59-1.55.89,3.54,4.83-3.54,4.83Z" transform="translate(-1546.38 -6633.91)"/></svg>';
    var speech_top = '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 11.6 11.4" style="enable-background:new 0 0 11.6 11.4;" xml:space="preserve"> <path id="_" class="st0" d="M10.1,0L5.9,5.6v0.2l4.3,5.6l1.5-0.9L8.1,5.7l3.5-4.8L10.1,0z M4.3,0L0,5.6v0.2l4.3,5.6l1.6-0.9L2.3,5.7l3.5-4.8L4.3,0z"/></svg>';

    $(".speech__top").each(function(){
        $(this).html(speech_top);
    });
    $(".speech__bottom").each(function(){
        $(this).html(speech_bottom);
    });

    $('.speech__top, .speech__bottom').each(function(){
        $(this).css('background-color',back_color);
        $(this).css('color',icon_color);
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

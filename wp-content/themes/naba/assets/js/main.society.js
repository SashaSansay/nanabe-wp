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

    $('body').flowtype({
        minimum   : 320,
        minFont   : 14,
        maxFont   : 20  ,
        fontRatio : 80
    });
    $('.button--dropdown').click(function(e){
        var parent = $(this).closest('.dropdown');
        var menu = $('.dropdown__menu',parent);

        parent.toggleClass('dropdown--active');

        e.preventDefault();
    })

    $('[href="#[popup][soc]"]').click(function(){
        $('.section--popup').addClass('section--opened');
        disableScroll();
    });

    $('.section--popup').click(function(e){
        if (e.target !== this)
            return;
        $('.section--popup').removeClass('section--opened');
        enableScroll();
    })

    $(document).click(function(){
        $(".dropdown").removeClass('dropdown--active');
    });

    $(".dropdown").click(function(e){
        e.stopPropagation();
    });

    var seeds = [
        23,
        24,
        149,
        160,
        182,
        196,
        211,
        220,
        223,
        262
    ];

    function genNumbers(nums) {
        var numbers = [];
        while (numbers.length < nums) {
            var newNr = Math.floor(Math.random() * (nums - 0 + 1)) + 0;
            if (numbers.indexOf(newNr) == -1) {
                numbers.push(newNr);
            }
        }
        return numbers;
    }

    var rNum = Math.floor(Math.random() * (seeds.length - 0 + 1)) + 0;

    var items = $('.society__item');

    var rand = randomColor({
        luminosity: 'light',
        count: items.length+1,
        seed: seeds[rNum]
    });
    var nums = genNumbers(items.length);

    for(var i = 0; i < items.length ; i++){
        items.eq(i).css('border-color',rand[nums[i]]);
    }



});
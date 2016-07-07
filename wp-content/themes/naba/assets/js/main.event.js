$(function(){

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

    var items = $('.event-header__info');

    var rand = randomColor({
        luminosity: 'light',
        count: items.length+1,
        seed: seeds[rNum]
    });
    var nums = genNumbers(items.length);

    for(var i = 0; i < items.length ; i++){
        items.eq(i).css('background-color',rand[nums[i]]);
    }

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
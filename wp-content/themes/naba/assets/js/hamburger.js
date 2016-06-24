$(function(){
   $('.hamburger').click(function(){
        $(this).toggleClass('is-active');
       $('body').toggleClass('body--menu-opened')
});
});
jQuery(document).ready(function ($) {
    $('.header.mobile .main-navigation .walker').each(function(){
        let back_title = $(this).find(">:first-child").text();
        $('<li class="nav-back"><span class="back-btn">'+back_title+'</span><button class="toggle-nav"></button></li>').insertBefore($(this).find('.sub-menu > li:first-child'));
    });
    $(document).on('click', '.toggle-nav', function(e){
        e.preventDefault();
        if($('.header.mobile').hasClass('nav-active')) {
            $('.header.mobile').removeClass('nav-active');
        } else {
            $('.header.mobile').addClass('nav-active');
        }
    });
    $(document).on('click', '.header.mobile .nav-back .back-btn', function(e){
        e.preventDefault();
        $(this).parents('.sub-menu').removeClass('active');
    });
    $(document).on('click', '.header.mobile li.walker > a', function(e){
        e.preventDefault();
        $(this).next('.sub-menu').addClass('active');
    });
});
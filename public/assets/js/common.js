$(function(){
    // sp
    $('.menu-trigger').on('click', function () {
        $(this).toggleClass('active');
        $('.sp-nav').slideToggle();
    });

    $('.sp-nav').css('top', $('header').height() + 'px');
    var timer = false;
    $(window).resize(function () {
        if (timer !== false) {
            clearTimeout(timer);
        }
        timer = setTimeout(function () {
            $('.sp-nav').css('top', $('header').height() + 'px');
        }, 200);
    });

    // anchor
    $('a[href^="#"]').click(function(){
        var speed = 500;
        var href= $(this).attr("href");
        var target = $(href == "#" || href == "" ? 'html' : href);
        var position = target.offset().top - 20;
        $("html, body").animate({scrollTop:position}, speed, "swing");
        return false;
    });
});
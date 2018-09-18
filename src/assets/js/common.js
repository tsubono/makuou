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

/*サイドナビ
--------------------------*/
$(window).on('load resize', function(){
        var windowWidth = $(window).width();
        var windowSm = 768;
        if (windowWidth <= windowSm) {
            $('.sidebtn img').attr('src','/assets/img/common/arrow_r_white.gif');
            $('.sidebtn').click(function(){
                $(this).toggleClass('open');
                $('aside').toggleClass('open');
                if($('.sidebtn').hasClass("open")){
                   $('.sidebtn img').attr('src','/assets/img/common/arrow_l_white.gif');
                  }else{
                   $('.sidebtn img').attr('src','/assets/img/common/arrow_r_white.gif');
                  }
            });
        } else {
            $('.sidebtn').click(function(){
                $(this).toggleClass('close');
                $('aside').toggleClass('close');
                if($('.sidebtn').hasClass("close")){
                   $('.sidebtn img').attr('src','/assets/img/common/arrow_r_white.gif');
                  }else{
                   $('.sidebtn img').attr('src','/assets/img/common/arrow_l_white.gif');
                  }
            });
        }
    });


/*サイドナビ
--------------------------*/
$(window).on('load resize', function(){
    var headerHeight = $('.l-header').innerHeight();
    	$('.bg').css('margin-top',headerHeight+'px'); 
    	$('.l-main').css('margin-top',headerHeight+'px'); 
    	$('aside').css('top',headerHeight+'px'); 
    	$('aside').css('padding-bottom',headerHeight+'px'); 
    	$('aside').css('margin-bottom',headerHeight+'px'); 
});
$(function(){
    // variable
    var $body = $('body');
    var scrollBarWidth = window.innerWidth - document.body.clientWidth;
    var scrollPosition;

    scrollBarWidth = Math.floor(scrollBarWidth / 2) * 2;
    console.log(scrollBarWidth);

    // show modal
    $('.js-showing-modal').click(function(e){
        e.preventDefault();
        scrollPosition = $(window).scrollTop();
        var targetID = $(this).attr('href');
        $('.modal, .modal__inner').show();
        $(targetID).show();
        $body.css({
            'position': 'fixed',
            'top': -1 * scrollPosition + 'px',
            'overflow': 'hidden',
            'width': '100%',
            'padding-right': scrollBarWidth + 'px'
        });
    });

    // hide modal
    $('.modal, .modal__close').on('click', function(){
        $('.modal, .modal__inner, .modal__content').hide();
        $body.removeAttr('style');
        $('html, body').prop({ scrollTop: scrollPosition });
    });
    $('.modal__content').click(function (e) {
        e.stopPropagation();
    });

});
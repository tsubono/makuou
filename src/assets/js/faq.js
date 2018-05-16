$(function(){
    $('.faq__list dt').click(function(){
        $(this).next().slideToggle(200);
        $(this).toggleClass('is-active');
    });
    $('.faq__tabs a').click(function(e){
        e.preventDefault();
        var id = $(this).attr('href');
        $('.faq__section').hide();
        $(id).show();
        $('.faq__tab').removeClass('is-current');
        $(this).parent().addClass('is-current');
    });
});
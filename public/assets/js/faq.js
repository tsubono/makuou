$(function(){
    // クエリ文字列での切り替え
    if (location.search != '') {
        var faq = 'faq' + location.search.replace('?id=', '');
        $('.faq__section').hide();
        $('#' + faq).show();
        $('.faq__tab').removeClass('is-current');
        $('[href="' + faq + '"]').parent().addClass('is-current');
    }

    // タブ切り替え
    $('.faq__tabs a').click(function(e){
        e.preventDefault();
        var id = $(this).attr('href');
        $('.faq__section').hide();
        $('#' + id).show();
        $('.faq__tab').removeClass('is-current');
        $(this).parent().addClass('is-current');
    });

    // アコーディオン開閉
    $('.faq__list dt').click(function () {
        $(this).next().slideToggle(200);
        $(this).toggleClass('is-active');
    });
});

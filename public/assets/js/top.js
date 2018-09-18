
    var mySwiper = new Swiper ('.swiper-container', {
          /*speed: 600,
          autoplay:true,*/
          loop: true,
          slidesPerView: 1,
          centeredSlides : true,
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
          },
        pagination: {
            el: '.swiper-my-pagination',
            clickable: true,
            renderBullet: function (index, className) {
              return '<span class="' + className + '">' + '<img src="assets/img/top/mainimg' + (index + 1) + '.png" alt="">' + '</span>';
            },
          },
          breakpoints: {
            767: {
              slidesPerView: 1,
              spaceBetween: 0
            }
          }
    });

    
    $(function(){
        $(".pickup li").matchHeight();
        $(".feature li").matchHeight();
    });
    
    
    $(function() {
        $('.choose_scene .more__btn').click(function(){
            $(this).toggleClass('up');
            $('.choose_scene .hidden').slideToggle();
        });
    });
    $(function() {
        $('.choose_sports .more__btn').click(function(){
            $(this).toggleClass('up');
            $('.choose_sports .hidden').slideToggle();
        });
    });
    $(function() {
        $('.choose_taste .more__btn').click(function(){
            $(this).toggleClass('up');
            $('.choose_taste .hidden').slideToggle();
        });
    });


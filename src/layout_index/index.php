<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>レイアウトを作る</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <link rel="shortcut icon" href="../assets/img/favicon.ico">
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="stylesheet" type="text/css" href="../assets/css/swiper.min.css">
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/edit.css">
    
</head>
<body>

<header>
    <div class="logo"><a href="/"><img src="../assets/img/layout/logo.png" alt="幕王"></a></div>    
</header>

<main class="l-main">
    <div class="l-inner">
        <section class="layout">
            <div class="main__content">
                <div class="edit__area">
                    編集エリア
                </div>
                <div class="edit__tools">
                    <h2>操作ツール</h2>
                    <ul>
                        <li><a href="#"><img src="../assets/img/layout/icon01.png" alt="">レイヤー一覧</a></li>
                        <li><a href="#"><img src="../assets/img/layout/icon02.png" alt="">コピー</a></li>
                        <li><a href="#"><img src="../assets/img/layout/icon03.png" alt="">貼り付け</a></li>
                        <li><a href="#"><img src="../assets/img/layout/icon04.png" alt="">前面に移動</a></li>
                        <li><a href="#"><img src="../assets/img/layout/icon05.png" alt="">背面に移動</a></li>
                        <li><a href="#"><img src="../assets/img/layout/icon06.png" alt="">水平に備える</a></li>
                        <li><a href="#"><img src="../assets/img/layout/icon07.png" alt="">垂直に揃える</a></li>
                        <li><a href="#"><img src="../assets/img/layout/icon08.png" alt="">左右反転</a></li>
                        <li><a href="#"><img src="../assets/img/layout/icon11.png" alt="">レイヤーロック</a></li>
                        <li><a href="#"><img src="../assets/img/layout/icon09.png" alt="">戻る</a></li>
                        <li><a href="#"><img src="../assets/img/layout/icon10.png" alt="">進む</a></li>
                    </ul>
                </div>
                <div class="edit__layer">
                    <h2>レイヤー一覧</h2>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">layer</div>
                            <div class="swiper-slide">layer</div>
                            <div class="swiper-slide">layer</div>
                            <div class="swiper-slide">layer</div>
                            <div class="swiper-slide">layer</div>
                            <div class="swiper-slide">layer</div>
                            <div class="swiper-slide">layer</div>
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
                <nav class="edit__tools__foot">
                    <div class="tools__inner">
                        <div class="btn"><a href="#">デザイン一覧へ戻る</a></div>
                        <ul class="edit__tab">
                            <li><img src="../assets/img/layout/icon_txt.png" alt="">テキスト追加・編集</li>
                            <li><img src="../assets/img/layout/icon_img.png" alt="">写真のアップロード</li>
                            <li><img src="../assets/img/layout/icon_stamp.png" alt="">スタンプ追加・編集</li>
                        </ul>
                        <div class="btn"><a href="#">確認ページへ進む</a></div>
                    </div>    
                </nav>
                <div class="edit__hidden">
                    <div class="edit__wrap">
                        <div class="edit__text">
                            <div class="edit__close"><div class="close__btn"><div class="close__ico"></div></div></div>
                            <ul class="text__tab">
                                <li class="select">追加する</li>
                                <li>編集する</li>
                            </ul>
                            <div class="text__content">
                                <div>
                                    <input type="text" name="" placeholder="テキストを入力してください">
                                    <div class="text__btnwrap">
                                        <div class="btn__custom">
                                            <div><input type="button" name="" value="フォントを選ぶ"></div>
                                            <div><input type="button" name="" value="色を選ぶ"></div>
                                            <div><input type="button" name="" value="透明度を調整"></div>
                                        </div>    
                                        <div class="btn__add"><input type="button" name="" value="テキストを追加"></div>
                                    </div>    
                                    <div class="font__select">

                                    </div>
                                </div>
                                <div>
                                    <input type="text" name="" placeholder="テキストを入力してください">
                                    <div class="text__btnwrap">
                                        <div class="btn__custom">
                                            <div><input type="button" name="" value="フォントを選ぶ"></div>
                                            <div><input type="button" name="" value="色を選ぶ"></div>
                                            <div><input type="button" name="" value="透明度を調整"></div>
                                        </div>    
                                    </div>
                                    <div class="font__select">

                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="edit__wrap">
                        <div class="edit__image">
                            <div class="edit__close"><div class="close__btn"><div class="close__ico"></div></div></div>
                            <div class="drop__area">
                                <p>ファイルを選択もしくはドラッグ＆ドロップしてください</p>
                                <div class="btn"><input type="button" value="ファイルを選択"></div>
                            </div>
                        </div>
                    </div>
                    <div class="edit__wrap">
                        <div class="edit__stamp">
                            <div class="edit__close"><div class="close__btn"><div class="close__ico"></div></div></div>
                            <div>
                                <div class="btn"><a href="#">カテゴリ一覧を見る</a></div>
                                <ul>
                                    <li>cat</li>
                                    <li>cat</li>
                                    <li>cat</li>
                                    <li>cat</li>
                                    <li>cat</li>
                                    <li>cat</li>
                                    <li>cat</li>
                                    <li>cat</li>
                                    <li>cat</li>
                                    <li>cat</li>
                                    <li>cat</li>
                                    <li>cat</li>
                                    <li>cat</li>
                                    <li>cat</li>
                                    <li>cat</li>
                                    <li>cat</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.layout -->
    </div>
</main>
<!-- /.l-main -->



<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/swiper.min.js"></script>
<script>
$(function() {
	$('.text__tab li').click(function() {
		var index = $('.text__tab li').index(this);
		$('.text__content > div').css('display','none');
		$('.text__content > div').eq(index).css('display','block');
		$('.text__tab li').removeClass('select');
		$(this).addClass('select')
	});
});
$(function() {
	$('.edit__tab li').click(function() {
		var index = $('.edit__tab li').index(this);
        if ($(this).hasClass('select')) {
            $('.edit__hidden > div').css('display','none');
            $('.edit__tab li').removeClass('select');
          } else {
            $('.edit__hidden > div').css('display','none');
            $('.edit__hidden > div').eq(index).css('display','block');
            $('.edit__tab li').removeClass('select');
            $(this).addClass('select')
          }
	});
});
$(function() {
	$('.edit__close').click(function() {
        $('.edit__hidden > div').css('display','none');
        $('.edit__tab li').removeClass('select');
	});
});
    
    

    var mySwiper = new Swiper ('.swiper-container', {
          /*speed: 600,
          autoplay:true,*/
          loop: true,
          slidesPerView: 8,
        　spaceBetween: 10,
          centeredSlides : true,
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
          },
          breakpoints: {
            767: {
              slidesPerView: 3,
              spaceBetween: 0
            }
          }
    });
</script>
</body>
</html>
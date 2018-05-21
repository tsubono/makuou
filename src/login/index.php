<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <link rel="shortcut icon" href="../assets/img/favicon.ico">
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/search.css">
    <link rel="stylesheet" href="../assets/css/layer.css">
    
</head>
<body>

<?php include_once "../inc/header.inc"; ?>

<main class="l-main">
    <div class="l-inner">
            <section class="login">
                
            <h1 class="main__title"><img src="../assets/img/login/title.png" alt="ログイン"></h1>
            <div class="main__content">
                <ul class="main__breadcrumb">
                    <li><a href="/">HOME</a></li>
                    <li>ログイン</li>
                </ul>
                <h4 class="ttl01">ログイン</h4>
                    <div class="login__column cf">
                        <div class="login__box member">
                            <h2>会員ログイン</h2>
                            <div class="innar">
                                <form action="">
                                    <dl>
                                        <dt>ID（メールアドレス）</dt>
                                        <dd><input type="email"></dd>
                                    </dl>
                                    <dl>
                                        <dt>パスワード</dt>
                                        <dd><input type="password"></dd>
                                    </dl>
                                    <p class="login_btn"><input type="submit" value="ログインする"></p>
                                </form>
                                <div class="cf forget_box">
                                    <p class="forget"><a href="#">パスワードを忘れた方はこちら</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="login__box first">
                            <h2>はじめての方</h2>
                            <div class="innar">
                                <p class="tec">当サイトからご注文・ご購入いただくには、<br>事前に無料会員登録が必要です。</p>
                                <p class="btn"><a href="#">新規会員登録はこちら</a></p>
                            </div>
                        </div>
                    </div>
                 </div>
                </section>
                <!-- /.search -->
                <section class="pickup">
                    <h2 class="pickup__heading"><img src="../assets/img/search/heading--pickup.png" alt="Pick Up!"></h2>
                    <div class="pickup__content">
                        <div class="pickup__box">
                            <div>
                                <img src="../assets/img/banner/banner01.png" alt="">
                                <dl class="pickup__info">
                                    <dt>比率</dt>
                                    <dd>1:1.5</dd>
                                    <dt>サイズ</dt>
                                    <dd>600</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="pickup__box">
                            <div>
                                <img src="../assets/img/banner/banner01.png" alt="">
                                <dl class="pickup__info">
                                    <dt>比率</dt>
                                    <dd>1:1.5</dd>
                                    <dt>サイズ</dt>
                                    <dd>600</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="pickup__box">
                            <div>
                                <img src="../assets/img/banner/banner01.png" alt="">
                                <dl class="pickup__info">
                                    <dt>比率</dt>
                                    <dd>1:1.5</dd>
                                    <dt>サイズ</dt>
                                    <dd>600</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="btn"><a href="/search/"><img src="../assets/img/top/make_btn.png" alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る"></a></div>
                </section>
                <!-- /.pickup -->
            </div>
</main>
<!-- /.l-main -->

<?php include_once "../inc/footer.inc"; ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../assets/js/common.js?v=1"></script>
<script src="../assets/js/search.js"></script>
<script src="../assets/js/jquery.matchHeight.js"></script>
<script>
    $(function(){
        $(".login__box .innar").matchHeight();
    });
</script>    
</body>
</html>
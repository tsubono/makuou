<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>再設定を受け付けました</title>
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
        <section class="password pass_accept">
            <h1 class="main__title"><img src="../assets/img/password/ttl_pass_accept.png" alt="再設定を受け付けました"></h1>
            <div class="main__content">
                <ul class="main__breadcrumb">
                    <li><a href="/">HOME</a></li>
                    <li>再設定を受け付けました</li>
                </ul>
                <h4 class="ttl01">再設定を受け付けました</h4>
                <div class="password__wrap">
                    <p class="txt">入力いただいたアドレスにメールを送信いたしました。<br>メールから新しいパスワード設定画面へお進みください。</p>
                </div>
            </div>
        </section><!-- /.search -->
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
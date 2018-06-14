<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>デザイン確認</title>
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
        <section class="layout confirm">
            <h1 class="main__title"><img src="../assets/img/layout/title_confirm.png" alt="デザイン確認"></h1>
            <div class="main__content">
                <ul class="main__breadcrumb">
                    <li><a href="">HOME</a></li>
                    <li><a href="">レイアウトを作る</a></li>
                    <li>デザイン確認</li>
                </ul>
                <div class="design w600"><img src="../assets/img/layout/600.png" alt="デザイン確認"></div>
                <form method="post" action="" class="form_template">
                    <div class="form__bd">
                        <dl>
                            <dt>デザイン名</dt>
                            <dd><input type="text" name="" id="" placeholder=" 例：○○フットボール部　ロゴ" /></dd>
                        </dl>
                        <dl>
                            <dt>備考欄</dt>
                            <dd><textarea name="" id=""></textarea></dd>
                        </dl>
                    </div>
                    <div class="share cf">
                        <ul class="cf">
                            <li><a href="#"><img src="../assets/img/layout/share_fb.png" alt="facebook"></a></li>
                            <li><a href="#"><img src="../assets/img/layout/share_twt.png" alt="Twitter"></a></li>
                            <li><a href="#"><img src="../assets/img/layout/share_line.png" alt="LINE"></a></li>
                            <li class="btn_org"><a href="#">デザインを保存する</a></li>
                        </ul>
                    </div>
                    <div class="btn"><input type="submit" name="submit" value="仕様を決める" /></div>
                </form>
            </div>
        </section>
        <!-- /.search -->
        <!-- /.pickup -->
    </div>
</main>
<!-- /.l-main -->

<?php include_once "../inc/footer.inc"; ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../assets/js/common.js?v=1"></script>
<script src="../assets/js/search.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ご注文情報</title>
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
        <section class="settlement">
            <h1 class="main__title"><img src="../assets/img/settlement/title.png" alt="ご注文"></h1>
            <div class="main__content">
                <ul class="main__breadcrumb">
                    <li><a href="/">HOME</a></li>
                    <li>ご注文情報</li>
                </ul>
                <h2 class="ttl01">このまま決済情報のご入力へお進みください。</h2>
                <div class="settlement__wrap">
                    <form class="form_template">
                        <p class="txt_c">クレジットカード決済には、株式会社ユニヴァ・ペイキャストの決済代行サービスを使用しています。<br>決済情報はSSL で暗号化され、安全性を確保しております。</p>
                        <ul class="sendarea type_css">
                            <li><input name="submit" value="決済へ進む" class="btn_css_check" type="submit"></li>
                        </ul>
                    </form>
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
</body>
</html>
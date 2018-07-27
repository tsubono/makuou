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
                <h4 class="ttl01">ご注文情報</h4>
                <div class="settlement__wrap">
                    <form class="form_template">
                        <h5 class="ttl02">会員情報（注文者）</h5>
                        <div class="form__bd">
                            <dl>
                                <dt>お名前</dt>
                                <dd>山田　太郎</dd>
                            </dl>
                        </div>
                        <h5 class="ttl02">お届け先のご住所</h5>
                        <div class="form__bd">
                            <dl>
                                <dt><span>必須</span>お名前</dt>
								<dd>山田　太郎</dd>
                            </dl>
                            <dl>
                                <dt><span>必須</span>お名前（フリガナ）</dt>
								<dd>やまだ　たろう</dd>
                            </dl>
                            <dl>
                                <dt>会社名</dt>
								<dd>●●株式会社</dd>
                            </dl>
                            <dl class="address_num">
                                <dt><span>必須</span>郵便番号</dt>
                                <dd>123 - 4567</dd>
                            </dl>
                            <dl class="innerlist_address add02">
                                <dt><span>必須</span>都道府県</dt>
                                <dd>大阪府</dd>
                            </dl>
                            <dl>
                                <dt><span>必須</span>住所（市区町村番地）</dt>
                                <dd>大阪市西区</dd>
                            </dl>
                            <dl>
                                <dt>住所（建物名・マンション名）</dt>
                                <dd>アーバンBLD心斎橋8F</dd>
                            </dl>
                            <dl>
                                <dt><span>必須</span>電話番号</dt>
                                <dd>06-6202-7773</dd>
                            </dl>
                            <dl>
								<dt>FAX番号</dt>
								<dd>06-6202-7773</dd>
                            </dl>
                        </div>
                        <h5 class="ttl02">お支払情報</h5>
                        <div class="form__bd">
                            <dl>
                                <dt>お支払い方法</dt>
                                <dd>クレジットカード</dd>
                            </dl>
                        </div>
                        
                        <h5 class="ttl02">料金</h5>
                        <div class="form__bd">
                            <dl>
                                <dt>合計金額（税込）</dt>
                                <dd>10,000円</dd>
                            </dl>
                        </div>
                        <ul class="sendarea type_css">
                            <li><input name="submit" value="注文を確定する" class="btn_css_check" type="submit"></li>
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
<script type="text/javascript" src="../assets/js/jquery.jpostal.js"></script>
<script>
    $(function () {
        $('#zip').jpostal({
            click : '#btn',
            postcode : [
                '#zip1',
    			'#zip2'
            ],
            address : {
                '#pref'  : '%3',
                '#address'  : '%4%5'
            }
        });
    });
</script>    
</body>
</html>
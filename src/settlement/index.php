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
                                <dd><ul class="innerlist_name"><li><input type="text" name=""></li><li><input type="text" name=""></li></ul></dd>
                            </dl>
                        </div>
                        <h5 class="ttl02">お届け先のご住所<input type="button" value="注文者情報をコピー"></h5>
                        <div class="form__bd">
                            <dl>
                                <dt><span>必須</span>お名前</dt>
                                <dd><ul class="innerlist_name"><li><input type="text" name=""></li><li><input type="text" name=""></li></ul></dd>
                            </dl>
                            <dl>
                                <dt><span>必須</span>お名前（フリガナ）</dt>
                                <dd><ul class="innerlist_kana"><li><input type="text" name=""></li><li><input type="text" name=""></li></ul></dd>
                            </dl>
                            <dl>
                                <dt>会社名</dt>
                                <dd><input type="text" class="" name=""></dd>
                            </dl>
                            <dl class="address_num">
                                <dt><span>必須</span>郵便番号</dt>
                                <dd><input name="zip1" id="zip1" type="text"> - <input name="zip2" id="zip2" type="text"><input type="button" id="btn" name="btn" value="郵便番号から自動入力"></dd>
                            </dl>
                            <dl class="innerlist_address add02">
                                <dt><span>必須</span>都道府県</dt>
                                <dd><select name="pref" id="pref">
                                    <option value="none" selected="selected">選択して下さい</option>
                                    <option value="北海道">北海道</option>
                                    <option value="青森県">青森県</option>
                                    <option value="岩手県">岩手県</option>
                                    <option value="宮城県">宮城県</option>
                                    <option value="秋田県">秋田県</option>
                                    <option value="山形県">山形県</option>
                                    <option value="福島県">福島県</option>
                                    <option value="茨城県">茨城県</option>
                                    <option value="栃木県">栃木県</option>
                                    <option value="群馬県">群馬県</option>
                                    <option value="埼玉県">埼玉県</option>
                                    <option value="千葉県">千葉県</option>
                                    <option value="東京都">東京都</option>
                                    <option value="神奈川県">神奈川県</option>
                                    <option value="新潟県">新潟県</option>
                                    <option value="富山県">富山県</option>
                                    <option value="石川県">石川県</option>
                                    <option value="福井県">福井県</option>
                                    <option value="山梨県">山梨県</option>
                                    <option value="長野県">長野県</option>
                                    <option value="岐阜県">岐阜県</option>
                                    <option value="静岡県">静岡県</option>
                                    <option value="愛知県">愛知県</option>
                                    <option value="三重県">三重県</option>
                                    <option value="滋賀県">滋賀県</option>
                                    <option value="京都府">京都府</option>
                                    <option value="大阪府">大阪府</option>
                                    <option value="兵庫県">兵庫県</option>
                                    <option value="奈良県">奈良県</option>
                                    <option value="和歌山県">和歌山県</option>
                                    <option value="鳥取県">鳥取県</option>
                                    <option value="島根県">島根県</option>
                                    <option value="岡山県">岡山県</option>
                                    <option value="広島県">広島県</option>
                                    <option value="山口県">山口県</option>
                                    <option value="徳島県">徳島県</option>
                                    <option value="香川県">香川県</option>
                                    <option value="愛媛県">愛媛県</option>
                                    <option value="高知県">高知県</option>
                                    <option value="福岡県">福岡県</option>
                                    <option value="佐賀県">佐賀県</option>
                                    <option value="長崎県">長崎県</option>
                                    <option value="熊本県">熊本県</option>
                                    <option value="大分県">大分県</option>
                                    <option value="宮崎県">宮崎県</option>
                                    <option value="鹿児島県">鹿児島県</option>
                                    <option value="沖縄県">沖縄県</option>
                                    <option value="日本国外">日本国外</option>
                                    </select></dd>
                            </dl>
                            <dl>
                                <dt><span>必須</span>住所（市区町村番地）</dt>
                                <dd><input type="text" id="address" name="address"></dd>
                            </dl>
                            <dl>
                                <dt>住所（建物名・マンション名）</dt>
                                <dd><input type="text" class="" name=""></dd>
                            </dl>
                            <dl>
                                <dt><span>必須</span>電話番号</dt>
                                <dd>
                                    <ul class="innerlist_tel">
                                        <li><input name="" id="" type="text"> - <input name="" id="" type="text"> - <input name="" id="" type="text"></li>
                                    </ul>
                                </dd>
                            </dl>
                            <dl>
                                <dt>FAX番号</dt>
                                <dd>
                                    <ul class="innerlist_tel">
                                        <li><input name="" id="" type="text"> - <input name="" id="" type="text"> - <input name="" id="" type="text"></li>
                                    </ul>
                                </dd>
                            </dl>
                        </div>
                        <h5 class="ttl02">お支払情報</h5>
                        <div class="form__bd">
                            <dl>
                                <dt>お支払い方法</dt>
                                <dd>
                                    <select class="order_pay" name="order_pay">
                                        <option value="クレジットカード">クレジットカード</option>
                                        <option value="代金引換">代金引換</option>
                                        <option value="コンビニ決済">コンビニ決済</option>
                                    </select>
                                </dd>
                            </dl>
                        </div>
                        
                        <h5 class="ttl02">料金</h5>
                        <div class="form__bd">
                            <dl>
                                <dt>合計金額（税込）</dt>
                                <dd>
                                    <input type="text" class="order_total" name="order_total">
                                </dd>
                            </dl>
                        </div>
                        <ul class="sendarea type_css">
                            <li><input name="submit" value="確認する" class="btn_css_check" type="submit"></li>
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
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>仕様を決める</title>
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
        <section class="layout spec">
            <h1 class="main__title"><img src="../assets/img/layout/title_spec.png" alt="仕様を決める"></h1>
            <div class="main__content">
                <ul class="main__breadcrumb">
                    <li><a href="">HOME</a></li>
                    <li><a href="">レイアウトを作る</a></li>
                    <li><a href="">デザイン確認</a></li>
                    <li>仕様を決める</li>
                </ul>
                <form method="post" name="option" action="" class="form_template">
                    <h2 class="ttl01">サイズを決める</h2>
                    <div class="form__bd">
                        <dl>
                            <dt>サイズ</dt>
                            <dd>
								<label><input type="radio" name="size" value="縦60cm" checked="checked">縦60cm</label>
								<label><input type="radio" name="size" value="縦90cm">縦90cm</label>
								<label><input type="radio" name="size" value="縦120cm">縦120cmm</label>
								<label><input type="radio" name="size" value="縦150cm">縦150cm</label>
								<label><input type="radio" name="size" value="縦180cm">縦180cm</label>
                            </dd>
                        </dl>
                    </div>
                    <div class="btn_two cf">
                        <div class="btn_return"><a href="/price/" target="_blank"><p>価格表</p></a></div>
                        <div class="btn_return"><a href="/size/" target="_blank"><p>おすすめサイズ</p></a></div>
                    </div>
                    <h2 class="ttl01">素材を決める</h2>
                    <div class="form__bd">
                        <dl class="material">
                            <dt>素材</dt>
                            <dd>
                                <ul>
                                    <li>
                                        <label><input type="radio" name="material" value="通常生地" checked="checked">通常生地</label>
                                        <label><input type="radio" name="material" value="メッシュ生地">メッシュ生地</label>
                                        <label><input type="radio" name="material" value="サテン生地">サテン生地</label>
                                        <label><input type="radio" name="material" value="強化ビニール生地">強化ビニール生地</label>
                                    </li>
                                    
                                </ul>    
                            </dd>
                        </dl>
                    </div>
                    <div class="btn_two">
                        <div class="btn_return"><a href="/price/" target="_blank"><p>価格表</p></a></div>
                        <div class="btn_return"><a href="/material/" target="_blank"><p>素材紹介</p></a></div>
                    </div>
                    <h2 class="ttl01">オプションを選ぶ</h2>
                    <div class="form__bd">
                        <dl>
                            <dt>ハトメの位置</dt>
                            <dd>
                                <label><input type="radio" name="hatome" value="通常" checked="checked">通常</label>
                                <label><input type="radio" name="hatome" value="上辺のみ">上辺のみ</label>
                                <label><input type="radio" name="hatome" value="左辺のみ">左辺のみ</label>
                                <label><input type="radio" name="hatome" value="ハトメなし">ハトメなし</label>
                            </dd>
                        </dl>
                        <dl>
                            <dt>付属品</dt>
                            <dd>
                                <ul class="option">
                                    <li class="rope">
                                        <p><label><input type="checkbox" name="" id="optcheck" value="1">ロープ</label></p>
                                        <ul class="cf">
                                            <li><input type="text" name="lope[1]" id="optinput1"></li>
                                            <li><input type="text" name="lope[2]" id="optinput2"></li>
                                        </ul>    
                                    </li>
                                    <li class="pole">
                                        <p><label><input type="checkbox" name="polecheck" id="" value="旗用ポール" onclick="checkBox()">旗用ポール</label></p>
                                        <div>
                                            <label><input type="radio" name="pole" value="2m・3段伸縮" onclick="radioButton()">2m・3段伸縮</label>
                                            <label><input type="radio" name="pole" value="3m・3段伸縮" onclick="radioButton()">3m・3段伸縮</label>
                                            <label><input type="radio" name="pole" value="4m・4段伸縮" onclick="radioButton()">4m・4段伸縮</label>
                                            <label><input type="radio" name="pole" value="5m・4段伸縮" onclick="radioButton()">5m・4段伸縮</label>
                                        </div>    
                                    </li>
                                </ul>
                            </dd>
                        </dl>
						<dl>
							<dt>納期</dt>
							<dd class="delivery">
								<label><input type="radio" name="hatome" value="通常発送（2営業日後）" checked="checked">通常発送（2営業日後）</label>
								<label><input type="radio" name="hatome" value="特急発送※価格が20%アップします（翌営業日後）">特急発送※価格が20%アップします（翌営業日後）</label>
							</dd>
						</dl>
                    </div>
                    <div class="btn_one">
                        <div class="btn_return"><a href="/option/" target="_blank"><p>オプションについて</p></a></div>
                    </div>
                    <div class="btn"><input type="submit" name="submit" value="確認画面へ" /></div>
                </form>
            </div>
        </section>
        <!-- /.search -->
        <!-- /.pickup -->
    </div>
</main>
<!-- /.l-main -->

<?php include_once "../inc/footer.inc"; ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../assets/js/common.js?v=1"></script>
<script src="../assets/js/search.js"></script>
<script>

$(function(){
    $("#optcheck").change(function(){
        optCheckVal = $("#optcheck:checked").val();
 
        if (optCheckVal == "1") {
            $("#optinput1").removeAttr("disabled").removeClass("bg_disabled").addClass("bg_white");
            $("#optinput2").removeAttr("disabled").removeClass("bg_disabled").addClass("bg_white");
        } else {
            $("#optinput1").attr("disabled", "disabled").removeClass("bg_white").addClass("bg_disabled");
            $("#optinput2").attr("disabled", "disabled").removeClass("bg_white").addClass("bg_disabled");
        }
    }).trigger("change");
});
    
//チェックボックスとラジオボタン連動
function checkBox() {
  if (document.option.polecheck.checked == true) {
    document.option.pole[0].checked = true;
  } else {
    document.option.pole[0].checked = false;
    document.option.pole[1].checked = false;
    document.option.pole[2].checked = false;
    document.option.pole[3].checked = false;
  }
}
function radioButton() {
  if (document.option.pole[0].checked == true) {
    document.option.polecheck.checked = true;
  }
  if (document.option.pole[1].checked == true) {
    document.option.polecheck.checked = true;
  }
	if (document.option.pole[2].checked == true) {
    document.option.polecheck.checked = true;
  }
	if (document.option.pole[3].checked == true) {
    document.option.polecheck.checked = true;
  }
}
</script>
</body>
</html>
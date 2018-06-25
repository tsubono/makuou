<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>登録情報の確認編集</title>
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
            <section class="member">
                
            <h1 class="main__title"><img src="../assets/img/member/title.png" alt="会員登録"></h1>
            <div class="main__content">
                <ul class="main__breadcrumb">
                    <li><a href="/">HOME</a></li>
                    <li><a href="../mypage/">マイページ</a></li>
                    <li>登録情報の確認編集</li>
                </ul>
				<div class="main__block_lr">
					<div class="main__block_r">
						<h4 class="ttl01 mt25">登録情報の確認編集</h4>

						<form method="post" action="" class="form_template">
							<div class="form__bd">
								<dl>
									<dt><span>必須</span>お名前</dt>
									<dd>
										<ul class="innerlist_name cf">
											<li><input type="text" name="" id="" placeholder=" 田中" /></li>
											<li><input type="text" name="" id="" placeholder=" 太郎" /></li>
										</ul>
									</dd>
								</dl>
								<dl>
									<dt><span>必須</span>おなまえ（ふりがな）</dt>
									<dd>
										<ul class="innerlist_kana cf">
											<li><input type="text" name="" id="" placeholder=" タナカ" /></li>
											<li><input type="text" name="" id="" placeholder=" タロウ" /></li>
										</ul>
									</dd>
								</dl>
								<dl>
									<dt><span>必須</span>メールアドレス</dt>
									<dd>
										<input type="text" name="" id="" placeholder="例：tanaka@jp">
									</dd>
								</dl>
								<dl>
									<dt>携帯電話番号</dt>
									<dd>
										<ul class="innerlist_tel">
											<li><input type="text" name="" id="" />&emsp;-&emsp;<input type="text" name="" id="" />&emsp;-&emsp;<input type="text" name="" id="" /></li>
										</ul>
									</dd>
								</dl>
								<dl>
									<dt>自宅電話番号</dt>
									<dd>
										<ul class="innerlist_tel">
											<li><input type="text" name="" id="" />&emsp;-&emsp;<input type="text" name="" id="" />&emsp;-&emsp;<input type="text" name="" id="" /></li>
										</ul>
									</dd>
								</dl>
								<dl class="address_num">
									<dt><span>必須</span>郵便番号</dt>
									<dd><input type="text" name="" id="" />&emsp;-&emsp;<input type="text" name="" id="" /></dd>
								</dl>
								<dl class="innerlist_address add02">
									<dt><span>必須</span>都道府県</dt>
									<dd><select name="address1" id="address1">
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
									<dt><span>必須</span>住所1（市町村名・番地）</dt>
									<dd>
										<input type="text" name="" id="" />
									</dd>
								</dl>
								<dl>
									<dt>住所2（建物名・マンション名）</dt>
									<dd>
										<input type="text" name="" id="" />
									</dd>
								</dl>
								<dl>
									<dt><span>必須</span>パスワード</dt>
									<dd>
										<input type="text" name="" id="" />
									</dd>
								</dl>
							</div>
							<ul class="sendarea type_css">
								<li><input type="submit" name="submit" value="確認する" class="btn_css_check"></li>
							</ul>
						</form>
					</div>
					<div class="main__block_l">
						<?php include_once "../inc/mypageside.inc"; ?>
					</div>
				</div>
            </div>    
        </section>
        
        
    </div>
</main>
<!-- /.l-main -->

<?php include_once "../inc/footer.inc"; ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../assets/js/common.js"></script>
<script src="../assets/js/search.js"></script>
</body>
</html>
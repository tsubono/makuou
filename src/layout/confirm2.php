<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>確認画面</title>
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
		<section class="layout confirm confirm2">
			<h1 class="main__title"><img src="../assets/img/layout/title_confirm2.png" alt="デザイン確認"></h1>
			<div class="main__content">
				<ul class="main__breadcrumb">
					<li><a href="">HOME</a></li>
					<li><a href="">レイアウトを作る</a></li>
					<li><a href="">デザイン確認</a></li>
					<li><a href="">仕様を決める</a></li>
					<li>確認画面</li>
				</ul>
				
				<form method="post" action="" class="form_template">
					<div class="form__bd">
						<dl>
							<dt>レイアウトイメージ</dt>
							<dd><div class="design w600"><img src="../assets/img/layout/600.png" alt="デザイン確認"></div></dd>
						</dl>
						<dl>
							<dt>デザイン名</dt>
							<dd>○○フットボール部　ロゴ</dd>
						</dl>
						<dl>
							<dt>備考欄</dt>
							<dd></dd>
						</dl>
						<dl>
							<dt>比率</dt>
							<dd>１：１</dd>
						</dl>
						<dl>
							<dt>サイズ</dt>
							<dd>縦60cm×横60cm</dd>
						</dl>
						<dl>
							<dt>素材</dt>
							<dd>通常生地</dd>
						</dl>
						<dl>
							<dt>ハトメ位置</dt>
							<dd>通常</dd>
						</dl>
						<dl>
							<dt>付属品（ロープ）</dt>
							<dd></dd>
						</dl>
						<dl>
							<dt>付属品（旗用ポール）</dt>
							<dd>4m・4段伸縮</dd>
						</dl>
						<dl>
							<dt>納期</dt>
							<dd>通常発送（2営業日後）</dd>
						</dl>
						<dl>
							<dt>価格</dt>
							<dd>●●●●円</dd>
						</dl>
					</div>
					
					<div class="btn">
						<input type="submit" name="submit" value="注文画面へ進む" />
					</div>
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
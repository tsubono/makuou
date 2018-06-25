<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マイページ</title>
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
			<section class="mypage">
			<h1 class="main__title"><img src="../assets/img/mypage/title.png" alt="ログイン"></h1>
			<div class="main__content">
				<ul class="main__breadcrumb">
					<li><a href="/">HOME</a></li>
					<li>マイページ</li>
				</ul>
				<h4 class="ttl01">マイページ</h4>
				<ul class="two_box">
					<li><a href="/save/"><img src="../assets/img/mypage/mypage_01.png" alt="保存作品"></a></li>
					<li><a href="/favorite/"><img src="../assets/img/mypage/mypage_02.png" alt="お気に入りテンプレート"></a></li>
				</ul>
				<ul class="there_box">
					<li><a href="/member/"><img src="../assets/img/mypage/mypage_03.png" alt="登録情報の確認編集"></a></li>
					<li><a href="/ordered/"><img src="../assets/img/mypage/mypage_04.png" alt="注文履歴"></a></li>
					<li><a href="/logout/"><img src="../assets/img/mypage/mypage_05.png" alt="ログアウト"></a></li>
				</ul>
				<div class="pickup">
					<div class="btn"><a href="/search/"><img src="../assets/img/top/make_btn.png" alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る"></a></div>
				</div>
			</div>
                </section>
                <!-- /.search -->
                
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
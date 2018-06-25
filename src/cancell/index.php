<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>退会する</title>
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
			<section class="cancel">
			<h1 class="main__title"><img src="../assets/img/cancell/title.png" alt="退会する"></h1>
			<div class="main__content">
				<ul class="main__breadcrumb">
					<li><a href="/">HOME</a></li>
					<li><a href="../mypage/">マイページ</a></li>
					<li>退会する</li>
				</ul>
				<h4 class="ttl01">退会する</h4>
				<div class="logout__info cf">
					<div class="txt">
						<h2 class="mt0">退会する</h2>
						<p class="txt_c mb30">退会すると、これまでの保存作品や注文履歴、登録情報が削除されます。</p>
						<p class="btn mb10"><a href="../mypage/">マイページへもどる</a></p>
						<p class="btn"><a href="./complecation.php">退会を確定する</a></p>
					</div>
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
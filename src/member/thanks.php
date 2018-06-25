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
					<li><a href="./">登録情報の確認編集</a></li>
                    <li>完了画面</li>
                </ul>
				<div class="main__block_lr">
					<div class="main__block_r">
						<h4 class="ttl01 mt25">登録情報の確認編集</h4>
						<div class="thanks__info cf">
							<div class="pho"><img src="../assets/img/common/makuou.png" alt=""></div>
							<div class="txt">
								<h2>登録情報を変更しました。</h2>
								<p class="btn"><a href="../">トップへもどる</a></p>
							</div>
						</div>
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
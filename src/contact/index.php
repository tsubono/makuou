<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせ</title>
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
            <section class="contact">
                
            <h1 class="main__title"><img src="../assets/img/contact/title.png" alt="お問い合わせ"></h1>
            <div class="main__content">
                <ul class="main__breadcrumb">
                    <li><a href="">HOME</a></li>
                    <li>お問い合わせ</li>
                </ul>
                <h4 class="ttl01">お問い合わせ</h4>
                <p>下記フォームにお問い合わせ内容を記入の上、画面下部の「確認する」を押して、登録確認にお進みください。</p>

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
                            <dt><span>必須</span>お問い合わせ内容</dt>
                            <dd>
                                <input type="textarea" name="" id="" />
                            </dd>
                        </dl>
                    </div>
                    <ul class="sendarea type_css">
                        <li><input type="submit" name="submit" value="確認する" class="btn_css_check" /></li>
                    </ul>
                </form>
            </div>    
        </section>
        
				<section class="pickup">
					<h2 class="pickup__heading"><img src="../assets/img/search/heading--pickup.png" alt=""></h2>
					<div class="pickup__content">
						<div class="pickup__box">
							<div>
								<img src="../assets/img/banner/banner01.png" alt="">
								<dl class="pickup__info">
									<dt>比率</dt>
									<dd>1:1.5</dd>
									<dt>サイズ</dt>
									<dd>600</dd>
								</dl>
							</div>
						</div>
						<div class="pickup__box">
							<div>
								<img src="../assets/img/banner/banner01.png" alt="">
								<dl class="pickup__info">
									<dt>比率</dt>
									<dd>1:1.5</dd>
									<dt>サイズ</dt>
									<dd>600</dd>
								</dl>
							</div>
						</div>
						<div class="pickup__box">
							<div>
								<img src="../assets/img/banner/banner01.png" alt="">
								<dl class="pickup__info">
									<dt>比率</dt>
									<dd>1:1.5</dd>
									<dt>サイズ</dt>
									<dd>600</dd>
								</dl>
							</div>
						</div>
					</div>
                    <div class="btn"><a href="#"><img src="../assets/img/top/make_btn.png" alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る"></a></div>
				</section>
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
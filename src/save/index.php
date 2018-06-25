<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
	<title>保存作品</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <link rel="shortcut icon" href="../assets/img/favicon.ico">
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="stylesheet" href="../assets/css/common.css">
	<link rel="stylesheet" href="../assets/css/example.css">
	<link rel="stylesheet" href="../assets/css/layer.css">
</head>
<body>

<?php include_once "../inc/header.inc"; ?>

<main class="l-main">
    <div class="l-inner">
		<section class="save">
        <h1 class="main__title">
            <picture>
                <img src="../assets/img/save/title.png" srcset="../assets/img/save/title.png" alt="保存作品">
            </picture>
        </h1>
        <div class="main__content">
            <ul class="main__breadcrumb">
                <li><a href="/">HOME</a></li>
				<li><a href="/mypage/">マイページ</a></li>
				<li>保存作品</li>
            </ul>
			<div class="main__block_lr">
			<div class="main__block_r">
               <h2 class="ttl01 mt25">保存作品</h2>
                <div class="example__content">
					<a class="js-showing-modal" href="#c001">
						<h3 class="ttl03">作品名</h3>
                        <figure>
                            <img src="../assets/img/example/c001_thumbnail.jpg" alt="">
                        </figure>
                        <table>
                        	<tr>
								<th>比率</th>
								<td>1:1.5</td>
                        	</tr>
                        </table>
                    </a>
					<a class="js-showing-modal" href="#c002">
						<h3 class="ttl03">作品名</h3>
                        <figure>
                            <img src="../assets/img/example/c001_thumbnail.jpg" alt="">
						</figure>
						<table>
							<tr>
								<th>比率</th>
								<td>1:1.5</td>
							</tr>
						</table>
                    </a>
					<a class="js-showing-modal" href="#c003">
						<h3 class="ttl03">作品名</h3>
						<figure><img src="../assets/img/example/c001_thumbnail.jpg" alt=""></figure>
						<table>
							<tr>
								<th>比率</th>
								<td>1:1.5</td>
							</tr>
						</table>
					</a>
					
					<a class="js-showing-modal" href="#c004">
						<h3 class="ttl03">作品名</h3>
						<figure><img src="../assets/img/example/c001_thumbnail.jpg" alt=""></figure>
						<table>
							<tr>
								<th>比率</th>
								<td>1:1.5</td>
							</tr>
						</table>
					</a>
					
					<a class="js-showing-modal" href="#c005">
						<h3 class="ttl03">作品名</h3>
						<figure><img src="../assets/img/example/c001_thumbnail.jpg" alt=""></figure>
						<table>
							<tr>
								<th>比率</th>
								<td>1:1.5</td>
							</tr>
						</table>
					</a>
					
					<a class="js-showing-modal" href="#c006">
						<h3 class="ttl03">作品名</h3>
						<figure><img src="../assets/img/example/c001_thumbnail.jpg" alt=""></figure>
						<table>
							<tr>
								<th>比率</th>
								<td>1:1.5</td>
							</tr>
						</table>
					</a>
					
				</div>
				<!-- /.example__content -->
				<a class="example__btn" href="/search/">
					<img src="../assets/img/top/make_btn.png" alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る">
				</a>
			</div>
			<!--/.main_blockr -->
			<div class="main__block_l">
				<?php include_once "../inc/mypageside.inc"; ?>
			</div>
			</div>
			<!--/.main_block_rl -->
			</div>
			<!--/.main__content -->
		</section>
	</div>
</main>
<!-- /.l-main -->

<div class="modal">
    <div class="modal__inner">
        <div id="c001" class="modal__content">
            <div class="modal__close"></div>
            <figure>
                <img src="../assets/img/example/c001_photo.jpg" alt="">
                <figcaption>
                    <p class="modal__heading">作品名</p>
                </figcaption>
            </figure>
        </div>
        <div id="c002" class="modal__content">
            <div class="modal__close"></div>
            <figure>
                <img src="../assets/img/example/c001_photo.jpg" alt="">
                <figcaption>
                    <p class="modal__heading">作品名</p>
                </figcaption>
            </figure>
        </div>
        <div id="c003" class="modal__content">
            <div class="modal__close"></div>
            <figure>
                <img src="../assets/img/example/c001_photo.jpg" alt="">
                <figcaption>
					<p class="modal__heading">作品名</p>
                </figcaption>
            </figure>
        </div>
        <div id="c004" class="modal__content">
            <div class="modal__close"></div>
            <figure>
                <img src="../assets/img/example/c001_photo.jpg" alt="">
                <figcaption>
					<p class="modal__heading">作品名</p>
                </figcaption>
            </figure>
        </div>
        <div id="c005" class="modal__content">
            <div class="modal__close"></div>
            <figure>
                <img src="../assets/img/example/c001_photo.jpg" alt="">
                <figcaption>
					<p class="modal__heading">作品名</p>
                </figcaption>
            </figure>
        </div>
        <div id="c006" class="modal__content">
            <div class="modal__close"></div>
            <figure>
                <img src="../assets/img/example/c001_photo.jpg" alt="">
                <figcaption>
					<p class="modal__heading">作品名</p>
                </figcaption>
            </figure>
        </div>
    </div>
</div>
<!-- /.modal -->

<?php include_once "../inc/footer.inc"; ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../assets/js/common.js"></script>
<script src="../assets/js/example.js"></script>

</body>
</html>
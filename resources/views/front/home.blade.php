@extends('front/layouts.default')

@section('title', 'ホーム | 幕王')

@section('content')

    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><a href="{{url('/result')}}"><img src="{{asset("assets/img/top/mainimg1.png")}}" alt=""></a></div>
            <div class="swiper-slide"><img src="{{asset("assets/img/top/mainimg2.png")}}" alt=""></div>
            <div class="swiper-slide"><a href="{{url('/price')}}"><img src="{{asset("assets/img/top/mainimg3.png")}}" alt=""></a></div>
            <div class="swiper-slide"><a href="{{url('/faq')}}"><img src="{{asset("assets/img/top/mainimg4.png")}}" alt=""></a></div>
            <div class="swiper-slide"><a href="{{url('/example')}}"><img src="{{asset("assets/img/top/mainimg5.png")}}" alt=""></a></div>
        </div>
        <div class="swiper-my-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    <div class="pickup">
        <div class="guide_flow">
            <div class="fl_box">
                <div class="fl_title">
                    <span class="fl_sh">STEP</span><span class="fl_bg">1</span>
                </div>
                <div class="fl_contents">
                    <div class="fl_img">
                        <div class="fl_icon1"></div>
                    </div>
                    <div class="fl_text">
                        <p class="fl_p">新規会員登録（無料）<br>して、ログイン</p>
                    </div>
                </div>
            </div>

            <div class="fl_box">
                <div class="fl_title">
                    <span class="fl_sh">STEP</span><span class="fl_bg">2</span>
                </div>
                <div class="fl_contents">
                    <div class="fl_img">
                        <div class="fl_icon2"></div>
                    </div>
                    <div class="fl_text">
                        <p class="fl_p">デザイン<br>テンプレートを選ぶ</p>
                    </div>
                </div>
            </div>

            <div class="fl_box">
                <div class="fl_title">
                    <span class="fl_sh">STEP</span><span class="fl_bg">3</span>
                </div>
                <div class="fl_contents">
                    <div class="fl_img">
                        <div class="fl_icon3"></div>
                    </div>
                    <div class="fl_text">
                        <p class="fl_p">デザインを作る</p>
                    </div>
                </div>
            </div>

            <div class="fl_box">
                <div class="fl_title">
                    <span class="fl_sh">STEP</span><span class="fl_bg">4</span>
                </div>
                <div class="fl_contents">
                    <div class="fl_img">
                        <div class="fl_icon4"></div>
                    </div>
                    <div class="fl_text">
                        <p class="fl_p">ご注文手続き</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contents">
        <section class="choose_scene box3">
            <h2>シーンから選ぶ</h2>
            <ul class="cf">
                <li><a href="{{ url('result') }}?category_3[]=33"><img src="{{asset("assets/img/top/scene_01.png")}}" alt="スポーツ応援"></a></li>
                <li><a href="{{ url('result') }}?category_3[]=34"><img src="{{asset("assets/img/top/scene_02.png")}}" alt="お祝い・式典"></a></li>
                <li><a href="{{ url('result') }}?category_3[]=35"><img src="{{asset("assets/img/top/scene_03.png")}}" alt="学校行事"></a></li>
            </ul>
            <ul class="hidden cf">
                <li><a href="{{ url('result') }}?category_3[]=36"><img src="{{asset("assets/img/top/scene_04.png")}}" alt="イベント・フェス"></a></li>
                <li><a href="{{ url('result') }}?category_3[]=37"><img src="{{asset("assets/img/top/scene_05.png")}}" alt="ホームパーティー"></a></li>
                <li><a href="{{ url('result') }}?category_3[]=38"><img src="{{asset("assets/img/top/scene_06.png")}}" alt="商売繁盛"></a></li>
            </ul>
            <div class="more__btn"><p>もっと見る</p></div>
        </section>
        <section class="choose_sports box5">
            <h2>スポーツから選ぶ</h2>
            <ul class="cf">
                <li><a href="{{ url('result') }}?category_1[]=4"><img src="{{asset("assets/img/top/sport_01.png")}}" alt="サッカー・フットサル"></a></li>
                <li><a href="{{ url('result') }}?category_1[]=5"><img src="{{asset("assets/img/top/sport_02.png")}}" alt="野球・ソフトボール"></a></li>
                <li><a href="{{ url('result') }}?category_1[]=6"><img src="{{asset("assets/img/top/sport_03.png")}}" alt="バスケットボール"></a></li>
                <li><a href="{{ url('result') }}?category_1[]=7"><img src="{{asset("assets/img/top/sport_04.png")}}" alt="バレーボール"></a></li>
                <li><a href="{{ url('result') }}?category_1[]=8"><img src="{{asset("assets/img/top/sport_05.png")}}" alt="テニス"></a></li>
            </ul>
            <ul class="hidden cf">
                <li><a href="{{ url('result') }}?category_1[]=9"><img src="{{asset("assets/img/top/sport_06.png")}}" alt="バドミントン"></a></li>
                <li><a href="{{ url('result') }}?category_1[]=10"><img src="{{asset("assets/img/top/sport_07.png")}}" alt="ラグビー"></a></li>
                <li><a href="{{ url('result') }}?category_1[]=11"><img src="{{asset("assets/img/top/sport_08.png")}}" alt="ハンドボール"></a></li>
                <li><a href="{{ url('result') }}?category_1[]=12"><img src="{{asset("assets/img/top/sport_09.png")}}" alt="ドッジボール"></a></li>
                <li><a href="{{ url('result') }}?category_1[]=13"><img src="{{asset("assets/img/top/sport_10.png")}}" alt="卓球"></a></li>
                <li><a href="{{ url('result') }}?category_1[]=14"><img src="{{asset("assets/img/top/sport_11.png")}}" alt="剣道"></a></li>
                <li><a href="{{ url('result') }}?category_1[]=15"><img src="{{asset("assets/img/top/sport_12.png")}}" alt="弓道"></a></li>
                <li><a href="{{ url('result') }}?category_1[]=16"><img src="{{asset("assets/img/top/sport_13.png")}}" alt="空手道・柔道"></a></li>
                <li><a href="{{ url('result') }}?category_1[]=17"><img src="{{asset("assets/img/top/sport_14.png")}}" alt="陸上競技"></a></li>
                <li><a href="{{ url('result') }}?category_1[]=18"><img src="{{asset("assets/img/top/sport_15.png")}}" alt="水泳"></a></li>
                <li><a href="{{ url('result') }}?category_1[]=19"><img src="{{asset("assets/img/top/sport_16.png")}}" alt="体操"></a></li>
                <li><a href="{{ url('result') }}?category_1[]=20"><img src="{{asset("assets/img/top/sport_17.png")}}" alt="スキー・スノーボード"></a></li>
                <li><a href="{{ url('result') }}?category_1[]=21"><img src="{{asset("assets/img/top/sport_18.png")}}" alt="スケート"></a></li>
                <li><a href="{{ url('result') }}?category_1[]=22"><img src="{{asset("assets/img/top/sport_19.png")}}" alt="レスリング"></a></li>
                <li><a href="{{ url('result') }}?category_1[]=23"><img src="{{asset("assets/img/top/sport_20.png")}}" alt="ダンス"></a></li>
            </ul>
            <div class="more__btn"><p>もっと見る</p></div>
        </section>
        <section class="choose_taste box3">
            <h2>テイストから選ぶ</h2>
            <ul class="cf">
                <li><a href="{{ url('result') }}?category_2[]=24"><img src="{{asset("assets/img/top/taste_01.png")}}" alt="シンプル素材少なめの定番柄"></a></li>
                <li><a href="{{ url('result') }}?category_2[]=25"><img src="{{asset("assets/img/top/taste_02.png")}}" alt="熱血応援幕らしい炎モチーフ"></a></li>
                <li><a href="{{ url('result') }}?category_2[]=26"><img src="{{asset("assets/img/top/taste_03.png")}}" alt="スポーティースポーツ幕らしいデザイン"></a></li>
            </ul>
            <ul class="hidden cf">
                <li><a href="{{ url('result') }}?category_2[]=27"><img src="{{asset("assets/img/top/taste_04.png")}}" alt="ナチュラル自然モチーフ"></a></li>
                <li><a href="{{ url('result') }}?category_2[]=28"><img src="{{asset("assets/img/top/taste_05.png")}}" alt="インパクトとにかく目立ちたい人向け"></a></li>
                <li><a href="{{ url('result') }}?category_2[]=29"><img src="{{asset("assets/img/top/taste_06.png")}}" alt="かわいいイラスト多めでポップなイメージ"></a></li>
                <li><a href="{{ url('result') }}?category_2[]=30"><img src="{{asset("assets/img/top/taste_07.png")}}" alt="ヴィンテージ古風柄で大人向け"></a></li>
                <li><a href="{{ url('result') }}?category_2[]=31"><img src="{{asset("assets/img/top/taste_08.png")}}" alt="ゴージャスキラキラや幻想的なデザイン"></a></li>
                <li><a href="{{ url('result') }}?category_2[]=32"><img src="{{asset("assets/img/top/taste_09.png")}}" alt="和風日本柄"></a></li>
            </ul>
            <div class="more__btn"><p>もっと見る</p></div>
        </section>
        <section class="feature">
            <h2>選ばれる6つの特徴</h2>
            <ul class="cf">
                <li>
                    <dl>
                        <dt>誰でも<span class="blue">簡単に</span>オリジナル<br class="pc_none sp_none">デザインが作れる！</dt>
                        <dd>デザインテンプレートよりお好みの編集が簡単にできます。<br class="sp_none">用途に合わせたデザイン制作が可能です！<br>自分で編集するので校正の時間を短縮でき、デザイン料無料です！</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt>最短<span class="blue">2営業日</span>後発送！</dt>
                        <dd>15時までのご注文で2営業日後発送です。<br>特急(料金2割増し)なら翌営業日後発送で！どこにも負けない短納期で、週末のイベントに間に合います！</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt>自社専門工場での制作で<br class="pc_none"><span class="blue">安心の高品質</span>！</dt>
                        <dd>印刷から縫製、発送まですべて自社工場で！豊富な取引実績から耐候性・発色にこだわった印刷方法や丈夫な縫製技術を研究開発し、お客様にご満足頂ける商品とサービス向上に努めています！</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt><span class="blue">見積り無料</span>で料金が<br class="pc_none sp_none">分かりやすい！</dt>
                        <dd>幕のサイズと生地をご選択いただくと価格が決まります。<br>加工の変更は無料で行います。デザインは何種類でも制作できるので、ご満足いただいてから発注できます！</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt><span class="blue">送料全国一律</span>800円！</dt>
                        <dd>1回のご注文で、全国どこでも送料一律です！<br>※発送先が複数ある場合、それぞれの納品先に送料がかかります。</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt><span class="blue">選べる支払方法</span>！<br class="pc_none sp_none">後払いOK！</dt>
                        <dd>初めての方やお急ぎの方でも、お支払方法が選べます！<br>カード払い・コンビニ振込み・郵便局振込み・銀行振込みで、後払いが可能です。</dd>
                    </dl>
                </li>
            </ul>
        </section>
        <div class="btn">
            <a href="{{ url('/search') }}">
                <img src="{{asset("assets/img/top/make_btn.png")}}" alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る"></a>
        </div>
    </div>
@endsection

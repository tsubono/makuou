@extends('front.layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
@endpush

@section('title', 'オプションについて')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="option">

                <h1 class="main__title"><img src="{{asset("assets/img/option/title.png")}}" alt="オプションについて"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url('/')}}">HOME</a></li>
                        <li><a href="{{url('/price')}}">価格表</a></li>
                        <li>オプションについて</li>
                    </ul>
                    <h3 class="catch">
                        <img class="pc" src="{{asset("assets/img/option/catch_pc.png")}}" alt="オプション・加工をお選びいただけます。">
                        <img class="sp" src="{{asset("assets/img/option/catch_sp.png")}}" alt="オプション・加工をお選びいただけます。">
                    </h3>
                    <h4 class="ttl01">通常加工<span class="small">（4種）</span></h4>
                    <h5 class="ttl02">通常生地・サテン生地・メッシュ生地</h5>
                    <h6 class="ttl03">四方三巻縫製</h6>
                    <div class="ph_tx cf">
                        <div class="pho"><img src="{{asset("assets/img/option/normal_01.png")}}" alt="四方三巻縫製"></div>
                        <div class="txt">周囲を2回折り返し、幅10mmを一重ステッチで縫製します。<br>生地のほつれを予防します。</div>
                    </div>
                    <h6 class="ttl03">透明プラスチックハトメ（裏補強あり）</h6>
                    <div class="tx_ph cf">
                        <div class="pho"><img src="{{asset("assets/img/option/normal_02.png")}}" alt="透明プラスチックハトメ（裏補強あり）"></div>
                        <div class="txt">内径12mmのプラスチックリングです。裏面に白色レザー生地を縫い付けて補強しています。<br>
                            四辺に40cm～ 60cm間隔でつきます。
                        </div>
                    </div>
                    <h5 class="ttl02">強化ビニール生地</h5>
                    <h6 class="ttl03">周囲ロープ編込み縫製</h6>
                    <div class="ph_tx cf">
                        <div class="pho"><img src="{{asset("assets/img/option/normal_03.png")}}" alt="周囲ロープ編込み縫製"></div>
                        <div class="txt">周囲を40mm折り返し、二重ステッチで縫製します。<br>
                            6φの太い補強ロープ入りで、しっかりとした強度があります。
                        </div>
                    </div>
                    <h6 class="ttl03">金色金属ハトメ</h6>
                    <div class="tx_ph cf">
                        <div class="pho"><img src="{{asset("assets/img/option/normal_04.png")}}" alt="金色金属ハトメ"></div>
                        <div class="txt">内径9mmの金属リングです。四辺に 40cm～ 60cm間隔でつきます。</div>
                    </div>


                    <h4 class="ttl01">選べる仕上げ加工</h4>
                    <h6 class="ttl03">ハトメ変更</h6>
                    <div class="ph_tx cf">
                        <div class="pho"><img src="{{asset("assets/img/option/hatome_normal.png")}}" alt="ハトメ変更"></div>
                        <div class="txt">通常加工では四辺に40cm～ 60cm間隔でついています。<br>
                            下記のようにハトメ位置を変更できます。<br>
                            <p class="indent1">※ハトメの数、位置指定のご希望がある場合は別途ご指示ください。</p></div>
                    </div>
                    <div class="there_box">
                        <ul class="cf">
                            <li>
                                <ul class="list_dot">
                                    <li>上辺のみハトメ</li>
                                </ul>
                                <img src="{{asset("assets/img/option/hatome_opt01.png")}}" alt="上辺のみハトメ">
                            </li>
                            <li>
                                <ul class="list_dot">
                                    <li>左辺のみハトメ</li>
                                </ul>
                                <img src="{{asset("assets/img/option/hatome_opt02.png")}}" alt="左辺のみハトメ">
                            </li>
                            <li>
                                <ul class="list_dot">
                                    <li>ハトメなし</li>
                                </ul>
                                <img src="{{asset("assets/img/option/hatome_opt03.png")}}" alt="ハトメなし">
                            </li>
                        </ul>
                    </div>


                    <h4 class="ttl01">付属品オプション</h4>
                    <h5 class="ttl03">ロープ</h5>
                    <div class="ph_tx cf">
                        <div class="pho"><img src="{{asset("assets/img/option/option_01.png")}}" alt="ロープ"></div>
                        <div class="txt">設置用ロープ（ビニロン製）太さ4 ㎜<br>
                            1 ㎝ 0.4 円での切売りです。ご希望の長さと本数をご記入ください。
                        </div>
                    </div>

                    <h5 class="ttl03">旗用ポール</h5>
                    <div class="ph_tx cf">
                        <div class="pho"><img src="{{asset("assets/img/option/option_02.png")}}" alt="旗用ポール"></div>
                        <div class="txt">
                            <p>旗としてお使いいただく時に、ご利用ください。</p>
                            <p>その場合は左辺のみハトメに仕上げを変更してください。</p>
                            <p class="indent1">※通常生地とサテン生地は裏面が白いです。</p>
                            <p class="indent1">※強化ビニール生地は生地が硬い為、旗としておすすめできません。</p>

                            <ul class="list_dot mt30">
                                <li>詳細資料</li>
                            </ul>
                            <ul class="pdf_list">
                                <li><a href="{{asset("assets/date/option/pole_2m.pdf")}}" target="_blank">2m・3段伸縮 ￥4,600</a></li>
                                <li><a href="{{asset("assets/date/option/pole_3m.pdf")}}" target="_blank">3m・3段伸縮 ￥6,500</a></li>
                                <li><a href="{{asset("assets/date/option/pole_4m.pdf")}}"target="_blank">4m・4段伸縮 ￥8,900</a></li>
                                <li><a href="{{asset("assets/date/option/pole_5m.pdf")}}" target="_blank">5m・4段伸縮 ￥10,700</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="btn_three">
                        <div class="btn_return"><a href="{{url('/price')}}"><p>価格表に戻る</p></a></div>
                        <div class="btn_return"><a href="{{url('/material')}}"><p>素材について</p></a></div>
                        <div class="btn_return"><a href="{{url('/option')}}"><p>オプションについて</p></a></div>
                    </div>
                    <div class="pickup">
                        <div class="btn"><a href="{{url('/search')}}"><img src="{{asset("assets/img/top/make_btn.png")}}"
                                                                 alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る"></a></div>
                    </div>

                </div>
            </section>

        </div>
    </main>
    <!-- /.l-main -->
@endsection
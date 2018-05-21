@extends('front.layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
@endpush

@section('title', 'サイズ選びについて')

@section('content')
    <main class="l-main">
        <div class="l-inner size">
            <h1 class="main__title"><img src="{{asset("assets/img/size/size_title.png")}}" alt="サイズ選びについて"></h1>
            <div class="main__content">
                <ul class="main__breadcrumb">
                    <li><a href="{{url('/')}}">HOME</a></li>
                    <li><a href="{{url('/price')}}">価格表</a></li>
                    <li>サイズ選びについて</li>
                </ul>

                <section class="size">
                    <h4 class="ttl01">サイズの選び方</h4>
                    <h5 class="ttl03">デザインから選ぶ</h5>
                    <p class="txt">
                        デザインは、最初に縦横の比率を決めて探していただきます。同じデザインでも正方形～長方形で印象が変わる為、テンプレート一覧から最もイメージに近い比率をお選びいただき、デザインを編集してください。デザイン決定後、その比率の縦横サイズを決定してください。
                    </p>

                    <h5 class="ttl03">設置場所で選ぶ場合</h5>
                    <p class="txt">
                        あらかじめ設置場所が決まっている場合は、縦か横だけでもロープや布で実寸を確認することをオススメします。また、屋内か屋外か、どの距離から見るのか、大きさの規定がないかなど、事前にご確認ください。<br>
                        広い屋外の場合、実際の距離感で設置場所を見ると意外と幕が小さかった、となることが多いです。屋内の場合、幕が大きすぎて設置ができなかった、となることが多いです。
                    </p>

                    <div class="size_hiritsu">
                        <div class="size_hiritsu1"></div>
                        <div class="size_hiritsu2"></div>
                        <div class="size_hiritsu3"></div>
                    </div>

                    <h4 class="ttl01">各サイズの特徴（5 サイズ）</h4>
                    <h5 class="ttl03">縦60cm</h5>
                    <div class="size_right">
                        <div class="size_img60"></div>
                        <div class="size_text">
                            <ul class="list_dot">
                                <li>
                                    <p>60×60cm～60×120cmはおひとり様でも手持ちで広げられます。</p></li>
                                <li>
                                    <p>屋内で掲げて使う場合、大きすぎず、また場所をとりすぎず、オススメです。</p></li>
                                <li>
                                    <p>高さのない手すりなどに、横長で表示できるのがポイントです。</p></li>
                            </ul>
                        </div>
                    </div>

                    <h5 class="ttl03">縦90cm</h5>
                    <div class="size_left">
                        <div class="size_img90"></div>
                        <div class="size_text">
                            <ul class="list_dot">
                                <li>
                                    <p>屋外スポーツでは、縦90cmの横長幕が多いです。</p></li>
                                <li>
                                    <p>フェンスなどに取り付けてご使用いただくのがオススメです。</p></li>
                                <li>
                                    <p>文字が多い場合などは、横180cm以上ですと収まりがいいです。</p></li>
                            </ul>
                        </div>
                    </div>

                    <h5 class="ttl03">縦120cm</h5>
                    <div class="size_right">
                        <div class="size_img120"></div>
                        <div class="size_text">
                            <ul class="list_dot">
                                <li>
                                    <p>屋内スポーツでは、120×180cmまたは120×240cmが多いです。</p></li>
                                <li>
                                    <p>屋内競技場で2階等から手すりに下げてお使いいただくのがオススメです。</p></li>
                                <li>
                                    <p>このサイズまでは、持ち歩くのに便利な幕です。</p></li>
                            </ul>
                        </div>
                    </div>

                    <h5 class="ttl03">縦150cm</h5>
                    <div class="size_left">
                        <div class="size_img150"></div>
                        <div class="size_text">
                            <ul class="list_dot">
                                <li>
                                    <p>屋内、屋外ともインパクトのあるサイズです。</p></li>
                                <li>
                                    <p>広さのあるフェンスや2階以上の手すり等につけても、遠くからよく目立つ大きさです。</p></li>
                            </ul>
                        </div>
                    </div>

                    <h5 class="ttl03">縦180cm<span class="size_p">（※サテン生地は制作できません）</span></h5>
                    <div class="size_right">
                        <div class="size_img180"></div>
                        <div class="size_text">
                            <ul class="list_dot">
                                <li>
                                    <p>広い会場でも、迫力満点に目立つサイズです。</p></li>
                                <li>
                                    <p>掲げる場所のサイズ規定がないか、事前にご確認ください。</p></li>
                            </ul>
                        </div>
                    </div>


                    <div class="btn_three">
                        <div class="btn_return"><a href="{{url('/price')}}"><p>価格表に戻る</p></a></div>
                        <div class="btn_return"><a href="{{url('/material')}}"><p>素材について</p></a></div>
                        <div class="btn_return"><a href="{{url('/option')}}"><p>オプションについて</p></div>
                    </div>

                    <div class="btn"><a href="{{url('/search')}}"><img src="{{asset("assets/img/top/make_btn.png")}}" alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る"></a></div>

                </section>
            </div>
        </div>
    </main>
    <!-- /.l-main -->
@endsection
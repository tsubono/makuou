@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
@endpush

@section('title', '幕王について')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="concept">
                <h1 class="main__title"><img src="{{asset("assets/img/concept/title.png")}}" alt="幕王について"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url('/')}}">HOME</a></li>
                        <li>幕王について</li>
                    </ul>
                    <h4 class="ttl01">幕王について</h4>
                    <p class="txt">
                        幕王では、気軽に楽しくオリジナルの横断幕を作成できます。<br>
                        デザインテンプレートからお好みのデザインを選び、WEB上で簡単に編集、発注まで。<br>
                        「デザインが浮かばない」「欲しいけど頼み方が分からない」「試合に間に合わせたい」<br>
                        そんな時は幕王にお任せください。<br>
                        ご家族、ご友人の応援やイベントPRなど、様々な場面に対応できます。<br>
                        応援幕・横断幕の制作なら幕王で！
                    </p>
                </div>
            </section>
            <!-- /.search -->
            <section class="pickup">
                <h2 class="pickup__heading"><img src="{{asset("assets/img/search/heading--pickup.png")}}" alt="Pick Up!">
                </h2>
                <div class="pickup__content">
                    <div class="pickup__box">
                        <div>
                            <img src="{{asset("assets/img/banner/banner01.png")}}" alt="">
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
                            <img src="{{asset("assets/img/banner/banner01.png")}}" alt="">
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
                            <img src="{{asset("assets/img/banner/banner01.png")}}" alt="">
                            <dl class="pickup__info">
                                <dt>比率</dt>
                                <dd>1:1.5</dd>
                                <dt>サイズ</dt>
                                <dd>600</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="btn"><a href="{{url('/search')}}"><img src="{{asset("assets/img/top/make_btn.png")}}"
                                                  alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る"></a></div>
            </section>
            <!-- /.pickup -->
        </div>
    </main>
    <!-- /.l-main -->
@endsection
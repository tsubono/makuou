@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
@endpush

@section('title', 'ログイン')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="login">

                <h1 class="main__title"><img src="{{asset("assets/img/login/title.png")}}" alt="ログイン"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url('/')}}">HOME</a></li>
                        <li>ログイン</li>
                    </ul>
                    <h4 class="ttl01">ログイン</h4>
                    <div class="login__column cf">
                        <div class="login__box member">
                            <h2>会員ログイン</h2>
                            <div class="innar">
                                <form action="{{url('/login')}}" method="post">
                                    @csrf
                                    <dl>
                                        <dt>ID（メールアドレス）</dt>
                                        <dd><input type="text" name="email"></dd>
                                    </dl>
                                    <dl>
                                        <dt>パスワード</dt>
                                        <dd><input type="text" name="password"></dd>
                                    </dl>
                                    <p class="login_btn"><input type="submit" value="ログインする"></p>
                                </form>
                                <div class="cf forget_box">
                                    <p class="forget"><a href="#">パスワードを忘れた方はこちら</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="login__box first">
                            <h2>はじめての方</h2>
                            <div class="innar">
                                <p class="tec">当サイトからご注文・ご購入いただくには、<br>事前に無料会員登録が必要です。</p>
                                <p class="btn"><a href="{{url('/register')}}">新規会員登録はこちら</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.search -->
            <section class="pickup">
                <h2 class="pickup__heading"><img src="{{asset("assets/img/search/heading--pickup.png")}}" alt=""></h2>
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
                <div class="btn"><a href="#"><img src="{{asset("assets/img/top/make_btn.png")}}"
                                                  alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る"></a></div>
            </section>
            <!-- /.pickup -->
        </div>
    </main>
    <!-- /.l-main -->
@endsection
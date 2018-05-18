@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
@endpush

@section('title', 'お問い合わせ')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="contact">

                <h1 class="main__title"><img src="{{asset("assets/img/contact/title.png")}}" alt="お問い合わせ"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url('/')}}">HOME</a></li>
                        <li>お問い合わせ</li>
                    </ul>
                    <h4 class="ttl01">お問い合わせ</h4>
                    <p>下記フォームにお問い合わせ内容を記入の上、画面下部の「確認する」を押して、登録確認にお進みください。</p>

                    <form method="post" action="{{url('/contact')}}" class="form_template">
                        {{csrf_field()}}
                        <div class="form__bd">
                            <dl>
                                <dt><span>必須</span>お名前</dt>
                                <dd>
                                    <ul class="innerlist_name cf">
                                        <li><input type="text" name="" id="" placeholder=" 田中"/></li>
                                        <li><input type="text" name="" id="" placeholder=" 太郎"/></li>
                                    </ul>
                                </dd>
                            </dl>
                            <dl>
                                <dt><span>必須</span>おなまえ（ふりがな）</dt>
                                <dd>
                                    <ul class="innerlist_kana cf">
                                        <li><input type="text" name="" id="" placeholder=" タナカ"/></li>
                                        <li><input type="text" name="" id="" placeholder=" タロウ"/></li>
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
                                    <input type="textarea" name="" id=""/>
                                </dd>
                            </dl>
                        </div>
                        <ul class="sendarea type_css">
                            <li><input type="submit" name="submit" value="確認する" class="btn_css_check"/></li>
                        </ul>
                    </form>
                </div>
            </section>

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
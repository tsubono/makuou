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
                    @if($errors->has('exception'))
                        <div>
                            <span class="error">{{$errors->first('exception')}}</span>
                        </div>
                    @endif
                    <form method="post" action="{{url('/contact/confirm')}}" class="form_template">
                        {{csrf_field()}}
                        <div class="form__bd">
                            <dl>
                                <dt><span>必須</span>お名前</dt>
                                <dd>
                                    <input type="text" name="name" id="" value="{{old('name')}}"
                                           placeholder=" 田中太郎"/>
                                    @if($errors->has('name'))
                                        <div>
                                            <span class="error">{{$errors->first('name')}}</span>
                                        </div>
                                    @endif
                                </dd>
                            </dl>
                            <dl>
                                <dt><span>必須</span>おなまえ（フリガナ）</dt>
                                <dd>
                                    <input type="text" name="nameKana" id="" value="{{old('nameKana')}}"
                                           placeholder=" タナカタロウ"/></li>
                                    @if($errors->has('nameKana'))
                                        <div>
                                            <span class="error">{{$errors->first('nameKana')}}</span>
                                        </div>
                                    @endif
                                </dd>
                            </dl>
                            <dl>
                                <dt><span>必須</span>メールアドレス</dt>
                                <dd>
                                    <input type="text" name="email" id="" value="{{old('email')}}"
                                           placeholder="例：tanaka@jp">
                                    @if($errors->has('email'))
                                        <div>
                                            <span class="error">{{$errors->first('email')}}</span>
                                        </div>
                                    @endif
                                </dd>
                            </dl>
                            <dl>
                                <dt><span>必須</span>お問い合わせ内容</dt>
                                <dd>
                                    <input type="textarea" name="content" id="" value="{{old('content')}}"/>
                                    @if($errors->has('content'))
                                        <div>
                                            <span class="error">{{$errors->first('content')}}</span>
                                        </div>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <ul class="sendarea type_css">
                            <li><input type="submit" name="submit" value="確認する" class="btn_css_check"></li>
                        </ul>
                    </form>
                </div>
            </section>

            <section class="pickup">
                <h2 class="pickup__heading"><img src="{{asset("assets/img/search/heading--pickup.png")}}"
                                                 alt="Pick Up!"></h2>
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
{{\Illuminate\Support\Facades\Session::flash('status','contact')}}
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
                    <p>下記フォームにお問い合わせ内容を記入の上、画面下部の「送信する」を押して、お問い合わせを送信してください。</p>

                    <form method="post" action="{{url('/contact')}}" class="form_template">
                        {{csrf_field()}}
                        <div class="form__bd">
                            <dl>
                                <dt><span>必須</span>お名前</dt>
                                <dd>
                                    {{$data['name']}}
                                    <input type="hidden" name="name" value="{{$data['name']}}"/>
                                </dd>
                            </dl>
                            <dl>
                                <dt><span>必須</span>おなまえ（ふりがな）</dt>
                                <dd>
                                    {{$data['nameKana']}}
                                    <input type="hidden" name="nameKana" value="{{$data['nameKana']}}"/>
                                </dd>
                            </dl>
                            <dl>
                                <dt><span>必須</span>メールアドレス</dt>
                                <dd>
                                    {{$data['email']}}
                                    <input type="hidden" name="email" value="{{$data['email']}}"/>
                                </dd>
                            </dl>
                            <dl>
                                <dt><span>必須</span>お問い合わせ内容</dt>
                                <dd>
                                    {{$data['content']}}
                                    <input type="hidden" name="content" value="{{$data['content']}}"/>
                                </dd>
                            </dl>
                        </div>
                        <div class="confirm_sendarea type_css">
                            <div class="confirm_wrapper">
                                <button name="submit" value="0" class="back_btn">前に戻る</button>
                                <button name="submit" value="1" class="btn_css_check">送信する</button>
                            </div>
                        </div>
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
@extends('front.layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
@endpush

@section('title', '会員登録')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="regist">

                <h1 class="main__title"><img src="{{asset("assets/img/register/title.png")}}" alt="会員登録"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url('/')}}">HOME</a></li>
                        <li>会員登録</li>
                    </ul>
                    <h4 class="ttl01">会員登録</h4>
                    <p>新規に会員を登録します。<br>
                        下記フォームに登録内容を記入の上、画面下部の「確認する」を押して、登録確認にお進みください。</p>
                    <form method="post" action="{{'/register'}}" class="form_template">
                        @csrf
                        <div class="form__bd">
                            <dl>
                                <dt><span>必須</span>お名前</dt>
                                <dd>
                                    <ul class="innerlist_name cf">
                                        <li><input type="text" name="lastName" value="{{old('lastName')}}" id=""
                                                   placeholder=" 田中"/></li>
                                        <li><input type="text" name="firstName" value="{{old('firstName')}}" id=""
                                                   placeholder=" 太郎"/></li>
                                    </ul>
                                </dd>
                            </dl>
                            <dl>
                                <dt><span>必須</span>おなまえ（ふりがな）</dt>
                                <dd>
                                    <ul class="innerlist_kana cf">
                                        <li><input type="text" name="lastNameKana" value="{{old('lastNameKana')}}" id=""
                                                   placeholder=" タナカ"/></li>
                                        <li><input type="text" name="firstNameKana" value="{{old('firstNameKana')}}"
                                                   id=""
                                                   placeholder=" タロウ"/></li>
                                    </ul>
                                </dd>
                            </dl>
                            <dl>
                                <dt><span>必須</span>メールアドレス</dt>
                                <dd>
                                    <input type="text" name="email" value="{{old('email')}}" id=""
                                           placeholder="例：tanaka@jp">
                                </dd>
                            </dl>
                            <dl>
                                <dt>携帯電話番号</dt>
                                <dd>
                                    <ul class="innerlist_tel">
                                        <li><input type="text" name="telOne" value="{{old('mobileOne')}}" id=""/>&emsp;-&emsp;<input
                                                    type="text" name="telTwo"
                                                    value="{{old('mobileTwo')}}" id=""/>&emsp;-&emsp;<input
                                                    type="text" name="telThree" value="{{old('mobileThree')}}" id=""/></li>
                                    </ul>
                                </dd>
                            </dl>
                            <dl>
                                <dt>自宅電話番号</dt>
                                <dd>
                                    <ul class="innerlist_tel">
                                        <li><input type="text" name="mobileOne" value="{{old('telOne')}}" id=""/>&emsp;-&emsp;<input
                                                    type="text" name="mobileTwo"
                                                    value="{{old('telTwo')}}" id=""/>&emsp;-&emsp;<input
                                                    type="text" name="mobileThree" value="{{old('telThree')}}"
                                                    id=""/>
                                        </li>
                                    </ul>
                                </dd>
                            </dl>
                            <dl class="address_num">
                                <dt><span>必須</span>郵便番号</dt>
                                <dd><input type="text" name="zipCodeOne" value="{{old('zipCodeOne')}}" id=""/>&emsp;-&emsp;<input
                                            type="text" name="zipCodeTwo"
                                            value="{{old('zipCodeTwo')}}" id=""/>
                                </dd>
                            </dl>
                            <dl class="innerlist_address add02">
                                <dt><span>必須</span>都道府県</dt>
                                <dd><select name="prefecture" id="address1">
                                        @foreach(config('pref') as $name)
                                            <option value="{{ $name }}"
                                                    @if(old('prefecture') == $name) selected @endif>{{$name}}
                                            </option>
                                        @endforeach
                                        <option value="日本国外">日本国外</option>
                                    </select></dd>
                            </dl>
                            <dl>
                                <dt><span>必須</span>住所1（市町村名・番地）</dt>
                                <dd>
                                    <input type="text" name="addressOne" value="{{old('addressOne')}}" id=""/>
                                </dd>
                            </dl>
                            <dl>
                                <dt>住所2（建物名・マンション名）</dt>
                                <dd>
                                    <input type="text" name="addressTwo" value="{{old('addressTwo')}}" id=""/>
                                </dd>
                            </dl>
                            <dl>
                                <dt><span>必須</span>パスワード</dt>
                                <dd>
                                    <input type="text" name="password" id=""/>
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
                <h2 class="pickup__heading"><img src="{{asset("assets/img/search/heading--pickup.png")}}" alt="Pick Up!"></h2>
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
                <div class="btn"><a href="{{url('/search')}}"><img src="{{asset("assets/img/top/make_btn.png")}}" alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る"></a></div>
            </section>
            <!-- /.pickup -->
        </div>
    </main>
    <!-- /.l-main -->
@endsection
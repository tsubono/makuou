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
                                        <li><input type="text" name="telOne" value="{{old('telOne')}}" id=""/>&emsp;-&emsp;<input
                                                    type="text" name="telTwo"
                                                    value="{{old('telTwo')}}" id=""/>&emsp;-&emsp;<input
                                                    type="text" name="telThree" value="{{old('telThree')}}" id=""/></li>
                                    </ul>
                                </dd>
                            </dl>
                            <dl>
                                <dt>自宅電話番号</dt>
                                <dd>
                                    <ul class="innerlist_tel">
                                        <li><input type="text" name="mobileOne" value="{{old('mobileOne')}}" id=""/>&emsp;-&emsp;<input
                                                    type="text" name="mobileTwo"
                                                    value="{{old('mobileTwo')}}" id=""/>&emsp;-&emsp;<input
                                                    type="text" name="mobileThree" value="{{old('mobileThree')}}"
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
                                        <option value="none" selected="selected">選択して下さい</option>
                                        <option value="北海道" @if(old('prefecture')=="1") selected @endif>北海道</option>
                                        <option value="青森県" @if(old('prefecture')=="青森県") selected @endif>青森県</option>
                                        <option value="岩手県" @if(old('prefecture')=="岩手県") selected @endif>岩手県</option>
                                        <option value="宮城県" @if(old('prefecture')=="宮城県") selected @endif>宮城県</option>
                                        <option value="秋田県" @if(old('prefecture')=="秋田県") selected @endif>秋田県</option>
                                        <option value="山形県" @if(old('prefecture')=="山形県") selected @endif>山形県</option>
                                        <option value="福島県" @if(old('prefecture')=="福島県") selected @endif>福島県</option>
                                        <option value="茨城県" @if(old('prefecture')=="茨城県") selected @endif>茨城県</option>
                                        <option value="栃木県" @if(old('prefecture')=="栃木県") selected @endif>栃木県</option>
                                        <option value="群馬県" @if(old('prefecture')=="群馬県") selected @endif>群馬県</option>
                                        <option value="埼玉県" @if(old('prefecture')=="埼玉県") selected @endif>埼玉県</option>
                                        <option value="千葉県" @if(old('prefecture')=="千葉県") selected @endif>千葉県</option>
                                        <option value="東京都" @if(old('prefecture')=="東京都") selected @endif>東京都</option>
                                        <option value="神奈川県" @if(old('prefecture')=="神奈川県") selected @endif>神奈川県
                                        </option>
                                        <option value="新潟県" @if(old('prefecture')=="新潟県") selected @endif>新潟県</option>
                                        <option value="富山県" @if(old('prefecture')=="富山県") selected @endif>富山県</option>
                                        <option value="石川県" @if(old('prefecture')=="石川県") selected @endif>石川県</option>
                                        <option value="福井県" @if(old('prefecture')=="福井県") selected @endif>福井県</option>
                                        <option value="山梨県" @if(old('prefecture')=="山梨県") selected @endif>山梨県</option>
                                        <option value="長野県" @if(old('prefecture')=="長野県") selected @endif>長野県</option>
                                        <option value="岐阜県" @if(old('prefecture')=="岐阜県") selected @endif>岐阜県</option>
                                        <option value="静岡県" @if(old('prefecture')=="静岡県") selected @endif>静岡県</option>
                                        <option value="愛知県" @if(old('prefecture')=="愛知県") selected @endif>愛知県</option>
                                        <option value="三重県" @if(old('prefecture')=="三重県") selected @endif>三重県</option>
                                        <option value="滋賀県" @if(old('prefecture')=="滋賀県") selected @endif>滋賀県</option>
                                        <option value="京都府" @if(old('prefecture')=="京都府") selected @endif>京都府</option>
                                        <option value="大阪府" @if(old('prefecture')=="大阪府") selected @endif>大阪府</option>
                                        <option value="兵庫県" @if(old('prefecture')=="兵庫県") selected @endif>兵庫県</option>
                                        <option value="奈良県" @if(old('prefecture')=="奈良県") selected @endif>奈良県</option>
                                        <option value="和歌山県" @if(old('prefecture')=="和歌山県") selected @endif>和歌山県
                                        </option>
                                        <option value="鳥取県" @if(old('prefecture')=="鳥取県") selected @endif>鳥取県</option>
                                        <option value="島根県" @if(old('prefecture')=="島根県") selected @endif>島根県</option>
                                        <option value="岡山県" @if(old('prefecture')=="岡山県") selected @endif>岡山県</option>
                                        <option value="広島県" @if(old('prefecture')=="広島県") selected @endif>広島県</option>
                                        <option value="山口県" @if(old('prefecture')=="山口県") selected @endif>山口県</option>
                                        <option value="徳島県" @if(old('prefecture')=="徳島県") selected @endif>徳島県</option>
                                        <option value="香川県" @if(old('prefecture')=="香川県") selected @endif>香川県</option>
                                        <option value="愛媛県" @if(old('prefecture')=="愛媛県") selected @endif>愛媛県</option>
                                        <option value="高知県" @if(old('prefecture')=="高知県") selected @endif>高知県</option>
                                        <option value="福岡県" @if(old('prefecture')=="福岡県") selected @endif>福岡県</option>
                                        <option value="佐賀県" @if(old('prefecture')=="佐賀県") selected @endif>佐賀県</option>
                                        <option value="長崎県" @if(old('prefecture')=="長崎県") selected @endif>長崎県</option>
                                        <option value="熊本県" @if(old('prefecture')=="熊本県") selected @endif>熊本県</option>
                                        <option value="大分県" @if(old('prefecture')=="大分県") selected @endif>大分県</option>
                                        <option value="宮崎県" @if(old('prefecture')=="宮崎県") selected @endif>宮崎県</option>
                                        <option value="鹿児島県" @if(old('prefecture')=="鹿児島県") selected @endif>鹿児島県
                                        </option>
                                        <option value="沖縄県" @if(old('prefecture')=="沖縄県") selected @endif>沖縄県</option>
                                        <option value="日本国外" @if(old('prefecture')=="日本国外") selected @endif>日本国外
                                        </option>
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
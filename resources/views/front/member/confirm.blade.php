{{\Illuminate\Support\Facades\Session::flash('status','sample')}}
@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
@endpush

@section('title', '登録情報の確認編集')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="member">

                <h1 class="main__title"><img src="{{asset("assets/img/member/title.png")}}" alt="会員登録"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url('/')}}">HOME</a></li>
                        <li><a href="{{url('/mypage')}}/">マイページ</a></li>
                        <li>登録情報の確認編集</li>
                    </ul>
                    <div class="main__block_lr">
                        <div class="main__block_r">
                            <h4 class="ttl01 mt25">登録情報の確認編集</h4>

                            <form method="post" action="{{url('/member')}}" class="form_template">
                                @csrf
                                <input type="hidden" name="member.confirm.token" value="{{$token}}">
                                <div class="form__bd">
                                    <dl>
                                        <dt><span>必須</span>お名前</dt>
                                        <dd>
                                            {{$data['name']}}
                                            <input type="hidden" name="name" value="{{$data['name']}}"/>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><span>必須</span>おなまえ（フリガナ）</dt>
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
                                        <dt>携帯電話番号</dt>
                                        <dd>
                                            <ul class="innerlist_tel">
                                                <li>
                                                    @if(preg_replace("/( |　)/", "", $data['mobileOne']) !== '' &&
                                                    preg_replace("/( |　)/", "", $data['mobileTwo']) !== '' &&
                                                    preg_replace("/( |　)/", "", $data['mobileThree']) !== '')
                                                    {{$data['mobileOne']}}&emsp;-&emsp;
                                                    {{$data['mobileTwo']}}&emsp;-&emsp;
                                                    {{$data['mobileThree']}}
                                                    @else
                                                        記入なし
                                                    @endif
                                                    <input type="hidden" name="mobileOne" value="{{$data['mobileOne']}}"/>
                                                    <input type="hidden" name="mobileTwo" value="{{$data['mobileTwo']}}"/>
                                                    <input type="hidden" name="mobileThree" value="{{$data['mobileThree']}}"/>
                                                </li>
                                            </ul>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>自宅電話番号</dt>
                                        <dd>
                                            <ul class="innerlist_tel">
                                                <li>
                                                    @if(preg_replace("/( |　)/", "", $data['telOne']) !== '' &&
                                                   preg_replace("/( |　)/", "", $data['telTwo']) !== '' &&
                                                   preg_replace("/( |　)/", "", $data['telThree']) !== '')
                                                    {{$data['telOne']}}&emsp;-&emsp;
                                                    {{$data['telTwo']}}&emsp;-&emsp;
                                                    {{$data['telThree']}}
                                                    @else
                                                        記入なし
                                                    @endif
                                                    <input type="hidden" name="telOne" value="{{$data['telOne']}}"/>
                                                    <input type="hidden" name="telTwo" value="{{$data['telTwo']}}"/>
                                                    <input type="hidden" name="telThree" value="{{$data['telThree']}}"/>
                                                </li>
                                            </ul>
                                        </dd>
                                    </dl>
                                    <dl class="address_num">
                                        <dt><span>必須</span>郵便番号</dt>
                                        <dd>
                                            {{$data['zipCodeOne']}}&emsp;-&emsp;
                                            {{$data['zipCodeTwo']}}
                                            <input type="hidden" name="zipCodeOne" value="{{$data['zipCodeOne']}}"/>
                                            <input type="hidden" name="zipCodeTwo" value="{{$data['zipCodeTwo']}}"/>
                                        </dd>
                                    </dl>
                                    <dl class="innerlist_address add02">
                                        <dt><span>必須</span>都道府県</dt>
                                        <dd>
                                            {{config('pref')[$data['prefecture']]}}
                                            <input type="hidden" name="prefecture" value="{{$data['prefecture']}}"/>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><span>必須</span>住所1（市町村名・番地）</dt>
                                        <dd>
                                            {{$data['addressOne']}}
                                            <input type="hidden" name="addressOne" value="{{$data['addressOne']}}"/>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>住所2（建物名・マンション名）</dt>
                                        <dd>
                                            @if(preg_replace("/( |　)/", "", $data['addressTwo']) !== '')
                                                {{$data['addressTwo']}}
                                            @else
                                                記入なし
                                            @endif
                                            <input type="hidden" name="addressTwo" value="{{$data['addressTwo']}}"/>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><span>必須</span>パスワード</dt>
                                        <dd>
                                            (入力されたパスワード)
                                            <input type="hidden" name="password" id="" value="{{$data['password']}}"/>
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
                        <div class="main__block_l">
                            @include('front.components.mypageside')
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- /.l-main -->
@endsection
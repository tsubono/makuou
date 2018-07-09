@extends('front.layouts.default')

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

                            <form method="post" action="{{url('/member/confirm')}}" class="form_template">
                                @csrf
                                <input type="hidden" name="member.token" value="{{$token}}">
                                <div class="form__bd">
                                    <dl>
                                        <dt><span>必須</span>お名前</dt>
                                        <dd>
                                            <ul class="innerlist_name cf">
                                                <input type="text" name="name" value="{{old('name',$user->name)}}"
                                                       id=""
                                                       placeholder=" 田中太郎"/>
                                                @if($errors->has('name'))
                                                    <div>
                                                        <span class="error">{{$errors->first('name')}}</span>
                                                    </div>
                                                @endif
                                            </ul>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><span>必須</span>おなまえ（フリガナ）</dt>
                                        <dd>
                                            <ul class="innerlist_kana cf">
                                                <input type="text" name="nameKana"
                                                       value="{{old('nameKana',$user->name_kana)}}" id=""
                                                       placeholder=" タナカタロウ"/>
                                                @if($errors->has('nameKana'))
                                                    <div>
                                                        <span class="error">{{$errors->first('nameKana')}}</span>
                                                    </div>
                                                @endif
                                            </ul>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><span>必須</span>メールアドレス</dt>
                                        <dd>
                                            <input type="text" name="email" value="{{old('email',$user->email)}}" id=""
                                                   placeholder="例：tanaka@jp">
                                            @if($errors->has('email'))
                                                <div>
                                                    <span class="error">{{$errors->first('email')}}</span>
                                                </div>
                                            @endif
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>携帯電話番号</dt>
                                        <dd>
                                            <ul class="innerlist_tel">
                                                <li><input type="text" name="mobileOne" value="@php
                                                        if($user->tel){
                                                            echo old('mobileOne',explode('-',$user->tel)[0]);
                                                        }else{
                                                            echo old('mobileOne');
                                                        }
                                                    @endphp" id=""/>&emsp;-&emsp;
                                                    <input type="text" name="mobileTwo" value="@php
                                                        if($user->tel){
                                                            echo old('mobileTwo',explode('-',$user->tel)[1]);
                                                        }else{
                                                            echo old('mobileTwo');
                                                        }
                                                    @endphp" id=""/>&emsp;-&emsp;
                                                    <input type="text" name="mobileThree" value="@php
                                                        if($user->tel){
                                                            echo old('mobileThree',explode('-',$user->tel)[2]);
                                                        }else{
                                                            echo old('mobileThree');
                                                        }
                                                    @endphp" id=""/>
                                                </li>
                                            </ul>
                                            @if($errors->has('mobile'))
                                                <div>
                                                    <span class="error">{{$errors->first('mobile')}}</span>
                                                </div>
                                            @endif
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>自宅電話番号</dt>
                                        <dd>
                                            <ul class="innerlist_tel">
                                                <li><input type="text" name="telOne"
                                                           value="@php
                                                               if($user->fax){
                                                                    echo old('telOne',explode('-',$user->fax)[0]);
                                                               }else{
                                                                    echo old('telOne');
                                                               }
                                                           @endphp" id=""/>&emsp;-&emsp;
                                                    <input type="text" name="telTwo"
                                                           value="@php
                                                               if($user->fax){
                                                                   echo old('telTwo',explode('-',$user->fax)[1]);
                                                               }else{
                                                                   echo old('telTwo');
                                                               }
                                                           @endphp" id=""/>&emsp;-&emsp;
                                                    <input type="text" name="telThree"
                                                           value="@php
                                                               if($user->fax){
                                                                   echo old('telThree',explode('-',$user->fax)[2]);
                                                               }else{
                                                                  echo old('telThree');
                                                               }
                                                           @endphp" id=""/>
                                                </li>
                                            </ul>
                                            @if($errors->has('tel'))
                                                <div>
                                                    <span class="error">{{$errors->first('tel')}}</span>
                                                </div>
                                            @endif
                                        </dd>
                                    </dl>
                                    <dl class="address_num">
                                        <dt><span>必須</span>郵便番号</dt>
                                        <dd>
                                            <input type="text" name="zipCodeOne"
                                                   value="{{old('zipCodeOne',explode('-',$user->zip_code)[0])}}" id=""/>&emsp;-&emsp;<input
                                                    type="text" name="zipCodeTwo"
                                                    value="{{old('zipCodeTwo',explode('-',$user->zip_code)[1])}}"
                                                    id=""/>
                                            @if($errors->has('zipCodeOne'))
                                                <div>
                                                    <span class="error">{{$errors->first('zipCodeOne')}}</span>
                                                </div>
                                            @elseif($errors->has('zipCodeTwo'))
                                                <div>
                                                    <span class="error">{{$errors->first('zipCodeTwo')}}</span>
                                                </div>
                                            @endif
                                            <button type="button" id="zip-btn">郵便番号から自動入力</button>

                                        </dd>
                                    </dl>
                                    <dl class="innerlist_address add02">
                                        <dt><span>必須</span>都道府県</dt>
                                        <dd>
                                            <select name="prefecture" id="address1">
                                                <option value="none" selected="selected">選択して下さい</option>
                                                @foreach(config('pref') as $index => $name)
                                                    <option value="{{ $index }}"
                                                            @if(old('prefecture',$user->pref_id) == $index) selected @endif>{{$name}}
                                                    </option>
                                                @endforeach
                                                <option value="48"
                                                        @if(old('prefecture',$user->pref_id) == 48) selected @endif>日本国外
                                                </option>
                                            </select>
                                            @if($errors->has('prefecture'))
                                                <div>
                                                    <span class="error">{{$errors->first('prefecture')}}</span>
                                                </div>
                                            @endif
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><span>必須</span>住所1（市町村名・番地）</dt>
                                        <dd>
                                            <input type="text" name="addressOne"
                                                   value="{{old('addressOne',$user->address1)}}" id=""/>
                                            @if($errors->has('addressOne'))
                                                <div>
                                                    <span class="error">{{$errors->first('addressOne')}}</span>
                                                </div>
                                            @endif
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>住所2（建物名・マンション名）</dt>
                                        <dd>
                                            <input type="text" name="addressTwo"
                                                   value="{{old('addressTwo',$user->address2)}}" id=""/>
                                            @if($errors->has('addressTwo'))
                                                <div>
                                                    <span class="error">{{$errors->first('addressTwo')}}</span>
                                                </div>
                                            @endif
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt><span>必須</span>パスワード</dt>
                                        <dd>
                                            <input type="text" name="password" id=""/>
                                            @if($errors->has('password'))
                                                <div>
                                                    <span class="error">{{$errors->first('password')}}</span>
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
                        <div class="main__block_l">
                            @include('front.components.mypageside')
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <script>
        window.onload = function () {
            $('#zip-btn').click(function () {
                AjaxZip3.zip2addr('zipCodeOne', 'zipCodeTwo', 'prefecture', 'addressOne');
            });
        }
    </script>
    <!-- /.l-main -->
@endsection
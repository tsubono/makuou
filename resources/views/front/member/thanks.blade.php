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
            <section class="member">

                <h1 class="main__title"><img src="{{asset("assets/img/member/title.png")}}" alt="会員登録"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url("/")}}">HOME</a></li>
                        <li><a href="{{url("/mypage")}}">マイページ</a></li>
                        <li><a href="{{url("/member")}}">登録情報の確認編集</a></li>
                        <li>完了画面</li>
                    </ul>
                    <div class="main__block_lr">
                        <div class="main__block_r">
                            <h4 class="ttl01 mt25">登録情報の確認編集</h4>
                            <div class="thanks__info cf">
                                <div class="pho"><img src="{{asset("assets/img/common/makuou.png")}}" alt=""></div>
                                <div class="txt">
                                    <h2>登録情報を変更しました。</h2>
                                    <p class="btn"><a href="{{url("/")}}">トップへもどる</a></p>
                                </div>
                            </div>
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
@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
@endpush

@section('title', '注文履歴')

@section('content')

    <main class="l-main">
        <div class="l-inner">
            <section class="ordered">

                <h1 class="main__title"><img src="{{asset("assets/img/ordered/title.png")}}" alt="お気に入りテンプレート"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url("/")}}">HOME</a></li>
                        <li><a href="{{url("mypage")}}">マイページ</a></li>
                        <li>注文履歴</li>
                    </ul>
                    <div class="main__block_lr">
                        <div class="main__block_r">
                            <h4 class="ttl01 mt25 mb30">注文履歴</h4>

                            <div class="ordered_box">
                                <div class="ordered_box__top">
                                    <div class="ordered_box__side">
                                        <h5 class="result__title mt0">デザイン名が入ります</h5>
                                        <p>受注日：2018年 6月25日</p>
                                        <p>発送日：2018年 7月10日</p>
                                    </div>
                                    <div class="ordered_box__reorder">
                                        <a href="#dummy"><img src="{{asset("assets/img/ordered/reorder_btn.png")}}" alt=""></a>
                                    </div>
                                </div>
                                <div class="ordered_box__bottom">
                                    <ul>
                                        <li><a href="#dummy">ご請求書</a></li>
                                        <li><a href="#dummy">お見積書</a></li>
                                        <li><a href="#dummy">領収書</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="ordered_box">
                                <div class="ordered_box__top">
                                    <div class="ordered_box__side">
                                        <h5 class="result__title mt0">デザイン名が入ります</h5>
                                        <p>受注日：2018年 6月25日</p>
                                        <p>発送日：2018年 7月10日</p>
                                    </div>
                                    <div class="ordered_box__reorder">
                                        <a href="#dummy"><img src="{{asset("assets/img/ordered/reorder_btn.png")}}" alt=""></a>
                                    </div>
                                </div>
                                <div class="ordered_box__bottom">
                                    <ul>
                                        <li><a href="#dummy">ご請求書</a></li>
                                        <li><a href="#dummy">お見積書</a></li>
                                        <li><a href="#dummy">領収書</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="ordered_box">
                                <div class="ordered_box__top">
                                    <div class="ordered_box__side">
                                        <h5 class="result__title mt0">デザイン名が入ります</h5>
                                        <p>受注日：2018年 6月25日</p>
                                        <p>発送日：2018年 7月10日</p>
                                    </div>
                                    <div class="ordered_box__reorder">
                                        <a href="#dummy"><img src="{{asset("assets/img/ordered/reorder_btn.png")}}" alt=""></a>
                                    </div>
                                </div>
                                <div class="ordered_box__bottom">
                                    <ul>
                                        <li><a href="#dummy">ご請求書</a></li>
                                        <li><a href="#dummy">お見積書</a></li>
                                        <li><a href="#dummy">領収書</a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="main__block_l">
                            @include('front.components.mypageside')
                        </div>
                    </div>
                    <!-- /.main__block_lr -->
                </div>
            </section>


        </div>
    </main>
    <!-- /.l-main -->

@endsection
@extends('front.layouts.default')

@section('title', '幕王')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <style>
        .errorMsg {
            text-align: center;
            font-size: 25px;
        }
    </style>
@endpush

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="layout confirm">
                <h1 class="main__title">
                </h1>
                <div class="main__content">
                    <section>
                        <div>
                            <div>
                                <p class="errorMsg">ページを閲覧する権限がありません。</p>
                            </div>
                        </div>
                    </section>
                    <section class="pickup">
                        <h2 class="pickup__heading">
                            <picture>
                                <img src="{{asset("assets/img/search/heading--pickup.png")}}"
                                     srcset="{{asset("assets/img/search/heading--pickup@2x.png")}} 2x" alt="Pick Up!">
                            </picture>
                        </h2>
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
                    </section>
                </div>
            </section>
        </div>
    </main>
@endsection


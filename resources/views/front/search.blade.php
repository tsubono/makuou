@extends('front/layouts.default')

@section('title', '横断幕を作る')

@section('content')
<main class="l-main">
    <div class="l-inner">
        <h1 class="main__title">
            <picture>
                <img src="{{asset("assets/img/search/title.png")}}" srcset="{{asset("assets/img/search/title@2x.png")}} 2x" alt="横断幕を作る">
            </picture>
        </h1>
        <div class="main__content">
            <ul class="main__breadcrumb">
                <li><a href="{{url('/')}}">HOME</a></li>
                <li>横断幕を作る</li>
            </ul>
            @include('front/search_form')
            <!-- /.search -->
            <section class="pickup">
                <h2 class="pickup__heading">
                    <picture>
                        <img src="{{asset("assets/img/search/heading--pickup.png")}}" srcset="{{asset("assets/img/search/heading--pickup@2x.png")}} 2x" alt="Pick Up!">
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
            <!-- /.pickup -->
        </div>
    </div>
</main>
<!-- /.l-main -->
@endsection
@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
@endpush

@section('title', '検索結果')

@section('content')
<main class="l-main">
    <div class="l-inner">
        <h1 class="main__title">
            <picture>
                <img src="{{asset("assets/img/search/result/title.png")}}" srcset="{{asset("assets/img/search/result/title@2x.png")}} 2x" alt="横断幕を作る">
            </picture>
        </h1>
        <div class="main__content">
            <ul class="main__breadcrumb">
                <li><a href="{{url('/')}}">HOME</a></li>
                <li><a href="{{url('search')}}">横断幕を作る</a></li>
                <li>検索結果</li>
            </ul>
            <div class="result">
                <div class="result__box">
                    <div>
                        <h2 class="result__title">タイトルが入ります</h2>
                        <img class="result__img" src="{{asset("assets/img/banner/banner01.png")}}" alt="">
                        <dl class="result__list">
                            <dt>スポーツ</dt>
                            <dd>
                                <ul class="result__tags">
                                    <li><a href="">2.野球・ソフトボール</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="result__list">
                            <dt>テイスト</dt>
                            <dd>
                                <ul class="result__tags">
                                    <li><a href="">2.熱血</a></li>
                                    <li><a href="">3.スポーティー</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="result__list">
                            <dt>シーン</dt>
                            <dd>
                                <ul class="result__tags">
                                    <li><a href="">1.スポーツ応援</a></li>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                </div>
                <!-- .result__box -->
                <div class="result__box">
                    <div>
                        <h2 class="result__title">タイトルが入ります</h2>
                        <img class="result__img" src="{{asset("assets/img/banner/banner02.png")}}" alt="">
                        <dl class="result__list">
                            <dt>テイスト</dt>
                            <dd>
                                <ul class="result__tags">
                                    <li>
                                        <a href="">2.熱血</a>
                                    </li>
                                    <li>
                                        <a href="">5.インパクト</a>
                                    </li>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="result__list">
                            <dt>シーン</dt>
                            <dd>
                                <ul class="result__tags">
                                    <li>
                                        <a href="">3.学校行事</a>
                                    </li>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                </div>
                <!-- .result__box -->
                <div class="result__box">
                    <div>
                        <h2 class="result__title">タイトルが入ります</h2>
                        <img class="result__img" src="{{asset("assets/img/banner/banner03.png")}}" alt="">
                        <dl class="result__list">
                            <dt>スポーツ</dt>
                            <dd>
                                <ul class="result__tags">
                                    <li><a href="">1.サッカー・フットサル</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="result__list">
                            <dt>テイスト</dt>
                            <dd>
                                <ul class="result__tags">
                                    <li><a href="">2.熱血</a></li>
                                    <li><a href="">3.スポーティー</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="result__list">
                            <dt>シーン</dt>
                            <dd>
                                <ul class="result__tags">
                                    <li><a href="">1.スポーツ応援</a></li>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                </div>
                <!-- .result__box -->
                <div class="result__box">
                    <div>
                        <h2 class="result__title">タイトルが入ります</h2>
                        <img class="result__img" src="{{asset("assets/img/banner/banner01.png")}}" alt="">
                        <dl class="result__list">
                            <dt>スポーツ</dt>
                            <dd>
                                <ul class="result__tags">
                                    <li><a href="">2.野球・ソフトボール</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="result__list">
                            <dt>テイスト</dt>
                            <dd>
                                <ul class="result__tags">
                                    <li><a href="">2.熱血</a></li>
                                    <li><a href="">3.スポーティー</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="result__list">
                            <dt>シーン</dt>
                            <dd>
                                <ul class="result__tags">
                                    <li><a href="">1.スポーツ応援</a></li>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                </div>
                <!-- .result__box -->
                <div class="result__box">
                    <div>
                        <h2 class="result__title">タイトルが入ります</h2>
                        <img class="result__img" src="{{asset("assets/img/banner/banner02.png")}}" alt="">
                        <dl class="result__list">
                            <dt>テイスト</dt>
                            <dd>
                                <ul class="result__tags">
                                    <li>
                                        <a href="">2.熱血</a>
                                    </li>
                                    <li>
                                        <a href="">5.インパクト</a>
                                    </li>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="result__list">
                            <dt>シーン</dt>
                            <dd>
                                <ul class="result__tags">
                                    <li>
                                        <a href="">3.学校行事</a>
                                    </li>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                </div>
                <!-- .result__box -->
                <div class="result__box">
                    <div>
                        <h2 class="result__title">タイトルが入ります</h2>
                        <img class="result__img" src="{{asset("assets/img/banner/banner03.png")}}" alt="">
                        <dl class="result__list">
                            <dt>スポーツ</dt>
                            <dd>
                                <ul class="result__tags">
                                    <li><a href="">1.サッカー・フットサル</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="result__list">
                            <dt>テイスト</dt>
                            <dd>
                                <ul class="result__tags">
                                    <li><a href="">2.熱血</a></li>
                                    <li><a href="">3.スポーティー</a></li>
                                </ul>
                            </dd>
                        </dl>
                        <dl class="result__list">
                            <dt>シーン</dt>
                            <dd>
                                <ul class="result__tags">
                                    <li><a href="">1.スポーツ応援</a></li>
                                </ul>
                            </dd>
                        </dl>
                    </div>
                </div>
                <!-- .result__box -->
            </div>
            @include('front.components.search_form')
        </div>
    </div>
</main>
<!-- /.l-main -->
@endsection
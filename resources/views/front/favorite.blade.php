@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
@endpush

@section('title', 'お気に入りテンプレート')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="favorite">

                <h1 class="main__title"><img src="{{asset("assets/img/favorite/title.png")}}" alt="お気に入りテンプレート"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="/">HOME</a></li>
                        <li><a href="{{ url('/mypage') }}">マイページ</a></li>
                        <li>お気に入りテンプレート</li>
                    </ul>
                    <div class="main__block_lr">
                        <div class="main__block_r">
                            <h4 class="ttl01 mt25">お気に入りテンプレート</h4>

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
                                    <div class="result__fav del">
                                        <a href="#dummy">
                                            <img src="{{asset("assets/img/common/ico_fav.png")}}"
                                                    alt="">お気に入りから削除する
                                        </a>
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
                                    <div class="result__fav del">
                                        <a href="#dummy">
                                            <img src="{{asset("assets/img/common/ico_fav.png")}}"
                                                 alt="">お気に入りから削除する
                                        </a>
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
                                    <div class="result__fav del">
                                        <a href="#dummy">
                                            <img src="{{asset("assets/img/common/ico_fav.png")}}"
                                                 alt="">お気に入りから削除する
                                        </a>
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
                                    <div class="result__fav del">
                                        <a href="#dummy">
                                            <img src="{{asset("assets/img/common/ico_fav.png")}}"
                                                 alt="">お気に入りから削除する
                                        </a>
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
                                    <div class="result__fav del">
                                        <a href="#dummy">
                                            <img src="{{asset("assets/img/common/ico_fav.png")}}"
                                                 alt="">お気に入りから削除する
                                        </a>
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
                                    <div class="result__fav del">
                                        <a href="#dummy">
                                            <img src="{{asset("assets/img/common/ico_fav.png")}}"
                                                 alt="">お気に入りから削除する
                                        </a>
                                    </div>
                                </div>
                                <!-- .result__box -->
                            </div>
                        </div>
                        <!--/.main_blockr -->
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
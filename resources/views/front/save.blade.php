@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/example.css")}}">

@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
    <script src="{{asset("assets/js/example.js")}}"></script>

@endpush

@section('title', '保存作品')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="save">
                <h1 class="main__title">
                    <picture>
                        <img src="{{asset("assets/img/save/title.png")}}" srcset="{{ asset("assets/img/save/title.png")}}" alt="保存作品">
                    </picture>
                </h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url("/")}}">HOME</a></li>
                        <li><a href="{{url("mypage")}}">マイページ</a></li>
                        <li>保存作品</li>
                    </ul>
                    <div class="main__block_lr">
                        <div class="main__block_r">
                            <h2 class="ttl01 mt25">保存作品</h2>
                            <div class="example__content">
                                <a class="js-showing-modal" href="#c001">
                                    <h3 class="ttl03">作品名</h3>
                                    <figure>
                                        <img src="{{asset("assets/img/example/c001_thumbnail.jpg")}}" alt="">
                                    </figure>
                                    <table>
                                        <tr>
                                            <th>比率</th>
                                            <td>1:1.5</td>
                                        </tr>
                                    </table>
                                </a>
                                <a class="js-showing-modal" href="#c002">
                                    <h3 class="ttl03">作品名</h3>
                                    <figure>
                                        <img src="{{asset("assets/img/example/c001_thumbnail.jpg")}}" alt="">
                                    </figure>
                                    <table>
                                        <tr>
                                            <th>比率</th>
                                            <td>1:1.5</td>
                                        </tr>
                                    </table>
                                </a>
                                <a class="js-showing-modal" href="#c003">
                                    <h3 class="ttl03">作品名</h3>
                                    <figure><img src="{{asset("assets/img/example/c001_thumbnail.jpg")}}" alt=""></figure>
                                    <table>
                                        <tr>
                                            <th>比率</th>
                                            <td>1:1.5</td>
                                        </tr>
                                    </table>
                                </a>

                                <a class="js-showing-modal" href="#c004">
                                    <h3 class="ttl03">作品名</h3>
                                    <figure><img src="{{asset("assets/img/example/c001_thumbnail.jpg")}}" alt=""></figure>
                                    <table>
                                        <tr>
                                            <th>比率</th>
                                            <td>1:1.5</td>
                                        </tr>
                                    </table>
                                </a>

                                <a class="js-showing-modal" href="#c005">
                                    <h3 class="ttl03">作品名</h3>
                                    <figure><img src="{{asset("assets/img/example/c001_thumbnail.jpg")}}" alt=""></figure>
                                    <table>
                                        <tr>
                                            <th>比率</th>
                                            <td>1:1.5</td>
                                        </tr>
                                    </table>
                                </a>

                                <a class="js-showing-modal" href="#c006">
                                    <h3 class="ttl03">作品名</h3>
                                    <figure><img src="{{asset("assets/img/example/c001_thumbnail.jpg")}}" alt=""></figure>
                                    <table>
                                        <tr>
                                            <th>比率</th>
                                            <td>1:1.5</td>
                                        </tr>
                                    </table>
                                </a>

                            </div>
                            <!-- /.example__content -->
                            <a class="example__btn" href="{{url("search/")}}">
                                <img src="{{asset("assets/img/top/make_btn.png")}}" alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る">
                            </a>
                        </div>
                        <!--/.main_blockr -->
                        <div class="main__block_l">
                            @include('front.components.mypageside')
                        </div>
                    </div>
                    <!--/.main_block_rl -->
                </div>
                <!--/.main__content -->
            </section>
        </div>
    </main>
    <!-- /.l-main -->

    <div class="modal">
        <div class="modal__inner">
            <div id="c001" class="modal__content">
                <div class="modal__close"></div>
                <figure>
                    <img src="{{asset("assets/img/example/c001_photo.jpg")}}" alt="">
                    <figcaption>
                        <p class="modal__heading">作品名</p>
                    </figcaption>
                </figure>
            </div>
            <div id="c002" class="modal__content">
                <div class="modal__close"></div>
                <figure>
                    <img src="{{asset("assets/img/example/c001_photo.jpg")}}" alt="">
                    <figcaption>
                        <p class="modal__heading">作品名</p>
                    </figcaption>
                </figure>
            </div>
            <div id="c003" class="modal__content">
                <div class="modal__close"></div>
                <figure>
                    <img src="{{asset("assets/img/example/c001_photo.jpg")}}" alt="">
                    <figcaption>
                        <p class="modal__heading">作品名</p>
                    </figcaption>
                </figure>
            </div>
            <div id="c004" class="modal__content">
                <div class="modal__close"></div>
                <figure>
                    <img src="{{asset("assets/img/example/c001_photo.jpg")}}" alt="">
                    <figcaption>
                        <p class="modal__heading">作品名</p>
                    </figcaption>
                </figure>
            </div>
            <div id="c005" class="modal__content">
                <div class="modal__close"></div>
                <figure>
                    <img src="{{asset("assets/img/example/c001_photo.jpg")}}" alt="">
                    <figcaption>
                        <p class="modal__heading">作品名</p>
                    </figcaption>
                </figure>
            </div>
            <div id="c006" class="modal__content">
                <div class="modal__close"></div>
                <figure>
                    <img src="{{asset("assets/img/example/c001_photo.jpg")}}" alt="">
                    <figcaption>
                        <p class="modal__heading">作品名</p>
                    </figcaption>
                </figure>
            </div>
        </div>
    </div>
    <!-- /.modal -->
@endsection
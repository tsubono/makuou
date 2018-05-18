@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/example.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
@endpush

@section('title', 'ギャラリー')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <h1 class="main__title">
                <picture>
                    <img src="{{asset("assets/img/example/title.png")}}" srcset="{{asset("assets/img/example/title@2x.png")}} 2x"
                         alt="よくあるご質問">
                </picture>
            </h1>
            <div class="main__content">
                <ul class="main__breadcrumb">
                    <li><a href="{{url('/')}}">HOME</a></li>
                    <li>ギャラリー</li>
                </ul>
                <div class="select-box">
                    <p class="select-box__title">事例を探す</p>
                    <div class="select-box__group">
                        <p>
                            <label for="sports">スポーツ</label>
                            <select name="sports" id="sports">
                                <option value="sports00">すべて</option>
                                <option value="sports01">サッカー・フットサル</option>
                                <option value="sports02">野球・ソフトボール</option>
                                <option value="sports03">バスケットボール</option>
                                <option value="sports04">バレーボール</option>
                                <option value="sports05">テニス</option>
                                <option value="sports06">バトミントン</option>
                                <option value="sports07">ラグビー</option>
                                <option value="sports08">ハンドボール</option>
                                <option value="sports09">ドッジボール</option>
                                <option value="sports10">卓球</option>
                                <option value="sports11">剣道</option>
                                <option value="sports12">弓道</option>
                                <option value="sports13">空手道・柔道</option>
                                <option value="sports14">陸上競技</option>
                                <option value="sports15">水泳</option>
                                <option value="sports16">体操</option>
                                <option value="sports17">スキー・スノーボード</option>
                                <option value="sports18">スケート</option>
                                <option value="sports19">レスリング</option>
                                <option value="sports20">ダンス</option>
                            </select>
                        </p>
                        <p>
                            <label for="taste">テイスト</label>
                            <select name="taste" id="taste">
                                <option value="taste00">すべて</option>
                                <option value="taste01">シンプル</option>
                                <option value="taste02">熱血</option>
                                <option value="taste03">スポーティ</option>
                                <option value="taste04">ナチュラル</option>
                                <option value="taste05">インパクト</option>
                                <option value="taste06">かわいい</option>
                                <option value="taste07">ヴィンテージ</option>
                                <option value="taste08">ゴージャス</option>
                                <option value="taste09">和風</option>
                            </select>
                        </p>
                        <p>
                            <label for="scene">シーン</label>
                            <select name="scene" id="scene">
                                <option value="scene00">すべて</option>
                                <option value="scene01">スポーツ応援</option>
                                <option value="scene02">お祝い・式典</option>
                                <option value="scene03">学校行事</option>
                                <option value="scene04">イベント・フェス</option>
                                <option value="scene05">ホームパーティ</option>
                                <option value="scene06">商売繁盛</option>
                            </select>
                        </p>
                    </div>
                </div>
                <!-- /.select-box -->
                <div class="example__content">
                    <a class="js-showing-modal" href="#c001">
                        <figure>
                            <img src="{{asset("assets/img/example/c001_thumbnail.jpg")}}" alt="">
                            <figcaption>高知大学高知医大様</figcaption>
                        </figure>
                    </a>
                    <a class="js-showing-modal" href="#c002">
                        <figure>
                            <img src="{{asset("assets/img/example/c001_thumbnail.jpg")}}" alt="">
                            <figcaption>高知大学高知医大様</figcaption>
                        </figure>
                    </a>
                    <a class="js-showing-modal" href="#c003">
                        <figure>
                            <img src="{{asset("assets/img/example/c001_thumbnail.jpg")}}" alt="">
                            <figcaption>高知大学高知医大様</figcaption>
                        </figure>
                    </a>
                    <a class="js-showing-modal" href="#c004">
                        <figure>
                            <img src="{{asset("assets/img/example/c001_thumbnail.jpg")}}" alt="">
                            <figcaption>高知大学高知医大様</figcaption>
                        </figure>
                    </a>
                    <a class="js-showing-modal" href="#c005">
                        <figure>
                            <img src="{{asset("assets/img/example/c001_thumbnail.jpg")}}" alt="">
                            <figcaption>高知大学高知医大様</figcaption>
                        </figure>
                    </a>
                    <a class="js-showing-modal" href="#c006">
                        <figure>
                            <img src="{{asset("assets/img/example/c001_thumbnail.jpg")}}" alt="">
                            <figcaption>高知大学高知医大様</figcaption>
                        </figure>
                    </a>
                </div>
                <!-- /.example__content -->
                <a class="example__btn" href=""><img src="{{asset("assets/img/top/make_btn.png")}}"
                                                     alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る"></a>
            </div>
        </div>
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
                        <p class="modal__heading">高知大学高知医大様</p>
                        <p class="modal__description">コメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメ
                            ントコメントコメントコメントコメントコメントコメントコメントコメント</p>
                    </figcaption>
                </figure>
            </div>
            <div id="c002" class="modal__content">
                <div class="modal__close"></div>
                <figure>
                    <img src="{{asset("assets/img/example/c001_photo.jpg")}}" alt="">
                    <figcaption>
                        <p class="modal__heading">テスト2</p>
                        <p class="modal__description">コメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメ
                            ントコメントコメントコメントコメントコメントコメントコメントコメント</p>
                    </figcaption>
                </figure>
            </div>
            <div id="c003" class="modal__content">
                <div class="modal__close"></div>
                <figure>
                    <img src="{{asset("assets/img/example/c001_photo.jpg")}}" alt="">
                    <figcaption>
                        <p class="modal__heading">テスト3</p>
                        <p class="modal__description">コメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメ
                            ントコメントコメントコメントコメントコメントコメントコメントコメント</p>
                    </figcaption>
                </figure>
            </div>
            <div id="c004" class="modal__content">
                <div class="modal__close"></div>
                <figure>
                    <img src="{{asset("assets/img/example/c001_photo.jpg")}}" alt="">
                    <figcaption>
                        <p class="modal__heading">テスト4</p>
                        <p class="modal__description">コメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメ
                            ントコメントコメントコメントコメントコメントコメントコメントコメント</p>
                    </figcaption>
                </figure>
            </div>
            <div id="c005" class="modal__content">
                <div class="modal__close"></div>
                <figure>
                    <img src="{{asset("assets/img/example/c001_photo.jpg")}}" alt="">
                    <figcaption>
                        <p class="modal__heading">テスト5</p>
                        <p class="modal__description">コメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメ
                            ントコメントコメントコメントコメントコメントコメントコメントコメント</p>
                    </figcaption>
                </figure>
            </div>
            <div id="c006" class="modal__content">
                <div class="modal__close"></div>
                <figure>
                    <img src="{{asset("assets/img/example/c001_photo.jpg")}}" alt="">
                    <figcaption>
                        <p class="modal__heading">テスト6</p>
                        <p class="modal__description">コメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメントコメ
                            ントコメントコメントコメントコメントコメントコメントコメントコメント</p>
                    </figcaption>
                </figure>
            </div>
        </div>
    </div>
    <!-- /.modal -->
@endsection
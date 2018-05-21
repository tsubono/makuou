@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
@endpush

@section('title', '価格表')

@section('content')

    <main class="l-main">
        <div class="l-inner">
            <section class="price">

                <h1 class="main__title"><img src="{{asset("assets/img/price/title.png")}}" alt="価格表"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url('/')}}">HOME</a></li>
                        <li>価格表</li>
                    </ul>
                    <h5 class="ttl03">通常生地（社内呼称：トロマット）</h5>
                    <div class="scroll">
                        <table>
                            <tbody>
                            <tr>
                                <td></td>
                                <td>1：1</td>
                                <td>1：1.5</td>
                                <td>1：2</td>
                                <td>1：3</td>
                                <td>1：4</td>
                            </tr>
                            <tr>
                                <td>600mm</td>
                                <td>3,000円</td>
                                <td>3,200円</td>
                                <td>3,400円</td>
                                <td>3,800円</td>
                                <td>5,000円</td>
                            </tr>
                            <tr>
                                <td>900mm</td>
                                <td>3,500円</td>
                                <td>4,200円</td>
                                <td>5,600円</td>
                                <td>8,100円</td>
                                <td>10,500円</td>
                            </tr>
                            <tr>
                                <td>1200mm</td>
                                <td>5,000円</td>
                                <td>7,200円</td>
                                <td>9,600円</td>
                                <td>14,000円</td>
                                <td>18,200円</td>
                            </tr>
                            <tr>
                                <td>1500mm</td>
                                <td>7,600円</td>
                                <td>10,900円</td>
                                <td>14,600円</td>
                                <td>21,300円</td>
                                <td>27,800円</td>
                            </tr>
                            <tr>
                                <td>1800mm</td>
                                <td>10,500円</td>
                                <td>15,700円</td>
                                <td>20,500円</td>
                                <td>29,900円</td>
                                <td>39,300円</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>

                    <h5 class="ttl03">メッシュ生地（社内呼称：メッシュポリエステル）</h5>

                    <div class="scroll">
                        <table>
                            <tbody>
                            <tr>
                                <td></td>
                                <td>1：1</td>
                                <td>1：1.5</td>
                                <td>1：2</td>
                                <td>1：3</td>
                                <td>1：4</td>
                            </tr>
                            <tr>
                                <td>600mm</td>
                                <td>3,000円</td>
                                <td>3,200円</td>
                                <td>3,400円</td>
                                <td>3,800円</td>
                                <td>5,000円</td>
                            </tr>
                            <tr>
                                <td>900mm</td>
                                <td>3,500円</td>
                                <td>4,200円</td>
                                <td>5,600円</td>
                                <td>8,100円</td>
                                <td>10,500円</td>
                            </tr>
                            <tr>
                                <td>1200mm</td>
                                <td>5,000円</td>
                                <td>7,200円</td>
                                <td>9,600円</td>
                                <td>14,000円</td>
                                <td>18,200円</td>
                            </tr>
                            <tr>
                                <td>1500mm</td>
                                <td>7,600円</td>
                                <td>10,900円</td>
                                <td>14,600円</td>
                                <td>21,300円</td>
                                <td>27,800円</td>
                            </tr>
                            <tr>
                                <td>10,500円</td>
                                <td>15,700円</td>
                                <td>20,500円</td>
                                <td>29,900円</td>
                                <td>39,300円</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>

                    <h5 class="ttl03">サテン生地（社内呼称：サテン）</h5>

                    <div class="scroll">
                        <table>
                            <tbody>
                            <tr>
                                <td></td>
                                <td>1：1</td>
                                <td>1：1.5</td>
                                <td>1：2</td>
                                <td>1：3</td>
                                <td>1：4</td>
                            </tr>
                            <tr>
                                <td>600mm</td>
                                <td>3,000円</td>
                                <td>3,200円</td>
                                <td>3,400円</td>
                                <td>3,800円</td>
                                <td>5,000円</td>
                            </tr>
                            <tr>
                                <td>900mm</td>
                                <td>3,500円</td>
                                <td>4,200円</td>
                                <td>5,600円</td>
                                <td>8,100円</td>
                                <td>10,500円</td>
                            </tr>
                            <tr>
                                <td>1200mm</td>
                                <td>5,000円</td>
                                <td>7,200円</td>
                                <td>9,600円</td>
                                <td>14,000円</td>
                                <td>18,200円</td>
                            </tr>
                            <tr>
                                <td>1500mm</td>
                                <td>7,600円</td>
                                <td>10,900円</td>
                                <td>14,600円</td>
                                <td>21,300円</td>
                                <td>27,800円</td>
                            </tr>
                            <tr>
                                <td>1800mm</td>
                                <td>10,500円</td>
                                <td>15,700円</td>
                                <td>20,500円</td>
                                <td>29,900円</td>
                                <td>39,300円</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>

                    <h5 class="ttl03">強化ビニール生地（社内呼称：通常ターポリン）</h5>

                    <div class="scroll">
                        <table>
                            <tbody>
                            <tr>
                                <td></td>
                                <td>1：1</td>
                                <td>1：1.5</td>
                                <td>1：2</td>
                                <td>1：3</td>
                                <td>1：4</td>
                            </tr>
                            <tr>
                                <td>600mm</td>
                                <td>3,600円</td>
                                <td>3,800円</td>
                                <td>4,000円</td>
                                <td>4,500円</td>
                                <td>6,000円</td>
                            </tr>
                            <tr>
                                <td>900mm</td>
                                <td>4,200円</td>
                                <td>5,000円</td>
                                <td>6,700円</td>
                                <td>9,700円</td>
                                <td>12,600円</td>
                            </tr>
                            <tr>
                                <td>1200mm</td>
                                <td>6,000円</td>
                                <td>8,600円</td>
                                <td>11,500円</td>
                                <td>16,800円</td>
                                <td>21,800円</td>
                            </tr>
                            <tr>
                                <td>1500mm</td>
                                <td>9,100円</td>
                                <td>13,000円</td>
                                <td>17,500円</td>
                                <td>25,500円</td>
                                <td>33,300円</td>
                            </tr>
                            <tr>
                                <td>1800mm</td>
                                <td>12,600円</td>
                                <td>18,800円</td>
                                <td>24,600円</td>
                                <td>35,800円</td>
                                <td>47,100円</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <!-- /.search -->
            <section class="pickup">
                <h2 class="pickup__heading"><img src="{{asset("assets/img/search/heading--pickup.png")}}" alt="PickUp"></h2>
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
                <div class="btn"><a href="{{url('/search')}}"><img src="{{asset("assets/img/top/make_btn.png")}}" alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る"></a></div>
            </section>
            <!-- /.pickup -->
        </div>
    </main>
    <!-- /.l-main -->
@endsection
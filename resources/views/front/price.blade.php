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
                    <h5 class="ttl03">メッシュポリエステル</h5>
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
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            <tr>
                                <td>900mm</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            <tr>
                                <td>1200mm</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            <tr>
                                <td>1500mm</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            <tr>
                                <td>1800mm</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>

                    <h5 class="ttl03">トロマット</h5>

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
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            <tr>
                                <td>900mm</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            <tr>
                                <td>1200mm</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            <tr>
                                <td>1500mm</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            <tr>
                                <td>1800mm</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>

                    <h5 class="ttl03">防災トロマット</h5>

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
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            <tr>
                                <td>900mm</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            <tr>
                                <td>1200mm</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            <tr>
                                <td>1500mm</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            <tr>
                                <td>1800mm</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>

                    <h5 class="ttl03">サテン</h5>

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
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            <tr>
                                <td>900mm</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            <tr>
                                <td>1200mm</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            <tr>
                                <td>1500mm</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            <tr>
                                <td>1800mm</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                                <td>1,980円</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <!-- /.search -->
            <section class="pickup">
                <h2 class="pickup__heading"><img src="../assets/img/search/heading--pickup.png" alt=""></h2>
                <div class="pickup__content">
                    <div class="pickup__box">
                        <div>
                            <img src="../assets/img/banner/banner01.png" alt="">
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
                            <img src="../assets/img/banner/banner01.png" alt="">
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
                            <img src="../assets/img/banner/banner01.png" alt="">
                            <dl class="pickup__info">
                                <dt>比率</dt>
                                <dd>1:1.5</dd>
                                <dt>サイズ</dt>
                                <dd>600</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="btn"><a href="#"><img src="../assets/img/top/make_btn.png" alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る"></a></div>
            </section>
            <!-- /.pickup -->
        </div>
    </main>
    <!-- /.l-main -->
@endsection
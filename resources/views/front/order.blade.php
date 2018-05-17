@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
@endpush

@section('title', '特定商取引に関する法律に基づく表記')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="order">
                <h1 class="main__title"><img src="{{asset("assets/img/order/title.png")}}" alt="特定商取引に関する法律に基づく表記"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url('/')}}">HOME</a></li>
                        <li>特定商取引に関する法律に基づく表記</li>
                    </ul>
                    <h4 class="ttl01">特定商取引に関する法律に基づく表記</h4>
                    <table class="table01 tate">
                        <tbody>
                        <tr>
                            <th>販売業者</th>
                            <td>株式会社 大阪美装</td>
                        </tr>
                        <tr>
                            <th>運営責任者</th>
                            <td>高松 輝久</td>
                        </tr>
                        <tr>
                            <th>住所</th>
                            <td>〒566-0035<br>
                                大阪府摂津市鶴野2-3-19
                            </td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td>0120-805-266</td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td>info@maku-ou.com</td>
                        </tr>
                        <tr>
                            <th>URL</th>
                            <td>https://maku-ou.com</td>
                        </tr>
                        <tr>
                            <th>商品以外の必要代金</th>
                            <td>1. 送料<br>
                                2. 消費税(税込表示)
                            </td>
                        </tr>
                        <tr>
                            <th>注文方法</th>
                            <td>1. インターネット受付<br>
                                &nbsp;&nbsp;&nbsp;&nbsp;24時間(但し、定休日の場合は翌営業日の受付です)<br>
                                ご注文フォームにご入力いただき、ご送信ください。
                            </td>
                        </tr>
                        <tr>
                            <th>支払方法</th>
                            <td>1. クレジットカード決済<br>
                                2. コンビニ決済<br>
                                3. 銀行振り込み
                            </td>
                        </tr>
                        <tr>
                            <th>支払期限</th>
                            <td>1. クレジットカード決済の場合：ご利用のカード会社ごとに異なります。<br>
                                2. コンビニ決済の場合：商品到着後1週間以内にお支払いください。<br>
                                3. 銀行振り込みの場合：商品到着後1週間以内にお振込みください。
                            </td>
                        </tr>
                        <tr>
                            <th>引渡し時期</th>
                            <td>原則として、在庫商品については受注当日の発送、オーダー製作品については受注日から2営業日後の発送となります。<br>
                                ただし、午後3時以降の注文の場合は、翌営業日の受注としての取り扱いになります。
                            </td>
                        </tr>
                        <tr>
                            <th>返品・交換について</th>
                            <td>返品は、商品到着後1週間以内にお申し出頂き、お客様の御都合による返品は返送料を御負担願います。<br>尚、オーダー制作品は、不良品以外のお客様の御都合による返品は出来ません。
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <!-- /.search -->
            <section class="pickup">
                <h2 class="pickup__heading"><img src="{{asset("assets/img/search/heading--pickup.png")}}" alt=""></h2>
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
                <div class="btn"><a href="#"><img src="{{asset("assets/img/top/make_btn.png")}}"
                                                  alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る"></a></div>
            </section>
            <!-- /.pickup -->
        </div>
    </main>
    <!-- /.l-main -->
@endsection
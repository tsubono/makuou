@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
@endpush

@section('title', '運営会社について')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="company">
                <h1 class="main__title"><img src="{{asset("assets/img/company/title.png")}}" alt="運営会社について"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url('/')}}">HOME</a></li>
                        <li>運営会社について</li>
                    </ul>
                    <h4 class="ttl01">運営会社について</h4>
                    <table class="table01 tate">
                        <tbody>
                        <tr>
                            <th>商号</th>
                            <td>株式会社 大阪美装（オオサカビソウ）</td>
                        </tr>
                        <tr>
                            <th>所在地</th>
                            <td>〒566-0035<br>
                                大阪府摂津市鶴野2-3-19
                            </td>
                        </tr>
                        <tr>
                            <th>事業内容</th>
                            <td>横断幕、のぼり、看板、標識類の製作並びに販売</td>
                        </tr>
                        <tr>
                            <th>沿革</th>
                            <td>
                                昭和39年 大阪市城東区にて商号を大阪色彩として印刷看板製造を開始<br>
                                昭和46年 摂津市一津屋に移転、株式会社大阪美装に改組<br>
                                平成8年 不動産関連看板類の通信販売を開始（サインハウス）<br>
                                平成15年 大阪府摂津市鶴野に移転<br>
                                平成22年 現住所に移転
                            </td>
                        </tr>
                        <tr>
                            <th>資本金</th>
                            <td>1,000万円</td>
                        </tr>
                        <tr>
                            <th>代表者</th>
                            <td>代表取締役　高松　輝久</td>
                        </tr>
                        <tr>
                            <th>従業員数</th>
                            <td>45名</td>
                        </tr>
                        <tr>
                            <th>取引銀行</th>
                            <td>三井住友銀行 守口支店<br>
                                京都銀行 茨木支店<br>
                                阿波銀行 北大阪支店
                            </td>
                        </tr>
                        <tr>
                            <th>主要取引先</th>
                            <td>株式会社 大国<br>
                                帝金 株式会社<br>
                                株式会社 日本緑十字社<br>
                                株式会社 アイケーシー<br>
                                メッシュ 株式会社
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
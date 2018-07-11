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
                        <img src="{{asset("assets/img/save/title.png")}}"
                             srcset="{{ asset("assets/img/save/title.png")}}" alt="保存作品">
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

                                @foreach ($orders as $order)
                                    @foreach ($order->order_details as $order_detail)
                                        <a class="js-showing-modal" href="#{{$order_detail->id}}">
                                            <h3 class="ttl03">
                                                {{ !empty($order_detail->design_name) ? $order_detail->design_name : ' NO TITLE ' }}
                                            </h3>
                                            <figure>
                                                <img src="{!! asset(env('PUBLIC', ''). $order_detail->designed_image) !!}"
                                                     alt="">
                                            </figure>
                                            <table>
                                                <tr>
                                                    <th>比率</th>
                                                    <td>
                                                        {{ $order_detail->product->ratio->height }}
                                                        :{{ $order_detail->product->ratio->width }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </a>
                                    @endforeach
                                @endforeach

                            </div>
                            <!-- /.example__content -->
                            <a class="example__btn" href="{{url("search/")}}">
                                <img src="{{asset("assets/img/top/make_btn.png")}}"
                                     alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る">
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
            @foreach ($orders as $order)
                @foreach ($order->order_details as $order_detail)
                    <div id="{{ $order_detail->id }}" class="modal__content">
                        <div class="modal__close"></div>
                        <figure>
                            <img src="{!! asset(env('PUBLIC', ''). $order_detail->designed_image) !!}" alt="">
                            <figcaption>
                                <p class="modal__heading">
                                    {{ !empty($order_detail->design_name) ? $order_detail->design_name : ' NO TITLE ' }}
                                </p>
                            </figcaption>
                        </figure>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
    <!-- /.modal -->
@endsection
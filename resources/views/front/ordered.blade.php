@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
    <script>
        $(function() {
            $('.download').click (function() {
                $(this).parent('form').submit();
            });

            $('.reorder').click (function() {
                $(this).parent('form').submit();
            });
        })
    </script>
@endpush

@section('title', '注文履歴')

@section('content')

    <main class="l-main">
        <div class="l-inner">
            <section class="ordered">

                <h1 class="main__title"><img src="{{asset("assets/img/ordered/title.png")}}" alt="お気に入りテンプレート"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url("/")}}">HOME</a></li>
                        <li><a href="{{url("mypage")}}">マイページ</a></li>
                        <li>注文履歴</li>
                    </ul>
                    <div class="main__block_lr">
                        <div class="main__block_r">
                            <h4 class="ttl01 mt25 mb30">注文履歴</h4>

                            @foreach ($orders as $order)
                                @foreach ($order->order_details as $order_detail)
                                    <div class="ordered_box">
                                        <div class="ordered_box__top">
                                            <div class="ordered_box__side">
                                                <h5 class="result__title mt0">{{ $order_detail->design_name }}</h5>
                                                <p>
                                                    受注日：
                                                    @if (!empty($order->ordered_at))
                                                        {{ $order->ordered_at->format('Y年m月d日') }}
                                                    @endif
                                                </p>
                                                <p>
                                                    発送日：
                                                    @if (!empty($order->shipping_at))
                                                        {{ $order->shipping_at->format('Y年m月d日') }}
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="ordered_box__reorder">
                                                <form action="{{ url('/ordered/reorder') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $order_detail->product->id }}">
                                                    <input type="hidden" name="order_detail_id" value="{{ $order_detail->id }}">
                                                    <a class="reorder">
                                                        <img src="{{asset("assets/img/ordered/reorder_btn.png")}}" alt="">
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="ordered_box__bottom">
                                            <ul>
                                                <li>
                                                    <form action="{{ url('/ordered/download') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $order->id }}">
                                                        <input type="hidden" name="type" value="請求書">
                                                        <a class="download">ご請求書</a>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ url('/ordered/download') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $order->id }}">
                                                        <input type="hidden" name="type" value="見積書">
                                                        <a class="download">お見積書</a>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ url('/ordered/download') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $order->id }}">
                                                        <input type="hidden" name="type" value="領収書">
                                                        <a class="download">領収書</a>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                        <div class="main__block_l">
                            @include('front.components.mypageside')
                        </div>
                    </div>
                    <!-- /.main__block_lr -->
                </div>
            </section>


        </div>
    </main>
    <!-- /.l-main -->

@endsection
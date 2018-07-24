@extends('front.layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script>
    </script>

@endpush

@section('title', '確認画面')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="layout confirm">
                <h1 class="main__title">
                    <img src="{{asset("assets/img/layout/title_confirm2.png")}}" alt="デザイン確認">
                </h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="">HOME</a></li>
                        <li><a href="{{ url('/layout/'. $order_detail['product_id']) }}">レイアウトを作る</a></li>
                        <li><a href="">デザイン確認</a></li>
                        <li><a href="">仕様を決める</a></li>
                        <li>確認画面</li>
                    </ul>

                    <form method="post" action="{{ url('layout/complete') }}" class="form_template confirm" id="form1">
                        @csrf
                        <input type="hidden" name="order[user_id]" value="{{ $order['user_id'] }}">
                        <input type="hidden" name="order_detail[product_id]" value="{{ $order_detail['product_id'] }}">
                        <input type="hidden" name="order_detail[designed_filename]" value="{{ $order_detail['designed_filename'] }}">
                        <input type="hidden" name="order_detail[uploaded_files]" value="{{ $order_detail['uploaded_files'] }}">
                        <input type="hidden" name="order_detail[json]" value="{{ $order_detail['json'] }}">

                        <div class="form__bd">
                            <dl>
                                <dt>レイアウトイメージ</dt>
                                <dd>
                                    <div class="design w600">
                                        <img src="{!! asset(env('PUBLIC', ''). $order_detail['designed_image']) !!}" alt="デザイン確認">
                                        <input type="hidden" name="order_detail[designed_image]" value="{{ $order_detail['designed_image'] }}">
                                    </div>
                                </dd>
                            </dl>
                            <dl>
                                <dt>デザイン名</dt>
                                <dd>
                                    {{ $order_detail['design_name'] }}
                                    <input type="hidden" name="order_detail[design_name]" value="{{ $order_detail['design_name'] }}">
                                </dd>
                            </dl>
                            <dl>
                                <dt>備考欄</dt>
                                <dd>
                                    {{ $order_detail['note'] }}
                                    <input type="hidden" name="order_detail[note]" value="{{ $order_detail['note'] }}">
                                </dd>
                            </dl>
                            <dl>
                                <dt>比率</dt>
                                <dd>
                                    {{ $product->ratio->height }} : {{ $product->ratio->width }}
                                </dd>
                            </dl>
                            <dl>
                                <dt>サイズ</dt>
                                <dd>
                                    縦{{ $order_detail['size'] }}cm×横{{ $order_detail['size'] * $product->ratio->width }}cm
                                    <input type="hidden" name="order_detail[size]" value="{{ $order_detail['size'] }}">
                                </dd>
                            </dl>
                            <dl>
                                <dt>素材</dt>
                                <dd>
                                    {{ $order_detail['material'] }}
                                    <input type="hidden" name="order_detail[material]" value="{{ $order_detail['material'] }}">
                                </dd>
                            </dl>
                            <dl>
                                <dt>ハトメ位置</dt>
                                <dd>
                                    {{ $order_detail['hatome'] }}
                                    <input type="hidden" name="order_detail[hatome]" value="{{ $order_detail['hatome'] }}">
                                </dd>
                            </dl>
                            <dl>
                                <dt>付属品（ロープ）</dt>
                                <dd>
                                    {{ !empty($order_detail['lope_1']) ? $order_detail['lope_1'] : '' }}
                                    <input type="hidden" name="order_detail[lope_1]" value="{{ !empty($order_detail['lope_1']) ? $order_detail['lope_1'] : '' }}">
                                </dd>
                            </dl>
                            <dl>
                                <dt>付属品（旗用ポール）</dt>
                                <dd>
                                    {{ !empty($order_detail['pole']) ? $order_detail['pole'] : '' }}
                                    <input type="hidden" name="order_detail[pole]" value="{{ !empty($order_detail['pole']) ? $order_detail['pole'] : '' }}">
                                </dd>
                            </dl>
                            <dl>
                                <dt>納期</dt>
                                <dd>
                                    {{ $order_detail['nouki'] }}
                                    <input type="hidden" name="order_detail[nouki]" value="{{ $order_detail['nouki'] }}">
                                </dd>
                            </dl>
                            <dl>
                                <dt>その他オプション</dt>
                                <dd>
                                    @foreach ($order_detail['option_ids'] as $option_id)
                                        <input type="hidden" name="order_detail[option_ids][]" value="{{ $option_id }}">
                                        {{ \App\Models\Option::where('id', $option_id)->first()->name }}
                                    @endforeach
                                </dd>
                            </dl>
                            <dl>
                                <dt>価格</dt>
                                <dd>
                                    ●●●●円
                                    <input type="hidden" name="order_detail[designed_image]" value="{{ $order_detail['designed_image'] }}">
                                </dd>
                            </dl>
                        </div>

                        <div class="btn">
                            <input type="submit" name="submit" value="注文画面へ進む" />
                        </div>
                    </form>
                </div>
            </section>
            <!-- /.layout -->
        </div>
    </main>
    <!-- /.l-main -->
@endsection
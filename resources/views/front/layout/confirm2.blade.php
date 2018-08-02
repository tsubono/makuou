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

                    <form method="post" action="{{ url('/order') }}" class="form_template confirm" id="form1">
                        @csrf
                        <input type="hidden" name="order[user_id]" value="{{ $order['user_id'] }}">
                        <input type="hidden" name="order_detail[product_id]" value="{{ $order_detail['product_id'] }}">
                        <input type="hidden" name="order_detail[designed_filename]" value="{{ $order_detail['designed_filename'] }}">
                        <input type="hidden" name="order_detail[uploaded_files]" value="{{ $order_detail['uploaded_files'] }}">
                        <input type="hidden" name="order_detail[json]" value="{{ $order_detail['json'] }}">

                        <input type="hidden" name="order[sub_total]" value="{{ $order['sub_total'] }}">
                        <input type="hidden" name="order[total]" value="{{ $order['total'] }}">

                        <input type="hidden" name="order_detail[ratio_id]" value="{{ $order_detail['ratio_id'] }}">
                        <input type="hidden" name="order_detail[price]" value="{{ $order_detail['price'] }}">
                        <input type="hidden" name="order_detail[price_id]" value="{{ $order_detail['price_id'] }}">
                        <input type="hidden" name="order_detail[option_price]" value="{{ $order_detail['option_price'] }}">
                        <input type="hidden" name="order_detail[tax_rate]" value="{{ $order_detail['tax_rate'] }}">
                        <input type="hidden" name="order_detail[sub_total]" value="{{ $order_detail['sub_total'] }}">

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
                                    {!! nl2br(e( $order_detail['note'] )) !!}
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
                                    @if (!empty($order_detail['size_id']))
                                        縦{{ \App\Models\Size::where('id', $order_detail['size_id'])->first()->value }}cm×横{{  \App\Models\Size::where('id', $order_detail['size_id'])->first()->value *  $product->ratio->width }}cm
                                        <input type="hidden" name="order_detail[size_id]" value="{{ $order_detail['size_id'] }}">
                                    @endif
                                </dd>
                            </dl>
                            <dl>
                                <dt>素材</dt>
                                <dd>
                                    @if (!empty($order_detail['clothe_id']))
                                        {{ \App\Models\Clothe::where('id', $order_detail['clothe_id'])->first()->name }}
                                        <input type="hidden" name="order_detail[clothe_id]" value="{{ $order_detail['clothe_id'] }}">
                                    @endif
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
                                    @if (!empty($order_detail['lope_flg']))
                                        {{ !empty($order_detail['lope_1']) ? $order_detail['lope_1']. 'm': ''}}
                                        ×
                                        {{ !empty($order_detail['lope_2']) ? $order_detail['lope_2']. '本': ''}}
                                    @endif
                                    <input type="hidden" name="order_detail[lope_flg]" value="{{ !empty($order_detail['lope_flg']) ? $order_detail['lope_flg'] : '' }}">
                                    <input type="hidden" name="order_detail[lope_1]" value="{{ !empty($order_detail['lope_1']) ? $order_detail['lope_1'] : '' }}">
                                    <input type="hidden" name="order_detail[lope_2]" value="{{ !empty($order_detail['lope_2']) ? $order_detail['lope_2'] : '' }}">
                                </dd>
                            </dl>
                            <dl>
                                <dt>付属品（旗用ポール）</dt>
                                <dd>
                                    @if (!empty($order_detail['pole_flg']))
                                        {{ !empty($order_detail['pole']) ? $order_detail['pole'] : '' }}
                                    @endif
                                    <input type="hidden" name="order_detail[pole_flg]" value="{{ !empty($order_detail['pole_flg']) ? $order_detail['pole_flg'] : '' }}">
                                    <input type="hidden" name="order_detail[pole]" value="{{ !empty($order_detail['pole']) ? $order_detail['pole'] : '' }}">
                                </dd>
                            </dl>
                            <dl>
                                <dt>納期</dt>
                                <dd>
                                    {{ config('const.nouki')[$order_detail['nouki_id']] }}
                                    <input type="hidden" name="order_detail[nouki_id]" value="{{ $order_detail['nouki_id'] }}">
                                </dd>
                            </dl>
                            <dl>
                                <dt>その他オプション</dt>
                                <dd>
                                    @if (!empty($order_detail['option_ids']))
                                        @foreach ($order_detail['option_ids'] as $option_id)
                                            <input type="hidden" name="order_detail[option_ids][]" value="{{ $option_id }}">
                                            {{ \App\Models\Option::where('id', $option_id)->first()->name }}
                                        @endforeach
                                    @endif
                                </dd>
                            </dl>
                            <dl>
                                <dt>個数</dt>
                                <dd>
                                    {{ number_format($order_detail['quantity']) }}
                                    <input type="hidden" name="order_detail[quantity]" value="{{ $order_detail['quantity'] }}">
                                </dd>
                            </dl>
                            <dl>
                                <dt>価格</dt>
                                <dd>
                                    {{ number_format($order['total']) }}円
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
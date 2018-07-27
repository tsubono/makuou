@extends('front.layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@section('title', 'ご注文情報')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="settlement">
                <h1 class="main__title"><img src="{{asset("assets/img/settlement/title.png")}}" alt="ご注文"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="/">HOME</a></li>
                        <li>ご注文情報</li>
                    </ul>
                    <h4 class="ttl01">ご注文情報</h4>
                    <div class="settlement__wrap">
                        <form method="post" action="{{ url('/order/payment') }}" class="form_template" id="form1">
                            @csrf
                            <input type="hidden" name="order[user_id]" value="{{ $order['user_id'] }}">
                            <input type="hidden" name="order_detail[product_id]" value="{{ $order_detail['product_id'] }}">
                            <input type="hidden" name="order_detail[designed_filename]" value="{{ $order_detail['designed_filename'] }}">
                            <input type="hidden" name="order_detail[uploaded_files]" value="{{ $order_detail['uploaded_files'] }}">
                            <input type="hidden" name="order_detail[json]" value="{{ $order_detail['json'] }}">
                            <input type="hidden" name="order_detail[designed_image]" value="{{ $order_detail['designed_image'] }}">
                            <input type="hidden" name="order_detail[design_name]" value="{{ $order_detail['design_name'] }}">
                            <input type="hidden" name="order_detail[note]" value="{{ $order_detail['note'] }}">
                            <input type="hidden" name="order_detail[hatome]" value="{{ $order_detail['hatome'] }}">
                            <input type="hidden" name="order_detail[lope_flg]" value="{{ !empty($order_detail['lope_flg']) ? $order_detail['lope_flg'] : '' }}">
                            <input type="hidden" name="order_detail[lope_1]" value="{{ !empty($order_detail['lope_1']) ? $order_detail['lope_1'] : '' }}">
                            <input type="hidden" name="order_detail[lope_2]" value="{{ !empty($order_detail['lope_2']) ? $order_detail['lope_2'] : '' }}">
                            <input type="hidden" name="order_detail[pole_flg]" value="{{ !empty($order_detail['pole_flg']) ? $order_detail['pole_flg'] : '' }}">
                            <input type="hidden" name="order_detail[pole]" value="{{ !empty($order_detail['pole']) ? $order_detail['pole'] : '' }}">
                            <input type="hidden" name="order_detail[nouki_id]" value="{{ $order_detail['nouki_id'] }}">
                            @if (!empty($order_detail['option_ids']))
                                @foreach ($order_detail['option_ids'] as $option_id)
                                    <input type="hidden" name="order_detail[option_ids][]" value="{{ $option_id }}">
                                @endforeach
                            @endif

                            <input type="hidden" name="order[sub_total]" value="{{ $order['sub_total'] }}">
                            <input type="hidden" name="order[total]" value="{{ $order['total'] }}">

                            <input type="hidden" name="order_detail[ratio_id]" value="{{ $order_detail['ratio_id'] }}">
                            <input type="hidden" name="order_detail[price]" value="{{ $order_detail['price'] }}">
                            <input type="hidden" name="order_detail[price_id]" value="{{ $order_detail['price_id'] }}">
                            <input type="hidden" name="order_detail[option_price]" value="{{ $order_detail['option_price'] }}">
                            <input type="hidden" name="order_detail[tax_rate]" value="{{ $order_detail['tax_rate'] }}">
                            <input type="hidden" name="order_detail[sub_total]" value="{{ $order_detail['sub_total'] }}">
                            <input type="hidden" name="order_detail[quantity]" value="{{ $order_detail['quantity'] }}">
                            <input type="hidden" name="order[status]" value="1">

                            <h5 class="ttl02">会員情報（注文者）</h5>
                            <div class="form__bd">
                                <dl>
                                    <dt>お名前</dt>
                                    <dd>
                                        {{ $user['name'] }}
                                        <input type="hidden" name="user[name]" value="{{ $user['name'] }}">
                                        <input type="hidden" name="user[id]" value="{{ $user['id'] }}">
                                    </dd>
                                </dl>
                            </div>
                            <h5 class="ttl02">お届け先のご住所</h5>
                            <div class="form__bd">
                                <dl>
                                    <dt><span>必須</span>お名前</dt>
                                    <dd>
                                        {{ $order_shipping_address['name'] }}
                                        <input type="hidden" name="order_shipping_address[name]" value="{{ $order_shipping_address['name'] }}">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt><span>必須</span>お名前（フリガナ）</dt>
                                    <dd>
                                        {{ $order_shipping_address['name_kana'] }}
                                        <input type="hidden" name="order_shipping_address[name_kana]" value="{{ $order_shipping_address['name_kana'] }}">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>会社名</dt>
                                    <dd>
                                        {{ $order_shipping_address['company_name'] }}
                                        <input type="hidden" name="order_shipping_address[company_name]" value="{{ $order_shipping_address['company_name'] }}">
                                    </dd>
                                </dl>
                                <dl class="address_num">
                                    <dt><span>必須</span>郵便番号</dt>
                                    <dd>
                                        {{ $order_shipping_address['zip01'] }} -  {{ $order_shipping_address['zip02'] }}
                                        <input type="hidden" name="order_shipping_address[zip01]" value="{{ $order_shipping_address['zip01'] }}">
                                        <input type="hidden" name="order_shipping_address[zip02]" value="{{ $order_shipping_address['zip02'] }}">
                                    </dd>
                                </dl>
                                <dl class="innerlist_address add02">
                                    <dt><span>必須</span>都道府県</dt>
                                    <dd>
                                        {{ config('const.pref')[$order_shipping_address['pref_id']] }}
                                        <input type="hidden" name="order_shipping_address[pref_id]" value="{{ $order_shipping_address['pref_id'] }}">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt><span>必須</span>住所（市区町村番地）</dt>
                                    <dd>
                                        {{ $order_shipping_address['address1'] }}
                                        <input type="hidden" name="order_shipping_address[address1]" value="{{ $order_shipping_address['address1'] }}">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>住所（建物名・マンション名）</dt>
                                    <dd>
                                        {{ $order_shipping_address['address2'] }}
                                        <input type="hidden" name="order_shipping_address[address2]" value="{{ $order_shipping_address['address2'] }}">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt><span>必須</span>電話番号</dt>
                                    <dd>
                                        {{ $order_shipping_address['tel01'] }} -  {{ $order_shipping_address['tel02'] }} -  {{ $order_shipping_address['tel03'] }}
                                        <input type="hidden" name="order_shipping_address[tel01]" value="{{ $order_shipping_address['tel01'] }}">
                                        <input type="hidden" name="order_shipping_address[tel02]" value="{{ $order_shipping_address['tel02'] }}">
                                        <input type="hidden" name="order_shipping_address[tel03]" value="{{ $order_shipping_address['tel03'] }}">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>FAX番号</dt>
                                    <dd>
                                        {{ $order_shipping_address['fax01'] }} -  {{ $order_shipping_address['fax02'] }} -  {{ $order_shipping_address['fax03'] }}
                                        <input type="hidden" name="order_shipping_address[fax01]" value="{{ $order_shipping_address['fax01'] }}">
                                        <input type="hidden" name="order_shipping_address[fax02]" value="{{ $order_shipping_address['fax02'] }}">
                                        <input type="hidden" name="order_shipping_address[fax03]" value="{{ $order_shipping_address['fax03'] }}">
                                    </dd>
                                </dl>
                            </div>
                            <h5 class="ttl02">お支払情報</h5>
                            <div class="form__bd">
                                <dl>
                                    <dt>お支払い方法</dt>
                                    <dd>
                                        {{ \App\Models\Payment::where('id', $order['payment_id'])->first()->name }}
                                        <input type="hidden" name="order[payment_id]" value="{{ $order['payment_id'] }}">
                                    </dd>
                                </dl>
                            </div>

                            <h5 class="ttl02">料金</h5>
                            <div class="form__bd">
                                <dl>
                                    <dt>合計金額（税込）</dt>
                                    <dd>
                                        {{ number_format($order['payment_total']) }}円
                                        <input type="hidden" name="order[payment_total]" value="{{ $order['payment_total'] }}">
                                    </dd>
                                </dl>
                            </div>
                            <ul class="sendarea type_css">
                                <li><input name="submit" value="注文を確定する" class="btn_css_check" type="submit"></li>
                            </ul>
                        </form>
                    </div>
                </div>
            </section><!-- /.search -->
        </div>
    </main>
    <!-- /.l-main -->
@endsection
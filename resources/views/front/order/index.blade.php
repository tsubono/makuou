@extends('front.layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/jquery.jpostal.js")}}"></script>
    <script>
        $(function () {
            $('#zip').jpostal({
                click : '#btn',
                postcode : [
                    '#zip1',
                    '#zip2'
                ],
                address : {
                    '#pref_id'  : '%3',
                    '#address1'  : '%4%5'
                }
            });

            // 注文者情報をコピー押下時
            $('#copy_user').click(function () {
                $('[name="order_shipping_address[name]"]').val($('[name="user[name]"]').val());
                $('[name="order_shipping_address[name_kana]"]').val($('[name="user[name_kana]"]').val());
                $('[name="order_shipping_address[company_name]"]').val($('[name="user[company_name]"]').val());
                $('[name="order_shipping_address[zip01]"]').val($('[name="user[zip01]"]').val());
                $('[name="order_shipping_address[zip02]"]').val($('[name="user[zip02]"]').val());
                $('[name="order_shipping_address[pref_id]"]').val($('[name="user[pref_id]"]').val());
                $('[name="order_shipping_address[address1]"]').val($('[name="user[address1]"]').val());
                $('[name="order_shipping_address[address2]"]').val($('[name="user[address2]"]').val());
                $('[name="order_shipping_address[tel01]"]').val($('[name="user[tel01]"]').val());
                $('[name="order_shipping_address[tel02]"]').val($('[name="user[tel02]"]').val());
                $('[name="order_shipping_address[tel03]"]').val($('[name="user[tel03]"]').val());
                $('[name="order_shipping_address[fax01]"]').val($('[name="user[fax01]"]').val());
                $('[name="order_shipping_address[fax02]"]').val($('[name="user[fax02]"]').val());
                $('[name="order_shipping_address[fax03]"]').val($('[name="user[fax03]"]').val());
            });

            // 支払い方法変更時
            // $('[name="order[payment_id]"]').change (function() {
            //     $commission = $('[name="order[payment_id]"] option:selected').data('commission');
            //     $before_commission = $('[name="order[fee]"]').val();
            //     $total = $('[name="order[total]"]').val();
            //
            //     $('[name="order[fee]"]').val($commission);
            //
            //     if ($commission != 0) {
            //        $('[name="order[total]"]').val($total - $before_commission + $commission);
            //    } else {
            //        $('[name="order[total]"]').val($total - $before_commission);
            //    }
            // });

        });
    </script>
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
                        <form method="post" action="{{ url('/order/confirm') }}" class="form_template" id="form1">
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

                            <input type="hidden" name="order_detail[ratio_id]" value="{{ $order_detail['ratio_id'] }}">
                            <input type="hidden" name="order_detail[price]" value="{{ $order_detail['price'] }}">
                            <input type="hidden" name="order_detail[price_id]" value="{{ $order_detail['price_id'] }}">
                            <input type="hidden" name="order_detail[option_price]" value="{{ $order_detail['option_price'] }}">
                            <input type="hidden" name="order_detail[tax_rate]" value="{{ $order_detail['tax_rate'] }}">
                            <input type="hidden" name="order_detail[sub_total]" value="{{ $order_detail['sub_total'] }}">
                            <input type="hidden" name="order_detail[quantity]" value="{{ $order_detail['quantity'] }}">

                            <input type="hidden" name="order[shipping_cost]" value="{{ $order['shipping_cost'] }}">

                            <h5 class="ttl02">会員情報（注文者）</h5>
                            <div class="form__bd">
                                <dl>
                                    <dt>お名前</dt>
                                    <dd>
                                        <input type="text" name="name" value="{{ old('name', $user['name']) }}" readonly>

                                        <input type="hidden" name="user[id]" value="{{ $user['id'] }}">
                                        <input type="hidden" name="user[name]" value="{{ $user['name'] }}">
                                        <input type="hidden" name="user[name_kana]" value="{{ $user['name_kana'] }}">
                                        <input type="hidden" name="user[company_name]" value="{{ $user['company_name'] }}">
                                        <input type="hidden" name="user[zip01]" value="{{ !empty($user['zip_code']) ? explode("-", $user['zip_code'])[0] : "" }}">
                                        <input type="hidden" name="user[zip02]" value="{{ !empty($user['zip_code']) ? explode("-", $user['zip_code'])[1] : "" }}">
                                        <input type="hidden" name="user[pref_id]" value="{{ $user['pref_id'] }}">
                                        <input type="hidden" name="user[address1]" value="{{ $user['address1'] }}">
                                        <input type="hidden" name="user[address2]" value="{{ $user['address2'] }}">
                                        <input type="hidden" name="user[tel01]" value="{{ !empty($user['tel']) ? explode("-", $user['tel'])[0] : "" }}">
                                        <input type="hidden" name="user[tel02]" value="{{ !empty($user['tel']) ? explode("-", $user['tel'])[1] : "" }}">
                                        <input type="hidden" name="user[tel03]" value="{{ !empty($user['tel']) ? explode("-", $user['tel'])[2] : "" }}">
                                        <input type="hidden" name="user[fax01]" value="{{ !empty($user['fax']) ? explode("-", $user['fax'])[0] : "" }}">
                                        <input type="hidden" name="user[fax02]" value="{{ !empty($user['fax']) ? explode("-", $user['fax'])[1] : "" }}">
                                        <input type="hidden" name="user[fax03]" value="{{ !empty($user['fax']) ? explode("-", $user['fax'])[2] : "" }}">
                                    </dd>
                                </dl>
                            </div>
                            <h5 class="ttl02">お届け先のご住所<input type="button" value="注文者情報をコピー" id="copy_user"></h5>
                            <div class="form__bd">
                                <dl>
                                    <dt><span>必須</span>お名前</dt>
                                    <dd>
                                        <input type="text" name="order_shipping_address[name]" value="{{ old('order_shipping_address.name') }}" required>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt><span>必須</span>お名前（フリガナ）</dt>
                                    <dd>
                                        <input type="text" name="order_shipping_address[name_kana]" value="{{ old('order_shipping_address.name_kana') }}" required>
                                        @if($errors->has('name_kana'))
                                            <div>
                                                <span class="error">{{$errors->first('name_kana')}}</span>
                                            </div>
                                        @endif
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>会社名</dt>
                                    <dd>
                                        <input type="text" name="order_shipping_address[company_name]" value="{{ old('order_shipping_address.company_name') }}">
                                    </dd>
                                </dl>
                                <dl class="address_num">
                                    <dt><span>必須</span>郵便番号</dt>
                                    <dd>
                                        <input name="order_shipping_address[zip01]" id="zip1" type="text" value="{{ old('order_shipping_address.zip01') }}"> 
                                        - 
                                        <input name="order_shipping_address[zip02]" id="zip2" type="text" value="{{ old('order_shipping_address.ip02') }}">
                                        <input type="button" id="btn" name="btn" value="郵便番号から自動入力">
                                    </dd>
                                </dl>
                                <dl class="innerlist_address add02">
                                    <dt><span>必須</span>都道府県</dt>
                                    <dd>
                                        <select name="order_shipping_address[pref_id]" id="pref_id">
                                            <option value="none" selected="selected">選択して下さい</option>
                                            @foreach(config('pref') as $key => $name)
                                                <option value="{{ $key }}" @if(old('pref_id') == $key) selected @endif>
                                                    {{$name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt><span>必須</span>住所（市区町村番地）</dt>
                                    <dd>
                                        <input type="text" name="order_shipping_address[address1]" value="{{ old('order_shipping_address.address1') }}" id="address1" required>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>住所（建物名・マンション名）</dt>
                                    <dd>
                                        <input type="text" name="order_shipping_address[address2]" value="{{ old('order_shipping_address.address2') }}">
                                    </dd>
                                </dl>
                                <dl>
                                    <dt><span>必須</span>電話番号</dt>
                                    <dd>
                                        <ul class="innerlist_tel">
                                            <li>
                                                <input name="order_shipping_address[tel01]" id="" type="number" required>
                                                 - 
                                                <input name="order_shipping_address[tel02]" id="" type="number" required> 
                                                - 
                                                <input name="order_shipping_address[tel03]" id="" type="number" required>
                                            </li>
                                        </ul>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>FAX番号</dt>
                                    <dd>
                                        <ul class="innerlist_tel">
                                            <li>
                                                <input name="order_shipping_address[fax01]" id="" type="number">
                                                 - 
                                                <input name="order_shipping_address[fax02]" id="" type="number"> 
                                                - 
                                                <input name="order_shipping_address[fax03]" id="" type="number">
                                            </li>
                                        </ul>
                                    </dd>
                                </dl>
                            </div>
                            <h5 class="ttl02">お支払情報</h5>
                            <div class="form__bd">
                                <dl>
                                    <dt>お支払い方法</dt>
                                    <dd>
                                        <select class="order_pay" name="order[payment_id]" required>
                                            <option value=""></option>
                                            @foreach(\App\Models\Payment::all() as $payment)
                                                <option value="{{ $payment->id }}" {{ old('order.payment_id') ==  $payment->id ? "selected" : ""}}>
                                                    {{ $payment->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </dd>
                                </dl>
                            </div>

                            <h5 class="ttl02">料金</h5>
                            <div class="form__bd">
                                <dl>
                                    <dt>合計金額（税込）</dt>
                                    <dd>
                                        <input type="text" class="order_total" name="order[total]" value="{{ $order['total'] }}" readonly>
                                        <input type="hidden" name="order[sub_total]" value="{{ $order['sub_total'] }}" readonly>
                                    </dd>
                                </dl>
                            </div>
                            <ul class="sendarea type_css">
                                <li><input name="submit" value="確認する" class="btn_css_check" type="submit"></li>
                            </ul>
                        </form>
                    </div>
                </div>
            </section><!-- /.search -->
        </div>
    </main>
    <!-- /.l-main -->
@endsection
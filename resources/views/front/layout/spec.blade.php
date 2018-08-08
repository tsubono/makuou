@extends('front.layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script>

        $(function () {
            $("#optcheck").change(function () {
                optCheckVal = $("#optcheck:checked").val();

                if (optCheckVal == "1") {
                    $("#optinput1").removeAttr("disabled").removeClass("bg_disabled").addClass("bg_white");
                    $("#optinput2").removeAttr("disabled").removeClass("bg_disabled").addClass("bg_white");
                } else {
                    $("#optinput1").attr("disabled", "disabled").removeClass("bg_white").addClass("bg_disabled");
                    $("#optinput2").attr("disabled", "disabled").removeClass("bg_white").addClass("bg_disabled");
                }
            }).trigger("change");
        });

        //チェックボックスとラジオボタン連動
        function checkBox() {
            if ($('#polecheck').is(':checked')) {
                $('[name="order_detail[pole]"]:first').prop('checked', true);
            } else {
                $('[name="order_detail[pole]"]').prop('checked', false);
            }
        }

        function radioButton() {

            $('[name="order_detail[pole]"]').each(function () {
                if ($(this).is(':checked')) {
                    $('#polecheck').prop('checked', true);
                }
            });
        }


        // オプション金額
        function updateOptionPrice() {
            var option_price = 0;
            $('.option_ids').each(function () {
                if (this.checked) {
                    option_price += parseInt($(this).attr('data-price'));
                }
            });
            $('[name="order_detail[option_price]"]').val(option_price);

            updateTotal();
        }
        updateOptionPrice();
        // オプション変更時
        $('.option_ids').change(function () {
            updateOptionPrice();
        });

        $('.prices').change (function() {
            updatePrice();
        });
        updatePrice();

        // 金額
        function updatePrice() {

            $('[name="order_detail[price]"]').val(0);
            $('[name="order_detail[price_id]"]').val("");

            var ratio_id = $('[name="order_detail[ratio_id]"]').val();
            var size_id = $('[name="order_detail[size_id]"]:checked').val();
            var clothe_id = $('[name="order_detail[clothe_id]"]:checked').val();

            $.ajax({
                type: 'post',
                data: {
                    'size_id': size_id,
                    'ratio_id': ratio_id,
                    'clothe_id': clothe_id,
                    '_token': '{{csrf_token()}}'
                },
                url: '{{ url('/ajaxGetPrice') }}'
            }).done(function (data) {
                var price = $.parseJSON(data)['price'];

                if (price != null && price != undefined) {
                    $('[name="order_detail[price]"]').val(parseInt(price['price']));
                    $('[name="order_detail[price_id]"]').val(price['id']);
                } else {
                    $('[name="order_detail[price]"]').val(0);
                    $('[name="order_detail[price_id]"]').val(0);
                }

                updateTotal();

            }).fail(function (data) {
            });
        }

        // 個数変更時
        $('[name="order_detail[quantity]"]').change (function() {
            updateTotal();
        });

        // 合計金額
        function updateTotal() {

            var price = $('[name="order_detail[price]"]').val();

            // 値段設定が不正の場合は強制的に0にする
            if (price == 0) {
                $('[name="order_detail[sub_total]"]').val(0);
                $('[name="order[sub_total]"]').val(0);
                $('[name="order[total]"]').val(0);
                return;
            }

            var option_price = $('[name="order_detail[option_price]"]').val();
            var quantity = $('[name="order_detail[quantity]"]').val();
            var tax_rate = $('[name="order_detail[tax_rate]"]').val();
            var shipping_cost = $('[name="order[shipping_cost]"]').val();

            if (option_price == "") {
                option_price = 0;
            }
            if (quantity == "") {
                quantity = 0;
            }
            if (shipping_cost == "") {
                shipping_cost = 0;
            }

            // ( 金額 + オプション金額 ) * 数量 * ( 1 + 税率 / 100 )
            var total = (parseInt(price) + parseInt(option_price)) * parseInt(quantity) * (1 + parseInt(tax_rate) / 100);
            // 送料
            total += parseInt(shipping_cost);

            $('[name="order_detail[sub_total]"]').val(total);
            $('[name="order[sub_total]"]').val(total);
            $('[name="order[total]"]').val(total);
            // $('[name="order[payment_total]"]').val(total);
        }
    </script>

@endpush

@section('title', '仕様を決める')

@section('content')
    <main class="l-main spec">
        <div class="l-inner">
            <section class="layout confirm">
                <h1 class="main__title">
                    <img src="{{asset("assets/img/layout/title_spec.png")}}" alt="仕様を決める">
                </h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url('/')}}">HOME</a></li>
                        <li><a href="{{ url('/layout/'. $order_detail['product_id']) }}">レイアウトを作る</a></li>
                        <li><a>デザイン確認</a></li>
                        <li>仕様を決める</li>
                    </ul>
                    <form method="post" action="{{ url('layout/confirm2') }}" class="form_template confirm" id="form1">
                        @csrf
                        <input type="hidden" name="order_detail[designed_filename]"
                               value="{{ $order_detail['designed_filename'] }}">
                        <input type="hidden" name="order_detail[designed_image]"
                               value="{{ $order_detail['designed_image'] }}">
                        <input type="hidden" name="order_detail[uploaded_files]"
                               value="{{ $order_detail['uploaded_files'] }}">
                        <input type="hidden" name="order_detail[json]" value="{{ $order_detail['json'] }}">
                        <input type="hidden" name="order_detail[design_name]"
                               value="{{ $order_detail['design_name'] }}">
                        <input type="hidden" name="order_detail[note]" value="{{ $order_detail['note'] }}">
                        <input type="hidden" name="order[user_id]" value="{{ $order['user_id'] }}">
                        <input type="hidden" name="order_detail[product_id]" value="{{ $order_detail['product_id'] }}">

                        <input type="hidden" name="order[sub_total]" value="">

                        <input type="hidden" name="order_detail[ratio_id]" value="{{ $order_detail['ratio_id'] }}">
                        <input type="hidden" name="order_detail[price]" value="0">
                        <input type="hidden" name="order_detail[price_id]" value="">
                        <input type="hidden" name="order_detail[option_price]" value="">
                        <input type="hidden" name="order_detail[tax_rate]" value="8">
                        <input type="hidden" name="order_detail[sub_total]" value="">


                        <h2 class="ttl01">サイズを決める</h2>
                        <div class="form__bd">
                            <dl>
                                <dt>サイズ</dt>
                                <dd>
                                    @foreach (\App\Models\Size::all() as $size)
                                        <label>
                                            <input type="radio" name="order_detail[size_id]" value="{{ $size->id }}" class="prices">
                                            {{ $size->name }}
                                        </label>
                                    @endforeach
                                </dd>
                            </dl>
                        </div>
                        <div class="btn_two cf">
                            <div class="btn_return"><a href="/price/" target="_blank"><p>価格表</p></a></div>
                            <div class="btn_return"><a href="/size/" target="_blank"><p>おすすめサイズ</p></a></div>
                        </div>
                        <h2 class="ttl01">素材を決める</h2>
                        <div class="form__bd">
                            <dl class="material">
                                <dt>素材</dt>
                                <dd>
                                    <ul>
                                        <li>
                                            @foreach (\App\Models\Clothe::all() as $clothe)
                                                <label>
                                                    <input type="radio" name="order_detail[clothe_id]" value="{{ $clothe->id }}" class="prices">
                                                    {{ $clothe->name }}
                                                </label>
                                            @endforeach
                                        </li>

                                    </ul>
                                </dd>
                            </dl>
                        </div>
                        <div class="btn_two">
                            <div class="btn_return"><a href="/price/" target="_blank"><p>価格表</p></a></div>
                            <div class="btn_return"><a href="/material/" target="_blank"><p>素材紹介</p></a></div>
                        </div>
                        <h2 class="ttl01">オプションを選ぶ</h2>
                        <div class="form__bd">
                            <dl>
                                <dt>ハトメの位置</dt>
                                <dd>
                                    <label><input type="radio" name="order_detail[hatome]" value="通常" checked="checked">通常</label>
                                    <label><input type="radio" name="order_detail[hatome]" value="上辺のみ">上辺のみ</label>
                                    <label><input type="radio" name="order_detail[hatome]" value="左辺のみ">左辺のみ</label>
                                    <label><input type="radio" name="order_detail[hatome]" value="ハトメなし">ハトメなし</label>
                                </dd>
                            </dl>
                            <dl>
                                <dt>付属品</dt>
                                <dd>
                                    <ul class="option">
                                        <li class="rope">
                                            <p><label><input type="checkbox" name="order_detail[lope_flg]" id="optcheck" value="1">ロープ</label>
                                            </p>
                                            <ul class="cf">
                                                <li><input type="text" name="order_detail[lope_1]" id="optinput1"></li>
                                                <li><input type="text" name="order_detail[lope_2]" id="optinput2"></li>
                                            </ul>
                                        </li>
                                        <li class="pole">
                                            <p><label><input type="checkbox" name="order_detail[pole_flg]" id="polecheck"
                                                             value="1" onclick="checkBox()">旗用ポール</label></p>
                                            <div>
                                                <label><input type="radio" name="order_detail[pole]" value="2m・3段伸縮"
                                                              onclick="radioButton()">2m・3段伸縮</label>
                                                <label><input type="radio" name="order_detail[pole]" value="3m・3段伸縮"
                                                              onclick="radioButton()">3m・3段伸縮</label>
                                                <label><input type="radio" name="order_detail[pole]" value="4m・4段伸縮"
                                                              onclick="radioButton()">4m・4段伸縮</label>
                                                <label><input type="radio" name="order_detail[pole]" value="5m・4段伸縮"
                                                              onclick="radioButton()">5m・4段伸縮</label>
                                            </div>
                                        </li>
                                    </ul>
                                </dd>
                            </dl>
                            <dl>
                                <dt>納期</dt>
                                <dd class="delivery">
                                    @foreach(config('const.nouki') as $key => $name)
                                        <label>
                                            <input type="radio" name="order_detail[nouki_id]" value="{{ $key }}"
                                                      @if ($key==1)checked="checked"@endif>
                                            {{ $name }}
                                        </label>
                                    @endforeach
                                  </dd>
                            </dl>
                            <dl>
                                <dt>その他オプション</dt>
                                <dd class="delivery">
                                    <label class="checkbox-inline">
                                        @foreach (\App\Models\Option::all() as $option)
                                            @if ($option->type=="1")
                                                <input type="checkbox" name="order_detail[option_ids][]"
                                                       value="{{ $option->id }}" class="option_ids"
                                                       data-price="{{ $option->price }}"
                                                       checked onclick='return false;'>
                                            @else
                                                <input type="checkbox" name="order_detail[option_ids][]"
                                                       value="{{ $option->id }}" class="option_ids"
                                                       data-price="{{ $option->price }}">
                                            @endif
                                            {{ $option->name }}
                                        @endforeach

                                    </label>
                                </dd>
                            </dl>
                            <dl>
                                <dt>送料</dt>
                                <dd>
                                    <label>
                                        <input type="text" name="order[shipping_cost]" value="{{ config('const.shipping_cost') }}" readonly>
                                    </label>
                                </dd>
                            </dl>
                        </div>
                        <h2 class="ttl01">個数を決める</h2>
                        <div class="form__bd">
                            <dl>
                                <dt>個数</dt>
                                <dd>
                                    <label>
                                        <input type="number" name="order_detail[quantity]" value="1" reaquired>
                                    </label>
                                </dd>
                            </dl>
                            <dl>
                                <dt>合計金額</dt>
                                <dd>
                                    <label>
                                        <input type="text" name="order[total]" value="0" readonly>
                                    </label>
                                </dd>
                            </dl>
                        </div>
                        <div class="btn_one">
                            <div class="btn_return"><a href="/option/" target="_blank"><p>オプションについて</p></a></div>
                        </div>
                        <div class="btn"><input type="submit" name="submit" value="確認画面へ"/></div>
                    </form>
                </div>
            </section>
            <!-- /.layout -->
        </div>
    </main>
    <!-- /.l-main -->
@endsection
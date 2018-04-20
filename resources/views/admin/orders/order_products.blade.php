<div class="item_box" id="item_box_{{ $index }}" data-index="{{ $index }}">

    <input type="hidden" name="order_details[{{ $index }}][id]" value="">

    <input type="hidden" name="order_details[{{ $index }}][order_id]" value="{{ $order_id or 0 }}">
    <input type="hidden" name="order_details[{{ $index }}][product_id]" value="{{ $product->id }}">
    <input type="hidden" name="order_details[{{ $index }}][sub_total]" value="0">
    <input type="hidden" name="order_details[{{ $index }}][product_title]" value="{{ $product->title }}">
    <input type="hidden" name="order_details[{{ $index }}][image]" value="{{ $product->image }}">
    <input type="hidden" name="order_details[{{ $index }}][json]" id="order_details_json_{{ $product->id }}"
           class="order_details_json" value="{{ $json }}" data-index="{{ $index }}" data-product_id="{{ $product->id }}"
           data-name="{{ $product->title }}" data-image="{{ $product->image }}">

    <input type="hidden" name="order_details[{{ $index }}][designed_filename]" value="">
    <input type="hidden" name="order_details[{{ $index }}][designed_image]" value="">
    <input type="hidden" name="order_details[{{ $index }}][uploaded_files]" value="">
    <input type="hidden" name="order_details[{{ $index }}][designed_json]" value="">
    <input type="hidden" name="order_details[{{ $index }}][json_text]" value="">
    <input type="hidden" name="order_details[{{ $index }}][width]"
           value="{{ $product->ratio->width * 600 }}">
    <input type="hidden" name="order_details[{{ $index }}][height]"
           value="{{ $product->ratio->height * 600 }}">

    <div class="item_detail">
        <div class="item_name_area">
            <strong class="item_name">{{ $product->title }}</strong><br>
        </div>
        <div class="item_image_area col-sm-12">
            <div class="design_image_area col-sm-12">
                【 テンプレート画像 】<br>
                <img src="{!! asset(env('PUBLIC', ''). $product->image) !!}"
                     class="max-w-150">
                <a class="btn btn-default design_edit_btn"
                   id="design_edit_btn_{{ $product->id }}"
                   data-name="{{ $product->name }}"
                   data-id="{{ $product->id }}"
                   data-image="{{ $product->image }}"
                   data-json="{{ $json }}"
                   data-width="{{ $product->ratio->width * 600 }}"
                   data-height="{{ $product->ratio->height * 600 }}"
                >
                    編集する
                </a>
            </div>
            <div class="clearfix"></div>
            <br><br>
        </div>
        @inject('price_service', 'App\Services\PriceService')
        <div class="col-sm-12">
            <table class="table">
                <tr>
                    <th>サイズ</th>
                    <th>比率</th>
                    <th>生地</th>
                    <th class="w300">オプション</th>
                    <th>オプション金額</th>
                    <th>金額</th>
                </tr>
                <tr>
                    <td>
                        <select name="order_details[{{ $index }}][size_id]" class="form-control size_id" data-index="{{ $index }}" required>
                            <option value=""></option>
                            @foreach($price_service->getSizes() as $key => $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="order_details[{{ $index }}][ratio_id]" class="form-control ratio_id" data-index="{{ $index }}" required>
                            <option value="" class="empty"></option>
                        </select>
                    </td>
                    <td>
                        <select name="order_details[{{ $index }}][clothe_id]" class="form-control clothe_id" data-index="{{ $index }}" required>
                            <option value="" class="empty"></option>
                        </select>
                    </td>
                    <td>
                        <div class="checkbox form-group" id="option_ids_area_{{ $index }}">
                            @foreach (\App\Models\Option::all() as $option)
                                <label class="checkbox-inline">
                                    @if ($option->type=="1")
                                        <input type="checkbox" name="order_details[{{ $index }}][option_ids][]" value="{{ $option->id }}"
                                               class="option_ids option_ids_{{ $index }}" data-index="{{ $index }}" data-price="{{ $option->price }}"
                                               @if ($option->type=="1") checked onclick='return false;'@endif>
                                    @else
                                        <input type="checkbox" name="order_details[{{ $index }}][option_ids][]" value="{{ $option->id }}"
                                               class="option_ids option_ids_{{ $index }}" data-index="{{ $index }}" data-price="{{ $option->price }}"
                                                {{ (!empty($order_details["option_ids"])?in_array($option->id, implode(',', $order_details["option_ids"])):false)?"checked":"" }}>
                                    @endif
                                    {{ $option->name }}
                                </label>
                            @endforeach
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">¥ </span>
                            <input type="number" name="order_details[{{ $index }}][option_price]"  value="0" class="form-control">
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">¥ </span>
                            <input type="number" name="order_details[{{ $index }}][price]"  value="0" class="form-control" required>
                            <input type="hidden" name="order_details[{{ $index }}][price_id]"  value="">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row">
            <div class="col-md-4 col-lg-3 form-group form-inline text-right">
                <span class="item_quantity">
                    数量：
                    <input type="text" name="order_details[{{ $index }}][quantity]"
                           required="required" class="form-control" value="1">
                </span>
            </div>
            <div class="col-md-4 col-lg-3 form-group form-inline text-right">
                <span class="item_tax">
                    税率：
                    <span class="input-group">
                        <input type="text" name="order_details[{{ $index }}][tax_rate]"
                               required="required" class="form-control" value="8">
                        <span class="input-group-addon">%</span>
                    </span>
                </span>
            </div>
            <div class="col-md-12 col-lg-3 item_sub_total text-right" id="item_sub_total_{{ $index }}">
                <span>小計：</span>
                ¥ <span class="sub_total_disp">0</span>
                <input type="hidden" name="order_details[{{ $index }}][sub_total]" value="0">
            </div>
        </div>
    </div>
    <div class="icon_edit delete-btn">
        <button type="button" class="btn btn-default btn-sm delete-item"
                data-index="{{ $index }}" data-id="">
            削除
        </button>
    </div>
</div>

<script>
    // 商品削除押下時
    $('.delete-item').click(function () {
        var index = $(this).attr('data-index');
        $('#item_box_' + index).remove();
    });

    // 商品のデザイン編集ボタン押下時
    $('.design_edit_btn').click(function () {
        $('#design-modal').find('.modal-title').text($(this).attr('data-name') + "デザイン編集");

        $('#productApp').scope().initFabric($(this).attr('data-width'), $(this).attr('data-height'));
        $('#productApp').scope().loadByJson($(this).attr('data-json'));

        // // 既に読み込み、編集している場合
        // if ($(this).attr('data-json') != "") {
        //     $('#productApp').scope().loadByJson($(this).attr('data-json'));
        // // 初回読み込み時
        // } else {
        //     $('#productApp').scope().loadProduct($(this).attr('data-name'), $(this).attr('data-image'), $(this).attr('data-id'));
        // }
        // 編集中の商品ID更新
        $('#productApp').scope().defaultProductId = $(this).attr('data-id');

        $('#design-modal').modal();
    });

    // デザインモーダルの確定押下時
    $('#save_design').click(function () {
        var product_id = $('#productApp').scope().defaultProductId;
        var json = $('#productApp').scope().getDesignJson();

        $('#design_edit_btn_' + product_id).attr('data-json', json);
        $('#order_details_json_' + product_id).val(json);

        $('#design-modal').modal('hide');
    });

    // デザインモーダルのキャンセル押下時
    $('#cancel_design').click(function () {
        $('#design-modal').modal('hide');
    });

    // サイズ変更時
    $('[name="order_details[{{ $index }}][size_id]"]').change (function() {
        var index = $(this).attr('data-index');

        // リセット
        $('[name="order_details['+index+'][ratio_id]"]').find('option:not(.empty)').remove();
        $('[name="order_details['+index+'][clothe_id]"]').find('option:not(.empty)').remove();
        $('[name="order_details['+index+'][price]"]').val(0);
        $('[name="order_details['+index+'][price_id]"]').val("");

        if ($(this).val() != "") {
            $.ajax({
                type: 'post',
                data: {
                    'size_id': $(this).val(),
                    '_token': '{{csrf_token()}}'
                },
                url: '{{ url('/admin/product-setting/prices/ajaxGetRatios') }}'
            }).done(function (data) {
                var ratios = $.parseJSON(data)['ratios'];
                // 比率選択肢更新
                for (var i=0; i < ratios.length; i++) {
                    var option = $('<option>')
                        .val(ratios[i]['id'])
                        .text(ratios[i]['height'] + ' : ' + ratios[i]['width']);
                    $('[name="order_details['+index+'][ratio_id]"]').append(option);
                }

                updateOrderDetailSubtotal(index);

            }).fail(function (data) {
            });
        }
    });

    // 比率変更時
    $('[name="order_details[{{ $index }}][ratio_id]"]').change (function() {
        var index = $(this).attr('data-index');

        // リセット
        $('[name="order_details['+index+'][clothe_id]"]').find('option:not(.empty)').remove();
        $('[name="order_details['+index+'][price]"]').val(0);
        $('[name="order_details['+index+'][price_id]"]').val("");

        if ($(this).val() != "") {
            $.ajax({
                type: 'post',
                data: {
                    'size_id': $('[name="order_details['+index+'][size_id]"]').find('option:selected').val(),
                    'ratio_id': $(this).val(),
                    '_token': '{{csrf_token()}}'
                },
                url: '{{ url('/admin/product-setting/prices/ajaxGetClothes') }}'
            }).done(function (data) {
                var clothes = $.parseJSON(data)['clothes'];
                // 生地選択肢更新
                for (var i=0; i < clothes.length; i++) {
                    var option = $('<option>')
                        .val(clothes[i]['id'])
                        .text(clothes[i]['name'])
                        .attr('data-id', 1);
                    $('[name="order_details['+index+'][clothe_id]"]').append(option);
                }

                updateOrderDetailSubtotal(index);

            }).fail(function (data) {
            });
        }
    });

    // 生地変更時
    $('[name="order_details[{{ $index }}][clothe_id]"]').change (function() {

        var index = $(this).attr('data-index');
        $('[name="order_details['+index+'][price]"]').val(0);
        $('[name="order_details['+index+'][price_id]"]').val("");

        if ($(this).val() != "") {
            $.ajax({
                type: 'post',
                data: {
                    'size_id': $('[name="order_details['+index+'][size_id]"]').find('option:selected').val(),
                    'ratio_id': $('[name="order_details['+index+'][ratio_id]"]').find('option:selected').val(),
                    'clothe_id': $(this).val(),
                    '_token': '{{csrf_token()}}'
                },
                url: '{{ url('/admin/product-setting/prices/ajaxGetPrice') }}'
            }).done(function (data) {
                var price = $.parseJSON(data)['price'];
                // 金額更新
                $('[name="order_details['+index+'][price]"]').val(parseInt(price['price']));
                $('[name="order_details['+index+'][price_id]"]').val(price['id']);

                updateOrderDetailSubtotal(index);

            }).fail(function (data) {
            });
        }
    });

    // 初期表示時のオプション値段計算
    var form_option_price = $('[name="order_details[{{ $index }}][option_price]"]');
    var option_price = 0;
    $('.option_ids_{{ $index }}').each(function () {
        if (this.checked) {
            option_price += parseInt($(this).attr('data-price'));
        }
    });
    form_option_price.val(option_price);
    updateOrderDetailSubtotal({{ $index }});
    updateOrderSubtotal();

    // オプション変更時
    $('.option_ids').change(function () {
        var index = $(this).attr('data-index');

        var form_option_price = $('[name="order_details[' + index + '][option_price]"]');
        var option_price = 0;

        $('.option_ids_'+index).each(function () {
            if (this.checked) {
                option_price += parseInt($(this).attr('data-price'));
            }
        });

        form_option_price.val(option_price);
        updateOrderDetailSubtotal(index);
        updateOrderSubtotal();
    });

    // オプション金額手入力変更時
    $('[name="order_details[{{ $index }}][option_price]"]').change (function() {
        updateOrderDetailSubtotal({{ $index }});
    });

    // 金額手入力変更時
    $('[name="order_details[{{ $index }}][price]"]').change (function() {
        updateOrderDetailSubtotal({{ $index }});
    });

    // 数量変更時
    $('[name="order_details[{{ $index }}][quantity]"]').change (function() {
        updateOrderDetailSubtotal({{ $index }});
    });

    // 税率変更時
    $('[name="order_details[{{ $index }}][tax_rate]"]').change (function() {
        updateOrderDetailSubtotal({{ $index }});
    });

    // 商品詳細ごとの小計金額更新
    function updateOrderDetailSubtotal(index) {

        var price = $('[name="order_details['+index+'][price]"]').val();
        var option_price = $('[name="order_details['+index+'][option_price]"]').val();
        var quantity = $('[name="order_details['+index+'][quantity]"]').val();
        var tax_rate = $('[name="order_details['+index+'][tax_rate]"]').val();

        // ( 金額 + オプション金額 ) * 数量 * ( 1 + 税率 / 100 )
        var sub_total = ( parseInt(price) + parseInt(option_price) ) * parseInt(quantity) * ( 1 + parseInt(tax_rate) / 100);
        $('#item_sub_total_'+index).find('.sub_total_disp').text(sub_total.toLocaleString());
        $('[name="order_details['+index+'][sub_total]"]').val(sub_total);

        // 受注小計金額合計を更新しておく
        updateOrderSubtotal();
    }

    // 受注小計金額合計更新
    function updateOrderSubtotal() {
        var sub_total = 0;

        $('.item_box').each (function() {
            var index = $(this).attr('data-index');

            sub_total += parseInt($('[name="order_details['+index+'][sub_total]"]').val());
        });
        $('[name="order[sub_total]"]').val(sub_total);
        $('#order_sub_total_disp').text("¥ " + sub_total.toLocaleString());

        updateTotal();
    }

    // 受注合計金額更新
    function updateTotal() {

        // 小計 - 値引き + 送料 + 手数料
        var total = parseInt($('[name="order[sub_total]"]').val()) - parseInt($('[name="order[discount]"]').val())
                + parseInt($('[name="order[shipping_cost]"]').val()) + parseInt($('[name="order[fee]"]').val());

        $('#order_total_disp').text("¥ " + total.toLocaleString());
        $('[name="order[total]"]').val(total);
    }

    // 値引き変更時
    $('[name="order[discount]"]').change (function() {
        updateTotal();
    });

    // 送料変更時
    $('[name="order[shipping_cost]"]').change (function() {
        updateTotal();
    });

    // 手数料変更時
    $('[name="order[fee]"]').change (function() {
        updateTotal();
    });


</script>
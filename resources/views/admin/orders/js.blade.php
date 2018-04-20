<script>
    window.onload = function () {

        @if (!$editFlg)
        @if (!empty(old('user.id')))
        $('.is_new').css('display', 'none');
        @endif
        @else
        @if (!empty(old('order.id')) && empty(old('user.id')))
        $('#user_id_disp').text("");
        @else
        $('.is_new').css('display', 'none');
        $('.is_new').find('input').attr("required", false);
        @endif
        @endif

        // 郵便番号から自動入力
        $('#user-zip-btn').click(function () {
            AjaxZip3.zip2addr('user[zip01]', 'user[zip02]', 'user[pref_id]', 'user[address1]');
        });
        $('#order_shipping_address-zip-btn').click(function () {
            AjaxZip3.zip2addr('order_shipping_address[zip01]', 'order_shipping_address[zip02]', 'order_shipping_address[pref_id]', 'order_shipping_address[address1]');
        });

        // 会員検索ボタン押下時
        $('#user_search_btn').click(function () {

            $('.user_result_area').html('');

            $.ajax({
                type: 'post',
                data: {
                    'search': $('#user_search_input').val(),
                    '_token': '{{csrf_token()}}'
                },
                url: '{{ url('/admin/users/ajaxSearchList') }}'
            }).done(function (data) {
                $('.user_result_area').html(data);
            }).fail(function (data) {
            });
        });

        // 注文者情報リセットボタン押下時
        $('#user_reset').click(function () {
            $('.user_section').find('input').each(function () {
                $(this).val("");
            });
            $('#user_id_disp').text("");

            $('.is_new').css('display', 'block');
            $('.is_new').find('input').attr("required", true);
        });

        // 商品の追加ボタン押下時
        $('#product_search_btn').click(function () {

            $('.product_result_area').html('');

            $.ajax({
                type: 'post',
                data: {
                    'search': $('#product_search_input').val(),
                    'category_search': $('#product_category_search_input').val(),
                    '_token': '{{csrf_token()}}',
                    'user_id': $('[name="user[id]"]').val(),
                    'order_id': 0
                },
                url: '{{ url('/admin/products/ajaxSearchList') }}'
            }).done(function (data) {
                $('.product_result_area').html(data);
            }).fail(function (data) {
            });
        });

        // 商品削除押下時
        $('.delete-item').click(function () {
            var index = $(this).attr('data-index');
            $('#item_box_' + index).remove();

            var deleted_order_detail_ids = $('[name=deleted_order_detail_ids]').val();
            var deleted_order_detail_ids_array = deleted_order_detail_ids.split(',');
            if ($(this).attr('data-id') != "") {
                deleted_order_detail_ids_array.push($(this).attr('data-id'));
            }
            deleted_order_detail_ids = deleted_order_detail_ids_array.join(',');

            $('[name=deleted_order_detail_ids]').val(deleted_order_detail_ids);
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

        // 商品のデザイン編集ボタン押下時
        $('.design_edit_btn').click(function () {
            $('#design-modal').find('.modal-title').text($(this).attr('data-name') + "デザイン編集");

            $('#productApp').scope().initFabric($(this).attr('data-width'), $(this).attr('data-height'));
            $('#productApp').scope().loadByJson($(this).attr('data-json'));

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

        // 登録ボタン押下時
        $('#form1').submit(function (event) {

            $("body").css("cursor", "progress");

            // 商品が選択されているかどうか
            if ($('.item_box').length == 0) {
                alert('商品を指定してください。');
                $("body").css("cursor", "auto");
                return false;
            }

            // まだバリデーションしていない場合
            if (!$('#productApp').scope().validatedFlg) {
                // HTMLでの送信をキャンセル
                event.preventDefault();

                // デザイン保存前にバリデーション
                validation($(this)).done(function (result) {
                    $("body").css("cursor", "auto");
                    // OK
                    if ($.parseJSON(result).status) {
                        //validatedFlg = true;
                        // デザインを保存してsubmit
                        $('#productApp').scope().saveByJson($('.item_box:first'));
                        // NG
                    } else {
                        $('#productApp').scope().validatedFlg = true;
                        // デザインを保存せずにsubmit(リダイレクトさせてエラー表示するため)
                        $('#form1').submit();
                    }
                }).fail(function (result) {
                });
            } else {
                jQuery("body").css("cursor", "auto");
            }
        });

        // ajaxでバリデーション
        function validation(form) {

            var token = "";

            for (var i = 0; i < form.serializeArray().length; i++) {
                if (form.serializeArray()[i].name == "_token") {
                    token = form.serializeArray()[i].value;
                }
            }
            return $.ajax({
                type: 'post',
                url: '{{ url('/admin/orders/ajaxValidation') }}',
                data: {
                    data: form.serialize(),
                    _token: token
                }
            }).success(function (data, status, headers, config) {
                return data.result;
            }).error(function (data, status, headers, config) {
                return false;
            });
        }

        // サイズ変更時
        $('.size_id').change(function () {
            var index = $(this).attr('data-index');
            updateRatio(index);
        });
        $('.size_id option:selected').each(function () {
            if ($(this).val()!="") {
                var index = $(this).parent('.size_id').attr('data-index');
                updateRatio(index);
            }
        });

        function updateRatio(index) {

            $('[name="order_details[' + index + '][ratio_id]"]').find('option:not(.empty)').remove();
            $('[name="order_details[' + index + '][clothe_id]"]').find('option:not(.empty)').remove();
            $('[name="order_details[' + index + '][price]"]').val(0);
            $('[name="order_details[' + index + '][price_id]"]').val("");

            var size_id = $('[name="order_details[' + index + '][size_id]"]').find('option:selected').val();
            if (size_id != "") {
                $.ajax({
                    type: 'post',
                    data: {
                        'size_id': size_id,
                        '_token': '{{csrf_token()}}'
                    },
                    url: '{{ url('/admin/product-setting/prices/ajaxGetRatios') }}'
                }).done(function (data) {
                    var ratios = $.parseJSON(data)['ratios'];
                    var old_ratio_id = $('[name="order_details[' + index + '][old_ratio_id]"]').val();

                    for (var i = 0; i < ratios.length; i++) {
                        var option = "";

                        if (ratios[i]['id'] == old_ratio_id) {
                            option = {value: ratios[i]['id'] , text:ratios[i]['height'] + ' : ' + ratios[i]['width'], selected:true};
                        } else {
                            option = {value: ratios[i]['id'] , text:ratios[i]['height'] + ' : ' + ratios[i]['width']};
                        }
                        var element = $('<option>', option);
                        $('[name="order_details[' + index + '][ratio_id]"]').append(element);
                    }

                    updateOrderDetailSubtotal(index);

                    if ($('#ratio_id_'+index).find('option:selected').val() != "") {
                        updateClothe(index);
                    }

                }).fail(function (data) {
                });
            }
        }

        // 比率変更時
        $('.ratio_id').change(function () {
            var index = $(this).attr('data-index');
            updateClothe(index);
        });

        function updateClothe(index) {

            $('[name="order_details[' + index + '][clothe_id]"]').find('option:not(.empty)').remove();
            $('[name="order_details[' + index + '][price]"]').val(0);
            $('[name="order_details[' + index + '][price_id]"]').val("");

            var ratio_id = $('[name="order_details[' + index + '][ratio_id]"]').find('option:selected').val();
            var size_id = $('[name="order_details[' + index + '][size_id]"]').find('option:selected').val();
            if (ratio_id != "") {
                $.ajax({
                    type: 'post',
                    data: {
                        'size_id': size_id,
                        'ratio_id': ratio_id,
                        '_token': '{{csrf_token()}}'
                    },
                    url: '{{ url('/admin/product-setting/prices/ajaxGetClothes') }}'
                }).done(function (data) {
                    var clothes = $.parseJSON(data)['clothes'];
                    var old_clothe_id = $('[name="order_details[' + index + '][old_clothe_id]"]').val();

                    for (var i = 0; i < clothes.length; i++) {
                        var option = "";

                        if (clothes[i]['id'] == old_clothe_id) {
                            option = {value: clothes[i]['id'] , text:clothes[i]['name'], selected:true};
                        } else {
                            option = {value: clothes[i]['id'] , text:clothes[i]['name']};
                        }
                        var element = $('<option>', option).attr('data-id', clothes[i]['id']);
                        $('[name="order_details[' + index + '][clothe_id]"]').append(element);
                    }

                    updateOrderDetailSubtotal(index);

                    if ($('#clothe_id_'+index).find('option:selected').val() != "") {
                        updatePrice(index);
                    }

                }).fail(function (data) {
                });
            }
        }

        // 生地変更時
        $('.clothe_id').change(function () {
            var index = $(this).attr('data-index');
            updatePrice(index);
        });

        function updatePrice(index) {
            $('[name="order_details[' + index + '][price]"]').val(0);
            $('[name="order_details[' + index + '][price_id]"]').val("");

            var clothe_id = $('[name="order_details[' + index + '][clothe_id]"]').find('option:selected').val();
            if (clothe_id != "") {
                $.ajax({
                    type: 'post',
                    data: {
                        'size_id': $('[name="order_details[' + index + '][size_id]"]').find('option:selected').val(),
                        'ratio_id': $('[name="order_details[' + index + '][ratio_id]"]').find('option:selected').val(),
                        'clothe_id': clothe_id,
                        '_token': '{{csrf_token()}}'
                    },
                    url: '{{ url('/admin/product-setting/prices/ajaxGetPrice') }}'
                }).done(function (data) {
                    var price = $.parseJSON(data)['price'];

                    $('[name="order_details[' + index + '][price]"]').val(parseInt(price['price']));
                    $('[name="order_details[' + index + '][price_id]"]').val(price['id']);

                    updateOrderDetailSubtotal(index);

                }).fail(function (data) {
                });
            }
        }

        // 初期表示時のオプション値段計算
        $('.item_box').each (function() {
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
        });
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
        $('.option_price').change (function() {
            var index = $(this).attr('data-index');
            updateOrderDetailSubtotal(index);
        });

        // 金額手入力変更時
        $('.price').change (function() {
            var index = $(this).attr('data-index');
            updateOrderDetailSubtotal(index);
        });

        // 数量変更時
        $('.quantity').change (function() {
            var index = $(this).attr('data-index');
            updateOrderDetailSubtotal(index);
        });

        // 税率変更時
        $('.tax_rate').change (function() {
            var index = $(this).attr('data-index');
            updateOrderDetailSubtotal(index);
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


    };

</script>
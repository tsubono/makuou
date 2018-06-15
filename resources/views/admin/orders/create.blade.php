@extends('admin.layouts.default')

@section('title', '受注登録 | 受注管理 | 幕王管理画面')

@section('content-header')
    <h1>
        受注管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/orders') }}">受注管理</a></li>
        <li class="active">受注登録</li>
    </ol>
@endsection

@section('content')
    <form class="form-horizontal" id="form1" action="{{ url('/admin/orders') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="order[id]" value="0">
        <input type="hidden" name="deleted_order_detail_ids" value="">

        <!-- ヘッダー部分 -->
        <section class="box box-default">
            <div class="box-header">
                <h3 class="box-title">受注登録</h3>
            </div>
            <div class="box-body">
                <fieldset>
                    <div class="form-group col-md-6 col-xs-12">
                        <label for="order-name" class="control-label col-md-3">
                            注文番号
                        </label>
                        <div class="col-md-6" style="padding: 5px;">
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <p>受注日：</p>
                        <p>入金日：</p>
                        <p>発送日：</p>
                        <p>更新日：</p>
                    </div>
                    <div class="form-group col-md-6 col-xs-12 order-status">
                        <label for="order-status" class="control-label col-md-3">
                            対応状況
                        </label>
                        <div class="col-md-6">
                            <select id="order-status" name="order[status]" class="form-control" required>
                                <option value=""></option>
                                @foreach (config('const.order.status') as $key => $status)
                                    <option value="{{ $key }}" {{ old('order.status')==$key?"selected":"" }}>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>
        </section>
        <!-- /ヘッダー部分 -->

        <!-- 会員情報 -->
        <section class="box box-default user_section">
            <!-- 会員情報ヘッダー -->
            <div class="box-header">
                <h3 class="box-title">注文者情報</h3>
                <button type="button" class="btn btn-md btn-default ml-30" data-toggle="modal"
                        data-target="#user-search-modal">
                    会員検索
                </button>
                <button type="button" class="btn btn-md btn-default ml-30" id="user_reset">
                    リセット
                </button>
            </div>
            <!-- /会員情報ヘッダー -->
            <!-- 会員情報ボディ -->
            <div class="box-body">
                <fieldset>
                    <div class="form-group">
                        <label for="order-id" class="control-label col-md-3">
                            会員ID
                        </label>
                        <input type="hidden" name="user[id]" value="{{ old('user.id') }}">
                        <div class="col-md-6" id="user_id_disp"></div>
                    </div>
                    <div class="form-group">
                        <label for="user-name" class="control-label col-md-3">
                            名前
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="user-name" name="user[name]" value="{{ old('user.name') }}"
                                   class="form-control" required placeholder=""/>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('name_kana') && $error_type=="user" ? 'has-error' : '' }}">
                        <label for="user-name_kana" class="control-label col-md-3">
                            名前（フリガナ）
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="user-name_kana" name="user[name_kana]"
                                   value="{{ old('user.name_kana') }}" class="form-control" required placeholder=""/>
                            @if ($errors->has('name_kana') && $error_type=="user")
                                @foreach ($errors->get('name_kana') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-company_name" class="control-label col-md-3">
                            会社名
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="user-company_name" name="user[company_name]"
                                   value="{{ old('user.company_name') }}" class="form-control" placeholder=""/>
                        </div>
                    </div>
                    <div class="form-group {{ ($errors->has('zip01')||$errors->has('zip02')) && $error_type=="user" ? 'has-error' : '' }}">
                        <label for="user-zip01" class="control-label col-md-3">
                            郵便番号
                        </label>
                        <div class="col-md-6 input_zip form-inline">
                            〒
                            <input type="number" id="user-zip01" name="user[zip01]" class="form-control"
                                   value="{{ old('user.zip01') }}" required>
                            -
                            <input type="number" id="user-zip02" name="user[zip02]" class="form-control"
                                   value="{{ old('user.zip02') }}" required>
                            <span>
                                <button type="button" id="user-zip-btn"
                                        class="btn btn-default btn-sm">郵便番号から自動入力</button>
                            </span>
                            @if ($errors->has('zip01') && $error_type=="user")
                                @foreach ($errors->get('zip01') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            @if ($errors->has('zip02') && $error_type=="user")
                                @foreach ($errors->get('zip02') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-pref_id" class="control-label col-md-3">
                            都道府県
                        </label>
                        <div class="col-md-6">
                            <select id="user-pref_id" name="user[pref_id]" class="form-control" required>
                                @foreach(config('pref') as $key => $name)
                                    <option value="{{ $key }}" {{ old('user.pref_id') == $key ? "selected" : "" }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-address1" class="control-label col-md-3">
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="user-address1" name="user[address1]"
                                   value="{{ old('user.address1') }}" class="form-control" required placeholder="市区町村"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-address2" class="control-label col-md-3">
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="user-address2" name="user[address2]"
                                   value="{{ old('user.address2') }}" class="form-control" required
                                   placeholder="番地・ビル名"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-tel01" class="control-label col-md-3">
                            電話番号
                        </label>
                        <div class="col-md-6 form-inline">
                            <input type="number" id="user-tel01" name="user[tel01]" class="form-control"
                                   value="{{ old('user.tel01') }}" required>
                            -
                            <input type="number" id="user-tel02" name="user[tel02]" class="form-control"
                                   value="{{ old('user.tel02') }}" required>
                            -
                            <input type="number" id="user-tel03" name="user[tel03]" class="form-control"
                                   value="{{ old('user.tel03') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-tel01" class="control-label col-md-3">
                            FAX番号
                        </label>
                        <div class="col-md-6 form-inline">
                            <input type="number" id="user-fax01" name="user[fax01]" class="form-control"
                                   value="{{ old('user.fax01') }}">
                            -
                            <input type="number" id="user-fax02" name="user[fax02]" class="form-control"
                                   value="{{ old('user.fax02') }}">
                            -
                            <input type="number" id="user-fax03" name="user[fax03]" class="form-control"
                                   value="{{ old('user.fax03') }}">
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="user-email" class="control-label col-md-3">
                            メールアドレス
                        </label>
                        <div class="col-md-6">
                            <input type="email" id="user-email" name="user[email]" value="{{ old('user.email') }}"
                                   class="form-control" required placeholder=""/>
                            @if ($errors->has('email'))
                                @foreach ($errors->get('email') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group is_new {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="user-password" class="control-label col-md-3">
                            パスワード
                        </label>
                        <div class="col-md-6">
                            <input type="password" id="user-password" name="user[password]"
                                   value="{{ old('user.password') }}" class="form-control" required
                                   placeholder="※6文字以上で入力してください。"/>
                            @if ($errors->has('password'))
                                @foreach ($errors->get('password') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                        <label for="order-message" class="control-label col-md-3">
                            お問い合わせ
                        </label>
                        <div class="col-md-6">
                            <textarea id="order-message" class="form-control" name="order[message]"
                                      rows="5">{{ old('order.message') }}</textarea>
                            @if ($errors->has('message'))
                                @foreach ($errors->get('message') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </fieldset>
            </div>
            <!-- /会員情報ボディ -->
        </section>
        <!-- /会員情報 -->

        <!-- 商品情報 -->
        <section class="box box-default">
            <!-- 商品情報ヘッダー -->
            <div class="box-header">
                <h3 class="box-title">受注商品情報</h3>
                <button type="button" class="btn btn-md btn-default ml-30" data-toggle="modal"
                        data-target="#product-search-modal">
                    商品の追加
                </button>
            </div>
            <!-- /商品情報ヘッダー -->
            <!-- 商品情報ボディ -->
            <div class="box-body">
                <!-- 商品情報リスト -->
                <div class="order_list">
                    @if (!empty(old('order_details')))
                        @foreach(old('order_details') as $index => $order_detail)

                            <div class="item_box" id="item_box_{{ $index }}" data-index="{{ $index }}">

                                <input type="hidden" name="order_details[{{ $index }}][id]" value="">

                                <input type="hidden" name="order_details[{{ $index }}][order_id]"
                                       value="{{ $order_detail["order_id"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][product_id]"
                                       value="{{ $order_detail["product_id"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][price]"
                                       value="{{ $order_detail["price"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][sub_total]"
                                       value="{{ $order_detail["sub_total"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][product_title]"
                                       value="{{ $order_detail["product_title"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][product_type_id]"
                                       value="0">
                                <input type="hidden" name="order_details[{{ $index }}][image]"
                                       value="{{ $order_detail["image"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][json]"
                                       id="order_details_json_{{ $order_detail["product_id"] }}_{{ $index }}"
                                       class="order_details_json" value="{{ $order_detail["json"] }}"
                                       data-index="{{ $index }}" data-name="{{ $order_detail["product_title"] }}"
                                       data-image="{{ $order_detail["image"] }}"
                                       data-product_id="{{ $order_detail["product_id"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][designed_filename]"
                                       value="{{ $order_detail["designed_filename"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][designed_image]"
                                       value="{{ $order_detail["designed_image"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][uploaded_files]"
                                       value="{{ $order_detail["uploaded_files"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][designed_json]"
                                       value="{{ $order_detail["designed_json"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][json_text]"
                                       value="{{ $order_detail["json"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][width]"
                                       value="{{ $order_detail["width"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][height]"
                                       value="{{ $order_detail["height"] }}">

                                <div class="item_detail">
                                    <div class="item_name_area">
                                        <strong class="item_name">{{ $order_detail["product_title"] }}</strong><br>
                                    </div>
                                    <div class="item_image_area">
                                        <div class="design_image_area col-sm-12">
                                            【 テンプレート画像 】<br>
                                            <img src="{!! asset(env('PUBLIC', ''). $order_detail["image"]) !!}"
                                                 class="max-w-150">
                                            <a class="btn btn-default design_edit_btn"
                                               id="design_edit_btn_{{ $order_detail["product_id"] }}_{{ $index }}"
                                               data-name="{{ $order_detail["product_title"] }}"
                                               data-id="{{ $order_detail["product_id"] }}"
                                               data-image="{{ $order_detail["image"] }}"
                                               data-json="{{ $order_detail["json"] }}"
                                               data-width="{{ $order_detail["width"] }}"
                                               data-height="{{ $order_detail["height"] }}"
                                               data-index="{{ $index }}"
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
                                                            <option value="{{ $size->id }}" {{ $order_detail["size_id"]==$size->id?"selected":""}}>{{ $size->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="order_details[{{ $index }}][ratio_id]" id="ratio_id_{{ $index }}" class="form-control ratio_id" data-index="{{ $index }}" required>
                                                        <option value="" class="empty"></option>
                                                    </select>
                                                    <input type="hidden" name="order_details[{{ $index }}][old_ratio_id]" value="{{ $order_detail["ratio_id"] }}">
                                                </td>
                                                <td>
                                                    <select name="order_details[{{ $index }}][clothe_id]" id="clothe_id_{{ $index }}" class="form-control clothe_id" data-index="{{ $index }}" required>
                                                        <option value="" class="empty"></option>
                                                    </select>
                                                    <input type="hidden" name="order_details[{{ $index }}][old_clothe_id]" value="{{ $order_detail["clothe_id"] }}">
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
                                                                            {{ (!empty($order_detail["option_ids"])?in_array($option->id, $order_detail["option_ids"]) : false)?"checked":"" }}>
                                                                @endif
                                                                {{ $option->name }}
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">¥ </span>
                                                        <input type="number" name="order_details[{{ $index }}][option_price]"  value="{{ $order_detail["option_price"] }}" class="form-control option_price" data-index="{{ $index }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">¥ </span>
                                                        <input type="number" name="order_details[{{ $index }}][price]"  value="{{ $order_detail["price"] }}" class="form-control price" data-index="{{ $index }}" required>
                                                        <input type="hidden" name="order_details[{{ $index }}][price_id]"  value="{{ $order_detail["price_id"] }}">
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
                                                           required="required" data-index="{{ $index }}"
                                                           class="form-control quantity" value="{{ $order_detail["quantity"] }}">
                                                </span>
                                        </div>
                                        <div class="col-md-4 col-lg-3 form-group form-inline text-right">
                                                <span class="item_tax">
                                                    税率：
                                                    <span class="input-group">
                                                        <input type="text" name="order_details[{{ $index }}][tax_rate]"
                                                               required="required" data-index="{{ $index }}"
                                                               class="form-control tax_rate"
                                                               value="{{ $order_detail["tax_rate"] }}">
                                                        <span class="input-group-addon">%</span>
                                                    </span>
                                                </span>
                                        </div>
                                        <div class="col-md-12 col-lg-3 item_sub_total text-right" id="item_sub_total_{{ $index }}">
                                            <span>小計：</span>
                                            ¥ <span class="sub_total_disp">{{ !empty($order_detail["sub_total"]) ? number_format($order_detail["sub_total"]) : 0 }}</span>
                                            <input type="hidden" name="order_details[{{ $index }}][sub_total]" value="{{ $order_detail["sub_total"] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="icon_edit delete-btn">
                                    <button type="button" class="btn btn-default btn-sm delete-item"
                                            data-index="{{ $index }}" data-id="">削除
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- /商品情報リスト -->
                <!-- 金額 -->
                <div class="row with-border no-margin text-right">
                    <br>
                    <div class="col-lg-7 col-lg-offset-5">
                        <dl id="product_info_result_box__body_sub_price" class="dl-horizontal">
                            <dt id="product_info_result_box__sub_total">小計：</dt>
                            <dd id="order_sub_total_disp">¥ {{ number_format(old('order.sub_total', 0)) }}</dd>
                            <input type="hidden" name="order[sub_total]" value="{{ old('order.sub_total', 0) }}">
                            <dt id="product_info_result_box__discount">値引き：</dt>
                            <dd class="form-group form-inline">
                                <div class="input-group">
                                    <span class="input-group-addon">¥ </span>
                                    <input type="text" name="order[discount]" class="form-control" value="{{ old('order.discount', 0) }}" required>
                                </div>
                            </dd>
                            <dt id="product_info_result_box__delivery_fee_total">送料：</dt>
                            <dd class="form-group form-inline">
                                <div class="input-group">
                                    <span class="input-group-addon">¥ </span>
                                    <input type="text" name="order[shipping_cost]" class="form-control" value="{{ old('order.shipping_cost', 0) }}"
                                           required>
                                </div>
                            </dd>
                            <dt id="product_info_result_box__charge">手数料：</dt>
                            <dd class="form-group form-inline">
                                <div class="input-group">
                                    <span class="input-group-addon">¥ </span>
                                    <input type="text" id="order_charge" name="order[fee]" class="form-control"
                                           value="{{ old('order.fee', 0) }}" required>
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="row with-border2 no-margin text-right  ta">
                    <div class="col-lg-7 col-lg-offset-5">
                        <dl id="product_info_result_box__body_summary" class="dl-horizontal">
                            <dt id="product_info_result_box__total">合計：</dt>
                            <dd id="order_total_disp">¥ {{ number_format(old('order.total', 0)) }}</dd>
                            <input type="hidden" name="order[total]" value="{{ old('order.total', 0) }}">
                        </dl>
                    </div>
                </div>
                <!-- /金額 -->
            </div>
            <!-- 商品情報ボディ -->
        </section>
        <!-- /商品情報 -->

        <!-- 支払い情報 -->
        <section class="box box-default">
            <!-- 支払い情報ヘッダー -->
            <div class="box-header">
                <h3 class="box-title">お支払い情報</h3>
            </div>
            <!-- /支払い情報ヘッダー -->
            <!-- 支払い情報ボディ -->
            <div class="box-body">
                <fieldset>
                    <div class="form-group">
                        <label for="order-payment" class="control-label col-md-3">
                            お支払い方法
                        </label>
                        <div class="col-md-6">
                            <select id=order-payment" name="order[payment_id]" class="form-control" required>
                                <option value=""></option>
                                @foreach($payments as $payment)
                                    <option value="{{ $payment->id }}" {{ old('order.payment_id') ==  $payment->id ? "selected" : ""}}>{{ $payment->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>
            <!-- /支払い情報ボディ -->
        </section>
        <!-- /支払い情報 -->

        <!-- お届け先情報 -->
        <section class="box box-default">
            <!-- お届け先情報ヘッダー -->
            <div class="box-header">
                <h3 class="box-title">お届け先情報</h3>
                <button type="button" class="btn btn-md btn-default ml-30" id="copy_user">
                    注文者情報をコピー
                </button>
            </div>
            <!-- /お届け先情報ヘッダー -->
            <!-- お届け先情報ボディ -->
            <div class="box-body">
                <fieldset>
                    <div class="form-group">
                        <label for="order_shipping_address-name" class="control-label col-md-3">
                            名前
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="order-name" name="order_shipping_address[name]"
                                   value="{{ old('order_shipping_address.name') }}"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('name_kana') && $error_type=="order_shipping_address" ? 'has-error' : '' }}">
                        <label for="order_shipping_address-name_kana" class="control-label col-md-3">
                            名前（フリガナ）
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="order_shipping_address-name_kana"
                                   name="order_shipping_address[name_kana]"
                                   value="{{ old('order_shipping_address.name_kana') }}" class="form-control" required>
                            @if ($errors->has('name_kana') && $error_type=="order_shipping_address")
                                @foreach ($errors->get('name_kana') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="order_shipping_address-company_name" class="control-label col-md-3">
                            会社名
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="order_shipping_address-company_name"
                                   name="order_shipping_address[company_name]"
                                   value="{{ old('order_shipping_address.company_name') }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group
                        {{ ($errors->has('zip01')||$errors->has('zip02')) && $error_type=="order_shipping_address" ? 'has-error' : '' }}">
                        <label for="order_shipping_address-zip01" class="control-label col-md-3">
                            郵便番号
                        </label>
                        <div class="col-md-6 input_zip form-inline">
                            〒
                            <input type="number" id="order_shipping_address-zip01" name="order_shipping_address[zip01]"
                                   class="form-control"
                                   value="{{ old('order_shipping_address.zip01') }}" required>
                            -
                            <input type="number" id="order_shipping_address-zip02" name="order_shipping_address[zip02]"
                                   class="form-control"
                                   value="{{ old('order_shipping_address.zip02') }}" required>
                            <span>
                                <button type="button" id="order_shipping_address-zip-btn"
                                        class="btn btn-default btn-sm">郵便番号から自動入力</button>
                            </span>
                            @if ($errors->has('zip01') && $error_type=="order_shipping_address")
                                @foreach ($errors->get('zip01') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            @if ($errors->has('zip02') && $error_type=="order_shipping_address")
                                @foreach ($errors->get('zip02') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="order_shipping_address-pref_id" class="control-label col-md-3">
                            都道府県
                        </label>
                        <div class="col-md-6">
                            <select id="order_shipping_address-pref_id" name="order_shipping_address[pref_id]"
                                    class="form-control" required>
                                @foreach(config('pref') as $key => $name)
                                    <option value="{{ $key }}" {{ old('order_shipping_address.pref_id') == $key ? "selected" : "" }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="order_shipping_address-address1" class="control-label col-md-3">
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="order_shipping_address-address1"
                                   name="order_shipping_address[address1]"
                                   value="{{ old('order_shipping_address.address1') }}" class="form-control" required
                                   placeholder="市区町村"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="order_shipping_address-address2" class="control-label col-md-3">
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="order_shipping_address-address2"
                                   name="order_shipping_address[address2]"
                                   value="{{ old('order_shipping_address.address2') }}" class="form-control" required
                                   placeholder="番地・ビル名"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="order_shipping_address-tel01" class="control-label col-md-3">
                            電話番号
                        </label>
                        <div class="col-md-6 form-inline">
                            <input type="number" id="order_shipping_address-tel01" name="order_shipping_address[tel01]"
                                   class="form-control"
                                   value="{{ old('order_shipping_address.tel01') }}" required>
                            -
                            <input type="number" id="order_shipping_address-tel02" name="order_shipping_address[tel02]"
                                   class="form-control"
                                   value="{{ old('order_shipping_address.tel02') }}" required>
                            -
                            <input type="number" id="order_shipping_address-tel03" name="order_shipping_address[tel03]"
                                   class="form-control"
                                   value="{{ old('order_shipping_address.tel03') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="order_shipping_address-fax01" class="control-label col-md-3">
                            FAX番号
                        </label>
                        <div class="col-md-6 form-inline">
                            <input type="number" id="order_shipping_address-fax01" name="order_shipping_address[fax01]"
                                   class="form-control"
                                   value="{{ old('order_shipping_address.fax01') }}">
                            -
                            <input type="number" id="order_shipping_address-fax02" name="order_shipping_address[fax02]"
                                   class="form-control"
                                   value="{{ old('order_shipping_address.fax02') }}">
                            -
                            <input type="number" id="order_shipping_address-fax03" name="order_shipping_address[fax03]"
                                   class="form-control"
                                   value="{{ old('order_shipping_address.fax03') }}">
                        </div>
                    </div>
                </fieldset>
            </div>
            <!-- /お届け先情報ボディ -->
        </section>
        <!-- /お届け先情報 -->

        <!-- ショップ用メモ -->
        <section class="box box-default">
            <!-- ショップ用メモヘッダー -->
            <div class="box-header">
                <h3 class="box-title">ショップ用メモ欄</h3>
            </div>
            <!-- /ショップ用メモヘッダー -->
            <!-- ショップ用メモボディ -->
            <div class="box-body">
                <fieldset>
                    <div class="form-group {{ $errors->has('note') ? 'has-error' : '' }}">
                        <div class="col-md-12">
                            <textarea id="order-note" class="form-control" name="order[note]"
                                      rows="10">{{ old('order.note') }}</textarea>
                            @if ($errors->has('note'))
                                @foreach ($errors->get('note') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </fieldset>
            </div>
            <!-- /ショップ用メモボディ -->
            <div class="box-footer">
                <a href="{{ url('/admin/orders') }}" class="btn btn-sm btn-default">
                    <i class="fa fa-chevron-left"></i>
                    受注一覧へ戻る
                </a>
            </div>
        </section>
        <!-- /ショップ用メモ -->

        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-lg btn-primary">
                この内容で登録する
            </button>
        </div>
    </form>

    <div class="clearfix"></div>

    <!-- 会員検索モーダル -->
    <div class="modal fade" id="user-search-modal" tabindex="-1" role="dialog"
         aria-labelledby="user-search-modal-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <i class="fa fa-search"></i>
                        会員検索
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control col-md-12" id="user_search_input"
                           placeholder="会員ID・メールアドレス・お名前">
                    <div class="user_result_area">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" id="user_search_btn">
                        <i class="fa fa-search"></i>
                        検索
                    </button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                        キャンセル
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /会員検索モーダル -->

    <!-- 商品検索モーダル -->
    <div class="modal fade" id="product-search-modal" tabindex="-1" role="dialog"
         aria-labelledby="product-search-modal-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <i class="fa fa-search"></i>
                        商品検索
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control col-md-12" id="product_search_input" placeholder="商品タイトル・ID">
                    <div class="clearfix"></div>
                    <br>
                    <select class="form-control" id="product_category_search_input">
                        <option value="">選択してください</option>
                        @foreach(\App\Models\ProductCategory::whereNull('path')->get() as $product_category)
                            <option value="{{ $product_category->id }}">{{ $product_category->name }}</option>
                            @foreach(\App\Models\ProductCategory::getChildren($product_category->id) as $child)
                                <option value="{{ $child->id }}">&nbsp;&nbsp;&nbsp;{{ $child->name }}</option>
                            @endforeach
                        @endforeach
                    </select>
                    <div class="product_result_area">
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" id="product_search_btn">
                        <i class="fa fa-search"></i>
                        検索
                    </button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                        キャンセル
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /商品検索モーダル -->

    <!-- デザインモーダル -->
    @include('admin.modal.design_modal')
    <div class="svgElements"></div>
    <!-- /デザインモーダル -->

    <!-- JS -->
    @include('admin.orders.js', ['editFlg' => false])
    <!-- /JS -->


@endsection

@extends('admin.layouts.default')

@section('title', '受注更新 | 受注管理 | 幕王管理画面')

@section('content-header')
    <h1>
        受注管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/orders') }}">受注管理</a></li>
        <li class="active">受注更新</li>
    </ol>
@endsection

@section('content')
    <form class="form-horizontal" id="form1" action="{{ url('/admin/orders/'. $order->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="hidden" name="order[id]" value="{{ $order->id }}">
        <input type="hidden" name="deleted_order_detail_ids" value="">

        <!-- ヘッダー部分 -->
        <section class="box box-default">
            <div class="box-header">
                <h3 class="box-title">受注更新</h3>
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
                        <p>受注日： {{ !empty($order->ordered_at) ? $order->ordered_at->format('Y年m月d日') : "" }}</p>
                        <p>入金日： {{ !empty($order->payment_at) ? $order->payment_at->format('Y年m月d日') : "" }}</p>
                        <p>発送日： {{ !empty($order->shipping_at) ? $order->shipping_at->format('Y年m月d日') : "" }}</p>
                        <p>更新日： {{ !empty($order->updated_at) ? $order->updated_at->format('Y年m月d日') : "" }}</p>
                    </div>
                    <div class="form-group col-md-6 col-xs-12 order-status">
                        <label for="order-status" class="control-label col-md-3">
                            対応状況
                        </label>
                        <div class="col-md-6">
                            <select id="order-status" name="order[status]" class="form-control" required>
                                <option value=""></option>
                                @foreach (config('const.order.status') as $key => $status)
                                    <option value="{{ $key }}" {{ old('order.status', $order->status)==$key?"selected":"" }}>{{ $status }}</option>
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
                        <input type="hidden" name="user[id]" value="{{ old('user.id', $order->user->id) }}">
                        <div class="col-md-6" id="user_id_disp"></div>
                    </div>
                    <div class="form-group">
                        <label for="user-name" class="control-label col-md-3">
                            名前
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="user-name" name="user[name]" value="{{ old('user.name', $order->user->name) }}"
                                   class="form-control" required placeholder=""/>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('name_kana') && $error_type=="user" ? 'has-error' : '' }}">
                        <label for="user-name_kana" class="control-label col-md-3">
                            名前（フリガナ）
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="user-name_kana" name="user[name_kana]"
                                   value="{{ old('user.name_kana', $order->user->name_kana) }}" class="form-control" required placeholder=""/>
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
                                   value="{{ old('user.company_name', $order->user->company_name) }}" class="form-control" placeholder=""/>
                        </div>
                    </div>
                    <div class="form-group {{ ($errors->has('zip01')||$errors->has('zip02')) && $error_type=="user" ? 'has-error' : '' }}">
                        <label for="user-zip01" class="control-label col-md-3">
                            郵便番号
                        </label>
                        <div class="col-md-6 input_zip form-inline">
                            〒
                            <input type="number" id="user-zip01" name="user[zip01]" class="form-control"
                                   value="{{ old('user.zip01', !empty($order->user->zip_code) ? explode("-", $order->user->zip_code)[0] : "") }}" required>
                            -
                            <input type="number" id="user-zip02" name="user[zip02]" class="form-control"
                                   value="{{ old('user.zip02', !empty($order->user->zip_code) ? explode("-", $order->user->zip_code)[1] : "") }}" required>
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
                                    <option value="{{ $key }}" {{ old('user.pref_id', $order->user->pref_id) == $key ? "selected" : "" }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-address1" class="control-label col-md-3">
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="user-address1" name="user[address1]"
                                   value="{{ old('user.address1', $order->user->address1) }}" class="form-control" required placeholder="市区町村"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-address2" class="control-label col-md-3">
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="user-address2" name="user[address2]"
                                   value="{{ old('user.address2', $order->user->address2) }}" class="form-control" required
                                   placeholder="番地・ビル名"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-tel01" class="control-label col-md-3">
                            電話番号
                        </label>
                        <div class="col-md-6 form-inline">
                            <input type="number" id="user-tel01" name="user[tel01]" class="form-control"
                                   value="{{ old('user.tel01', !empty($order->user->tel) ? explode("-", $order->user->tel)[0] : "") }}" required>
                            -
                            <input type="number" id="user-tel02" name="user[tel02]" class="form-control"
                                   value="{{ old('user.tel02', !empty($order->user->tel) ? explode("-", $order->user->tel)[1] : "") }}" required>
                            -
                            <input type="number" id="user-tel03" name="user[tel03]" class="form-control"
                                   value="{{ old('user.tel03', !empty($order->user->tel) ? explode("-", $order->user->tel)[2] : "") }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-tel01" class="control-label col-md-3">
                            FAX番号
                        </label>
                        <div class="col-md-6 form-inline">
                            <input type="number" id="user-fax01" name="user[fax01]" class="form-control"
                                   value="{{ old('user.fax01', !empty($order->user->fax) ? explode("-", $order->user->fax)[0] : "") }}">
                            -
                            <input type="number" id="user-fax02" name="user[fax02]" class="form-control"
                                   value="{{ old('user.fax02', !empty($order->user->fax) ? explode("-", $order->user->fax)[1] : "") }}">
                            -
                            <input type="number" id="user-fax03" name="user[fax03]" class="form-control"
                                   value="{{ old('user.fax03', !empty($order->user->fax) ? explode("-", $order->user->fax)[2] : "") }}">
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="user-email" class="control-label col-md-3">
                            メールアドレス
                        </label>
                        <div class="col-md-6">
                            <input type="email" id="user-email" name="user[email]" value="{{ old('user.email', $order->user->email) }}"
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
                                   value="{{ old('user.password', $order->user->password) }}" class="form-control" required
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
                                      rows="5">{{ old('order.message', $order->message) }}</textarea>
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
                    @if (!empty(old('order_details', $order->order_details)))
                        @foreach(old('order_details', $order->order_details) as $index => $order_detail)

                            <div class="item_box" id="item_box_{{ $index }}" data-index="{{ $index }}">

                                <input type="hidden" name="order_details[{{ $index }}][id]" value="{{ $order_detail["id"] }}">

                                <input type="hidden" name="order_details[{{ $index }}][order_id]"
                                       value="{{ $order_detail["order_id"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][product_id]"
                                       value="{{ $order_detail["product_id"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][price]"
                                       value="{{ $order_detail["price"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][sub_total]"
                                       value="{{ $order_detail["sub_total"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][product_title]"
                                       value="{{empty($order_detail["product_title"]) ? $order_detail->product->title : $order_detail["product_title"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][product_type_id]"
                                       value="0">
                                <input type="hidden" name="order_details[{{ $index }}][image]"
                                       value="{{ empty($order_detail["image"]) ? $order_detail->product->image : $order_detail["image"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][json]"
                                       id="order_details_json_{{ $order_detail["product_id"] }}_{{ $index }}"
                                       class="order_details_json" value="{{ empty($order_detail["json"]) ? (!empty($order_detail->id)?\App\Models\OrderDetail::getJsonText($order_detail->id):"") : $order_detail["json"] }}"
                                       data-index="{{ $index }}" data-name="{{ $order_detail["product_title"] }}"
                                       data-image="{{ empty($order_detail["image"]) ? $order_detail->product->image : $order_detail["image"] }}"
                                       data-product_id="{{ $order_detail["product_id"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][designed_filename]"
                                       value="{{ $order_detail["designed_filename"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][designed_image]"
                                       value="{{ $order_detail["designed_image"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][uploaded_files]"
                                       value="{{ $order_detail["uploaded_files"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][designed_json]"
                                       value="{{ $order_detail["designed_json"] }}">
                                {{--<input type="hidden" name="order_details[{{ $index }}][json_text]"--}}
                                       {{--value="{{ empty($order_detail["json"]) ? (!empty($order_detail->id)?\App\Models\OrderDetail::getJsonText($order_detail->id):"") : $order_detail["json"] }}">--}}
                                <input type="hidden" name="order_details[{{ $index }}][width]" class="width-hidden"
                                       value="{{ empty($order_detail["width"]) ? $order_detail->product->ratio->width * 600 : $order_detail["width"] }}">
                                <input type="hidden" name="order_details[{{ $index }}][height]" class="height-hidden"
                                       value="{{ empty($order_detail["height"]) ? $order_detail->product->ratio->height * 600 : $order_detail["height"] }}">

                                <div class="item_detail">
                                    <div class="item_name_area">
                                        <strong class="item_name">
                                            {{ empty($order_detail["product_title"]) ? $order_detail->product->title : $order_detail["product_title"] }}
                                        </strong><br>
                                    </div>
                                    <div class="item_image_area">
                                        <div class="design_image_area col-sm-12">
                                            【 テンプレート画像 】<br>
                                            <img src="{!! empty($order_detail["image"]) ? asset(env('PUBLIC', '')). $order_detail->product->image : asset(env('PUBLIC', '')). $order_detail["image"] !!}"
                                                 class="max-w-150">
                                            <a class="btn btn-default design_edit_btn"
                                               id="design_edit_btn_{{ $order_detail["product_id"] }}_{{ $index }}"
                                               data-name="{{ empty($order_detail["product_title"]) ? $order_detail->product->title : $order_detail["product_title"] }}"
                                               data-id="{{ $order_detail["product_id"] }}"
                                               data-image="{{ empty($order_detail["image"]) ? $order_detail->product->image : $order_detail["image"] }}"
                                               data-json="{{ empty($order_detail["json"]) ? (!empty($order_detail->id)?\App\Models\OrderDetail::getJsonText($order_detail->id):"") : $order_detail["json"] }}"
                                               data-width="{{ empty($order_detail["width"]) ?  $order_detail->product->ratio->width * 600 : $order_detail["width"] }}"
                                               data-height="{{ empty($order_detail["height"]) ? $order_detail->product->ratio->height * 600 : $order_detail["height"] }}"
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
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select name="order_details[{{ $index }}][size_id]" class="form-control size_id" data-index="{{ $index }}" required>
                                                        <option value=""></option>
                                                        @foreach($price_service->getSizes() as $key => $size)
                                                            <option value="{{ $size->id }}"
                                                                    {{ (!empty($order_detail["size_id"])?$order_detail["size_id"]:$price_service->getSizeId($order_detail["price_id"]))==$size->id?"selected":""}}>
                                                                {{ $size->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="order_details[{{ $index }}][ratio_id]" id="ratio_id_{{ $index }}" class="form-control ratio_id" data-index="{{ $index }}" required>
                                                        <option value="" class="empty"></option>
                                                    </select>
                                                    <input type="hidden" name="order_details[{{ $index }}][old_ratio_id]" value="{{ (!empty($order_detail["ratio_id"])?$order_detail["ratio_id"]:$price_service->getRatioId($order_detail["price_id"])) }}">
                                                </td>
                                                <td>
                                                    <select name="order_details[{{ $index }}][clothe_id]" id="clothe_id_{{ $index }}" class="form-control clothe_id" data-index="{{ $index }}" required>
                                                        <option value="" class="empty"></option>
                                                    </select>
                                                    <input type="hidden" name="order_details[{{ $index }}][old_clothe_id]" value="{{ (!empty($order_detail["clothe_id"])?$order_detail["clothe_id"]:$price_service->getClotheId($order_detail["price_id"])) }}">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-sm-12">
                                        <table class="table">
                                            <tr>
                                                <th>ハトメの位置</th>
                                                <th>付属品</th>
                                                <th>納期</th>
                                                <th class="w300">オプション</th>
                                            </tr>
                                            <tr>
                                                <!-- ハトメの位置 -->
                                                <td>
                                                    <label>
                                                        <input type="radio" name="order_details[{{ $index }}][hatome]" value="通常" checked="checked" data-index="{{ $index }}"
                                                                {{ (!empty($order_detail["hatome"])?$order_detail["hatome"]:"")=="通常"?"checked":"" }}>通常
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="order_details[{{ $index }}][hatome]" value="上辺のみ" data-index="{{ $index }}"
                                                                {{ (!empty($order_detail["hatome"])?$order_detail["hatome"]:"")=="上辺のみ"?"checked":"" }}>上辺のみ
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="order_details[{{ $index }}][hatome]" value="左辺のみ" data-index="{{ $index }}"
                                                                {{ (!empty($order_detail["hatome"])?$order_detail["hatome"]:"")=="左辺のみ"?"checked":"" }}>左辺のみ
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="order_details[{{ $index }}][hatome]" value="ハトメなし" data-index="{{ $index }}"
                                                                {{ (!empty($order_detail["hatome"])?$order_detail["hatome"]:"")=="ハトメなし"?"checked":"" }}>ハトメなし
                                                    </label>
                                                </td>
                                                <!-- ./ハトメの位置 -->
                                                <!-- 付属品 -->
                                                <td>
                                                    <ul class="option">
                                                        <li class="rope">
                                                            <p>
                                                                <label>
                                                                    <input type="hidden" name="order_details[{{ $index }}][lope_flg]" data-index="{{ $index }}" value="0">
                                                                    <input type="checkbox" name="order_details[{{ $index }}][lope_flg]" data-index="{{ $index }}" id="optcheck" value="1"
                                                                            {{ (!empty($order_detail["lope_flg"])?$order_detail["lope_flg"]:"")=="1"?"checked":"" }}>
                                                                    ロープ
                                                                </label>
                                                            </p>
                                                            <ul class="cf">
                                                                <li>
                                                                    <input type="text" name="order_details[{{ $index }}][lope_1]" id="optinput1" data-index="{{ $index }}"  value="{{ $order_detail["lope_1"] }}">m
                                                                </li>
                                                                <li>
                                                                    <input type="text" name="order_details[{{ $index }}][lope_2]" id="optinput2" data-index="{{ $index }}" value="{{ $order_detail["lope_2"] }}">本
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li class="pole">
                                                            <br>
                                                            <p>
                                                                <label>
                                                                    <input type="hidden" name="order_details[{{ $index }}][pole_flg]" data-index="{{ $index }}" value="0">
                                                                    <input type="checkbox" name="order_details[{{ $index }}][pole_flg]" id="polecheck" data-index="{{ $index }}"
                                                                           value="1"
                                                                            {{ (!empty($order_detail["pole_flg"])?$order_detail["pole_flg"]:"")=="1"?"checked":"" }}>旗用ポール
                                                                </label>
                                                            </p>
                                                            <div>
                                                                <label>
                                                                    <input type="radio" name="order_details[{{ $index }}][pole]" value="2m・3段伸縮"
                                                                           data-index="{{ $index }}"
                                                                            {{ (!empty($order_detail["pole"])?$order_detail["pole"]:"")=="2m・3段伸縮"?"checked":"" }}>2m・3段伸縮
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="order_details[{{ $index }}][pole]" value="3m・3段伸縮"
                                                                           data-index="{{ $index }}"
                                                                            {{ (!empty($order_detail["pole"])?$order_detail["pole"]:"")=="3m・3段伸縮"?"checked":"" }}>3m・3段伸縮
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="order_details[{{ $index }}][pole]" value="4m・4段伸縮"
                                                                           data-index="{{ $index }}"
                                                                            {{ (!empty($order_detail["pole"])?$order_detail["pole"]:"")=="4m・4段伸縮"?"checked":"" }}>4m・4段伸縮
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="order_details[{{ $index }}][pole]" value="5m・4段伸縮"
                                                                           data-index="{{ $index }}"
                                                                            {{ (!empty($order_detail["pole"])?$order_detail["pole"]:"")=="5m・4段伸縮"?"checked":"" }}>5m・4段伸縮
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <!-- ./付属品 -->
                                                <!-- 納期 -->
                                                <td>
                                                    @foreach(config('const.nouki') as $key => $name)
                                                        <label>
                                                            <input type="radio" name="order_details[{{ $index }}][nouki_id]" value="{{ $key }}" data-index="{{ $index }}"
                                                                    {{ (!empty($order_detail["nouki_id"])?$order_detail["nouki_id"]:"")==$key?"checked":"" }}>
                                                            {{ $name }}
                                                        </label>
                                                    @endforeach
                                                </td>
                                                <!-- ./納期 -->
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
                                                                            {{ (!empty($order_detail["option_ids"])?in_array($option->id, old('order.id')?$order_detail["option_ids"]:explode(',', $order_detail["option_ids"])) : false)?"checked":"" }}>
                                                                @endif
                                                                {{ $option->name }}
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </td>

                                            </tr>
                                        </table>
                                    </div>

                                    <div class="row col-md-8 pull-right">
                                        <div class="col-md-6 col-lg-6 form-group form-inline text-right">
                                                <span class="item_quantity">
                                                    オプション金額：
                                                        <input type="number" name="order_details[{{ $index }}][option_price]"  value="{{ $order_detail["option_price"] }}" class="form-control option_price" data-index="{{ $index }}">
                                                </span>
                                        </div>
                                        <div class="col-md-6 col-lg-6 form-group form-inline text-right">
                                                <span class="item_quantity">
                                                    金額：
                                                        <input type="number" name="order_details[{{ $index }}][price]"  value="{{ $order_detail["price"] }}" class="form-control price" data-index="{{ $index }}" required>
                                                        <input type="hidden" name="order_details[{{ $index }}][price_id]"  value="{{ $order_detail["price_id"] }}">
                                                </span>
                                        </div>
                                        <div class="col-md-6 col-lg-6 form-group form-inline text-right">
                                                <span class="item_quantity">
                                                    数量：
                                                    <input type="text" name="order_details[{{ $index }}][quantity]"
                                                           required="required" data-index="{{ $index }}"
                                                           class="form-control quantity" value="{{ $order_detail["quantity"] }}">
                                                </span>
                                        </div>
                                        <div class="col-md-6 col-lg-6 form-group form-inline text-right">
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
                                        <div class="col-md-12 col-lg-12 item_sub_total text-right" id="item_sub_total_{{ $index }}">
                                            <span>小計：</span>
                                            ¥ <span class="sub_total_disp">{{ !empty($order_detail["sub_total"]) ? number_format($order_detail["sub_total"]) : 0 }}</span>
                                            <input type="hidden" name="order_details[{{ $index }}][sub_total]" value="{{ $order_detail["sub_total"] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="icon_edit delete-btn">
                                    <button type="button" class="btn btn-default btn-sm delete-item"
                                            data-index="{{ $index }}" data-id="{{ $order_detail["id"] }}">削除
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
                            <dd id="order_sub_total_disp">¥ {{ number_format(old('order.sub_total', $order->sub_total)) }}</dd>
                            <input type="hidden" name="order[sub_total]" value="{{ old('order.sub_total', $order->sub_total) }}">
                            <dt id="product_info_result_box__discount">値引き：</dt>
                            <dd class="form-group form-inline">
                                <div class="input-group">
                                    <span class="input-group-addon">¥ </span>
                                    <input type="text" name="order[discount]" class="form-control" value="{{ old('order.discount', !empty($order->discount)?$order->discount:0) }}" required>
                                </div>
                            </dd>
                            <dt id="product_info_result_box__delivery_fee_total">送料：</dt>
                            <dd class="form-group form-inline">
                                <div class="input-group">
                                    <span class="input-group-addon">¥ </span>
                                    <input type="text" name="order[shipping_cost]" class="form-control" value="{{ old('order.shipping_cost', !empty($order->shipping_cost)?$order->shipping_cost:0) }}"
                                           required>
                                </div>
                            </dd>
                            <dt id="product_info_result_box__charge">手数料：</dt>
                            <dd class="form-group form-inline">
                                <div class="input-group">
                                    <span class="input-group-addon">¥ </span>
                                    <input type="text" id="order_charge" name="order[fee]" class="form-control"
                                           value="{{ old('order.fee', !empty($order->fee)?$order->fee:0) }}" required>
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="row with-border2 no-margin text-right  ta">
                    <div class="col-lg-7 col-lg-offset-5">
                        <dl id="product_info_result_box__body_summary" class="dl-horizontal">
                            <dt id="product_info_result_box__total">合計：</dt>
                            <dd id="order_total_disp">¥ {{ number_format(old('order.total', $order->total)) }}</dd>
                            <input type="hidden" name="order[total]" value="{{ old('order.total', $order->total) }}">
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
                                    <option value="{{ $payment->id }}" {{ old('order.payment_id', $order->payment->id)==  $payment->id ? "selected" : ""}}>{{ $payment->name }}</option>
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
                                   value="{{ old('order_shipping_address.name', $order->order_shipping_address->name) }}"
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
                                   value="{{ old('order_shipping_address.name_kana', $order->order_shipping_address->name_kana) }}" class="form-control" required>
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
                                   value="{{ old('order_shipping_address.company_name', $order->order_shipping_address->company_name) }}" class="form-control">
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
                                   value="{{ old('order_shipping_address.zip01', !empty($order->order_shipping_address->zip_code) ? explode("-", $order->order_shipping_address->zip_code)[0] : "") }}" required>
                            -
                            <input type="number" id="order_shipping_address-zip02" name="order_shipping_address[zip02]"
                                   class="form-control"
                                   value="{{ old('order_shipping_address.zip02', !empty($order->order_shipping_address->zip_code) ? explode("-", $order->order_shipping_address->zip_code)[1] : "") }}" required>
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
                                    <option value="{{ $key }}" {{ old('order_shipping_address.pref_id', $order->order_shipping_address->pref_id) == $key ? "selected" : "" }}>{{ $name }}</option>
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
                                   value="{{ old('order_shipping_address.address1', $order->order_shipping_address->address1) }}" class="form-control" required
                                   placeholder="市区町村"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="order_shipping_address-address2" class="control-label col-md-3">
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="order_shipping_address-address2"
                                   name="order_shipping_address[address2]"
                                   value="{{ old('order_shipping_address.address2', $order->order_shipping_address->address2) }}" class="form-control" required
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
                                   value="{{ old('order_shipping_address.tel01', !empty($order->order_shipping_address->tel) ? explode("-", $order->order_shipping_address->tel)[0] : "") }}"
                                   required>
                            -
                            <input type="number" id="order_shipping_address-tel02" name="order_shipping_address[tel02]"
                                   class="form-control"
                                   value="{{ old('order_shipping_address.tel02', !empty($order->order_shipping_address->tel) ? explode("-", $order->order_shipping_address->tel)[1] : "") }}"
                                   required>
                            -
                            <input type="number" id="order_shipping_address-tel03" name="order_shipping_address[tel03]"
                                   class="form-control"
                                   value="{{ old('order_shipping_address.tel03', !empty($order->order_shipping_address->tel) ? explode("-", $order->order_shipping_address->tel)[2] : "") }}"
                                   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="order_shipping_address-fax01" class="control-label col-md-3">
                            FAX番号
                        </label>
                        <div class="col-md-6 form-inline">
                            <input type="number" id="order_shipping_address-fax01" name="order_shipping_address[fax01]"
                                   class="form-control"
                                   value="{{ old('order_shipping_address.fax01', !empty($order->order_shipping_address->fax) ? explode("-", $order->order_shipping_address->fax)[0] : "") }}">
                            -
                            <input type="number" id="order_shipping_address-fax02" name="order_shipping_address[fax02]"
                                   class="form-control"
                                   value="{{ old('order_shipping_address.fax02', !empty($order->order_shipping_address->fax) ? explode("-", $order->order_shipping_address->fax)[1] : "") }}">
                            -
                            <input type="number" id="order_shipping_address-fax03" name="order_shipping_address[fax03]"
                                   class="form-control"
                                   value="{{ old('order_shipping_address.fax03', !empty($order->order_shipping_address->fax) ? explode("-", $order->order_shipping_address->fax)[2] : "") }}">
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
                                      rows="10">{{ old('order.note', $order->note) }}</textarea>
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
                この内容で更新する
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
    @include('admin.orders.js', ['editFlg' => true])
    <!-- /JS -->

@endsection

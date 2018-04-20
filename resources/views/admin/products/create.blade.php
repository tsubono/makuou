@extends('admin.layouts.default')

@section('title', 'テンプレート登録 | テンプレート管理 | 幕王管理画面')

@section('content-header')
    <h1>
        テンプレート管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/products') }}">テンプレート管理</a></li>
        <li class="active">テンプレート登録</li>
    </ol>
@endsection

@section('content')
    <!-- form -->
    <form action="{{ url('/admin/products') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <!-- #detail_wrap -->
        <div id="detail_wrap" class="col-md-9">
            <div class="box form-horizontal">
                <div class="box-body">
                    <div class="form-group input_row">
                        <label class="control-label col-md-3">タイトル</label>
                        <div class="col-md-6">
                            <input type="title" name="product[title]" value="{{ old('product.title') }}"
                                   class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group input_row">
                        <label class="control-label col-md-3">比率</label>
                        <div class="col-md-6">
                            <div class="radio form-group">
                                @foreach ($ratios as $ratio)
                                    <label class="radio-inline">
                                        <input type="radio" name="product[ratio_id]" value="{{ $ratio->id }}"
                                               required {{ old('product.ratio_id')==$ratio->id?"checked":"" }}>
                                        {{ $ratio->height }} : {{ $ratio->width }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group input_row">
                        <label class="control-label col-md-3">スポーツ</label>
                        <div class="col-md-6">
                            <div class="checkbox form-group">
                                @foreach( $category_1 as $category)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="product[category_1][]" value="{{ $category->id }}"
                                                {{ old('product.category_1')=="1"?"checked":"" }}>
                                        {{ $category->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group input_row">
                        <label for="product-category_2" class="control-label col-md-3">
                            テイスト
                        </label>
                        <div class="col-md-6">
                            <div class="checkbox form-group" id="product-category_2">
                                @foreach( $category_2 as $category)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="product[category_2][]" value="{{ $category->id }}"
                                                {{ old('product.category_2')=="1"?"checked":"" }}>
                                        {{ $category->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group input_row">
                        <label for="product-category_3" class="control-label col-md-3">
                            シーン
                        </label>
                        <div class="col-md-6">
                            <div class="checkbox form-group" id="product-category_3">
                                @foreach( $category_3 as $category)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="product[category_3][]" value="{{ $category->id }}"
                                                {{ old('product.category_3')=="1"?"checked":"" }}>
                                        {{ $category->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group input_row">
                        <label class="control-label col-md-3">表示用画像</label>
                        <div class="col-md-6">
                            <input class="upload_file" name="product[image]" type="file"
                                   multiple="" accept=".svg" required>
                        </div>
                    </div>
                    <div class="form-group input_row">
                        <label for="product-category_3" class="control-label col-md-3">画像 ( サイズ：600 )</label>
                        <div class="col-md-9">
                            <div class="col-md-6 col-xs-12">
                                <div>【 レイアウト用画像 】</div>
                                <input class="upload_file" name="product[image_600_layout]" type="file"
                                       multiple="" accept=".svg">
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div>【 印刷用データ 】</div>
                                <input class="upload_file" name="product[image_600_copy]" type="file" multiple=""
                                       accept=".ai,.eps,.svg">
                            </div>
                        </div>
                    </div>
                    {{--<div class="form-group input_row">--}}
                        {{--<label for="product-category_3" class="control-label col-md-3">画像 ( サイズ：900 )</label>--}}
                        {{--<div class="col-md-9">--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div>【 レイアウト用画像 】</div>--}}
                                {{--<input class="upload_file" name="product[image_900_layout]" type="file"--}}
                                       {{--multiple="" accept=".svg">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div>【 印刷用データ 】</div>--}}
                                {{--<input class="upload_file" name="product[image_900_copy]" type="file" multiple=""--}}
                                       {{--accept=".ai,.eps,.svg">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group input_row">--}}
                        {{--<label for="product-category_3" class="control-label col-md-3">画像 ( サイズ：1200 )</label>--}}
                        {{--<div class="col-md-9">--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div>【 レイアウト用画像 】</div>--}}
                                {{--<input class="upload_file" name="product[image_1200_layout]" type="file"--}}
                                       {{--multiple="" accept=".svg">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div>【 印刷用データ 】</div>--}}
                                {{--<input class="upload_file" name="product[image_1200_copy]" type="file" multiple=""--}}
                                       {{--accept=".ai,.eps,.svg">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group input_row">--}}
                        {{--<label for="product-category_3" class="control-label col-md-3">画像 ( サイズ：1500 )</label>--}}
                        {{--<div class="col-md-9">--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div>【 レイアウト用画像 】</div>--}}
                                {{--<input class="upload_file" name="product[image_1500_layout]" type="file"--}}
                                       {{--multiple="" accept=".svg">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div>【 印刷用データ 】</div>--}}
                                {{--<input class="upload_file" name="product[image_1500_copy]" type="file" multiple=""--}}
                                       {{--accept=".ai,.eps,.svg">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group input_row">--}}
                        {{--<label for="product-category_3" class="control-label col-md-3">画像 ( サイズ：1800 )</label>--}}
                        {{--<div class="col-md-9">--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div>【 レイアウト用画像 】</div>--}}
                                {{--<input class="upload_file" name="product[image_1800_layout]" type="file"--}}
                                       {{--multiple="" accept=".svg">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div>【 印刷用データ 】</div>--}}
                                {{--<input class="upload_file" name="product[image_1800_copy]" type="file" multiple=""--}}
                                       {{--accept=".ai,.eps,.svg">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <div class="box-footer">
                    <a href="{{ url('/admin/products') }}" class="btn btn-sm btn-default">
                        <i class="fa fa-chevron-left"></i>
                        テンプレート一覧へ戻る
                    </a>
                </div>
            </div>
        </div>
        <!-- /#detail_wrap -->

        <!-- #aside_column -->
        <div class="col-md-3" id="aside_column">
            <div class="col_inner">
                <div class="box no-header text-center submit_box">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <div class="radio-inline">
                                    <div class="radio">
                                        <label class="">
                                            <input type="radio" name="product[status]" value="1"
                                                   checked="checked">
                                            公開
                                        </label>
                                    </div>
                                </div>
                                <div class="radio-inline">
                                    <div class="radio">
                                        <label class="">
                                            <input type="radio" name="product[status]" value="0">
                                            非公開
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-sm-12 col-md-12">
                                <button type="submit"
                                        class="btn btn-primary btn-block btn-md prevention-btn prevention-mask">
                                    テンプレートを登録
                                </button>
                            </div>
                        </div>
                        <div class="row text-center with-border">
                            <ul class="col-sm-12 col-md-12">
                                <li class="col-sm-12 col-lg-6">
                                    <button class="btn btn-default btn-block btn-sm" disabled="">
                                        表示確認
                                    </button>
                                </li>
                                <li class="col-sm-12 col-lg-6">
                                    <button class="btn btn-danger btn-block btn-sm" disabled="">
                                        削除
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="box no-header">
                    <div class="box-body update-area">
                        <p><i class="far fa-clock"></i>登録日：</p>
                        <p><i class="far fa-clock"></i>更新日：</p>
                    </div>
                </div>

                <div id="common_shop_note_box" class="box">
                    <div id="common_shop_note_box__header" class="box-header">
                        <h3 class="box-title">備考・メモ</h3>
                    </div>
                    <div class="box-body">
                        <textarea name="product[note]" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#aside_column -->
    </form>
    <!-- /form -->
    <div class="clearfix"></div>

    <script>
        window.onload = function () {
            $("input.upload_file").fileinput({
                maxFilePreviewSize: 10240,
                showUpload: false,
                maxFileCount: 1,
                browseClass: 'btn btn-info fileinput-browse-button',
                browseLabel: '',
                showRemove: false,
                showZoom: false
            });
        };
    </script>

@endsection

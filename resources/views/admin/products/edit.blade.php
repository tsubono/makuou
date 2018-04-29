@extends('admin.layouts.default')

@section('title', 'テンプレート編集 | テンプレート管理 | 幕王管理画面')

@section('content-header')
    <h1>
        テンプレート管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/products') }}">テンプレート管理</a></li>
        <li class="active">テンプレート編集</li>
    </ol>
@endsection


@section('content')
    <!-- form -->
    <form action="{{ url('/admin/products/'. $product->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
            <input type="hidden" name="product[id]" value="{{ $product->id }}">
    <!-- #detail_wrap -->
        <div id="detail_wrap" class="col-md-9">
            <div class="box form-horizontal">
                <div class="box-body">
                    <div class="form-group input_row">
                        <label class="control-label col-md-3">タイトル</label>
                        <div class="col-md-6">
                            <input type="title" name="product[title]" value="{{ old('product.title', $product->title) }}"
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
                                               required {{ old('product.ratio_id', $product->ratio_id)==$ratio->id?"checked":"" }}>
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
                                                {{ \App\Models\Product::isCategory(old('product.category_1', $product->category_1), $category->id) ? "checked" : "" }}>
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
                                                {{ \App\Models\Product::isCategory(old('product.category_2', $product->category_2), $category->id) ? "checked" : "" }}>
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
                                                {{ \App\Models\Product::isCategory(old('product.category_3', $product->category_3), $category->id) ? "checked" : "" }}>
                                        {{ $category->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group input_row">
                        <label class="control-label col-md-3">画像</label>
                        <div class="col-md-6">
                            <input type="hidden" name="product[image_edit]" value="-1">
                            <input class="upload_file" name="product[image]" type="file"
                                   multiple="" accept=".svg" value="{{ old('product.image', $product->image) }}">
                        </div>
                    </div>
                    {{--<div class="form-group input_row">--}}
                        {{--<label for="product-category_3" class="control-label col-md-3">画像 ( サイズ：600 )</label>--}}
                        {{--<div class="col-md-9 pict">--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div>【 レイアウト用画像 】</div>--}}
                                {{--<input type="hidden" name="product[image_600_layout_edit]" value="-1">--}}
                                {{--<input class="upload_file" name="product[image_600_layout]" type="file"--}}
                                       {{--multiple="" accept=".svg" value="{{ old('product.image_600_layout', $product->image_600_layout) }}">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div>【 印刷用データ 】</div>--}}
                                {{--<input type="hidden" name="product[image_600_copy_edit]" value="-1">--}}
                                {{--<input class="upload_file" name="product[image_600_copy]" type="file" multiple=""--}}
                                       {{--accept=".ai,.eps,.svg" value="{{ old('product.image_600_copy', $product->image_600_copy) }}">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group input_row">--}}
                        {{--<label for="product-category_3" class="control-label col-md-3">画像 ( サイズ：900 )</label>--}}
                        {{--<div class="col-md-9 pict">--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div>【 レイアウト用画像 】</div>--}}
                                {{--<input type="hidden" name="product[image_900_layout_edit]" value="-1">--}}
                                {{--<input class="upload_file" name="product[image_900_layout]" type="file"--}}
                                       {{--multiple="" accept=".svg" value="{{ old('product.image_900_layout', $product->image_900_layout) }}">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div>【 印刷用データ 】</div>--}}
                                {{--<input type="hidden" name="product[image_900_copy_edit]" value="-1">--}}
                                {{--<input class="upload_file" name="product[image_900_copy]" type="file" multiple=""--}}
                                       {{--accept=".ai,.eps,.svg" value="{{ old('product.image_900_copy', $product->image_900_copy) }}">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group input_row">--}}
                        {{--<label for="product-category_3" class="control-label col-md-3">画像 ( サイズ：1200 )</label>--}}
                        {{--<div class="col-md-9 pict">--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div>【 レイアウト用画像 】</div>--}}
                                {{--<input type="hidden" name="product[image_1200_layout_edit]" value="-1">--}}
                                {{--<input class="upload_file" name="product[image_1200_layout]" type="file"--}}
                                       {{--multiple="" accept=".svg" value="{{ old('product.image_1200_layout', $product->image_1200_layout) }}">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div>【 印刷用データ 】</div>--}}
                                {{--<input type="hidden" name="product[image_1200_copy_edit]" value="-1">--}}
                                {{--<input class="upload_file" name="product[image_1200_copy]" type="file" multiple=""--}}
                                       {{--accept=".ai,.eps,.svg" value="{{ old('product.image_1200_copy', $product->image_1200_copy) }}">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group input_row">--}}
                        {{--<label for="product-category_3" class="control-label col-md-3">画像 ( サイズ：1500 )</label>--}}
                        {{--<div class="col-md-9 pict">--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div>【 レイアウト用画像 】</div>--}}
                                {{--<input type="hidden" name="product[image_1500_layout_edit]" value="-1}">--}}
                                {{--<input class="upload_file" name="product[image_1500_layout]" type="file"--}}
                                       {{--multiple="" accept=".svg" value="{{ old('product.image_1500_layout', $product->image_1500_layout) }}">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div>【 印刷用データ 】</div>--}}
                                {{--<input type="hidden" name="product[image_1500_copy_edit]" value="-1">--}}
                                {{--<input class="upload_file" name="product[image_1500_copy]" type="file" multiple=""--}}
                                       {{--accept=".ai,.eps,.svg" value="{{ old('product.image_1500_copy', $product->image_1500_copy) }}">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group input_row">--}}
                        {{--<label for="product-category_3" class="control-label col-md-3">画像 ( サイズ：1800 )</label>--}}
                        {{--<div class="col-md-9 pict">--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div>【 レイアウト用画像 】</div>--}}
                                {{--<input type="hidden" name="product[image_1800_layout_edit]" value="-1">--}}
                                {{--<input class="upload_file" name="product[image_1800_layout]" type="file"--}}
                                       {{--multiple="" accept=".svg" value="{{ old('product.image_1800_layout', $product->image_1800_layout) }}">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6 col-xs-12">--}}
                                {{--<div>【 印刷用データ 】</div>--}}
                                {{--<input type="hidden" name="product[image_1800_copy_edit]" value="-1">--}}
                                {{--<input class="upload_file" name="product[image_1800_copy]" type="file" multiple=""--}}
                                       {{--accept=".ai,.eps,.svg" value="{{ old('product.image_1800_copy', $product->image_1800_copy) }}">--}}
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
                                                   {{ old('product.status', $product->status) ? "checked" : "" }}>
                                            公開
                                        </label>
                                    </div>
                                </div>
                                <div class="radio-inline">
                                    <div class="radio">
                                        <label class="">
                                            <input type="radio" name="product[status]" value="0"
                                                    {{ !old('product.status', $product->status) ? "checked" : "" }}>
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
                                    テンプレートを更新
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
                                    <button type="button" class="btn btn-danger btn-block btn-sm" data-toggle="modal" data-target="#product-{{ $product->id }}-delete-modal">
                                        削除
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="box no-header">
                    <div class="box-body update-area">
                        <p><i class="far fa-clock"></i>登録日： {{ $product->created_at->format('Y年m月d日 H:i:s') }}</p>
                        <p><i class="far fa-clock"></i>更新日： {{ $product->updated_at->format('Y年m月d日 H:i:s') }}</p>
                    </div>
                </div>

                <div id="common_shop_note_box" class="box">
                    <div id="common_shop_note_box__header" class="box-header">
                        <h3 class="box-title">備考・メモ</h3>
                    </div>
                    <div class="box-body">
                        <textarea name="product[note]" class="form-control">{{ old('product.note', $product->note) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#aside_column -->
    </form>
    <!-- /form -->
    <div class="clearfix"></div>

    <div class="modal fade" id="product-{{ $product->id }}-delete-modal" tabindex="-1" role="dialog" aria-labelledby="product-{{ $product->id }}-delete-modal-label">
        <div class="modal-dialog" role="document">
            <form action="{{ url('/admin/products/'. $product->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="product-{{ $product->id }}-delete-modal-label">
                            <i class="fa fa-trash"></i>
                            {{ $product->title }}削除確認
                        </h4>
                    </div>
                    <div class="modal-body">
                        <p>本当に削除してもよろしいですか？</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                            <i class="fa fa-times"></i>
                            キャンセル
                        </button>
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>
                            削除する
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.onload = function () {

            $("[name='product[image]']").fileinput({
                maxFilePreviewSize: 10240,
                showUpload: false,
                maxFileCount: 1,
                browseClass: 'btn btn-info fileinput-browse-button',
                browseLabel: '',
                showRemove: true,
                removeLabel: '',
                removeClass: 'btn btn-danger',
                @if (!empty(old('product.image', $product->image)))
                initialPreview: "{{ asset(env('PUBLIC', ''). old('product.image', $product->image)) }}",
                initialPreviewAsData: true,
                overwriteInitial : true,
                initialPreviewDownloadUrl: "{{ asset(env('PUBLIC', ''). old('product.image', $product->image)) }}"
                @endif
            });
            $("[name='product[image]']").on('filecleared', function(event) {
                $("[name='product[image_edit]']").val(1);
                $("[name='product[image]']").attr('required', true);
            });

            {{--$("[name='product[image_600_layout]']").fileinput({--}}
                {{--maxFilePreviewSize: 10240,--}}
                {{--showUpload: false,--}}
                {{--maxFileCount: 1,--}}
                {{--browseClass: 'btn btn-info fileinput-browse-button',--}}
                {{--browseLabel: '',--}}
                {{--showRemove: true,--}}
                {{--removeLabel: '',--}}
                {{--removeClass: 'btn btn-danger',--}}
                {{--@if (!empty(old('product.image_600_layout', $product->image_600_layout)))--}}
                    {{--initialPreview: "{{ asset(env('PUBLIC', ''). old('product.image_600_layout', $product->image_600_layout)) }}",--}}
                    {{--initialPreviewAsData: true,--}}
                    {{--overwriteInitial : true,--}}
                    {{--initialPreviewDownloadUrl: "{{ asset(env('PUBLIC', ''). old('product.image_600_layout', $product->image_600_layout)) }}"--}}
                {{--@endif--}}
            {{--});--}}
            {{--$("[name='product[image_600_layout]']").on('filecleared', function(event) {--}}
                {{--$("[name='product[image_600_layout_edit]']").val(1);--}}
            {{--});--}}
            
            {{--$("[name='product[image_600_copy]']").fileinput({--}}
                {{--maxFilePreviewSize: 10240,--}}
                {{--showUpload: false,--}}
                {{--maxFileCount: 1,--}}
                {{--browseClass: 'btn btn-info fileinput-browse-button',--}}
                {{--browseLabel: '',--}}
                {{--showRemove: true,--}}
                {{--removeLabel: '',--}}
                {{--removeClass: 'btn btn-danger',--}}
                {{--@if (!empty(old('product.image_600_copy', $product->image_600_copy)))--}}
                    {{--initialPreview: "{{ asset(env('PUBLIC', ''). old('product.image_600_copy', $product->image_600_copy)) }}",--}}
                    {{--initialPreviewAsData: true,--}}
                    {{--overwriteInitial : true,--}}
                    {{--initialPreviewDownloadUrl: "{{ asset(env('PUBLIC', ''). old('product.image_600_copy', $product->image_600_copy)) }}",--}}
                {{--@endif--}}
            {{--});--}}
            {{--$("[name='product[image_600_copy]']").on('filecleared', function(event) {--}}
                {{--$("[name='product[image_600_copy_edit]']").val(1);--}}
            {{--});--}}

            {{--$("[name='product[image_900_layout]']").fileinput({--}}
                {{--maxFilePreviewSize: 10240,--}}
                {{--showUpload: false,--}}
                {{--maxFileCount: 1,--}}
                {{--browseClass: 'btn btn-info fileinput-browse-button',--}}
                {{--browseLabel: '',--}}
                {{--showRemove: true,--}}
                {{--removeLabel: '',--}}
                {{--removeClass: 'btn btn-danger',--}}
                {{--@if (!empty(old('product.image_900_layout', $product->image_900_layout)))--}}
                    {{--initialPreview: "{{ asset(env('PUBLIC', ''). old('product.image_900_layout', $product->image_900_layout)) }}",--}}
                    {{--initialPreviewAsData: true,--}}
                    {{--overwriteInitial : true,--}}
                    {{--initialPreviewDownloadUrl: "{{ asset(env('PUBLIC', ''). old('product.image_900_layout', $product->image_900_layout)) }}"--}}
                {{--@endif--}}
            {{--});--}}
            {{--$("[name='product[image_900_layout]']").on('filecleared', function(event) {--}}
                {{--$("[name='product[image_900_layout_edit]']").val(1);--}}
            {{--});--}}

            {{--$("[name='product[image_900_copy]']").fileinput({--}}
                {{--maxFilePreviewSize: 10240,--}}
                {{--showUpload: false,--}}
                {{--maxFileCount: 1,--}}
                {{--browseClass: 'btn btn-info fileinput-browse-button',--}}
                {{--browseLabel: '',--}}
                {{--showRemove: true,--}}
                {{--removeLabel: '',--}}
                {{--removeClass: 'btn btn-danger',--}}
                {{--@if (!empty(old('product.image_900_copy', $product->image_900_copy)))--}}
                    {{--initialPreview: "{{ asset(env('PUBLIC', ''). old('product.image_900_copy', $product->image_900_copy)) }}",--}}
                    {{--initialPreviewAsData: true,--}}
                    {{--overwriteInitial : true,--}}
                    {{--initialPreviewDownloadUrl: "{{ asset(env('PUBLIC', ''). old('product.image_900_copy', $product->image_900_copy)) }}"--}}
                {{--@endif--}}
            {{--});--}}
            {{--$("[name='product[image_900_copy]']").on('filecleared', function(event) {--}}
                {{--$("[name='product[image_900_copy_edit]']").val(1);--}}
            {{--});--}}

            {{--$("[name='product[image_1200_layout]']").fileinput({--}}
                {{--maxFilePreviewSize: 10240,--}}
                {{--showUpload: false,--}}
                {{--maxFileCount: 1,--}}
                {{--browseClass: 'btn btn-info fileinput-browse-button',--}}
                {{--browseLabel: '',--}}
                {{--showRemove: true,--}}
                {{--removeLabel: '',--}}
                {{--removeClass: 'btn btn-danger',--}}
                {{--@if (!empty(old('product.image_1200_layout', $product->image_1200_layout)))--}}
                    {{--initialPreview: "{{ asset(env('PUBLIC', ''). old('product.image_1200_layout', $product->image_1200_layout)) }}",--}}
                    {{--initialPreviewAsData: true,--}}
                    {{--overwriteInitial : true,--}}
                    {{--initialPreviewDownloadUrl: "{{ asset(env('PUBLIC', ''). old('product.image_1200_layout', $product->image_1200_layout)) }}"--}}
                {{--@endif--}}
            {{--});--}}
            {{--$("[name='product[image_1200_layout]']").on('filecleared', function(event) {--}}
                {{--$("[name='product[image_1200_layout_edit]']").val(1);--}}
            {{--});--}}

            {{--$("[name='product[image_1200_copy]']").fileinput({--}}
                {{--maxFilePreviewSize: 10240,--}}
                {{--showUpload: false,--}}
                {{--maxFileCount: 1,--}}
                {{--browseClass: 'btn btn-info fileinput-browse-button',--}}
                {{--browseLabel: '',--}}
                {{--showRemove: true,--}}
                {{--removeLabel: '',--}}
                {{--removeClass: 'btn btn-danger',--}}
                {{--@if (!empty(old('product.image_1200_copy', $product->image_1200_copy)))--}}
                    {{--initialPreview: "{{ asset(env('PUBLIC', ''). old('product.image_1200_copy', $product->image_1200_copy)) }}",--}}
                    {{--initialPreviewAsData: true,--}}
                    {{--overwriteInitial : true,--}}
                    {{--initialPreviewDownloadUrl: "{{ asset(env('PUBLIC', ''). old('product.image_1200_copy', $product->image_1200_copy)) }}"--}}
                {{--@endif--}}
            {{--});--}}
            {{--$("[name='product[image_1200_copy]']").on('filecleared', function(event) {--}}
                {{--$("[name='product[image_1200_copy_edit]']").val(1);--}}
            {{--});--}}

            {{--$("[name='product[image_1500_layout]']").fileinput({--}}
                {{--maxFilePreviewSize: 10240,--}}
                {{--showUpload: false,--}}
                {{--maxFileCount: 1,--}}
                {{--browseClass: 'btn btn-info fileinput-browse-button',--}}
                {{--browseLabel: '',--}}
                {{--showRemove: true,--}}
                {{--removeLabel: '',--}}
                {{--removeClass: 'btn btn-danger',--}}
                {{--@if (!empty(old('product.image_1500_layout', $product->image_1500_layout)))--}}
                    {{--initialPreview: "{{ asset(env('PUBLIC', ''). old('product.image_1500_layout', $product->image_1500_layout)) }}",--}}
                    {{--initialPreviewAsData: true,--}}
                    {{--overwriteInitial : true,--}}
                    {{--initialPreviewDownloadUrl: "{{ asset(env('PUBLIC', ''). old('product.image_1500_layout', $product->image_1500_layout)) }}"--}}
                {{--@endif--}}
            {{--});--}}
            {{--$("[name='product[image_1500_layout]']").on('filecleared', function(event) {--}}
                {{--$("[name='product[image_1500_layout_edit]']").val(1);--}}
            {{--});--}}

            {{--$("[name='product[image_1500_copy]']").fileinput({--}}
                {{--maxFilePreviewSize: 10240,--}}
                {{--showUpload: false,--}}
                {{--maxFileCount: 1,--}}
                {{--browseClass: 'btn btn-info fileinput-browse-button',--}}
                {{--browseLabel: '',--}}
                {{--showRemove: true,--}}
                {{--removeLabel: '',--}}
                {{--removeClass: 'btn btn-danger',--}}
                {{--@if (!empty(old('product.image_1500_copy', $product->image_1500_copy)))--}}
                    {{--initialPreview: "{{ asset(env('PUBLIC', ''). old('product.image_1500_copy', $product->image_1500_copy)) }}",--}}
                    {{--initialPreviewAsData: true,--}}
                    {{--overwriteInitial : true,--}}
                    {{--initialPreviewDownloadUrl: "{{ asset(env('PUBLIC', ''). old('product.image_1500_copy', $product->image_1500_copy)) }}"--}}
                {{--@endif--}}
            {{--});--}}
            {{--$("[name='product[image_1500_copy]']").on('filecleared', function(event) {--}}
                {{--$("[name='product[image_1500_copy_edit]']").val(1);--}}
            {{--});--}}

            {{--$("[name='product[image_1800_layout]']").fileinput({--}}
                {{--maxFilePreviewSize: 10240,--}}
                {{--showUpload: false,--}}
                {{--maxFileCount: 1,--}}
                {{--browseClass: 'btn btn-info fileinput-browse-button',--}}
                {{--browseLabel: '',--}}
                {{--showRemove: true,--}}
                {{--removeLabel: '',--}}
                {{--removeClass: 'btn btn-danger',--}}
                {{--@if (!empty(old('product.image_1800_layout', $product->image_1800_layout)))--}}
                    {{--initialPreview: "{{ asset(env('PUBLIC', ''). old('product.image_1800_layout', $product->image_1800_layout)) }}",--}}
                    {{--initialPreviewAsData: true,--}}
                    {{--overwriteInitial : true,--}}
                    {{--initialPreviewDownloadUrl: "{{ asset(env('PUBLIC', ''). old('product.image_1800_layout', $product->image_1800_layout)) }}"--}}
                {{--@endif--}}
            {{--});--}}
            {{--$("[name='product[image_1800_layout]']").on('filecleared', function(event) {--}}
                {{--$("[name='product[image_1800_layout_edit]']").val(1);--}}
            {{--});--}}

            {{--$("[name='product[image_1800_copy]']").fileinput({--}}
                {{--maxFilePreviewSize: 10240,--}}
                {{--showUpload: false,--}}
                {{--maxFileCount: 1,--}}
                {{--browseClass: 'btn btn-info fileinput-browse-button',--}}
                {{--browseLabel: '',--}}
                {{--showRemove: true,--}}
                {{--removeLabel: '',--}}
                {{--removeClass: 'btn btn-danger',--}}
                {{--@if (!empty(old('product.image_1800_copy', $product->image_1800_copy)))--}}
                    {{--initialPreview: "{{ asset(env('PUBLIC', ''). old('product.image_1800_copy', $product->image_1800_copy)) }}",--}}
                    {{--initialPreviewAsData: true,--}}
                    {{--overwriteInitial : true,--}}
                    {{--initialPreviewDownloadUrl: "{{ asset(env('PUBLIC', ''). old('product.image_1800_copy', $product->image_1800_copy)) }}"--}}
                {{--@endif--}}
            {{--});--}}
            {{--$("[name='product[image_1800_copy]']").on('filecleared', function(event) {--}}
                {{--$("[name='product[image_1800_copy_edit]']").val(1);--}}
            {{--});--}}
        };
    </script>
@endsection

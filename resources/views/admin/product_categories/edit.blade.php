@extends('admin.layouts.default')

@section('title', 'テンプレートカテゴリー編集 | テンプレートカテゴリー管理 | 幕王管理画面')

@section('content-header')
    <h1>
        テンプレートカテゴリー管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/product-categories') }}">テンプレートカテゴリー管理</a></li>
        <li class="active">テンプレートカテゴリー編集</li>
    </ol>
@endsection

@section('content')
    <!-- form -->
    <form action="{{ url('/admin/product-categories') }}" method="post">
    {{ csrf_field() }}
    <!-- #detail_wrap -->
        <div id="detail_wrap" class="col-md-12">
            <div class="box form-horizontal">
                <div class="box-body">
                    <div class="form-group input_row">
                        <label class="control-label col-md-3">カテゴリー名</label>
                        <div class="col-md-6">
                            <input type="text" name="product_category[name]" value="{{ old('product_category.name') }}"
                                   class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group input_row">
                        <label class="control-label col-md-3">親カテゴリ</label>
                        <div class="col-md-6">
                            <select name="product_category[parent_category_id]">
                                @foreach($product_categories as $product_category)
                                    <option value="{{ $product_category->id  }}">{{ $product_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-md-6">
                        <a href="{{ url('/admin/product-categories') }}" class="btn btn-sm btn-default">
                            <i class="fa fa-chevron-left"></i>
                            テンプレートカテゴリー一覧へ戻る
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary btn-md prevention-btn">
                            テンプレートカテゴリーを登録
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#detail_wrap -->
    </form>
    <!-- /form -->
@endsection

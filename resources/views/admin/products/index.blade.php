@extends('admin.layouts.default')

@section('title', 'テンプレート一覧 | テンプレート管理 | 幕王管理画面')

@section('content-header')
    <h1>
        テンプレート管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/products') }}">テンプレート管理</a></li>
        <li class="active">テンプレート一覧</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">テンプレート一覧</h3>
            <div class="box-tools">
                <a href="{{ url('/admin/products/create') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i>
                    テンプレート登録
                </a>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>タイトル</th>
                        <th style="width: 16%;">画像</th>
                        <th>比率</th>
                        <th>スポーツ</th>
                        <th>テイスト</th>
                        <th>シーン</th>
                        <th>更新日</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->title }}</td>
                        <td>
                            @if (!empty($product->image))
                                <img src="{!! asset(env('PUBLIC', ''). $product->image) !!}" class="max-w-150">
                            @endif
                        </td>
                        <td>{{ $product->ratio->height }} : {{ $product->ratio->width }}</td>
                        <td class="max-w-150">
                            @foreach($product->product_categories as $index => $product_category)
                                @if ($product_category->path == 1)
                                    @if ($index!=0),@endif {{ $product_category->name }}
                                @endif
                            @endforeach
                        </td>
                        <td class="max-w-150">
                            @foreach($product->product_categories as $index => $product_category)
                                @if ($product_category->path == 2)
                                    @if ($index!=0),@endif {{ $product_category->name }}
                                @endif
                            @endforeach
                        </td>
                        <td class="max-w-150">
                            @foreach($product->product_categories as $index => $product_category)
                                @if ($product_category->path == 3)
                                    @if ($index!=0),@endif {{ $product_category->name }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{ \Carbon\Carbon::parse($product->updated_at)->format('Y年m月d日 h:i') }}</td>
                        <td>
                            <a href="{{ url('/admin/products/'. $product->id. '/edit') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i>
                                編集
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#product-{{ $product->id }}-delete-modal">
                                <i class="fa fa-trash"></i>
                                削除
                            </button>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->appends(request()->all())->render() }}
        </div>
    </section>
    @foreach($products as $product)
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
    @endforeach
@endsection

@extends('admin.layouts.default')

@section('title', 'テンプレートカテゴリー一覧 | テンプレートカテゴリー管理 | 幕王管理画面')

@section('content-header')
    <h1>
        テンプレートカテゴリー管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/product-categories') }}">テンプレートカテゴリー管理</a></li>
        <li class="active">テンプレートカテゴリー一覧</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">テンプレートカテゴリー一覧</h3>
        </div>
        <div class="box-body">
            <table class="table">
                <thead>
                <tr>
                    <th>カテゴリー名</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($product_categories as $product_category)
                    <tr>
                        <td>{{ $product_category->name }}</td>
                        <td>
                            <a href="{{ url('/admin/product-categories/'. $product_category->id) }}"
                               class="btn btn-sm btn-success">
                                <i class="fa fa-edit"></i>
                                詳細
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $product_categories->appends(request()->all())->render() }}
        </div>
    </section>
@endsection

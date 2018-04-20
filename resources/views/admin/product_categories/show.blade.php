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
            <h3 class="box-title">『{{ $parent_category->name }}』のテンプレートカテゴリー一覧</h3>
            <div class="box-tools">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#product_category-create-modal">
                    <i class="fa fa-plus"></i>
                    テンプレートカテゴリー登録
                </button>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <thead>
                <tr>
                    <th>カテゴリー名</th>
                    <th>説明</th>
                    <th>更新日</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($product_categories as $product_category)
                    <tr>
                        <td>{{ $product_category->name }}</td>
                        <td>{!! nl2br(e( $product_category->description )) !!}</td>
                        <td>{{ \Carbon\Carbon::parse($product_category->updated_at)->format('Y年m月d日 h:i') }}</td>
                        <td>
                            {{--<a href="/admin/product-categories/{{ $product_category->id }}/edit"--}}
                               {{--class="btn btn-sm btn-primary" >--}}
                                {{--<i class="fa fa-edit"></i>--}}
                                {{--編集--}}
                            {{--</a>--}}
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#product_category-{{ $product_category->id }}-update-modal" >
                                <i class="fa fa-edit"></i>
                                編集
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#product_category-{{ $product_category->id }}-delete-modal" >
                                <i class="fa fa-trash"></i>
                                削除
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $product_categories->appends(request()->all())->render() }}
        </div>
        <div class="box-footer">
            <a href="{{ url('/admin/product-categories') }}" class="btn btn-sm btn-default">
                <i class="fa fa-chevron-left"></i>
                テンプレートカテゴリー一覧に戻る
            </a>
        </div>
    </section>

    <!-- 新規追加モーダル -->
    <div class="modal fade" id="product_category-create-modal" tabindex="-1"
         role="dialog" aria-labelledby="product_category-create-modal-label">
        <div class="modal-dialog" role="document">
            <form action="{{ url('/admin/product-categories') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="product_category[path]" value="{{ $parent_category->id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"
                            id="product_category-create-modal-label">
                            <i class="fa fa-plus"></i>
                            『{{ $parent_category->name }}』のカテゴリー追加
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">カテゴリー名</label>
                            <div class="col-md-6">
                                <input type="text" name="product_category[name]" value=""
                                       class="form-control" required/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">説明</label>
                            <div class="col-md-6">
                                <textarea name="product_category[description]" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                            <i class="fa fa-times"></i>
                            キャンセル
                        </button>
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus"></i>
                            追加する
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @foreach($product_categories as $product_category)
        <!-- 編集モーダル -->
        <div class="modal fade" id="product_category-{{ $product_category->id }}-update-modal" tabindex="-1"
             role="dialog" aria-labelledby="product_category-{{ $product_category->id }}-update-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/product-categories/'. $product_category->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="product_category-{{ $product_category->id }}-update-modal-label">
                                <i class="fa fa-edit"></i>
                                『{{ $product_category->name }}』のカテゴリー編集
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">カテゴリー名</label>
                                <div class="col-md-6">
                                    <input type="text" name="product_category[name]" value="{{ $product_category->name }}"
                                           class="form-control" required/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">説明</label>
                                <div class="col-md-6">
                                    <textarea name="product_category[description]" class="form-control">{{ $product_category->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="clearfix"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                                <i class="fa fa-times"></i>
                                キャンセル
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i>
                                更新する
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /編集モーダル -->

        <!-- 削除モーダル -->
        <div class="modal fade" id="product_category-{{ $product_category->id }}-delete-modal" tabindex="-1"
             role="dialog" aria-labelledby="product_category-{{ $product_category->id }}-delete-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/product-categories/'. $product_category->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="product_category-{{ $product_category->id }}-delete-modal-label">
                                <i class="fa fa-trash"></i>
                                {{ $product_category->name }}削除確認
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
        <!-- /削除モーダル -->
    @endforeach
@endsection

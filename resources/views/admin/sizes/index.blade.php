@extends('admin.layouts.default')

@section('title', 'サイズ一覧 | サイズ管理 | 幕王管理画面')

@section('content-header')
    <h1>
        サイズ管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/sizes') }}">サイズ管理</a></li>
        <li class="active">サイズ一覧</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">サイズ一覧</h3>
            <div class="box-tools">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#size-create-modal">
                    <i class="fa fa-plus"></i>
                    サイズ登録
                </button>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <thead>
                <tr>
                    <th>名前</th>
                    <th>備考</th>
                    <th>更新日</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($sizes as $size)
                    <tr>
                        <td>{{ $size->name }}</td>
                        <td>{!! nl2br(e( $size->note )) !!}</td>
                        <td>{{ \Carbon\Carbon::parse($size->updated_at)->format('Y年m月d日 h:i') }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#size-{{ $size->id }}-update-modal">
                                <i class="fa fa-edit"></i>
                                編集
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#size-{{ $size->id }}-delete-modal">
                                <i class="fa fa-trash"></i>
                                削除
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $sizes->appends(request()->all())->render() }}
        </div>
    </section>

    <!-- 新規追加モーダル -->
    <div class="modal fade" id="size-create-modal" tabindex="-1"
         role="dialog" aria-labelledby="size-create-modal-label">
        <div class="modal-dialog" role="document">
            <form action="{{ url('/admin/product-setting/sizes') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"
                            id="size-create-modal-label">
                            <i class="fa fa-plus"></i>
                            サイズ追加
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">名前</label>
                            <div class="col-md-6">
                                <input type="text" name="size[name]" value="{{ old('size.name') }}"
                                       class="form-control" required/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">備考</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="size[note]">{{ old('size.note') }}</textarea>
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

    @foreach($sizes as $size)
        <!-- 編集モーダル -->
        <div class="modal fade" id="size-{{ $size->id }}-update-modal" tabindex="-1"
             role="dialog" aria-labelledby="size-{{ $size->id }}-update-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/product-setting/sizes/'. $size->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="size[id]" value="{{ $size->id }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="size-{{ $size->id }}-update-modal-label">
                                <i class="fa fa-edit"></i>
                                {{ $size->name }}編集
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">名前</label>
                                <div class="col-md-6">
                                    <input type="text" name="size[name]" value="{{ old('size.name', $size->name) }}"
                                           class="form-control" required/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">備考</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="size[note]">{{ old('size.note', $size->note) }}</textarea>
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
        <div class="modal fade" id="size-{{ $size->id }}-delete-modal" tabindex="-1"
             role="dialog" aria-labelledby="size-{{ $size->id }}-delete-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/product-setting/sizes/'. $size->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="size-{{ $size->id }}-delete-modal-label">
                                <i class="fa fa-trash"></i>
                                {{ $size->name }}削除確認
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

    <script>
        window.onload = function () {
        };
    </script>

@endsection

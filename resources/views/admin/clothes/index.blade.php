@extends('admin.layouts.default')

@section('title', '生地一覧 | 生地管理 | 幕王管理画面')

@section('content-header')
    <h1>
        生地管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/clothes') }}">生地管理</a></li>
        <li class="active">生地一覧</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">生地一覧</h3>
            <div class="box-tools">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#clothe-create-modal">
                    <i class="fa fa-plus"></i>
                    生地登録
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
                @foreach($clothes as $clothe)
                    <tr>
                        <td>{{ $clothe->name }}</td>
                        <td>{!! nl2br(e( $clothe->note )) !!}</td>
                        <td>{{ \Carbon\Carbon::parse($clothe->updated_at)->format('Y年m月d日 h:i') }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#clothe-{{ $clothe->id }}-update-modal">
                                <i class="fa fa-edit"></i>
                                編集
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#clothe-{{ $clothe->id }}-delete-modal">
                                <i class="fa fa-trash"></i>
                                削除
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $clothes->appends(request()->all())->render() }}
        </div>
    </section>

    <!-- 新規追加モーダル -->
    <div class="modal fade" id="clothe-create-modal" tabindex="-1"
         role="dialog" aria-labelledby="clothe-create-modal-label">
        <div class="modal-dialog" role="document">
            <form action="{{ url('/admin/product-setting/clothes') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"
                            id="clothe-create-modal-label">
                            <i class="fa fa-plus"></i>
                            生地追加
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">名前</label>
                            <div class="col-md-6">
                                <input type="text" name="clothe[name]" value="{{ old('clothe.name') }}"
                                       class="form-control" required/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">備考</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="clothe[note]">{{ old('clothe.note') }}</textarea>
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

    @foreach($clothes as $clothe)
        <!-- 編集モーダル -->
        <div class="modal fade" id="clothe-{{ $clothe->id }}-update-modal" tabindex="-1"
             role="dialog" aria-labelledby="clothe-{{ $clothe->id }}-update-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/product-setting/clothes/'. $clothe->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="clothe[id]" value="{{ $clothe->id }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="clothe-{{ $clothe->id }}-update-modal-label">
                                <i class="fa fa-edit"></i>
                                {{ $clothe->name }}編集
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">名前</label>
                                <div class="col-md-6">
                                    <input type="text" name="clothe[name]" value="{{ old('clothe.name', $clothe->name) }}"
                                           class="form-control" required/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">備考</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="clothe[note]">{{ old('clothe.note', $clothe->note) }}</textarea>
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
        <div class="modal fade" id="clothe-{{ $clothe->id }}-delete-modal" tabindex="-1"
             role="dialog" aria-labelledby="clothe-{{ $clothe->id }}-delete-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/product-setting/clothes/'. $clothe->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="clothe-{{ $clothe->id }}-delete-modal-label">
                                <i class="fa fa-trash"></i>
                                {{ $clothe->name }}削除確認
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

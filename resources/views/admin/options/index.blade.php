@extends('admin.layouts.default')

@section('title', '仕上げオプション一覧 | 仕上げオプション管理 | 幕王管理画面')

@section('content-header')
    <h1>
        仕上げオプション管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/options') }}">仕上げオプション管理</a></li>
        <li class="active">仕上げオプション一覧</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">仕上げオプション一覧</h3>
            <div class="box-tools">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#option-create-modal">
                    <i class="fa fa-plus"></i>
                    仕上げオプション登録
                </button>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <thead>
                <tr>
                    <th>名前</th>
                    <th>種別</th>
                    <th>値段</th>
                    <th>備考</th>
                    <th>更新日</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($options as $option)
                    <tr>
                        <td>{{ $option->name }}</td>
                        <td>{{ $option->type=="1"?"固定":"選択" }}</td>
                        <td>{{ number_format($option->price) }}</td>
                        <td>{!! nl2br(e( $option->note )) !!}</td>
                        <td>{{ \Carbon\Carbon::parse($option->updated_at)->format('Y年m月d日 h:i') }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#option-{{ $option->id }}-update-modal">
                                <i class="fa fa-edit"></i>
                                編集
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#option-{{ $option->id }}-delete-modal">
                                <i class="fa fa-trash"></i>
                                削除
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $options->appends(request()->all())->render() }}
        </div>
    </section>

    <!-- 新規追加モーダル -->
    <div class="modal fade" id="option-create-modal" tabindex="-1"
         role="dialog" aria-labelledby="option-create-modal-label">
        <div class="modal-dialog" role="document">
            <form action="{{ url('/admin/product-setting/options') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"
                            id="option-create-modal-label">
                            <i class="fa fa-plus"></i>
                            仕上げオプション追加
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">名前</label>
                            <div class="col-md-6">
                                <input type="text" name="option[name]" value="{{ old('option.name') }}"
                                       class="form-control" required/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <label class="control-label col-md-3">種別</label>
                        <div class="radio form-group">
                            <label class="radio-inline">
                                <input type="radio" name="option[type]" value="1"
                                       required {{ old('option.type', 1)==1?"checked":"" }}>
                                固定
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="option[type]" value="2"
                                       required {{ old('option.type', 1)==2?"checked":"" }}>
                                選択
                            </label>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">値段</label>
                            <div class="col-md-6">
                                <input type="number" name="option[price]" value="{{ old('option.price') }}"
                                       class="form-control"/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">備考</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="option[note]">{{ old('option.note') }}</textarea>
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

    @foreach($options as $option)
        <!-- 編集モーダル -->
        <div class="modal fade" id="option-{{ $option->id }}-update-modal" tabindex="-1"
             role="dialog" aria-labelledby="option-{{ $option->id }}-update-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/product-setting/options/'. $option->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="option[id]" value="{{ $option->id }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="option-{{ $option->id }}-update-modal-label">
                                <i class="fa fa-edit"></i>
                                {{ $option->name }}編集
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">名前</label>
                                <div class="col-md-6">
                                    <input type="text" name="option[name]"
                                           value="{{ old('option.name', $option->name) }}"
                                           class="form-control" required/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <label class="control-label col-md-3">種別</label>
                            <div class="radio form-group">
                                <label class="radio-inline">
                                    <input type="radio" name="option[type]" value="1"
                                           required {{ old('option.type', $option->type)==1?"checked":"" }}>
                                    固定
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="option[type]" value="2"
                                           required {{ old('option.type', $option->type)==2?"checked":"" }}>
                                    選択
                                </label>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">値段</label>
                                <div class="col-md-6">
                                    <input type="number" name="option[price]" value="{{ old('option.price', $option->price) }}"
                                           class="form-control"/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">備考</label>
                                <div class="col-md-6">
                                <textarea class="form-control"
                                          name="option[note]">{{ old('option.note', $option->note) }}</textarea>
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
        <div class="modal fade" id="option-{{ $option->id }}-delete-modal" tabindex="-1"
             role="dialog" aria-labelledby="option-{{ $option->id }}-delete-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/product-setting/options/'. $option->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="option-{{ $option->id }}-delete-modal-label">
                                <i class="fa fa-trash"></i>
                                {{ $option->name }}削除確認
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

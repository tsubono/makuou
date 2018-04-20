@extends('admin.layouts.default')

@section('title', '比率一覧 | 比率管理 | 幕王管理画面')

@section('content-header')
    <h1>
        比率管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/ratios') }}">比率管理</a></li>
        <li class="active">比率一覧</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">比率一覧</h3>
            <div class="box-tools">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#ratio-create-modal">
                    <i class="fa fa-plus"></i>
                    比率登録
                </button>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <thead>
                <tr>
                    <th>比率</th>
                    <th>備考</th>
                    <th>更新日</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($ratios as $ratio)
                    <tr>
                        <td>{{ $ratio->height }} : {{ $ratio->width }}</td>
                        <td>{!! nl2br(e( $ratio->note )) !!}</td>
                        <td>{{ \Carbon\Carbon::parse($ratio->updated_at)->format('Y年m月d日 h:i') }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#ratio-{{ $ratio->id }}-update-modal">
                                <i class="fa fa-edit"></i>
                                編集
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#ratio-{{ $ratio->id }}-delete-modal">
                                <i class="fa fa-trash"></i>
                                削除
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $ratios->appends(request()->all())->render() }}
        </div>
    </section>

    <!-- 新規追加モーダル -->
    <div class="modal fade" id="ratio-create-modal" tabindex="-1"
         role="dialog" aria-labelledby="ratio-create-modal-label">
        <div class="modal-dialog" role="document">
            <form action="{{ url('/admin/product-setting/ratios') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"
                            id="ratio-create-modal-label">
                            <i class="fa fa-plus"></i>
                            比率追加
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">縦</label>
                            <div class="col-md-6">
                                <input type="number" step="0.1" name="ratio[height]" value=""
                                       class="form-control" required/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">横</label>
                            <div class="col-md-6">
                                <input type="number" step="0.1" name="ratio[width]" value=""
                                       class="form-control" required/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">備考</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="ratio[note]">{{ old('ratio.note') }}</textarea>
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

    @foreach($ratios as $ratio)
        <!-- 編集モーダル -->
        <div class="modal fade" id="ratio-{{ $ratio->id }}-update-modal" tabindex="-1"
             role="dialog" aria-labelledby="ratio-{{ $ratio->id }}-update-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/product-setting/ratios/'. $ratio->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="ratio[id]" value="{{ $ratio->id }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="ratio-{{ $ratio->id }}-update-modal-label">
                                <i class="fa fa-edit"></i>
                                {{ $ratio->name }}編集
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">縦</label>
                                <div class="col-md-6">
                                    <input type="number" step="0.1" name="ratio[height]" value="{{ old('ratio.height', $ratio->height) }}"
                                           class="form-control" required/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">横</label>
                                <div class="col-md-6">
                                    <input type="number" step="0.1" name="ratio[width]" value="{{ old('ratio.width', $ratio->width) }}"
                                           class="form-control" required/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">備考</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="ratio[note]">{{ old('ratio.note', $ratio->note) }}</textarea>
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
        <div class="modal fade" id="ratio-{{ $ratio->id }}-delete-modal" tabindex="-1"
             role="dialog" aria-labelledby="ratio-{{ $ratio->id }}-delete-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/product-setting/ratios/'. $ratio->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="ratio-{{ $ratio->id }}-delete-modal-label">
                                <i class="fa fa-trash"></i>
                                {{ $ratio->height }} : {{ $ratio->width }}削除確認
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

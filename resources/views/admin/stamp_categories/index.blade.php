@extends('admin.layouts.default')

@section('title', 'スタンプカテゴリー一覧 | スタンプカテゴリー管理 | 幕王管理画面')

@section('content-header')
    <h1>
        スタンプカテゴリー管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/stamp-categories') }}">スタンプカテゴリー管理</a></li>
        <li class="active">スタンプカテゴリー一覧</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">スタンプカテゴリー一覧</h3>
            <div class="box-tools">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#stamp_category-create-modal">
                    <i class="fa fa-plus"></i>
                    スタンプカテゴリー登録
                </button>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <thead>
                <tr>
                    <th>カテゴリー名</th>
                    <th>カテゴリー画像</th>
                    {{--<th>説明</th>--}}
                    <th>更新日</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($stamp_categories as $stamp_category)
                    <tr>
                        <td>{{ $stamp_category->name }}</td>
                        <td>
                            @if (!empty($stamp_category->image))
                                <img src="{!! asset(env('PUBLIC', ''). $stamp_category->image) !!}" class="max-w-150">
                            @endif
                        </td>
                        {{--<td>{!! nl2br(e( $stamp_category->description )) !!}</td>--}}
                        <td>{{ \Carbon\Carbon::parse($stamp_category->updated_at)->format('Y年m月d日 h:i') }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#stamp_category-{{ $stamp_category->id }}-update-modal">
                                <i class="fa fa-edit"></i>
                                編集
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#stamp_category-{{ $stamp_category->id }}-delete-modal">
                                <i class="fa fa-trash"></i>
                                削除
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $stamp_categories->appends(request()->all())->render() }}
        </div>
    </section>

    <!-- 新規追加モーダル -->
    <div class="modal fade" id="stamp_category-create-modal" tabindex="-1"
         role="dialog" aria-labelledby="stamp_category-create-modal-label">
        <div class="modal-dialog" role="document">
            <form action="{{ url('/admin/stamp-categories') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"
                            id="stamp_category-create-modal-label">
                            <i class="fa fa-plus"></i>
                            スタンプカテゴリー追加
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">カテゴリー名</label>
                            <div class="col-md-6">
                                <input type="text" name="stamp_category[name]" value=""
                                       class="form-control" required/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">スタンプカテゴリー画像</label>
                            <div class="col-md-6">
                                <input class="upload_file" name="stamp_category[image]" type="file"
                                       multiple="" accept="image/*">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        {{--<div class="form-group input_row">--}}
                        {{--<label class="control-label col-md-3">説明</label>--}}
                        {{--<div class="col-md-6">--}}
                        {{--<textarea name="stamp_category[description]" class="form-control"></textarea>--}}
                        {{--</div>--}}
                        {{--</div>--}}
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

    @foreach($stamp_categories as $stamp_category)
        <!-- 編集モーダル -->
        <div class="modal fade" id="stamp_category-{{ $stamp_category->id }}-update-modal" tabindex="-1"
             role="dialog" aria-labelledby="stamp_category-{{ $stamp_category->id }}-update-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/stamp-categories/'. $stamp_category->id) }}" method="post"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="stamp_category[id]" value="{{ $stamp_category->id }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="stamp_category-{{ $stamp_category->id }}-update-modal-label">
                                <i class="fa fa-edit"></i>
                                {{ $stamp_category->name }}編集
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">カテゴリー名</label>
                                <div class="col-md-6">
                                    <input type="text" name="stamp_category[name]" value="{{ $stamp_category->name }}"
                                           class="form-control" required/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">スタンプカテゴリー画像</label>
                                <div class="col-md-6">
                                    <input type="hidden" name="stamp_category[image_edit]" value="-1" id="image_edit_{{ $stamp_category->id }}">
                                    <input class="edit_file" name="stamp_category[image]" type="file"
                                           multiple="" accept="image/*" id="edit_file_{{ $stamp_category->id }}">
                                </div>
                            </div>
                            {{--<div class="clearfix"></div>--}}
                            {{--<br>--}}
                            {{--<div class="form-group input_row">--}}
                                {{--<label class="control-label col-md-3">説明</label>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<textarea name="stamp_category[description]"--}}
                                              {{--class="form-control">{{ $stamp_category->description }}</textarea>--}}
                                {{--</div>--}}
                            {{--</div>--}}
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
        <div class="modal fade" id="stamp_category-{{ $stamp_category->id }}-delete-modal" tabindex="-1"
             role="dialog" aria-labelledby="stamp_category-{{ $stamp_category->id }}-delete-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/stamp-categories/'. $stamp_category->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="stamp_category-{{ $stamp_category->id }}-delete-modal-label">
                                <i class="fa fa-trash"></i>
                                {{ $stamp_category->name }}削除確認
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

            $("input.upload_file").fileinput({
                maxFilePreviewSize: 10240,
                showUpload: false,
                maxFileCount: 1,
                browseClass: 'btn btn-info fileinput-browse-button',
                browseLabel: '',
                showRemove: false,
                showZoom: false
            });

            @foreach($stamp_categories as $stamp_category)
                $("#edit_file_{{ $stamp_category->id }}").fileinput({
                    maxFilePreviewSize: 10240,
                    showUpload: false,
                    maxFileCount: 1,
                    browseClass: 'btn btn-info fileinput-browse-button',
                    browseLabel: '',
                    showRemove: true,
                    removeLabel: '',
                    removeClass: 'btn btn-danger',
                    @if (!empty(old('stamp_category.image', $stamp_category->image)))
                        initialPreview: "{{ asset(env('PUBLIC', ''). old('stamp_category.image', $stamp_category->image)) }}",
                        initialPreviewAsData: true,
                        overwriteInitial: true,
                        initialPreviewDownloadUrl: "{{ asset(env('PUBLIC', ''). old('stamp_category.image', $stamp_category->image)) }}"
                    @endif
                });
                $("#edit_file_{{ $stamp_category->id }}").on('filecleared', function (event) {
                    $("#image_edit_{{ $stamp_category->id }}").val(1);
                });
            @endforeach
        };
    </script>

@endsection

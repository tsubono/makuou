@extends('admin.layouts.default')

@section('title', '値段一覧 | 値段管理 | 幕王管理画面')

@section('content-header')
    <h1>
        値段管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/prices') }}">値段管理</a></li>
        <li class="active">値段一覧</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">値段一覧</h3>
            <div class="box-tools">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#price-create-modal">
                    <i class="fa fa-plus"></i>
                    値段登録
                </button>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <thead>
                <tr>
                    <th>サイズ</th>
                    <th>生地</th>
                    <th>比率</th>
                    <th>値段</th>
                    <th>備考</th>
                    <th>更新日</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($prices as $price)
                    <tr>
                        <td>{{ $price->size->name }}</td>
                        <td>{{ $price->clothe->name }}</td>
                        <td>{{ $price->ratio->height }} : {{ $price->ratio->width }}</td>
                        <td>{{ number_format($price->price) }}</td>
                        <td>{!! nl2br(e( $price->note )) !!}</td>
                        <td>{{ \Carbon\Carbon::parse($price->updated_at)->format('Y年m月d日 h:i') }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#price-{{ $price->id }}-update-modal">
                                <i class="fa fa-edit"></i>
                                編集
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#price-{{ $price->id }}-delete-modal">
                                <i class="fa fa-trash"></i>
                                削除
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $prices->appends(request()->all())->render() }}
        </div>
    </section>

    <!-- 新規追加モーダル -->
    <div class="modal fade" id="price-create-modal" tabindex="-1"
         role="dialog" aria-labelledby="price-create-modal-label">
        <div class="modal-dialog" role="document">
            <form action="{{ url('/admin/product-setting/prices') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"
                            id="price-create-modal-label">
                            <i class="fa fa-plus"></i>
                            値段追加
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">サイズ</label>
                            <div class="col-md-6">
                                <select name="price[size_id]" class="form-control" required>
                                    <option value=""></option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}" {{ old('price.size_id')==$size->id?"selected":"" }}>{{ $size->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">生地</label>
                            <div class="col-md-6">
                                <select name="price[clothe_id]" class="form-control" required>
                                    <option value=""></option>
                                    @foreach ($clothes as $clothe)
                                        <option value="{{ $clothe->id }}" {{ old('price.clothe_id')==$clothe->id?"selected":"" }}>{{ $clothe->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">比率</label>
                            <div class="col-md-6">
                                <select name="price[ratio_id]" class="form-control" required>
                                    <option value=""></option>
                                    @foreach ($ratios as $ratio)
                                        <option value="{{ $ratio->id }}" {{ old('price.ratio_id')==$ratio->id?"selected":"" }}>{{ $ratio->height }}
                                            : {{ $ratio->width }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">値段</label>
                            <div class="col-md-6">
                                <input type="number" name="price[price]" value=""
                                       class="form-control" required/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">備考</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="price[note]">{{ old('price.note') }}</textarea>
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

    @foreach($prices as $price)
        <!-- 編集モーダル -->
        <div class="modal fade" id="price-{{ $price->id }}-update-modal" tabindex="-1"
             role="dialog" aria-labelledby="price-{{ $price->id }}-update-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/product-setting/prices/'. $price->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="price[id]" value="{{ $price->id }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="price-{{ $price->id }}-update-modal-label">
                                <i class="fa fa-edit"></i>
                                編集
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">サイズ</label>
                                <div class="col-md-6">
                                    <select name="price[size_id]" class="form-control" required>
                                        <option value=""></option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}" {{ old('price.size_id', $price->size->id)==$size->id?"selected":"" }}>{{ $size->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">生地</label>
                                <div class="col-md-6">
                                    <select name="price[clothe_id]" class="form-control" required>
                                        <option value=""></option>
                                        @foreach ($clothes as $clothe)
                                            <option value="{{ $clothe->id }}" {{ old('price.clothe_id', $price->clothe->id)==$clothe->id?"selected":"" }}>{{ $clothe->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">比率</label>
                                <div class="col-md-6">
                                    <select name="price[ratio_id]" class="form-control" required>
                                        <option value=""></option>
                                        @foreach ($ratios as $ratio)
                                            <option value="{{ $ratio->id }}" {{ old('price.ratio_id', $price->ratio->id)==$ratio->id?"selected":"" }}>{{ $ratio->height }}
                                                : {{ $ratio->width }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">値段</label>
                                <div class="col-md-6">
                                    <input type="number" name="price[price]"
                                           value="{{ old('price.price', $price->price) }}"
                                           class="form-control" required/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">備考</label>
                                <div class="col-md-6">
                                    <textarea class="form-control"
                                              name="price[note]">{{ old('price.note', $price->note) }}</textarea>
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
        <div class="modal fade" id="price-{{ $price->id }}-delete-modal" tabindex="-1"
             role="dialog" aria-labelledby="price-{{ $price->id }}-delete-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/product-setting/prices/'. $price->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="price-{{ $price->id }}-delete-modal-label">
                                <i class="fa fa-trash"></i>
                                {{ $price->name }}削除確認
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

            @foreach($prices as $price)
            $("#edit_file_{{ $price->id }}").fileinput({
                maxFilePreviewSize: 10240,
                showUpload: false,
                maxFileCount: 1,
                browseClass: 'btn btn-info fileinput-browse-button',
                browseLabel: '',
                showRemove: true,
                removeLabel: '',
                removeClass: 'btn btn-danger',
                @if (!empty(old('price.image', $price->image)))
                initialPreview: "{{ asset(env('PUBLIC', ''). '/'. old('price.image', $price->image)) }}",
                initialPreviewAsData: true,
                overwriteInitial: true,
                initialPreviewDownloadUrl: "{{ asset(env('PUBLIC', ''). '/'. old('price.image', $price->image)) }}"
                @endif
            });
            $("#edit_file_{{ $price->id }}").on('filecleared', function (event) {
                $("#image_edit_{{ $price->id }}").val(1);
            });
            @endforeach
        };
    </script>

@endsection

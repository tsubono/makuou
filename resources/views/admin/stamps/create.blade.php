@extends('admin.layouts.default')

@section('title', 'スタンプ登録 | スタンプ管理 | 幕王管理画面')

@section('content-header')
    <h1>
        スタンプ管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/stamps') }}">スタンプ管理</a></li>
        <li class="active">スタンプ登録</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">スタンプ登録</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal" action="{{ url('/admin/stamps') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <fieldset>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="admin-email" class="control-label col-md-3">
                            名前
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="admin-name" name="stamp[name]" value="{{ old('stamp.name') }}" class="form-control" required placeholder=""/>
                            @if ($errors->has('name'))
                                @foreach ($errors->get('name') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('stamp_category_id') ? 'has-error' : '' }}">
                        <label for="admin-stamp_category_id" class="control-label col-md-3">
                            カテゴリー
                        </label>
                        <div class="col-md-6">
                            <select id="stamp-stamp_category_id" name="stamp[stamp_category_id]" class="form-control" required>
                                @foreach($stamp_categories as $stamp_category)
                                    <option value="{{ $stamp_category->id }}" {{ old('stamp.stamp_category_id') == $stamp_category->id ? "selected" : ""}}>
                                        {{ $stamp_category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('stamp_category_id'))
                                @foreach ($errors->get('stamp_category_id') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                        <label for="admin-image" class="control-label col-md-3">
                            画像
                        </label>
                        <div class="col-md-6">
                            <input class="upload_file" name="stamp[image]" type="file"
                                   multiple="" accept=".svg">
                            @if ($errors->has('image'))
                                @foreach ($errors->get('image') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="fa fa-plus"></i>
                                この内容で登録する
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="box-footer">
            <a href="{{ url('/admin/stamps') }}" class="btn btn-sm btn-default">
                <i class="fa fa-chevron-left"></i>
                スタンプ一覧へ戻る
            </a>
        </div>
    </section>

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
        };
    </script>

@endsection

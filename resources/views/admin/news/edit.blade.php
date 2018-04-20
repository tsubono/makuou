@extends('admin.layouts.default')

@section('title', '新着情報編集 | 新着情報管理 | 幕王管理画面')

@section('content-header')
    <h1>
        新着情報管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/news') }}">新着情報管理</a></li>
        <li class="active">新着情報編集</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">新着情報編集</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal" action="{{ url('/admin/news/'. $new->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <fieldset>
                    <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                        <label for="new-date" class="control-label col-md-3">
                            日付
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="new-date" name="new[date]" value="{{ old('new.name', $new->date->format('Y-m-d')) }}" class="form-control" required placeholder=""/>
                            @if ($errors->has('date'))
                                @foreach ($errors->get('date') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="new-title" class="control-label col-md-3">
                            タイトル
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="new-title" name="new[title]" value="{{ old('new.title', $new->title) }}" class="form-control" required placeholder=""/>
                            @if ($errors->has('title'))
                                @foreach ($errors->get('title') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
                        <label for="new-title" class="control-label col-md-3">
                            URL
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="new-url" name="new[url]" value="{{ old('new.url', $new->url) }}" class="form-control" placeholder=""/>
                            @if ($errors->has('url'))
                                @foreach ($errors->get('url') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            <input type="hidden" name="new[blank_flg]" value="">
                            <input type="checkbox" name="new[blank_flg]" id="new-blank_flg" value="1" {{ old('new.blank_flg', $new->blank_flg) == "1" ? "checked" : "" }}>
                            <label for="new-blank_flg">別ウィンドウを開く</label>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                        <label for="new-text" class="control-label col-md-3">
                            本文
                        </label>
                        <div class="col-md-6">
                            <textarea id="new-text" name="new[text]" class="form-control" required>{{ old('new.text', $new->text) }}</textarea>
                            @if ($errors->has('text'))
                                @foreach ($errors->get('text') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="fa fa-plus"></i>
                                この内容で更新する
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="box-footer">
            <a href="{{ url('/admin/news') }}" class="btn btn-sm btn-default">
                <i class="fa fa-chevron-left"></i>
                新着情報一覧へ戻る
            </a>
        </div>
    </section>

    <script>
        window.onload = function () {
            $('#new-date').datepicker({
                format: 'yyyy-mm-dd'
            });
        }
    </script>

@endsection

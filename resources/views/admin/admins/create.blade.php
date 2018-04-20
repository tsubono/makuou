@extends('admin.layouts.default')

@section('title', '管理スタッフ登録 | 管理スタッフ管理 | 幕王管理画面')

@section('content-header')
    <h1>
        管理スタッフ管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/admins') }}">管理スタッフ管理</a></li>
        <li class="active">管理スタッフ登録</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">管理スタッフ登録</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal" action="{{ url('/admin/admins') }}" method="post">
                {{ csrf_field() }}

                <fieldset>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="admin-name" class="control-label col-md-3">
                            名前
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="admin-name" name="admin[name]" value="{{ old('admin.name') }}" class="form-control" required placeholder=""/>
                            @if ($errors->has('name'))
                                @foreach ($errors->get('name') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="admin-email" class="control-label col-md-3">
                            メールアドレス
                        </label>
                        <div class="col-md-6">
                            <input type="email" id="admin-email" name="admin[email]" value="{{ old('admin.email') }}" class="form-control" required placeholder=""/>
                            @if ($errors->has('email'))
                                @foreach ($errors->get('email') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="admin-password" class="control-label col-md-3">
                            パスワード
                        </label>
                        <div class="col-md-6">
                            <input type="password" id="admin-password" name="admin[password]" class="form-control" required placeholder="※6文字以上で入力してください。"/>
                            @if ($errors->has('password'))
                                @foreach ($errors->get('password') as $error)
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
            <a href="{{ url('/admin/admins') }}" class="btn btn-sm btn-default">
                <i class="fa fa-chevron-left"></i>
                管理スタッフ一覧へ戻る
            </a>
        </div>
    </section>

@endsection

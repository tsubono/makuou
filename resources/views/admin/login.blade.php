@extends('admin.layouts.auth')

@section('content')
    <div class="login-logo">
        <b>幕王</b>管理画面
    </div>

    <section class="login-box-body">
        <p class="login-box-msg">ログインフォーム</p>
        <form action="{{ url('/admin/login') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="メールアドレス" required
                       value="{{ old('email') }}"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="パスワード" required/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" value="1">
                            ログイン状態を保存する
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">ログイン</button>
                </div>
            </div>
        </form>
    </section>
@endsection

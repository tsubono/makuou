@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@section('title', 'パスワード再設定')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="password pass_reset">

                <h1 class="main__title"><img src="{{asset("assets/img/password/ttl_pass_reset.png")}}" alt="パスワード再設定"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="/">HOME</a></li>
                        <li>パスワード再設定</li>
                    </ul>
                    <h4 class="ttl01">パスワード再設定</h4>

                    <div class="password__wrap">
                        <form method="POST" action="{{ route('password.request') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <dl>
                                <dt>メールアドレス</dt>
                                <dd>
                                    <input id="email" type="email" name="email" value="{{ $email or old('email') }}"
                                           required readonly>
                                </dd>
                            </dl>
                            <dl>
                                <dt>新しいパスワードを入力してください</dt>
                                <dd>
                                    <input type="password" name="password" required autofocus>
                                    @if ($errors->has('password'))
                                        <p style="color: red">{{ $errors->first('password') }}</p>
                                    @endif
                                </dd>
                            </dl>
                            <dl class="again">
                                <dt>新しいパスワードをもう一度入力してください</dt>
                                <dd>
                                    <input type="password" name="password_confirmation" placeholder="確認用" required>
                                    @if ($errors->has('password_confirmation'))
                                       <p style="color: red">{{ $errors->first('password_confirmation') }}</p>
                                    @endif
                                </dd>
                            </dl>
                            <p class="submit_btn"><input type="submit" value="パスワードを再設定する"></p>
                        </form>
                    </div>
                </div>
            </section>
            <!-- /.search -->
        </div>
    </main>
@endsection

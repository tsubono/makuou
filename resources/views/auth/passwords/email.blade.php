@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@section('title', 'パスワード再設定')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="password pass_forgot">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <h1 class="main__title"><img src="{{asset("assets/img/password/ttl_pass_forgot.png")}}"
                                                 alt="パスワードを忘れた方"></h1>
                    <div class="main__content">
                        <ul class="main__breadcrumb">
                            <li><a href="/">HOME</a></li>
                            <li>パスワードを忘れた方</li>
                        </ul>
                        <h4 class="ttl01">パスワードを忘れた方</h4>
                        <div class="password__wrap">
                            <form action="">
                                <dl>
                                    <dt>ご登録されているメールアドレスをご入力ください。</dt>
                                    <dd>
                                        <input type="email" name="email" value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                            <p style="color: red;">{{ $errors->first('email') }}</p>
                                        @endif
                                    </dd>
                                </dl>
                                <p class="submit_btn"><input type="submit" value="パスワード再設定メールを送信する"></p>
                            </form>
                        </div>
                    </div>
                </form>
            </section>
            <!-- /.search -->
        </div>
    </main>
@endsection

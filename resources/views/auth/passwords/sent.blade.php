@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@section('title', '再設定を受け付けました')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="password pass_accept">
                <h1 class="main__title"><img src="{{asset("assets/img/password/ttl_pass_accept.png")}}" alt="再設定を受け付けました"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="/">HOME</a></li>
                        <li>再設定を受け付けました</li>
                    </ul>
                    <h4 class="ttl01">再設定を受け付けました</h4>
                    <div class="password__wrap">
                        <p class="txt">入力いただいたアドレスにメールを送信いたしました。<br>メールから新しいパスワード設定画面へお進みください。</p>
                    </div>
                </div>
            </section><!-- /.search -->
        </div>
    </main>
@endsection

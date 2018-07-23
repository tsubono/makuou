@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@section('title', 'パスワードを変更いたしました')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="password pass_complete">
                <h1 class="main__title"><img src="{{asset("assets/img/password/ttl_pass_complete.png")}}"
                                             alt="パスワードを変更いたしました"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="/">HOME</a></li>
                        <li>パスワードを変更いたしました</li>
                    </ul>
                    <h4 class="ttl01">パスワードを変更いたしました</h4>
                    <div class="password__wrap">
                        <p class="txt">パスワードを変更いたしました。</p>
                        <p class="submit_btn">
                        <form action="{{ url('/login') }}" method="get">
                            <input type="submit" value="ログインページへ">
                        </form>
                        </p>
                    </div>
                </div>
            </section>
            <!-- /.search -->
        </div>
    </main>
@endsection

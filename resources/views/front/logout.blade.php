@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
@endpush

@section('title', 'ログアウト')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="logout">
                <h1 class="main__title"><img src="{{asset("assets/img/logout/title.png")}}" alt="ログアウト"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url("/")}}">HOME</a></li>
                        <li><a href="{{url("mypage")}}">マイページ</a></li>
                        <li>ログアウト</li>
                    </ul>
                    <h4 class="ttl01">ログアウト</h4>
                    <div class="logout__info cf">
                        <div class="txt">
                            <div class="img"><img src="{{asset("assets/img/common/makuou.png")}}" alt=""></div>
                            <h2>ログアウトしました</h2>
                            <p class="btn"><a href="{{url("/")}}">トップへもどる</a></p>
                        </div>
                    </div>

                </div>
            </section>
            <!-- /.search -->

        </div>
    </main>
    <!-- /.l-main -->
@endsection
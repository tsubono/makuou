@extends('front.layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
@endpush

@section('title', '退会する')

@section('content')

    <main class="l-main">
        <div class="l-inner">
            <section class="cancel">
                <h1 class="main__title"><img src="{{asset("assets/img/cancell/title.png")}}" alt="退会する"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="/">HOME</a></li>
                        <li><a href="{{url("mypage")}}">マイページ</a></li>
                        <li><a href="{{url("index.php")}}">退会する</a></li>
                        <li>完了画面</li>
                    </ul>
                    <h4 class="ttl01">退会する</h4>
                    <div class="logout__info cf">
                        <div class="txt">
                            <div class="img"><img src="{{asset("assets/img/common/makuou.png")}}" alt=""></div>
                            <h2>ご利用いただきありがとうございました。</h2>
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
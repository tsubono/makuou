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
                        <li><a href="{{url("/")}}">HOME</a></li>
                        <li><a href="{{url("mypage")}}">マイページ</a></li>
                        <li>退会する</li>
                    </ul>
                    <h4 class="ttl01">退会する</h4>
                    <div class="logout__info cf">
                        <div class="txt">
                            <h2 class="mt0">退会する</h2>
                            <p class="txt_c mb30">退会すると、これまでの保存作品や注文履歴、登録情報が削除されます。</p>
                            <p class="btn mb10"><a href="{{url("mypage")}}">マイページへもどる</a></p>
                            <p class="btn"><a href="{{url("cancel/complete")}}">退会を確定する</a></p>
                        </div>
                    </div>

                </div>
            </section>
            <!-- /.search -->

        </div>
    </main>
    <!-- /.l-main -->
@endsection
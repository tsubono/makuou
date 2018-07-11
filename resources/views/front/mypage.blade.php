@extends('front/layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
@endpush

@section('title', 'マイページ')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="mypage">
                <h1 class="main__title"><img src="{{asset("assets/img/mypage/title.png")}}" alt="ログイン"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url("/")}}">HOME</a></li>
                        <li>マイページ</li>
                    </ul>
                    <h4 class="ttl01">マイページ</h4>
                    <ul class="two_box">
                        <li><a href="{{url("save")}}"><img src="{{asset("assets/img/mypage/mypage_01.png")}}" alt="保存作品"></a></li>
                        <li><a href="{{url("favorite")}}"><img src="{{asset("assets/img/mypage/mypage_02.png")}}" alt="お気に入りテンプレート"></a></li>
                    </ul>
                    <ul class="there_box">
                        <li><a href="{{url("member")}}"><img src="{{asset("assets/img/mypage/mypage_03.png")}}" alt="登録情報の確認編集"></a></li>
                        <li><a href="{{url("ordered")}}"><img src="{{asset("assets/img/mypage/mypage_04.png")}}" alt="注文履歴"></a></li>
                        <li><a href="{{url("logout")}}"><img src="{{asset("assets/img/mypage/mypage_05.png")}}" alt="ログアウト"></a></li>
                    </ul>
                    <div class="pickup">
                        <div class="btn"><a href="{{url("search")}}"><img src="{{asset("assets/img/top/make_btn.png")}}" alt="ネットでレイアウトを調整しながら自分でデザイン！オリジナル横断幕を作る"></a></div>
                    </div>
                </div>
            </section>
            <!-- /.search -->

        </div>
    </main>
    <!-- /.l-main -->
@endsection
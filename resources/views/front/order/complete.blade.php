@extends('front.layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
@endpush

@section('title', 'ご注文情報')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="settlement">
                <h1 class="main__title"><img src="{{asset("assets/img/settlement/title.png")}}" alt="ご注文"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="/">HOME</a></li>
                        <li>ご注文情報</li>
                    </ul>
                    <h2 class="ttl01">決済完了</h2>
                    <div class="settlement__wrap">
                        <form class="form_template" action="{{ url('/mypage') }}" method="get">
                            <p class="txt_c">この度は幕王よりご注文いただきありがとうございます。<br>ご注文内容を確認し、担当者よりご連絡させていただきます。<br>今しばらくお待ちくださいませ。</p>
                            <ul class="sendarea complete type_css">
                                <li><input name="submit" value="マイページトップへもどる" class="btn_css_check" type="submit"></li>
                            </ul>
                        </form>
                    </div>
                </div>
            </section><!-- /.search -->
        </div>
    </main>
    <!-- /.l-main -->
@endsection
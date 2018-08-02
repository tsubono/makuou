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
                    <h2 class="ttl01">このまま決済情報のご入力へお進みください。</h2>
                    <div class="settlement__wrap">
                        <form class="form_template">
                            <p class="txt_c">クレジットカード決済には、株式会社ユニヴァ・ペイキャストの決済代行サービスを使用しています。<br>決済情報はSSL で暗号化され、安全性を確保しております。</p>
                            <ul class="sendarea row type_css">
                                <li><input name="submit" value="クレジットカード決済をお選びの方" class="btn_css_check" type="submit"></li>
                                <li><input name="submit" value="銀行振込をお選びの方" class="btn_css_check" type="submit"></li>
                                <li><input name="submit" value="コンビニ決済をお選びの方" class="btn_css_check" type="submit"></li>
                            </ul>
                        </form>
                    </div>
                </div>
            </section><!-- /.search -->
        </div>
    </main>
    <!-- /.l-main -->
@endsection
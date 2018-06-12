@extends('front/layouts.default')

@push('css')
    <!-- bootstrap -->
    <link href="{{asset("bower_components/bootstrap/dist/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")}}"
          rel="stylesheet" type="text/css"/>
    {{--type="text/css"/>--}}
    <link rel="stylesheet" type="text/css" href="{{asset("css/font-awesome.min.css")}}">
    <!-- ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset("bower_components/bootstrap-fileinput/css/fileinput.min.css")}}" media="all" rel="stylesheet"
          type="text/css"/>

    <link href='https://fonts.googleapis.com/css?family=Lato:400,300|Lobster|Architects+Daughter|Roboto|Oswald|Montserrat|Lora|PT+Sans|Ubuntu|Roboto+Slab|Fjalla+One|Indie+Flower|Playfair+Display|Poiret+One|Dosis|Oxygen|Lobster|Play|Shadows+Into+Light|Pacifico|Dancing+Script|Kaushan+Script|Gloria+Hallelujah|Black+Ops+One|Lobster+Two|Satisfy|Pontano+Sans|Domine|Russo+One|Handlee|Courgette|Special+Elite|Amaranth|Vidaloka'
          rel='stylesheet' type='text/css'>
    {{--<link rel="stylesheet" type="text/css" href="{{asset("css/normalize.css")}}">--}}
    <link rel="stylesheet" type="text/css" href="{{asset("css/ng-scrollbar.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/canvas_custom.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/fonts.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/bootstrap-colorpicker.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("css/angular-material.css")}}">


    <link href="{{asset("css/custom.css")}}" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">

@endpush

@push('script')
    <script src="{{asset("assets/js/search.js")}}"></script>
    <script>
        $(function () {
            var id = "{{ $product->id }}";
            $('#productApp').scope().initFabric("{{ $product->ratio->width * 600 }}", "{{ $product->ratio->height * 600 }}");
            $('#productApp').scope().loadProduct("{{ $product->title }}", "{{ $product->image }}", id);

            setTimeout(function () {
                $('#productApp').scope().deactivateAll();
                var json = $('#productApp').scope().getDesignJson();

                $('#productApp').scope().loadByJson(json);

                // 編集中の商品ID更新
                $('#productApp').scope().defaultProductId = id;


            }, 100);
        });
    </script>

@endpush

@section('title', 'レイアウトを作る')

@section('content')
    <main class="l-main">
        <div class="l-inner">
            <section class="layout">
                <h1 class="main__title"><img src="{{asset("assets/img/layout/title.png")}}" alt="レイアウトを作る"></h1>
                <div class="main__content">
                    <ul class="main__breadcrumb">
                        <li><a href="{{url('/')}}">HOME</a></li>
                        <li>レイアウトを作る</li>
                    </ul>
                    <div>
                        {{--<img src="{{asset("assets/img/layout/scrn.png")}}" alt="デザイン編集画面">--}}
                        @include('front.design')
                    </div>
                    <div class="btn">
                        <a href="#">デザイン確認</a>
                    </div>
                </div>
            </section>
            <!-- /.layout -->
        </div>
    </main>
    <!-- /.l-main -->
@endsection
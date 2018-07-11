@extends('front.layouts.default')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/layer.css")}}">
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
                        <a href="#" id="save_design">デザイン確認</a>
                    </div>
                </div>
                <form class="form-horizontal" id="form1" action="{{ url('/layout/confirm') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="designed_filename" value="">
                    <input type="hidden" name="designed_image" value="">
                    <input type="hidden" name="uploaded_files" value="">
                    <input type="hidden" name="json_text" value="">
                </form>
            </section>
            <!-- /.layout -->
        </div>
    </main>
    <!-- /.l-main -->
@endsection
@extends('admin.layouts.default')

@section('title', '幕王管理画面')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/search.css")}}">
    <style>
        .errorMsg {
            text-align: center;
            font-size: 25px;
        }
    </style>
@endpush

@section('content')
    <section class="box box-default">
        <div class="box-body">
            <p class="errorMsg">エラーが発生しました。</p>
        </div>
    </section>
@endsection

@extends('admin/layouts.default')

@section('title', 'ホーム | 幕王管理画面')

@section('content-header')
    <h1>
        幕王管理
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ダッシュボード</a></li>
    </ol>
@endsection

@section('content')
    <!-- コンテンツ1 -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">ボックスタイトル</h3>
        </div>
        <div class="box-body">
            <p>ボックスボディー</p>
        </div>
    </div>
@endsection

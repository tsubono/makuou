@extends('admin.layouts.default')

@section('title', '受注一覧 | 受注管理 | 幕王管理画面')

@section('content-header')
    <h1>
        受注管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/orders') }}">受注管理</a></li>
        <li class="active">受注一覧</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">受注一覧</h3>
            <div class="box-tools">
                <a href="{{ url('/admin/orders/create') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i>
                    受注登録
                </a>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>注文番号</th>
                        <th>受注日</th>
                        <th>お名前</th>
                        <th>支払い方法</th>
                        <th>購入金額</th>
                        <th>発送日</th>
                        <th>対応状況</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->ordered_at->format('Y年m月d日') }}</td>
                        <td>{{ $order->user->name or "" }}</td>
                        <td>{{ $order->payment->name }}</td>
                        <td>{{ number_format($order->total) }}</td>
                        <td>
                            @if (!empty($order->shipping_at))
                                {{ $order->shipping_at->format('Y年m月d日') }}
                            @endif
                        </td>
                        <td>{{ config('const.order.status')[$order->status] }}</td>
                        <td>
                            <a href="{{ url('/admin/orders/'. $order->id. '/edit') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i>
                                編集
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#order-{{ $order->id }}-delete-modal">
                                <i class="fa fa-trash"></i>
                                削除
                            </button>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $orders->appends(request()->all())->render() }}
        </div>
    </section>
    @foreach($orders as $order)
        <div class="modal fade" id="order-{{ $order->id }}-delete-modal" tabindex="-1" role="dialog" aria-labelledby="order-{{ $order->id }}-delete-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/orders/'. $order->id) }}" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="order-{{ $order->id }}-delete-modal-label">
                                <i class="fa fa-trash"></i>
                                削除確認
                            </h4>
                        </div>
                        <div class="modal-body">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <p>本当に削除してもよろしいですか？</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                                <i class="fa fa-times"></i>
                                キャンセル
                            </button>
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                                削除する
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection

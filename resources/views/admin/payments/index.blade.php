@extends('admin.layouts.default')

@section('title', '支払い方法一覧 | 支払い方法管理 | 幕王管理画面')

@section('content-header')
    <h1>
        支払い方法管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/payments') }}">支払い方法管理</a></li>
        <li class="active">支払い方法一覧</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">支払い方法一覧</h3>
            <div class="box-tools">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#payment-create-modal">
                    <i class="fa fa-plus"></i>
                    支払い方法登録
                </button>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <thead>
                <tr>
                    <th>支払い方法</th>
                    <th>手数料</th>
                    <th>利用条件</th>
                    <th>更新日</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->name }}</td>
                        <td>{{ $payment->commission }}</td>
                        <td>{{ $payment->minimum_amount }} 〜　{{ $payment->maximum_amount }}</td>
                        <td>{{ \Carbon\Carbon::parse($payment->updated_at)->format('Y年m月d日 h:i') }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#payment-{{ $payment->id }}-update-modal">
                                <i class="fa fa-edit"></i>
                                編集
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#payment-{{ $payment->id }}-delete-modal">
                                <i class="fa fa-trash"></i>
                                削除
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $payments->appends(request()->all())->render() }}
        </div>
    </section>

    <!-- 新規追加モーダル -->
    <div class="modal fade" id="payment-create-modal" tabindex="-1"
         role="dialog" aria-labelledby="payment-create-modal-label">
        <div class="modal-dialog" role="document">
            <form action="{{ url('/admin/setting/payments') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"
                            id="payment-create-modal-label">
                            <i class="fa fa-plus"></i>
                            支払い方法追加
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">名前</label>
                            <div class="col-md-6">
                                <input type="text" name="payment[name]" value=""
                                       class="form-control" required/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">手数料</label>
                            <div class="col-md-6 form-inline">
                                <div class="input-group">
                                    <span class="input-group-addon">¥ </span>
                                    <input type="number" name="payment[commission]" value="0"
                                           class="form-control" required/>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="form-group input_row">
                            <label class="control-label col-md-3">利用条件</label>
                            <div class="col-md-9 form-inline">
                                <div class="input-group col-md-5">
                                    <span class="input-group-addon">¥ </span>
                                    <input type="number" name="payment[minimum_amount]" class="form-control" value="0" required>
                                </div>
                                〜
                                <div class="input-group col-md-5">
                                    <span class="input-group-addon">¥ </span>
                                    <input type="number" name="payment[maximum_amount]" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                            <i class="fa fa-times"></i>
                            キャンセル
                        </button>
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus"></i>
                            追加する
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @foreach($payments as $payment)
        <!-- 編集モーダル -->
        <div class="modal fade" id="payment-{{ $payment->id }}-update-modal" tabindex="-1"
             role="dialog" aria-labelledby="payment-{{ $payment->id }}-update-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/setting/payments/'. $payment->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="payment[id]" value="{{ $payment->id }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="payment-{{ $payment->id }}-update-modal-label">
                                <i class="fa fa-edit"></i>
                                {{ $payment->name }}編集
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">名前</label>
                                <div class="col-md-6">
                                    <input type="text" name="payment[name]" value="{{ old('payment.name', $payment->name) }}"
                                           class="form-control" required/>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">手数料</label>
                                <div class="col-md-6 form-inline">
                                    <div class="input-group">
                                        <span class="input-group-addon">¥ </span>
                                        <input type="number" name="payment[commission]" value="{{ old('payment.commission', $payment->commission) }}"
                                               class="form-control" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <div class="form-group input_row">
                                <label class="control-label col-md-3">利用条件</label>
                                <div class="col-md-9 form-inline">
                                    <div class="input-group col-md-5">
                                        <span class="input-group-addon">¥ </span>
                                        <input type="number" name="payment[minimum_amount]" class="form-control" value="{{ old('payment.minimum_amount', $payment->minimum_amount) }}" required>
                                    </div>
                                    〜
                                    <div class="input-group col-md-5">
                                        <span class="input-group-addon">¥ </span>
                                        <input type="number" name="payment[maximum_amount]" class="form-control" value="{{ old('payment.maximum_amount', $payment->maximum_amount) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="clearfix"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">
                                <i class="fa fa-times"></i>
                                キャンセル
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i>
                                更新する
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /編集モーダル -->

        <!-- 削除モーダル -->
        <div class="modal fade" id="payment-{{ $payment->id }}-delete-modal" tabindex="-1"
             role="dialog" aria-labelledby="payment-{{ $payment->id }}-delete-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/setting/payments/'. $payment->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"
                                id="payment-{{ $payment->id }}-delete-modal-label">
                                <i class="fa fa-trash"></i>
                                {{ $payment->name }}削除確認
                            </h4>
                        </div>
                        <div class="modal-body">
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
        <!-- /削除モーダル -->
    @endforeach

    <script>
        window.onload = function () {
        };
    </script>

@endsection

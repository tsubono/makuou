@extends('admin.layouts.default')

@section('title', '特定商取引法管理 | 幕王管理画面')

@section('content-header')
    <h1>
        特定商取引法管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li class="active">特定商取引法管理</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">特定商取引法編集</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal" action="{{ url('/admin/setting/tradelaw/'. $tradelaw->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <fieldset>
                    <div class="form-group {{ $errors->has('seller') ? 'has-error' : '' }}">
                        <label for="tradelaw-seller" class="control-label col-md-3">
                            販売業者
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="tradelaw-seller" name="tradelaw[seller]" value="{{ old('tradelaw.seller', $tradelaw->seller) }}" class="form-control" required placeholder=""/>
                            @if ($errors->has('seller'))
                                @foreach ($errors->get('seller') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('operation_manager') ? 'has-error' : '' }}">
                        <label for="tradelaw-operation_manager" class="control-label col-md-3">
                            運営責任者
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="tradelaw-operation_manager" name="tradelaw[operation_manager]" value="{{ old('tradelaw.operation_manager', $tradelaw->operation_manager) }}" class="form-control" required placeholder=""/>
                            @if ($errors->has('operation_manager'))
                                @foreach ($errors->get('operation_manager') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ ($errors->has('zip01')||$errors->has('zip02')) ? 'has-error' : '' }}">
                        <label for="tradelaw-zip01" class="control-label col-md-3">
                            郵便番号
                        </label>
                        <div class="col-md-6 input_zip form-inline">
                            〒
                            <input type="number" id="tradelaw-zip01" name="tradelaw[zip01]" class="form-control" value="{{ old('tradelaw.zip01', !empty($tradelaw->zip_code) ? explode("-", $tradelaw->zip_code)[0] : "") }}" required>
                            -
                            <input type="number" id="tradelaw-zip02" name="tradelaw[zip02]" class="form-control" value="{{ old('tradelaw.zip02', !empty($tradelaw->zip_code) ? explode("-", $tradelaw->zip_code)[1] : "") }}" required>
                            <span>
                                <button type="button" id="zip-btn" class="btn btn-default btn-sm">郵便番号から自動入力</button>
                            </span>
                            @if ($errors->has('zip01'))
                                @foreach ($errors->get('zip01') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            @if ($errors->has('zip02'))
                                @foreach ($errors->get('zip02') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('pref_id') ? 'has-error' : '' }}">
                        <label for="tradelaw-pref_id" class="control-label col-md-3">
                            都道府県
                        </label>
                        <div class="col-md-6">
                            <select id="tradelaw-pref_id" name="tradelaw[pref_id]" class="form-control" required>
                                @foreach(config('pref') as $key => $name)
                                    <option value="{{ $key }}" {{ old('tradelaw.pref_id', $tradelaw->pref_id) == $key ? "selected" : "" }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('pref_id'))
                                @foreach ($errors->get('pref_id') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('address1') ? 'has-error' : '' }}">
                        <label for="tradelaw-address1" class="control-label col-md-3">
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="tradelaw-address1" name="tradelaw[address1]" value="{{ old('tradelaw.address1', $tradelaw->address1) }}" class="form-control" required placeholder="市区町村"/>
                            @if ($errors->has('address1'))
                                @foreach ($errors->get('address1') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('address2') ? 'has-error' : '' }}">
                        <label for="tradelaw-address2" class="control-label col-md-3">
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="tradelaw-address2" name="tradelaw[address2]" value="{{ old('tradelaw.address2', $tradelaw->address2) }}" class="form-control" required placeholder="番地・ビル名"/>
                            @if ($errors->has('address2'))
                                @foreach ($errors->get('address2') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ ($errors->has('tel01')||$errors->has('tel02')||$errors->has('tel03')) ? 'has-error' : '' }}">
                        <label for="tradelaw-tel01" class="control-label col-md-3">
                            電話番号
                        </label>
                        <div class="col-md-6 form-inline">
                            <input type="number" id="tradelaw-tel01" name="tradelaw[tel01]" class="form-control" value="{{ old('tradelaw.tel01', !empty($tradelaw->tel) ? explode("-", $tradelaw->tel)[0] : "") }}" required>
                            -
                            <input type="number" id="tradelaw-tel02" name="tradelaw[tel02]" class="form-control" value="{{ old('tradelaw.tel02', !empty($tradelaw->tel) ? explode("-", $tradelaw->tel)[1] : "") }}" required>
                            -
                            <input type="number" id="tradelaw-tel03" name="tradelaw[tel03]" class="form-control" value="{{ old('tradelaw.tel03', !empty($tradelaw->tel) ? explode("-", $tradelaw->tel)[2] : "") }}" required>
                            @if ($errors->has('tel01'))
                                @foreach ($errors->get('tel01') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            @if ($errors->has('tel02'))
                                @foreach ($errors->get('tel02') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            @if ($errors->has('tel03'))
                                @foreach ($errors->get('tel03') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ ($errors->has('fax01')||$errors->has('fax02')||$errors->has('fax03')) ? 'has-error' : '' }}">
                        <label for="tradelaw-tel01" class="control-label col-md-3">
                            FAX番号
                        </label>
                        <div class="col-md-6 form-inline">
                            <input type="text" id="tradelaw-fax01" name="tradelaw[fax01]" class="form-control" value="{{ old('tradelaw.fax01', !empty($tradelaw->fax) ? explode("-", $tradelaw->fax)[0] : "") }}">
                            -
                            <input type="text" id="tradelaw-fax02" name="tradelaw[fax02]" class="form-control" value="{{ old('tradelaw.fax02', !empty($tradelaw->fax) ? explode("-", $tradelaw->fax)[1] : "") }}">
                            -
                            <input type="text" id="tradelaw-fax03" name="tradelaw[fax03]" class="form-control" value="{{ old('tradelaw.fax03', !empty($tradelaw->fax) ? explode("-", $tradelaw->fax)[2] : "") }}">
                            @if ($errors->has('fax01'))
                                @foreach ($errors->get('fax01') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            @if ($errors->has('fax02'))
                                @foreach ($errors->get('fax02') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            @if ($errors->has('fax03'))
                                @foreach ($errors->get('fax03') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="tradelaw-email" class="control-label col-md-3">
                            メールアドレス
                        </label>
                        <div class="col-md-6">
                            <input type="email" id="tradelaw-email" name="tradelaw[email]" value="{{ old('tradelaw.email', $tradelaw->email) }}" class="form-control" required placeholder=""/>
                            @if ($errors->has('email'))
                                @foreach ($errors->get('email') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('other_price') ? 'has-error' : '' }}">
                        <label for="tradelaw-other_price" class="control-label col-md-3">
                            商品代金以外の必要料金
                        </label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="tradelaw-other_price" name="tradelaw[other_price]" rows="4" required>{{ old('tradelaw.other_price', $tradelaw->other_price) }}</textarea>
                            @if ($errors->has('other_price'))
                                @foreach ($errors->get('other_price') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('payment_method') ? 'has-error' : '' }}">
                        <label for="tradelaw-payment_method" class="control-label col-md-3">
                            支払方法
                        </label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="tradelaw-payment_method" name="tradelaw[payment_method]" rows="4" required>{{ old('tradelaw.payment_method', $tradelaw->payment_method) }}</textarea>
                            @if ($errors->has('payment_method'))
                                @foreach ($errors->get('payment_method') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('payment_limit') ? 'has-error' : '' }}">
                        <label for="tradelaw-payment_limit" class="control-label col-md-3">
                            支払期限
                        </label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="tradelaw-payment_limit" name="tradelaw[payment_limit]" rows="4" required>{{ old('tradelaw.payment_limit', $tradelaw->payment_limit) }}</textarea>
                            @if ($errors->has('payment_limit'))
                                @foreach ($errors->get('payment_limit') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('delivery_time') ? 'has-error' : '' }}">
                        <label for="tradelaw-delivery_time" class="control-label col-md-3">
                            引き渡し時期
                        </label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="tradelaw-delivery_time" name="tradelaw[delivery_time]" rows="4" required>{{ old('tradelaw.delivery_time', $tradelaw->delivery_time) }}</textarea>
                            @if ($errors->has('delivery_time'))
                                @foreach ($errors->get('delivery_time') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('about_returned_exchange') ? 'has-error' : '' }}">
                        <label for="tradelaw-about_returned_exchange" class="control-label col-md-3">
                            返品・交換について
                        </label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="tradelaw-about_returned_exchange" name="tradelaw[about_returned_exchange]" rows="4" required>{{ old('tradelaw.about_returned_exchange', $tradelaw->about_returned_exchange) }}</textarea>
                            @if ($errors->has('about_returned_exchange'))
                                @foreach ($errors->get('about_returned_exchange') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="fa fa-plus"></i>
                                この内容で更新する
                            </button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </section>

    <script>
        window.onload = function () {
            $('#zip-btn').click(function(){
                AjaxZip3.zip2addr('tradelaw[zip01]', 'tradelaw[zip02]', 'tradelaw[pref_id]', 'tradelaw[address1]');
            });
        }
    </script>

@endsection

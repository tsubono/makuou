@extends('admin.layouts.default')

@section('title', 'ショップ情報管理 | 幕王管理画面')

@section('content-header')
    <h1>
        ショップ情報管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li class="active">ショップ情報管理</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">ショップ情報編集</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal" action="{{ url('/admin/setting/shop/'. $shop->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <fieldset>
                    <div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}">
                        <label for="shop-company_name" class="control-label col-md-3">
                            会社名
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="shop-company_name" name="shop[company_name]" value="{{ old('shop.company_name', $shop->company_name) }}" class="form-control" required placeholder=""/>
                            @if ($errors->has('company_name'))
                                @foreach ($errors->get('company_name') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('company_name_kana') ? 'has-error' : '' }}">
                        <label for="shop-company_name_kana" class="control-label col-md-3">
                            会社名（フリガナ）
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="shop-company_name_kana" name="shop[company_name_kana]" value="{{ old('shop.company_name_kana', $shop->company_name_kana) }}" class="form-control" placeholder=""/>
                            @if ($errors->has('company_name_kana'))
                                @foreach ($errors->get('company_name_kana') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('shop_name') ? 'has-error' : '' }}">
                        <label for="shop-shop_name" class="control-label col-md-3">
                            ショップ名
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="shop-shop_name" name="shop[shop_name]" value="{{ old('shop.shop_name', $shop->shop_name) }}" class="form-control" required placeholder=""/>
                            @if ($errors->has('shop_name'))
                                @foreach ($errors->get('shop_name') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('shop_name_kana') ? 'has-error' : '' }}">
                        <label for="shop-shop_name_kana" class="control-label col-md-3">
                            ショップ名（フリガナ）
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="shop-shop_name_kana" name="shop[shop_name_kana]" value="{{ old('shop.shop_name_kana', $shop->shop_name_kana) }}" class="form-control" placeholder=""/>
                            @if ($errors->has('shop_name_kana'))
                                @foreach ($errors->get('shop_name_kana') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ ($errors->has('zip01')||$errors->has('zip02')) ? 'has-error' : '' }}">
                        <label for="shop-zip01" class="control-label col-md-3">
                            郵便番号
                        </label>
                        <div class="col-md-6 input_zip form-inline">
                            〒
                            <input type="number" id="shop-zip01" name="shop[zip01]" class="form-control" value="{{ old('shop.zip01', !empty($shop->zip_code) ? explode("-", $shop->zip_code)[0] : "") }}" required>
                            -
                            <input type="number" id="shop-zip02" name="shop[zip02]" class="form-control" value="{{ old('shop.zip02', !empty($shop->zip_code) ? explode("-", $shop->zip_code)[1] : "") }}" required>
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
                        <label for="shop-pref_id" class="control-label col-md-3">
                            都道府県
                        </label>
                        <div class="col-md-6">
                            <select id="shop-pref_id" name="shop[pref_id]" class="form-control" required>
                                @foreach(config('pref') as $key => $name)
                                    <option value="{{ $key }}" {{ old('shop.pref_id', $shop->pref_id) == $key ? "selected" : "" }}>{{ $name }}</option>
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
                        <label for="shop-address1" class="control-label col-md-3">
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="shop-address1" name="shop[address1]" value="{{ old('shop.address1', $shop->address1) }}" class="form-control" required placeholder="市区町村"/>
                            @if ($errors->has('address1'))
                                @foreach ($errors->get('address1') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('address2') ? 'has-error' : '' }}">
                        <label for="shop-address2" class="control-label col-md-3">
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="shop-address2" name="shop[address2]" value="{{ old('shop.address2', $shop->address2) }}" class="form-control" required placeholder="番地・ビル名"/>
                            @if ($errors->has('address2'))
                                @foreach ($errors->get('address2') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ ($errors->has('tel01')||$errors->has('tel02')||$errors->has('tel03')) ? 'has-error' : '' }}">
                        <label for="shop-tel01" class="control-label col-md-3">
                            電話番号
                        </label>
                        <div class="col-md-6 form-inline">
                            <input type="number" id="shop-tel01" name="shop[tel01]" class="form-control" value="{{ old('shop.tel01', !empty($shop->tel) ? explode("-", $shop->tel)[0] : "") }}" required>
                            -
                            <input type="number" id="shop-tel02" name="shop[tel02]" class="form-control" value="{{ old('shop.tel02', !empty($shop->tel) ? explode("-", $shop->tel)[1] : "") }}" required>
                            -
                            <input type="number" id="shop-tel03" name="shop[tel03]" class="form-control" value="{{ old('shop.tel03', !empty($shop->tel) ? explode("-", $shop->tel)[2] : "") }}" required>
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
                        <label for="shop-tel01" class="control-label col-md-3">
                            FAX番号
                        </label>
                        <div class="col-md-6 form-inline">
                            <input type="text" id="shop-fax01" name="shop[fax01]" class="form-control" value="{{ old('shop.fax01', !empty($shop->fax) ? explode("-", $shop->fax)[0] : "") }}">
                            -
                            <input type="text" id="shop-fax02" name="shop[fax02]" class="form-control" value="{{ old('shop.fax02', !empty($shop->fax) ? explode("-", $shop->fax)[1] : "") }}">
                            -
                            <input type="text" id="shop-fax03" name="shop[fax03]" class="form-control" value="{{ old('shop.fax03', !empty($shop->fax) ? explode("-", $shop->fax)[2] : "") }}">
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
                    <div class="form-group {{ $errors->has('business_hours') ? 'has-error' : '' }}">
                        <label for="shop-business_hours" class="control-label col-md-3">
                            営業時間
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="shop-business_hours" name="shop[business_hours]" value="{{ old('shop.business_hours', $shop->business_hours) }}" class="form-control" placeholder=""/>
                            @if ($errors->has('business_hours'))
                                @foreach ($errors->get('business_hours') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email_from') ? 'has-error' : '' }}">
                        <label for="shop-email_from" class="control-label col-md-3">
                            送信元メールアドレス(From)
                        </label>
                        <div class="col-md-6">
                            <input type="email" id="shop-email_from" name="shop[email_from]" value="{{ old('shop.email_from', $shop->email_from) }}" class="form-control" required placeholder=""/>
                            @if ($errors->has('email_from'))
                                @foreach ($errors->get('email_from') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                        <label for="shop-message" class="control-label col-md-3">
                            メッセージ
                        </label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="shop-message" name="shop[message]">{{ old('shop.message', $shop->message) }}</textarea>
                            @if ($errors->has('message'))
                                @foreach ($errors->get('message') as $error)
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
                AjaxZip3.zip2addr('shop[zip01]', 'shop[zip02]', 'shop[pref_id]', 'shop[address1]');
            });
        }
    </script>

@endsection

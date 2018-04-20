@extends('admin.layouts.default')

@section('title', '会員編集 | 会員管理 | 幕王管理画面')

@section('content-header')
    <h1>
        会員管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/users') }}">会員管理</a></li>
        <li class="active">会員編集</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">会員編集</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal" action="{{ url('/admin/users/'. $user->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <fieldset>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="user-name" class="control-label col-md-3">
                            名前
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="user-name" name="user[name]" value="{{ old('user.name', $user->name) }}" class="form-control" required placeholder=""/>
                            @if ($errors->has('name'))
                                @foreach ($errors->get('name') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('name_kana') ? 'has-error' : '' }}">
                        <label for="user-name_kana" class="control-label col-md-3">
                            名前（フリガナ）
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="user-name_kana" name="user[name_kana]" value="{{ old('user.name_kana', $user->name_kana) }}" class="form-control" required placeholder=""/>
                            @if ($errors->has('name_kana'))
                                @foreach ($errors->get('name_kana') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}">
                        <label for="user-company_name" class="control-label col-md-3">
                            会社名
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="user-company_name" name="user[company_name]" value="{{ old('user.company_name', $user->company_name) }}" class="form-control" placeholder=""/>
                            @if ($errors->has('company_name'))
                                @foreach ($errors->get('company_name') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ ($errors->has('zip01')||$errors->has('zip02')) ? 'has-error' : '' }}">
                        <label for="user-zip01" class="control-label col-md-3">
                            郵便番号
                        </label>
                        <div class="col-md-6 input_zip form-inline">
                            〒
                            <input type="number" id="user-zip01" name="user[zip01]" class="form-control" value="{{ old('user.zip01', !empty($user->zip_code) ? explode("-", $user->zip_code)[0] : "") }}" required>
                            -
                            <input type="number" id="user-zip02" name="user[zip02]" class="form-control" value="{{ old('user.zip02', !empty($user->zip_code) ? explode("-", $user->zip_code)[1] : "") }}" required>
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
                        <label for="user-pref_id" class="control-label col-md-3">
                            都道府県
                        </label>
                        <div class="col-md-6">
                            <select id="user-pref_id" name="user[pref_id]" class="form-control" required>
                                @foreach(config('pref') as $key => $name)
                                    <option value="{{ $key }}" {{ old('user.pref_id', $user->pref_id) == $key ? "selected" : "" }}>{{ $name }}</option>
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
                        <label for="user-address1" class="control-label col-md-3">
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="user-address1" name="user[address1]" value="{{ old('user.address1', $user->address1) }}" class="form-control" required placeholder="市区町村"/>
                            @if ($errors->has('address1'))
                                @foreach ($errors->get('address1') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('address2') ? 'has-error' : '' }}">
                        <label for="user-address2" class="control-label col-md-3">
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="user-address2" name="user[address2]" value="{{ old('user.address2', $user->address2) }}" class="form-control" required placeholder="番地・ビル名"/>
                            @if ($errors->has('address2'))
                                @foreach ($errors->get('address2') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ ($errors->has('tel01')||$errors->has('tel02')||$errors->has('tel03')) ? 'has-error' : '' }}">
                        <label for="user-tel01" class="control-label col-md-3">
                            電話番号
                        </label>
                        <div class="col-md-6 form-inline">
                            <input type="number" id="user-tel01" name="user[tel01]" class="form-control" value="{{ old('user.tel01', !empty($user->tel) ? explode("-", $user->tel)[0] : "") }}" required>
                            -
                            <input type="number" id="user-tel02" name="user[tel02]" class="form-control" value="{{ old('user.tel02', !empty($user->tel) ? explode("-", $user->tel)[1] : "") }}" required>
                            -
                            <input type="number" id="user-tel03" name="user[tel03]" class="form-control" value="{{ old('user.tel03', !empty($user->tel) ? explode("-", $user->tel)[2] : "") }}" required>
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
                        <label for="user-tel01" class="control-label col-md-3">
                            FAX番号
                        </label>
                        <div class="col-md-6 form-inline">
                            <input type="text" id="user-fax01" name="user[fax01]" class="form-control" value="{{ old('user.fax01', !empty($user->fax) ? explode("-", $user->fax)[0] : "") }}">
                            -
                            <input type="text" id="user-fax02" name="user[fax02]" class="form-control" value="{{ old('user.fax02', !empty($user->fax) ? explode("-", $user->fax)[1] : "") }}">
                            -
                            <input type="text" id="user-fax03" name="user[fax03]" class="form-control" value="{{ old('user.fax03', !empty($user->fax) ? explode("-", $user->fax)[2] : "") }}">
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
                        <label for="user-email" class="control-label col-md-3">
                            メールアドレス
                        </label>
                        <div class="col-md-6">
                            <input type="email" id="user-email" name="user[email]" value="{{ old('user.email', $user->email) }}" class="form-control" required placeholder=""/>
                            @if ($errors->has('email'))
                                @foreach ($errors->get('email') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="user-password" class="control-label col-md-3">
                            パスワード
                        </label>
                        <div class="col-md-6">
                            <input type="password" id="user-password" name="user[password]" class="form-control" required placeholder="※6文字以上で入力してください。"/>
                            @if ($errors->has('password'))
                                @foreach ($errors->get('password') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('birthday') ? 'has-error' : '' }}">
                        <label for="user-birthday" class="control-label col-md-3">
                            生年月日
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="user-birthday" name="user[birthday]" value="{{ old('user.birthday', !empty($user->birthday) ? $user->birthday->format('Y-m-d') : '') }}" class="form-control" placeholder=""/>
                            @if ($errors->has('birthday'))
                                @foreach ($errors->get('birthday') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                        <label for="user-gender" class="control-label col-md-3">
                            性別
                        </label>
                        <div class="col-md-6">
                            <select id="user-gender" name="user[gender]" class="form-control">
                                <option value=""></option>
                                @foreach (config('const.gender') as $key => $gender)
                                    <option value="{{ $key }}" {{ old('user.gender', $user->gender) == $key ? "selected" : "" }}>{{ $gender }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('gender'))
                                @foreach ($errors->get('gender') as $error)
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
        <div class="box-footer">
            <a href="{{ url('/admin/users') }}" class="btn btn-sm btn-default">
                <i class="fa fa-chevron-left"></i>
                会員一覧へ戻る
            </a>
        </div>
    </section>

    <script>
        window.onload = function () {
            $('#user-birthday').datepicker({
                format: 'yyyy-mm-dd'
            });

            $('#zip-btn').click(function(){
                AjaxZip3.zip2addr('user[zip01]', 'user[zip02]', 'user[pref_id]', 'user[address1]');
            });
        }
    </script>

@endsection

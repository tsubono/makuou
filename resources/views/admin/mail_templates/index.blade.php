@extends('admin.layouts.default')

@section('title', 'メール設定管理 | 幕王管理画面')

@section('content-header')
    <h1>
        メール設定管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li class="active">メール設定管理</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">メール設定編集</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal" id="form1" action="{{ url('/admin/setting/mail-templates') }}" method="post"
                  data-action="{{ url('/admin/setting/mail-templates') }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <fieldset>
                    <div class="form-group {{ $errors->has('id') ? 'has-error' : '' }}">
                        <label for="mail_template-id" class="control-label col-md-3">
                            テンプレート
                        </label>
                        <div class="col-md-6">
                            <select id="mail_template-id" class="form-control" name="mail_template[id]" required>
                                <option value=""></option>
                                @foreach($mail_templates as $mail_template)
                                    <option value="{{ $mail_template->id }}" {{ old('mail_template.id', $id)==$mail_template->id?"selected":"" }}>
                                        {{ $mail_template->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('id'))
                                @foreach ($errors->get('id') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="mail_template-title" class="control-label col-md-3">
                            件名
                        </label>
                        <div class="col-md-6">
                            <input type="text" id="mail_template-title" name="mail_template[title]"
                                   value="{{ old('mail_template.title') }}" class="form-control" required
                                   placeholder=""/>
                            @if ($errors->has('title'))
                                @foreach ($errors->get('title') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('header') ? 'has-error' : '' }}">
                        <label for="mail_template-header" class="control-label col-md-3">
                            ヘッダー
                        </label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="mail_template-header" name="mail_template[header]"
                                      rows="8" required>{{ old('mail_template.header') }}</textarea>
                            @if ($errors->has('header'))
                                @foreach ($errors->get('header') as $error)
                                    <div class="text-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('footer') ? 'has-error' : '' }}">
                        <label for="mail_template-footer" class="control-label col-md-3">
                            フッター
                        </label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="mail_template-footer" name="mail_template[footer]"
                                      rows="8" required>{{ old('mail_template.footer') }}</textarea>
                            @if ($errors->has('footer'))
                                @foreach ($errors->get('footer') as $error)
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

            loadData($('[name="mail_template[id]"]').val());
            $('[name="mail_template[id]"]').change(function () {
                loadData($(this).val());
            });

            // メールテンプレート内容をajaxで取得する
            function loadData(id) {
                if (id != "") {
                    $.ajax({
                        type: 'post',
                        data: {
                            'id': id,
                            '_token': '{{csrf_token()}}'
                        },
                        url: '{{ url('/admin/setting/mail-templates/ajaxLoadData') }}'
                    }).done(function (data) {
                        var mail_template = $.parseJSON(data);
                        $('[name="mail_template[title]"]').val(mail_template["title"]);
                        $('[name="mail_template[header]"]').val(mail_template["header"]);
                        $('[name="mail_template[footer]"]').val(mail_template["footer"]);
                        $('#form1').attr('action', $('#form1').data('action') + "/" + mail_template["id"]);
                    }).fail(function (data) {
                        // alert("error!");
                    });
                } else {
                    $('[name="mail_template[title]"]').val("");
                    $('[name="mail_template[header]"]').val("");
                    $('[name="mail_template[footer]"]').val("");
                }
            }
        }
    </script>

@endsection

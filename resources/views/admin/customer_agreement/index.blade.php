@extends('admin.layouts.default')

@section('title', '利用規約管理 | 幕王管理画面')

@section('content-header')
    <h1>
        利用規約管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li class="active">利用規約管理</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">利用規約編集</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal" action="{{ url('/admin/setting/customer-agreement/'. $customer_agreement->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <fieldset>
                    <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                        <label for="customer_agreement-text" class="control-label col-md-1">
                            利用規約
                        </label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="customer_agreement-text" name="customer_agreement[text]" rows="50" required>{{ old('customer_agreement.text', $customer_agreement->text) }}</textarea>
                            @if ($errors->has('text'))
                                @foreach ($errors->get('text') as $error)
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

@endsection

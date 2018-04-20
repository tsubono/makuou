@extends('admin.layouts.default')

@section('title', '会員一覧 | 会員管理 | 幕王管理画面')

@section('content-header')
    <h1>
        会員管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/users') }}">会員管理</a></li>
        <li class="active">会員一覧</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">会員一覧</h3>
            <div class="box-tools">
                <a href="{{ url('/admin/users/create') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i>
                    会員登録
                </a>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>名前</th>
                        <th>メールアドレス</th>
                        <th>更新日</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->updated_at->format('Y年m月d日 h:i:s') }}</td>
                        <td>
                            <a href="{{ url('/admin/users/'. $user->id. '/edit') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i>
                                編集
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#user-{{ $user->id }}-delete-modal">
                                <i class="fa fa-trash"></i>
                                削除
                            </button>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->appends(request()->all())->render() }}
        </div>
    </section>
    @foreach($users as $user)
        <div class="modal fade" id="user-{{ $user->id }}-delete-modal" tabindex="-1" role="dialog" aria-labelledby="user-{{ $user->id }}-delete-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/users/'. $user->id) }}" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="user-{{ $user->id }}-delete-modal-label">
                                <i class="fa fa-trash"></i>
                                {{ $user->name }}削除確認
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

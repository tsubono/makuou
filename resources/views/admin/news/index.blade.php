@extends('admin.layouts.default')

@section('title', '新着情報一覧 | 新着情報管理 | 幕王管理画面')

@section('content-header')
    <h1>
        新着情報管理
        <small>幕王管理画面</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/admin') }}">ホーム</a></li>
        <li><a href="{{ url('/admin/news') }}">新着情報管理</a></li>
        <li class="active">新着情報一覧</li>
    </ol>
@endsection

@section('content')

    <section class="box box-default">
        <div class="box-header">
            <h3 class="box-title">新着情報一覧</h3>
            <div class="box-tools">
                <a href="{{ url('/admin/news/create') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i>
                    新着情報登録
                </a>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>日付</th>
                        <th>タイトル</th>
                        <th>URL</th>
                        <th>更新日</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $new)
                    <tr>
                        <td>{{ $new->date->format('Y年m月d日') }}</td>
                        <td>{{ $new->title }}</td>
                        <td>{{ $new->url }}</td>
                        <td>{{ $new->updated_at->format('Y年m月d日 h:i:s') }}</td>
                        <td>
                            <a href="{{ url('/admin/news/'. $new->id. '/edit') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i>
                                編集
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#new-{{ $new->id }}-delete-modal">
                                <i class="fa fa-trash"></i>
                                削除
                            </button>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $news->appends(request()->all())->render() }}
        </div>
    </section>
    @foreach($news as $new)
        <div class="modal fade" id="new-{{ $new->id }}-delete-modal" tabindex="-1" role="dialog" aria-labelledby="new-{{ $new->id }}-delete-modal-label">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/admin/news/'. $new->id) }}" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="admin-{{ $new->id }}-delete-modal-label">
                                <i class="fa fa-trash"></i>
                                {{ $new->title }}削除確認
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

<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    private $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    /**
     * 新着情報ー一覧
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $news = $this->news->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.news.index', compact('news'));
    }

    /**
     * 新着情報新規作成表示
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.news.create');
    }

    /**
     * 新着情報新規作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->news->create($request->input('new'));

        return redirect()->route('admin.news.index')->with('success', '新着情報を登録しました。');
    }

    /**
     * 親新着情報詳細
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //
    }

    /**
     * 新着情報編集表示
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $new = $this->news->findOrFail($id);

        return view('admin.news.edit', compact('new'));
    }

    /**
     * 新着情報編集
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $news = $this->news->findOrFail($id);
        $news->update($request->input('new'));

        return redirect()->route('admin.news.index')->with('success', '新着情報を更新しました。');
    }

    /**
     * 新着情報削除
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $news = $this->news->findOrFail($id);
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', '新着情報を削除しました。');
    }

}

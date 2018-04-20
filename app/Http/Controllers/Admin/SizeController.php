<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SizeController extends Controller
{
    private $size;

    public function __construct(Size $size)
    {
        $this->size = $size;
    }

    /**
     * サイズー一覧
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sizes = $this->size->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.sizes.index', compact('sizes'));
    }

    /**
     * サイズ新規作成表示
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * サイズ新規作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->size->create($request->input('size'));

        return redirect()->route('admin.sizes.index')->with('success', 'サイズを登録しました。');
    }

    /**
     * 親サイズ詳細
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
     * サイズ編集表示
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        //
    }

    /**
     * サイズ編集
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $size = $this->size->findOrFail($id);
        $size->update($request->input('size'));

        return redirect()->route('admin.sizes.index')->with('success', 'サイズを更新しました。');
    }

    /**
     * サイズ削除
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $size = $this->size->findOrFail($id);
        $size->delete();

        return redirect()->route('admin.sizes.index')->with('success', 'サイズを削除しました。');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clothe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClotheController extends Controller
{
    private $clothe;

    public function __construct(Clothe $clothe)
    {
        $this->clothe = $clothe;
    }

    /**
     * 生地ー一覧
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clothes = $this->clothe->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.clothes.index', compact('clothes'));
    }

    /**
     * 生地新規作成表示
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * 生地新規作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->clothe->create($request->input('clothe'));

        return redirect()->route('admin.clothes.index')->with('success', '生地を登録しました。');
    }

    /**
     * 親生地詳細
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
     * 生地編集表示
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
     * 生地編集
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $clothe = $this->clothe->findOrFail($id);
        $clothe->update($request->input('clothe'));

        return redirect()->route('admin.clothes.index')->with('success', '生地を更新しました。');
    }

    /**
     * 生地削除
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $clothe = $this->clothe->findOrFail($id);
        $clothe->delete();

        return redirect()->route('admin.clothes.index')->with('success', '生地を削除しました。');
    }

}

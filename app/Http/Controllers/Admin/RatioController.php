<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clothe;
use App\Models\Ratio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RatioController extends Controller
{
    private $ratio;

    public function __construct(Ratio $ratio)
    {
        $this->ratio = $ratio;
    }

    /**
     * 比率ー一覧
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ratios = $this->ratio->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.ratios.index', compact('ratios'));
    }

    /**
     * 比率新規作成表示
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * 比率新規作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ratio->create($request->input('ratio'));

        return redirect()->route('admin.ratios.index')->with('success', '比率を登録しました。');
    }

    /**
     * 親比率詳細
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
     * 比率編集表示
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
     * 比率編集
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $ratio = $this->ratio->findOrFail($id);
        $ratio->update($request->input('ratio'));

        return redirect()->route('admin.ratios.index')->with('success', '比率を更新しました。');
    }

    /**
     * 比率削除
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $ratio = $this->ratio->findOrFail($id);
        $ratio->delete();

        return redirect()->route('admin.ratios.index')->with('success', '比率を削除しました。');
    }

}

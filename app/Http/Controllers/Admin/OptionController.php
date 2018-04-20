<?php

namespace App\Http\Controllers\Admin;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OptionController extends Controller
{
    private $option;

    public function __construct(Option $option)
    {
        $this->option = $option;
    }

    /**
     * 仕上げオプションー一覧
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $options = $this->option->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.options.index', compact('options'));
    }

    /**
     * 仕上げオプション新規作成表示
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * 仕上げオプション新規作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->option->create($request->input('option'));

        return redirect()->route('admin.options.index')->with('success', '仕上げオプションを登録しました。');
    }

    /**
     * 親仕上げオプション詳細
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
     * 仕上げオプション編集表示
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
     * 仕上げオプション編集
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $option = $this->option->findOrFail($id);
        $option->update($request->input('option'));

        return redirect()->route('admin.options.index')->with('success', '仕上げオプションを更新しました。');
    }

    /**
     * 仕上げオプション削除
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $option = $this->option->findOrFail($id);
        $option->delete();

        return redirect()->route('admin.options.index')->with('success', '仕上げオプションを削除しました。');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\StampCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class StampCategoryController extends Controller
{
    private $stampCategory;

    public function __construct(StampCategory $stampCategory)
    {
        $this->stampCategory = $stampCategory;
    }

    /**
     * スタンプカテゴリー一覧
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stamp_categories = $this->stampCategory->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.stamp_categories.index', compact('stamp_categories'));
    }

    /**
     * スタンプカテゴリー新規作成表示
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // モーダルのため未使用
//        $stamp_categories = $this->stampCategory->orderBy('created_at', 'desc')->paginate(15);
//
//        return view('admin.stamp_categories.create', compact('stamp_categories'));

        return redirect()->route('admin.stamp-categories.index');
    }

    /**
     * スタンプカテゴリー新規作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $create = $this->getDataForDB($request);
        $this->stampCategory->create($create);

        return redirect()->route('admin.stamp-categories.index')->with('success', 'スタンプカテゴリーを登録しました。');
    }

    /**
     * 親スタンプカテゴリー詳細
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
     * スタンプカテゴリー編集表示
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
//        $stamp_category = $this->stampCategory->findOrFail($id);
//        $stamp_categories = $this->stampCategory->where('id', '<>', $id)->orderBy('created_at', 'desc')->paginate(15);
//
//        return view('admin.stamp_categories.edit', compact('stamp_category','stamp_categories'));
        // モーダルのため未使用
        return redirect()->route('admin.stamp-categories.index');
    }

    /**
     * スタンプカテゴリー編集
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $stamp_category = $this->stampCategory->findOrFail($id);
        $update = $this->getDataForDB($request);
        $stamp_category->update($update);

        return redirect()->route('admin.stamp-categories.index')->with('success', 'スタンプカテゴリーを更新しました。');
    }

    /**
     * スタンプカテゴリー削除
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $stamp_category = $this->stampCategory->findOrFail($id);

        // ファイルたちを削除
        $this->deleteFiles($stamp_category);

        $stamp_category->delete();

        return redirect()->route('admin.stamp-categories.index')->with('success', 'スタンプカテゴリーを削除しました。');
    }

    /**
     * DB保存用データを返す
     *
     * @param  \Illuminate\Http\Request $request
     * @return $res
     */
    protected function getDataForDB($request)
    {

        $res = $request->input('stamp_category');

        // 画像
        if (empty($res["id"]) || $request->hasFile('stamp_category.image') || $res["image_edit"] == "1") {
            $res["image"] = $this->uploadFile($request);
        }

        return $res;
    }

    /**
     * スタンプカテゴリーファイルをアップロードする
     *
     * @param  \Illuminate\Http\Request $request
     * @return $path
     */
    protected function uploadFile($request)
    {
        $path = "";

        if (!empty($request->input('stamp_category.id'))) {
            // 既存ファイルがあれば削除
            $stamp_category = $this->stampCategory->findOrFail($request->input('stamp_category.id'));
            if (!empty($stamp_category->image)) {
                unlink(public_path(). $stamp_category->image);
            }
        }
        if (!empty($request->file('stamp_category.image'))) {
            $file = $request->file('stamp_category.image');
            $datetime = Carbon::now()->format('YmdHis');
            $filename = $datetime . mt_rand() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/stamp_files', $filename);

            $path = "/storage/stamp_files/" . $filename;
        }

        return $path;
    }

    /**
     * 既存のファイルを削除する
     *
     * @param  StampCategory $stamp_category
     */
    protected function deleteFiles($stamp_category) {
        if (!empty($stamp_category->image)) {
            unlink(public_path(). $stamp_category->image);
        }
    }
}

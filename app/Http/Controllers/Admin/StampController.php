<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stamp;
use App\Models\StampCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StampController extends Controller
{
    private $stamp;
    private $stampCategory;

    public function __construct(Stamp $stamp, StampCategory $stampCategory)
    {
        $this->stamp = $stamp;
        $this->stampCategory = $stampCategory;
    }

    /**
     * スタンプ一覧
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stamps = $this->stamp->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.stamps.index', compact('stamps'));
    }

    /**
     * スタンプ新規作成表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // カテゴリー
        $stamp_categories = $this->stampCategory->orderBy('created_at', 'desc')->get();

        return view('admin.stamps.create', compact('stamp_categories'));
    }

    /**
     * スタンプ新規作成
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $create = $this->getDataForDB($request);
        $this->stamp->create($create);

        return redirect()->route('admin.stamps.index')->with('success', 'スタンプを登録しました。');
    }

    /**
     * スタンプ詳細
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //
    }

    /**
     * スタンプ編集表示
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $stamp = $this->stamp->findOrFail($id);

        // カテゴリー
        $stamp_categories = $this->stampCategory->orderBy('created_at', 'desc')->get();

        return view('admin.stamps.edit', compact('stamp', 'stamp_categories'));
    }

    /**
     * スタンプ編集
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $stamp = $this->stamp->findOrFail($id);
        $update = $this->getDataForDB($request);
        $stamp->update($update);

        return redirect()->route('admin.stamps.index')->with('success', 'スタンプを更新しました。');
    }

    /**
     * スタンプ削除
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $stamp = $this->stamp->findOrFail($id);

        // ファイルたちを削除
        $this->deleteFiles($stamp);

        $stamp->delete();

        return redirect()->route('admin.stamps.index')->with('success', 'スタンプを削除しました。');
    }

    /**
     * DB保存用データを返す
     *
     * @param  \Illuminate\Http\Request $request
     * @return $res
     */
    protected function getDataForDB($request)
    {

        $res = $request->input('stamp');

        // 画像
        if (empty($res["id"]) || $request->hasFile('stamp.image') || $res["image_edit"] == "1") {
            $res["image"] = $this->uploadFile($request);
        }

        return $res;
    }

    /**
     * スタンプファイルをアップロードする
     *
     * @param  \Illuminate\Http\Request $request
     * @param  $size
     * @param  $type
     * @return $path
     */
    protected function uploadFile($request)
    {
        $path = "";

        if (!empty($request->input('stamp.id'))) {
            // 既存ファイルがあれば削除
            $stamp = $this->stamp->findOrFail($request->input('stamp.id'));
            if (!empty($stamp->image)) {
                unlink(public_path(). $stamp->image);
            }
        }
        if (!empty($request->file('stamp.image'))) {
            $file = $request->file('stamp.image');
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
     * @param  stamp $stamp
     */
    protected function deleteFiles($stamp) {
        if (!empty($stamp->image)) {
            unlink(public_path(). $stamp->image);
        }
    }

}

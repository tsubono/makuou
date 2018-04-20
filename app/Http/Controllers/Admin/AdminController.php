<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    private $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    /**
     * 管理スタッフ一覧
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admins = $this->admin->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.admins.index', compact('admins'));
    }

    /**
     * 管理スタッフ新規作成表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.admins.create', []);
    }

    /**
     * 管理スタッフ新規作成
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->input('admin'), $this->getRules(), $this->getMessages());

        if ($validator->fails()) {
            return redirect()->route('admin.admins.create')
                ->withErrors($validator)
                ->withInput();
        }

        $this->admin->create($request->input('admin'));

        return redirect()->route('admin.admins.index')->with('success', '管理スタッフを登録しました。');
    }

    /**
     * 管理スタッフ詳細
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
     * 管理スタッフ編集表示
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $admin = $this->admin->findOrFail($id);

        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * 管理スタッフ編集
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $admin = $this->admin->findOrFail($id);
        $validator = Validator::make($request->input('admin'), $this->getRules($admin->id), $this->getMessages());

        if ($validator->fails()) {
            return redirect()->route('admin.admins.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $admin->update($request->input('admin'));

        return redirect()->route('admin.admins.index')->with('success', '管理スタッフを更新しました。');
    }

    /**
     * 管理スタッフ削除
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $admin = $this->admin->findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', '管理スタッフを削除しました。');
    }

    private function getRules($ignoreId = null) {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('admins')->ignore($ignoreId)->whereNull('deleted_at'),
            ],
            'password' => 'required|min:6',
        ];
    }

    private function getMessages() {
        return [
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスを正しく入力してください。',
            'email.max' => 'メールアドレスを255文字以内で入力してください。',
            'email.unique' => '既に使用されているメールアドレスです。',
            'password.required' => 'パスワードを入力してください。',
            'password.min' => 'パスワードを6文字以上で入力してください。',
        ];
    }
}

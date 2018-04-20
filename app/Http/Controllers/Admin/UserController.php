<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use App\Models\Order;
use App\Models\OrderDetail;
class UserController extends Controller
{
    private $user;
    private $order;
    private $orderService;

    public function __construct(User $user, Order $order, OrderService $orderService)
    {
        $this->user = $user;
        $this->order = $order;
        $this->orderService = $orderService;
    }

    /**
     * 会員一覧
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->user->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * 会員新規作成表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.users.create', []);
    }

    /**
     * 会員新規作成
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->input('user'), $this->getRules(), $this->getMessages());

        if ($validator->fails()) {
            return redirect()->route('admin.users.create')
                ->withErrors($validator)
                ->withInput();
        }

        $create = $this->getDataForDB($request);

        $this->user->create($create);

        return redirect()->route('admin.users.index')->with('success', '会員を登録しました。');
    }

    /**
     * 会員詳細
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
     * 会員編集表示
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $user = $this->user->findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * 会員編集
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $user = $this->user->findOrFail($id);
        $validator = Validator::make($request->input('user'), $this->getRules($user->id), $this->getMessages());

        if ($validator->fails()) {
            return redirect()->route('admin.users.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $update = $this->getDataForDB($request);

        $user->update($update);

        return redirect()->route('admin.users.index')->with('success', '会員を更新しました。');
    }

    /**
     * 会員削除
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user = $this->user->findOrFail($id);
        $user->delete();

        // 受注関連情報を削除
        $orders = $this->order->where('user_id', $id)->get();
        foreach ($orders as $order) {
            if (!empty($order)) {
                $this->orderService->delete($order->id);
            }
        }

        return redirect()->route('admin.users.index')->with('success', '会員を削除しました。');
    }

    /**
     * DB保存用データを返す
     *
     * @param  \Illuminate\Http\Request $request
     * @return $res
     */
    protected function getDataForDB($request)
    {

        $res = $request->input('user');

        // 郵便番号
        $res["zip_code"] = $res["zip01"]. "-". $res["zip02"];
        // 電話番号
        $res["tel"] = $res["tel01"]. "-". $res["tel02"]. "-". $res["tel03"];
        // fax番号
        if (!empty($res["fax01"]) && !empty($res["fax02"]) && !empty($res["fax03"])) {
            $res["fax"] = $res["fax01"] . "-" . $res["fax02"] . "-" . $res["fax03"];
        }
        return $res;
    }

    private function getRules($ignoreId = null) {
        return [
            'name_kana' => 'regex:/[ァ-ヶ]/u',
            'zip01' => 'digits:3',
            'zip02' => 'digits:4',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($ignoreId)->whereNull('deleted_at'),
            ],
            'password' => 'required|min:6',
        ];
    }

    private function getMessages() {
        return [
            'name_kana.regex' => '全角カタカナで入力してください。',
            'zip01.digits' => '3文字で入力してください。',
            'zip02.digits' => '4文字で入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスを正しく入力してください。',
            'email.max' => 'メールアドレスを255文字以内で入力してください。',
            'email.unique' => '既に使用されているメールアドレスです。',
            'password.required' => 'パスワードを入力してください。',
            'password.min' => 'パスワードを6文字以上で入力してください。',
        ];
    }

    /**
     *会員一覧検索(ajax)
     *
     * @param  \Illuminate\Http\Request $request
     * @return $viewStr
     */
    public function ajaxSearchList(Request $request) {

        $search = $request->get('search');

        if (!empty($search)) {
            $users = $this->user
                ->where('id', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('name_kana', 'LIKE', "%{$search}%")
                ->get();
        } else {
            $users = $this->user->all();
        }

        $viewStr = View::make('admin.orders.searched_users')->with('users', $users)->render();
        echo $viewStr;
    }
    /**
     *会員検索(ajax)
     *
     * @param  \Illuminate\Http\Request $request
     * @return $user
     */
    public function ajaxSearch(Request $request) {

        $id = $request->get('id');
        $user = $this->user->findOrFail($id);

        echo json_encode($user);
    }
}

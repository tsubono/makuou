<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Payment;
use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class OrderController extends Controller
{
    private $order;
    private $payment;
    private $orderService;

    public function __construct(Order $order, Payment $payment, OrderService $orderService)
    {
        $this->order = $order;
        $this->payment = $payment;
        $this->orderService = $orderService;
    }

    /**
     * 受注一覧
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = $this->order->whereNotNull('status')->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * 受注新規作成表示
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $payments = $this->payment->all();
        $error_type = session('error_type', '');
        $request->session()->forget('error_type');

        return view('admin.orders.create', compact('payments', 'error_type'));
    }

    /**
     * 受注新規作成
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->input('user');
        $order = $request->input('order');
        $order_details = $request->input('order_details');
        $order_shipping_address = $request->input('order_shipping_address');

        // 注文者情報バリデーション
        if (!empty($user["id"])) {
            unset($user["password"]);
        }
        $validator = Validator::make($user, $this->getUserRules($user['id']), $this->getUserMessages());
        if ($validator->fails()) {
            session(['error_type' => 'user']);
            return redirect()->route('admin.orders.create')
                ->withErrors($validator)
                ->withInput();
        }
        // 受注配送先情報バリデーション
        $validator = Validator::make($order_shipping_address, $this->getOrderShippingAddressRules(), $this->getOrderShippingAddressMessages());
        if ($validator->fails()) {
            session(['error_type' => 'order_shipping_address']);
            return redirect()->route('admin.orders.create')
                ->withErrors($validator)
                ->withInput();
        }

        // 更新処理
        $this->orderService->create($user, $order, $order_details, $order_shipping_address);

        return redirect()->route('admin.orders.index')->with('success', '受注情報を登録しました。');
    }

    public function ajaxValidation(Request $request) {

        $res = true;
        $params = array();
        parse_str($request->get('data'), $params);

        $user = $params['user'];
        $order_shipping_address = $params['order_shipping_address'];

        // 注文者情報バリデーション
        if (!empty($user["id"])) {
            unset($user["password"]);
        }
        $validator = Validator::make($user, $this->getUserRules($user['id']), $this->getUserMessages());
        if ($validator->fails()) {
            $res = false;
        }
        // 受注配送先情報バリデーション
        $validator = Validator::make($order_shipping_address, $this->getOrderShippingAddressRules(), $this->getOrderShippingAddressMessages());
        if ($validator->fails()) {
            $res = false;
        }

        echo json_encode(['status' => $res]);
    }

    /**
     * 受注詳細
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
     * 受注編集表示
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $order = $this->order->findOrFail($id);
        $payments = $this->payment->all();
        $error_type = session('error_type', '');
        $request->session()->forget('error_type');

        return view('admin.orders.edit', compact('order', 'payments', 'error_type'));
    }

    /**
     * 受注編集
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $user = $request->input('user');
        $order = $request->input('order');
        $order_details = $request->input('order_details');
        $order_shipping_address = $request->input('order_shipping_address');
        $deleted_order_detail_ids = $request->input('deleted_order_detail_ids');

        // 注文者情報バリデーション
        if (!empty($user["id"])) {
            unset($user["password"]);
        }
        $validator = Validator::make($user, $this->getUserRules($user['id']), $this->getUserMessages());
        if ($validator->fails()) {
            session(['error_type' => 'user']);
            return redirect()->route('admin.orders.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }
        // 受注配送先情報バリデーション
        $validator = Validator::make($order_shipping_address, $this->getOrderShippingAddressRules(), $this->getOrderShippingAddressMessages());
        if ($validator->fails()) {
            session(['error_type' => 'order_shipping_address']);
            return redirect()->route('admin.orders.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        // 更新処理
        $this->orderService->update($user, $order, $order_details, $order_shipping_address, $deleted_order_detail_ids);

        return redirect()->route('admin.orders.index')->with('success', '受注情報を更新しました。');
    }

    /**
     * 受注削除
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $this->orderService->delete($id);
        return redirect()->route('admin.orders.index')->with('success', '受注情報を削除しました。');
    }

    public function saveDesign(Request $request) {

        $filename = "";
        $post_data_svg = json_decode($request->get('objects_svg'), true);
        // $post_data_jpg = json_decode($request->get('objects_jpg'), true);

        foreach ($post_data_svg as $key => $value) {
            if (!empty($value) && $value != null) {
                if (!file_exists(public_path() . '/storage/saved_designs')) {
                    mkdir(public_path() . '/storage/saved_designs');
                }
                if (!file_exists(public_path() . '/storage/saved_designs/svg')) {
                    mkdir(public_path() . '/storage/saved_designs/svg/');
                }

                $destination = public_path() . "/storage/saved_designs/svg/";
                $filename = $request->get('name') . '.svg';
                $content = file_get_contents($value);

                file_put_contents($destination . $filename, $content);
            }
        }

        echo json_encode([
            'filename' => $filename,
            'designed_image' => "/storage/saved_designs/svg/".$filename
        ]);

    }

    /**
     * バリデーション関連
     */
    private function getOrderShippingAddressRules($ignoreId = null)
    {
        return [
            'name_kana' => 'regex:/[ァ-ヶ]/u',
            'zip01' => 'digits:3',
            'zip02' => 'digits:4',
        ];
    }

    private function getOrderShippingAddressMessages()
    {
        return [
            'name_kana.regex' => '全角カタカナで入力してください。',
            'zip01.digits' => '3文字で入力してください。',
            'zip02.digits' => '4文字で入力してください。',
        ];
    }

    private function getUserRules($ignoreId = null)
    {
        return [
            'name_kana' => 'regex:/[ァ-ヶ]/u',
            'zip01' => 'digits:3',
            'zip02' => 'digits:4',
            'email' => [
                'email',
                'max:255',
                Rule::unique('users')->ignore($ignoreId)->whereNull('deleted_at'),
            ],
            'password' => 'min:6',
        ];
    }

    private function getUserMessages()
    {
        return [
            'name_kana.regex' => '全角カタカナで入力してください。',
            'zip01.digits' => '3文字で入力してください。',
            'zip02.digits' => '4文字で入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスを正しく入力してください。',
            'email.max' => 'メールアドレスを255文字以内で入力してください。',
            'email.unique' => '既に使用されているメールアドレスです。',
            'password.min' => 'パスワードを6文字以上で入力してください。',
        ];
    }
}

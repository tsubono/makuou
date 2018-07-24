<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use App\Models\Payment;
use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
     * 受注情報入力画面
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $order = $request->input('order', []);
        $order_detail = $request->input('order_detail', []);
        $user = Auth::user();

        return view('front.order.index', compact('order', 'order_detail', 'user'));
    }

    /**
     * 決済
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function payment(Request $request)
    {
        $user = $request->input('user');
        $order = $request->input('order');
        $order_details = $request->input('order_details');
        $order_shipping_address = $request->input('order_shipping_address');


        // 受注配送先情報バリデーション
        $validator = Validator::make($order_shipping_address, $this->getOrderShippingAddressRules(), $this->getOrderShippingAddressMessages());
        if ($validator->fails()) {
            return redirect('/order')
                ->withErrors($validator)
                ->withInput();
        }

        // 更新処理
        // $this->orderService->create($user, $order, $order_details, $order_shipping_address);
        return view('front.order.payment', compact('order', 'order_detail', 'user'));
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
}

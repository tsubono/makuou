<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    private $product;
    private $user;
    private $order;
    private $orderDetail;

    public function __construct(Product $product, User $user, Order $order, OrderDetail $orderDetail)
    {
        $this->product = $product;
        $this->user = $user;
        $this->order = $order;
        $this->orderDetail = $orderDetail;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * レイアウト画面
     *
     */
    public function index($id)
    {
        $product = $this->product->findOrFail($id);
        $layoutFlg = true;

        // 再購入の場合
        $designed_json = session('designed_json', '');
        session()->forget('designed_json');

        return view('front.layout.index', compact('product', 'layoutFlg', 'designed_json'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * デザイン確認
     *
     */
    public function confirm(Request $request)
    {
        $order = $request->input('order', []);
        $order_detail = $request->input('order_detail', []);

        return view('front.layout.confirm', compact('order', 'order_detail'));
    }

    /**
     * @param Request $request
     *
     * 仕様を決める
     *
     */
    public function spec(Request $request)
    {
        $preSaveFlg = $request->input('preSaveFlg', NULL);
        $order = $request->input('order', []);
        $order_detail = $request->input('order_detail', []);

        // デザインを保存する（注文には進まない）
        if (!empty($preSaveFlg)) {
            // Order登録
            $created_order = $this->order->create($order);
            $order_detail['order_id'] = $created_order->id;

            $this->saveOrderDetail($created_order, $order_detail);

            return redirect('/save');

        // 仕様を決める
        } else {
            return view('front.layout.spec', compact('order', 'order_detail'));
        }
    }

    public function saveOrderDetail($order, $form_order_detail) {
        // アップロードされた写真
        $uploaded_files = explode(",", $form_order_detail['uploaded_files']);

        // 更新の場合
        if (!empty($form_order_detail["id"])) {
            $order_detail = OrderDetail::findOrFail($form_order_detail["id"]);
            $before_uploaded_files = explode(",", $order_detail->uploaded_files);
            $uploaded_files = array_merge($uploaded_files, $before_uploaded_files);
            // 新規追加の場合
        } else {
            $order_detail = new OrderDetail();
        }
        // 空白がある場合削除する
        $uploaded_files = array_unique($uploaded_files);
        $uploaded_files = array_filter($uploaded_files, "strlen");
        $uploaded_files = array_values($uploaded_files);

        // canvasにアップロードされた写真一覧をsavedに移動する
        foreach ($uploaded_files as $uploaded_file) {
            if(!empty($uploaded_file)) {
                if (file_exists(public_path() . '/storage/upload/tmp/' . $uploaded_file)) {
                    if (!file_exists(public_path() . '/storage/upload/saved')) {
                        mkdir(public_path() . '/storage/upload/saved');
                    }
                    if (file_exists(public_path() . '/storage/upload/tmp/' . $uploaded_file)) {
                        rename(public_path() . '/storage/upload/tmp/' . $uploaded_file,
                            public_path() . '/storage/upload/saved/' . $uploaded_file);
                    }
                }
            }
        }

        $form_order_detail['uploaded_files'] = implode( ",", $uploaded_files);

        // jsonファイル書き出し
        if (!file_exists(public_path() . '/storage/saved_designs/json')) {
            mkdir(public_path() . '/storage/saved_designs/json');
        }
        if (!file_exists(public_path() . '/storage/saved_designs/json/'. $order->user_id)) {
            mkdir(public_path() . '/storage/saved_designs/json/'. $order->user_id);
        }


        \File::put(public_path(). "/storage/saved_designs/json/".$order->user_id. '/'.  $form_order_detail['designed_filename']. ".json", $form_order_detail['json']);

        $form_order_detail['designed_json'] = "/storage/saved_designs/json/". $order->user_id. '/'. $form_order_detail['designed_filename']. ".json";
        if (!empty($form_order_detail["option_ids"])) {
            $form_order_detail["option_ids"] = implode(',', $form_order_detail["option_ids"]);
        }

        $order_detail->fill($form_order_detail)->save();
    }

    public function getPreSaveDatas(Request $request) {

        $filename = "";
        $post_data_svg = json_decode($request->get('objects_svg'), true);

        foreach ($post_data_svg as $key => $value) {
            if (!empty($value) && $value != null) {
                if (!file_exists(public_path() . '/storage/saved_designs')) {
                    mkdir(public_path() . '/storage/saved_designs');
                }
                if (!file_exists(public_path() . '/storage/saved_designs/svg')) {
                    mkdir(public_path() . '/storage/saved_designs/svg');
                }
                if (!file_exists(public_path() . '/storage/saved_designs/svg/'. $request->get('user_id'))) {
                    mkdir(public_path() . '/storage/saved_designs/svg/'. $request->get('user_id'));
                }

                $destination = public_path() . "/storage/saved_designs/svg/". $request->get('user_id'). '/';
                $filename = $request->get('name') . '.svg';
                $content = file_get_contents($value);

                file_put_contents($destination . $filename, $content);
            }
        }

        echo json_encode([
            'filename' => $filename,
            'designed_image' => "/storage/saved_designs/svg/". $request->get('user_id') . '/'. $filename
        ]);

    }

    /**
     * @param Request $request
     *
     * 最終確認画面
     *
     */
    public function confirm2(Request $request) {

        $order = $request->input('order', []);
        $order_detail = $request->input('order_detail', []);
        $product = $this->product->findOrFail($order_detail['product_id']);

        return view('front.layout.confirm2', compact('order', 'order_detail', 'product'));

    }

    /**
     * @param Request $request
     *
     * TODO:決済へ
     */
    public function postComplete(Request $request) {

    }


}

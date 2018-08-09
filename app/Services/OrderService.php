<?php

namespace App\Services;


use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderShippingAddress;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderService
{
    private $user;
    private $order;
    private $orderDetail;
    private $orderShippingAddress;

    function __construct(User $user, Order $order, OrderDetail $orderDetail, OrderShippingAddress $orderShippingAddress) {
        $this->user = $user;
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->orderShippingAddress = $orderShippingAddress;
    }

    /**
     * 受注作成
     */
    public function create($form_user, $form_order, $form_order_details, $form_order_shipping_address) {
        $form_user = $this->getFormatDataForDB($form_user);
        $form_order_shipping_address = $this->getFormatDataForDB($form_order_shipping_address);
        $form_order = $this->getOrderDataForDB($form_order);
        $form_order["ordered_at"] = Carbon::now();

        // 注文者情報更新
        if (!empty($form_user['id'])) {
            $user = $this->user->findOrFail($form_user['id']);
            $user->update($form_user);
        } else {
            $user = $this->user->create($form_user);
        }

        // 受注配送先情報更新
        $order_shipping_address = $this->orderShippingAddress->create($form_order_shipping_address);
        // 受注情報更新
        $form_order['user_id'] = $user->id;
        $form_order['order_shipping_address_id'] = $order_shipping_address->id;
        $order = $this->order->create($form_order);

        // 受注詳細情報更新
        foreach ($form_order_details as $form_order_detail) {
            $form_order_detail["order_id"] = $order->id;
            // canvasにアップロードされた写真一覧をsavedに移動する
            $uploaded_files = explode(",", $form_order_detail['uploaded_files']);
            foreach ($uploaded_files as $uploaded_file) {
                if(!empty($uploaded_file)) {
                    if (file_exists(public_path() . '/storage/upload/tmp/' . $uploaded_file)) {
                        if (!file_exists(public_path() . '/storage/upload/saved')) {
                            mkdir(public_path() . '/storage/upload/saved');
                        }
                        rename(public_path() . '/storage/upload/tmp/' . $uploaded_file,
                            public_path() . '/storage/upload/saved/' . $uploaded_file);
                    }
                }
            }
            // jsonファイル書き出し
            if (!file_exists(public_path() . '/storage/saved_designs/json')) {
                mkdir(public_path() . '/storage/saved_designs/json');
            }
            \File::put(public_path(). "/storage/saved_designs/json/". $form_order_detail['designed_filename']. ".json", $form_order_detail['json']);

            $form_order_detail['designed_json'] = "/storage/saved_designs/json/". $form_order_detail['designed_filename']. ".json";
            if (!empty($form_order_detail["option_ids"])) {
                $form_order_detail["option_ids"] = implode(',', $form_order_detail["option_ids"]);
            }
            $this->orderDetail->create($form_order_detail);
        }
    }

    /**
     * 受注更新
     */
    public function update($form_user, $form_order, $form_order_details, $form_order_shipping_address, $form_deleted_order_detail_ids) {

        $form_user = $this->getFormatDataForDB($form_user);
        $form_order_shipping_address = $this->getFormatDataForDB($form_order_shipping_address);
        $form_order = $this->getOrderDataForDB($form_order);

        // 注文者情報更新
        if (!empty($form_user['id'])) {
            $user = $this->user->findOrFail($form_user['id']);
            $user->update($form_user);
        } else {
            $user = $this->user->create($form_user);
        }

        $order = $this->order->findOrFail($form_order["id"]);

        // 受注配送先情報更新
        $order_shipping_address = $this->orderShippingAddress->findOrFail($order->order_shipping_address_id);
        $order_shipping_address->update($form_order_shipping_address);

        // 受注情報更新
        $form_order['user_id'] = $user->id;
        $order->update($form_order);

        // 受注詳細情報更新
        foreach ($order->order_details as $order_detail) {
            // 前回のデザイン画像を削除
            if (!empty($order_detail->designed_image) && file_exists(public_path(). $order_detail->designed_image)) {
                unlink(public_path(). $order_detail->designed_image);
            }
            if (!empty($order_detail->designed_json) && file_exists(public_path(). $order_detail->designed_json)) {
                unlink(public_path(). $order_detail->designed_json);
            }

            // 商品削除がある場合
            if (!empty($form_deleted_order_detail_ids)) {
                $form_deleted_order_detail_ids_array = explode(",", $form_deleted_order_detail_ids);
                if (in_array($order_detail->id, $form_deleted_order_detail_ids_array)) {
                    // アップロードされた写真を削除
                    $deleted_uploaded_files = explode(",", $order_detail->uploaded_files);
                    foreach ($deleted_uploaded_files as $deleted_uploaded_file) {
                        if(!empty($deleted_uploaded_file)) {
                            if (file_exists(public_path(). "/storage/upload/saved/". $deleted_uploaded_file)) {
                                unlink(public_path(). "/storage/upload/saved/". $deleted_uploaded_file);
                            }
                        }
                    }
                    //レコード削除
                    $order_detail->delete();
                }
            }
        }

        foreach ($form_order_details as $form_order_detail) {
            // アップロードされた写真
            $uploaded_files = explode(",", $form_order_detail['uploaded_files']);

            // 更新の場合
            if (!empty($form_order_detail["id"])) {
                $order_detail = OrderDetail::findOrFail($form_order_detail["id"]);
                $before_uploaded_files = explode(",", $order_detail->uploaded_files);
                $uploaded_files = array_merge($uploaded_files, $before_uploaded_files);
            // 新規追加の場合
            } else {
                $form_order_detail["order_id"] = $order->id;
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

            \File::put(public_path(). "/storage/saved_designs/json/". $form_order_detail['designed_filename']. ".json", $form_order_detail['json']);

            $form_order_detail['designed_json'] = "/storage/saved_designs/json/". $form_order_detail['designed_filename']. ".json";
            if (!empty($form_order_detail["option_ids"])) {
                $form_order_detail["option_ids"] = implode(',', $form_order_detail["option_ids"]);
            }

            // $this->orderDetail->create($form_order_detail);
            $order_detail->fill($form_order_detail)->save();
        }
    }

    /**
     * 受注削除
     */
    public function delete($order_id)
    {
        $order = $this->order->findOrFail($order_id);

        // 受注詳細情報削除
        foreach ($order->order_details as $order_detail) {
            $order_detail->delete();
        }

        if (!empty($order->order_shipping_address_id)) {
            $order_shipping_address = $this->orderShippingAddress->findOrFail($order->order_shipping_address_id);
            // 受注配送先情報削除
            $order_shipping_address->delete();
        }

        // 受注情報削除
        $order->delete();

    }

    /**
     * 受注情報のDB保存用データを返す
     */
    public function getOrderDataForDB($data)
    {
        $now = Carbon::now();
        switch(Config('const.order.status')[$data['status']]) {
            case "新規受付":
                $data["ordered_at"] = $now;
//                $data["payment_at"] = NULL;
//                $data["shipping_at"] = NULL;
                break;
            case "決済処理中":
                // $res["ordered_at"] = $now;
//                $data["payment_at"] = NULL;
//                $data["shipping_at"] = NULL;
                break;
            case "入金待ち":
                // $res["ordered_at"] = $now;
//                $data["payment_at"] = NULL;
//                $data["shipping_at"] = NULL;
                break;
            case "入金済み":
                // $res["ordered_at"] = $now;
//                $data["payment_at"] = $now;
//                $data["shipping_at"] = NULL;
                break;
            case "キャンセル":
                // $data["ordered_at"] = $now;
//                $data["payment_at"] = NULL;
//                $data["shipping_at"] = NULL;
                break;
            case "取り寄せ中":
                // $data["ordered_at"] = $now;
                // $data["payment_at"] = $now;
                // $data["shipping_at"] = NULL;
                break;
            case "発送済み":
                // $data["ordered_at"] = $now;
                // $data["payment_at"] = $now;
                // $data["shipping_at"] = $now;
                break;

        }

        return $data;
    }

    /**
     * DB用の整形データを返す
     */
    public function getFormatDataForDB($data)
    {
        // 郵便番号
        if (!empty($data["zip01"]) && !empty($data["zip02"])) {
            $data["zip_code"] = $data["zip01"] . "-" . $data["zip02"];
        }
        // 電話番号
        if (!empty($data["tel01"]) && !empty($data["tel02"]) && !empty($data["tel03"])) {
            $data["tel"] = $data["tel01"] . "-" . $data["tel02"] . "-" . $data["tel03"];
        }
        // fax番号
        if (!empty($data["fax01"]) && !empty($data["fax02"]) && !empty($data["fax03"])) {
            $data["fax"] = $data["fax01"] . "-" . $data["fax02"] . "-" . $data["fax03"];
        }

        return $data;
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderShippingAddress;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CancelController extends Controller
{
    public function index()
    {
        return view('front.cancel.index');
    }

    public function complete()
    {

        $id = Auth::id();

        DB::beginTransaction();
        try {

            //Orders取得
            $orders = Order::where('user_id',$id)->get();

            //orderテーブルの相関テーブルの該当レコードを削除
            foreach ($orders as $order){
                OrderDetail::where('order_id',$order->id)->delete();
            }

            //order_shipping_addressesテーブルの該当コード削除
            OrderShippingAddress::destroy($id);

            //ユーザ削除
            User::destroy($id);
            DB::commit();
            return view('front.cancel.complete');

        } catch (\Exception $e) {
            DB::rollBack();
            return view('front.cancel.index');
        }

    }
}

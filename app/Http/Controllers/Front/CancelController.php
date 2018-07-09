<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CancelController extends Controller
{

    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        return view('front.cancel.index');
    }

    public function complete(Request $request)
    {

        $id = Auth::id();

        DB::beginTransaction();
        try {

            // 受注関連情報を削除
            $orders = Order::where('user_id',$id)->get();
            info($orders);
            foreach ($orders as $order) {
                if (!empty($order)) {
                    $this->orderService->delete($order->id);
                }
            }

            //ユーザ削除
            Auth::logout();
            User::destroy($id);
            DB::commit();
            $request->session()->regenerate();
            return view('front.cancel.complete');

        } catch (\Exception $e) {
            DB::rollBack();
            info($e);
            return view('front.cancel.index');
        }

    }
}

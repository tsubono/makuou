<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaveController extends Controller
{
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index(){

        $orders = $this->order->where('user_id', auth()->user()->id)->whereNull('status')->paginate(15);
        return view('front.save', compact('orders'));
    }
}

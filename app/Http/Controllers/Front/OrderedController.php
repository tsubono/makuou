<?php


namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;
use App\Services\PrintReceiptService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class OrderedController extends Controller
{

    private $order;
    private $orderService;
    private $printReceiptService;

    public function __construct(Order $order, OrderService $orderService, PrintReceiptService $printReceiptService)
    {
        $this->order = $order;
        $this->orderService = $orderService;
        $this->printReceiptService = $printReceiptService;
    }

    public function index()
    {
        $orders = $this->order->where('user_id', auth()->user()->id)->whereNotNull('status')->get();
        return view('front.ordered', compact('orders'));
    }

    public function download(Request $request) {
        $order = $this->order->findOrFail($request->input('id'));
        $type = $request->input('type');

        $path = $this->printReceiptService->printReceipt('./tmp/sample.xlsx', $order, 0.08, $type);

        $headers = ['Content-Type' => 'application/vnd.ms-excel'];
        return Response::download($path , basename($path), $headers);
    }

    public function reorder(Request $request) {

        $order = $this->order->findOrFail($request->input('id'));


    }
}

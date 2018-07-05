<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $product = $this->product->findOrFail($id);
        $layoutFlg = true;
        return view('front.layout.index', compact('product', 'layoutFlg'));
    }

    public function confirm(Request $request)
    {
        $product = $this->product->findOrFail($request->get('id'));

        return view('front.layout.confirm', compact('product', 'layoutFlg'));
    }

    public function postComplete(Request $request)
    {
    }

    public function getComplete()
    {
        return view('front.layout.complete');
    }
}

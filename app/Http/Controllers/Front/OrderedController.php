<?php


namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class OrderedController extends Controller
{
    public function index()
    {
        return view('front.ordered');
    }
}

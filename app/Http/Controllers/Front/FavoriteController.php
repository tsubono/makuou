<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{

    public function __construct()
    {
    }

    public function index(){

        return view('front.favorite');
    }
}

<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{	
	/**
	 * 展示我的订单页面
	 */
    public function Index()
    {
    	return view('home/my_order');
    }
}

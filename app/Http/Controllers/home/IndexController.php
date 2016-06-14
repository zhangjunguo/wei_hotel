<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{	
	/**
	 * 展示格子首页
	 */
    public function Index()
    {
    	return view('home/index');
    }
}

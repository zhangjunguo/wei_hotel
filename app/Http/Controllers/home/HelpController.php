<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;

class HelpController extends Controller
{	
	/**
	 * 展示帮助页面
	 */
    public function Index()
    {
    	return view('home/help');
    }
}

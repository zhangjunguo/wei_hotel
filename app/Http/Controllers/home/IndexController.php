<?php

namespace App\Http\Controllers\home;

use DB;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{	
	/**
	 * 展示格子首页
	 */
    public function Index()
    {
    	$arr = DB::table('hotel')->take(5)->get();
    	//print_r($arr);die;
    	return view('home/index')->with('arr', $arr);
    }
}

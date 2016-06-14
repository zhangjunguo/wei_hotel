<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;

class GiftController extends Controller
{	
	/**
	 * 展示礼物列表页面
	 */
    public function Index()
    {
    	return view('home/GiftList');
    }

    /**
	 * 展示礼物详情页面
	 */
    public function GiftInfo()
    {
    	return view('home/gift');
    }
}

<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;

class HotelController extends Controller
{	
	/**
	 * 展示酒店列表页面
	 */
    public function Index()
    {
    	return view('home/CityList');
    }

    /**
	 * 展示酒店详情页面
	 */
    public function HotelInfo()
    {
    	return view('home/Hotel');
    }

    /**
     * 展示酒店评论页面
     */
    public function HotelReview()
    {
        return view('home/HotelReview');
    }

     /**
     * 展示酒店简介页面  
     */
    public function HotelDesc()
    {
        return view('home/HotelInfo');
    }

    /**
     * 前台酒店列表
     */
    public function HotelList()
    {
        return view('home/HotelList');
    }
}

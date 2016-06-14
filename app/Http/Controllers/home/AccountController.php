<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;

class AccountController extends Controller
{	
	/**
	 * 展示我的格子
	 */
    public function Index()
    {
    	return view('home/user_account');
    }

    /**
     * 展示我的礼物
     */
    public function MyGift()
    {
    	return view('home/my_gift');
    }

    /**
     * 展示我的订单
     */
    public function MyOrder()
    {
    	return view('home/my_order');
    }

     /**
     * 展示我的信息
     */
    public function MyInfo()
    {
    	return view('home/my_list');
    }

    /**
     * 展示我的收藏
     */
    public function MyCollection()
    {
        return view('home/my_Collection');
    }
}

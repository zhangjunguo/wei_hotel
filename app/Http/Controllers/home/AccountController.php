<?php

namespace App\Http\Controllers\home;

use DB,Session,Request;
use App\Http\Controllers\Controller;


class AccountController extends Controller
{	
	/**
	 * 展示我的格子
	 */
    public function Index()

    {

        $user_name = Session::get('user_name');
        
        if(!empty($user_name)){

            //查询用户资料
            $data = DB::table('users')->where('u_id', $user_id)->first();
            return view('home/user_account')->with('data', $data);
        }else{
            return redirect('home/Login');
        }

    }

    /**
     * 展示我的礼物
     */
    public function MyGift()
    {
    	$user_name = Session::get('user_name');

        return view('home/my_gift');
    }

    /**
     * 展示我的订单
     */
    public function MyOrder()
    {   
        $user_name = Session::get('user_name');
        if(!empty($user_name)){
            return view('home/my_order');
        }else{
            return redirect('home/Login');
        }
    	
    }

     /**
     * 展示我的信息
     */
    public function MyInfo()
    {
        $u_id = Session::get('user_id');

        $data = DB::table('users')->where('u_id', $u_id)->first();

    	return view('home/my_list')->with('data', $data);
    }

    /**
     * 展示我的收藏
     */
    public function MyCollection()
    {
        return view('home/my_Collection');
    }
}

<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Request,DB;
class LoginController extends Controller
{	
	/**
	 * 展示登录页面
	 */
    public function Index()
    {
    	return view('home/login');
    }

    /**
     * 展示注册页面
     */
    public function Register()
    {
    	return view('home/register');
    }

    /**
     * 注册
     */
    public function Enroll()
    {
        $mobile_phone = Request::input('mobile_phone');
        $id_card = Request::input('id_card');
        echo $mobile_phone;
    }
}
